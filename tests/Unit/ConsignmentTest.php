<?php

declare(strict_types=1);

use GuzzleHttp\Psr7\HttpFactory;
use Psr\Http\Client\ClientInterface;
use zaporylie\Cargonizer\Client;
use zaporylie\Cargonizer\Config;
use zaporylie\Cargonizer\Consignment;
use zaporylie\Cargonizer\Data\Consignments;
use zaporylie\Cargonizer\Data\ConsignmentsResponse;

beforeEach(function (): void {
    Config::set('endpoint', Config::SANDBOX);
    Config::set('secret', 'test-secret');
    Config::set('sender', 'test-sender');
});

test('can instantiate consignment service', function (): void {
    $consignment = new Consignment;
    expect($consignment)->toBeInstanceOf(Consignment::class);
});

test('consignment extends Client', function (): void {
    $consignment = new Consignment;
    expect($consignment)->toBeInstanceOf(Client::class);
});

test('createConsignments sends POST request with XML body', function (): void {
    $xmlResponse = loadFixture('consignment_response.xml');
    $requestFactory = new HttpFactory;

    $mock = Mockery::mock(ClientInterface::class);
    $mock->shouldReceive('sendRequest')
        ->once()
        ->withArgs(fn ($request): bool => $request->getMethod() === 'POST' &&
               $request->getBody()->getSize() > 0 &&
               str_contains((string) $request->getUri()->getPath(), '/consignments.xml'))
        ->andReturn(createMockResponse($xmlResponse));

    $consignments = new Consignments;
    $service = new Consignment($mock, $requestFactory);
    $consignmentsResponse = $service->createConsignments($consignments);

    expect($consignmentsResponse)->toBeInstanceOf(ConsignmentsResponse::class);
});

test('createConsignments returns ConsignmentsResponse', function (): void {
    $xmlResponse = loadFixture('consignment_response.xml');
    $client = mockHttpClient($xmlResponse);

    $consignments = new Consignments;
    $service = new Consignment($client);
    $consignmentsResponse = $service->createConsignments($consignments);

    expect($consignmentsResponse)->toBeInstanceOf(ConsignmentsResponse::class);
});

test('deprecated requestConsigment still works', function (): void {
    $xmlResponse = loadFixture('consignment_response.xml');
    $client = mockHttpClient($xmlResponse);

    $consignments = new Consignments;
    $service = new Consignment($client);
    $consignmentsResponse = $service->requestConsigment($consignments);

    expect($consignmentsResponse)->toBeInstanceOf(ConsignmentsResponse::class);
});
