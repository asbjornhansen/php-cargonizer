<?php

declare(strict_types=1);

use GuzzleHttp\Psr7\HttpFactory;
use Psr\Http\Client\ClientInterface;
use zaporylie\Cargonizer\Agreements;
use zaporylie\Cargonizer\Client;
use zaporylie\Cargonizer\Config;
use zaporylie\Cargonizer\Data\TransportAgreements;

beforeEach(function (): void {
    Config::set('endpoint', Config::SANDBOX);
    Config::set('secret', 'test-secret');
    Config::set('sender', 'test-sender');
});

test('can instantiate agreements service', function (): void {
    $agreements = new Agreements;
    expect($agreements)->toBeInstanceOf(Agreements::class);
});

test('agreements extends Client', function (): void {
    $agreements = new Agreements;
    expect($agreements)->toBeInstanceOf(Client::class);
});

test('getAgreements returns TransportAgreements collection', function (): void {
    $xmlResponse = loadFixture('transport_agreements.xml');
    $client = mockHttpClient($xmlResponse);

    $agreements = new Agreements($client);
    $transportAgreements = $agreements->getAgreements();

    expect($transportAgreements)->toBeInstanceOf(TransportAgreements::class);
});

test('getAgreements makes GET request to correct endpoint', function (): void {
    $xmlResponse = loadFixture('transport_agreements.xml');
    $requestFactory = new HttpFactory;

    $mock = Mockery::mock(ClientInterface::class);
    $mock->shouldReceive('sendRequest')
        ->once()
        ->withArgs(fn ($request): bool => $request->getMethod() === 'GET' &&
               str_contains((string) $request->getUri()->getPath(), '/transport_agreements.xml') &&
               $request->hasHeader('X-Cargonizer-Key') &&
               $request->hasHeader('X-Cargonizer-Sender'))
        ->andReturn(createMockResponse($xmlResponse));

    $agreements = new Agreements($mock, $requestFactory);
    $agreements->getAgreements();
});

test('getAgreements parses multiple agreements', function (): void {
    $xmlResponse = loadFixture('transport_agreements.xml');
    $client = mockHttpClient($xmlResponse);

    $agreements = new Agreements($client);
    $transportAgreements = $agreements->getAgreements();

    // TransportAgreements implements Iterator
    $agreementArray = iterator_to_array($transportAgreements);
    expect($agreementArray)->toBeArray();
    expect(count($agreementArray))->toBeGreaterThan(0);
});
