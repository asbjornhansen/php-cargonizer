<?php

declare(strict_types=1);

use GuzzleHttp\Psr7\HttpFactory;
use Psr\Http\Client\ClientInterface;
use zaporylie\Cargonizer\CargonizerException;
use zaporylie\Cargonizer\Client;
use zaporylie\Cargonizer\Config;

beforeEach(function (): void {
    Config::set('endpoint', Config::SANDBOX);
    Config::set('secret', 'test-secret');
    Config::set('sender', 'test-sender');
});

// Create a concrete implementation for testing abstract Client
class TestClient extends Client
{
    protected $resource = '/test.xml';

    protected $method = 'GET';

    public function makeRequest(array $headers = [], $data = null): \SimpleXMLElement|false
    {
        return $this->request($headers, $data);
    }

    public function getResourcePublic(): string
    {
        return $this->getResource();
    }

    public function getMethodPublic(): string
    {
        return $this->getMetod();
    }
}

test('client can be instantiated', function (): void {
    $client = new TestClient;
    expect($client)->toBeInstanceOf(Client::class);
});

test('client adds authentication headers', function (): void {
    $requestFactory = new HttpFactory;

    $mock = Mockery::mock(ClientInterface::class);
    $mock->shouldReceive('sendRequest')
        ->once()
        ->withArgs(fn ($request): bool => $request->hasHeader('X-Cargonizer-Key') &&
               $request->hasHeader('X-Cargonizer-Sender') &&
               $request->getHeaderLine('X-Cargonizer-Key') === 'test-secret' &&
               $request->getHeaderLine('X-Cargonizer-Sender') === 'test-sender')
        ->andReturn(createMockResponse('<xml/>'));

    $testClient = new TestClient($mock, $requestFactory);
    $testClient->makeRequest();
});

test('client throws CargonizerException on API error', function (): void {
    $errorXml = '<xml><error>API Error Message</error></xml>';
    $client = mockHttpClient($errorXml);
    $requestFactory = new HttpFactory;

    $testClient = new TestClient($client, $requestFactory);
    $testClient->makeRequest();
})->throws(CargonizerException::class, 'API Error Message');

test('client handles 400 status code', function (): void {
    $errorXml = 'Invalid request';
    $client = mockHttpClient($errorXml, 400);
    $requestFactory = new HttpFactory;

    $testClient = new TestClient($client, $requestFactory);
    $testClient->makeRequest();
})->throws(CargonizerException::class);

test('client returns parsed XML on success', function (): void {
    $xmlResponse = '<response><status>success</status></response>';
    $client = mockHttpClient($xmlResponse);
    $requestFactory = new HttpFactory;

    $testClient = new TestClient($client, $requestFactory);
    $result = $testClient->makeRequest();

    expect($result)->toBeInstanceOf(SimpleXMLElement::class);
    expect((string) $result->status)->toBe('success');
});

test('getResource returns resource path', function (): void {
    $testClient = new TestClient;
    expect($testClient->getResourcePublic())->toBe('/test.xml');
});

test('getMetod returns HTTP method', function (): void {
    $testClient = new TestClient;
    expect($testClient->getMethodPublic())->toBe('GET');
});

test('client builds correct URI for GET requests', function (): void {
    $requestFactory = new HttpFactory;

    $mock = Mockery::mock(ClientInterface::class);
    $mock->shouldReceive('sendRequest')
        ->once()
        ->withArgs(function ($request): bool {
            $uri = (string) $request->getUri();

            return str_contains($uri, 'https://sandbox.cargonizer.no/test.xml');
        })
        ->andReturn(createMockResponse('<xml/>'));

    $testClient = new TestClient($mock, $requestFactory);
    $testClient->makeRequest();
});

test('client appends query string for GET requests with data', function (): void {
    $requestFactory = new HttpFactory;

    $mock = Mockery::mock(ClientInterface::class);
    $mock->shouldReceive('sendRequest')
        ->once()
        ->withArgs(function ($request): bool {
            $query = $request->getUri()->getQuery();

            return str_contains($query, 'param1=value1') &&
                   str_contains($query, 'param2=value2');
        })
        ->andReturn(createMockResponse('<xml/>'));

    $testClient = new TestClient($mock, $requestFactory);
    $testClient->makeRequest([], ['param1' => 'value1', 'param2' => 'value2']);
});
