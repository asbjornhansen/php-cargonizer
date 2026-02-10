<?php

declare(strict_types=1);

use Psr\Http\Client\ClientInterface;
use Psr\Http\Message\ResponseInterface;
use Psr\Http\Message\StreamInterface;
use Tests\TestCase;

/*
|--------------------------------------------------------------------------
| Test Case
|--------------------------------------------------------------------------
*/

uses(TestCase::class)->in('Unit', 'Feature');

/*
|--------------------------------------------------------------------------
| Expectations
|--------------------------------------------------------------------------
*/

expect()->extend('toBeValidXml', function () {
    $xml = @simplexml_load_string($this->value);
    expect($xml)->not->toBeFalse('Expected valid XML string');

    return $this;
});

/*
|--------------------------------------------------------------------------
| Functions
|--------------------------------------------------------------------------
*/

/**
 * Create a mock PSR-18 HTTP Client for testing
 */
function mockHttpClient(string $responseBody, int $statusCode = 200): ClientInterface
{
    $mock = Mockery::mock(ResponseInterface::class);
    $mock->shouldReceive('getStatusCode')->andReturn($statusCode);

    $stream = Mockery::mock(StreamInterface::class);
    $stream->shouldReceive('getContents')->andReturn($responseBody);

    $mock->shouldReceive('getBody')->andReturn($stream);

    $client = Mockery::mock(ClientInterface::class);
    $client->shouldReceive('sendRequest')->andReturn($mock);

    return $client;
}

/**
 * Load XML fixture from tests/Fixtures/ directory
 */
function loadFixture(string $filename): string
{
    $path = __DIR__.'/Fixtures/'.$filename;
    if (! file_exists($path)) {
        throw new RuntimeException('Fixture not found: '.$filename);
    }

    return file_get_contents($path);
}

/**
 * Create a mock PSR-7 Response
 */
function createMockResponse(string $body, int $statusCode = 200): ResponseInterface
{
    $mock = Mockery::mock(ResponseInterface::class);
    $mock->shouldReceive('getStatusCode')->andReturn($statusCode);

    $stream = Mockery::mock(StreamInterface::class);
    $stream->shouldReceive('getContents')->andReturn($body);
    $stream->shouldReceive('getSize')->andReturn(strlen($body));

    $mock->shouldReceive('getBody')->andReturn($stream);

    return $mock;
}
