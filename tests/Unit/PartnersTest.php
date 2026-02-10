<?php

declare(strict_types=1);

use GuzzleHttp\Psr7\HttpFactory;
use Psr\Http\Client\ClientInterface;
use zaporylie\Cargonizer\Client;
use zaporylie\Cargonizer\Config;
use zaporylie\Cargonizer\Data\Results;
use zaporylie\Cargonizer\Partners;

beforeEach(function (): void {
    Config::set('endpoint', Config::SANDBOX);
    Config::set('secret', 'test-secret');
    Config::set('sender', 'test-sender');
});

test('can instantiate partners service', function (): void {
    $partners = new Partners;
    expect($partners)->toBeInstanceOf(Partners::class);
});

test('partners extends Client', function (): void {
    $partners = new Partners;
    expect($partners)->toBeInstanceOf(Client::class);
});

test('getPickupPoints accepts parameters', function (): void {
    $xmlResponse = loadFixture('service_partners.xml');
    $client = mockHttpClient($xmlResponse);

    $partners = new Partners($client);
    $results = $partners->getPickupPoints('NO', '0150', 'bring', 'pakke_i_postkassen', 'shop-123');

    expect($results)->toBeInstanceOf(Results::class);
});

test('getPickupPoints includes query parameters in GET request', function (): void {
    $xmlResponse = loadFixture('service_partners.xml');
    $requestFactory = new HttpFactory;

    $mock = Mockery::mock(ClientInterface::class);
    $mock->shouldReceive('sendRequest')
        ->once()
        ->withArgs(function ($request): bool {
            $query = $request->getUri()->getQuery();

            return str_contains($query, 'country=NO') &&
                   str_contains($query, 'postcode=0150') &&
                   str_contains($query, 'carrier=bring') &&
                   str_contains($query, 'product=pakke_i_postkassen') &&
                   str_contains($query, 'shop_id=shop-123');
        })
        ->andReturn(createMockResponse($xmlResponse));

    $partners = new Partners($mock, $requestFactory);
    $partners->getPickupPoints('NO', '0150', 'bring', 'pakke_i_postkassen', 'shop-123');
});

test('getPickupPoints works with required parameters only', function (): void {
    $xmlResponse = loadFixture('service_partners.xml');
    $client = mockHttpClient($xmlResponse);

    $partners = new Partners($client);
    $results = $partners->getPickupPoints('NO', '0150', 'bring');

    expect($results)->toBeInstanceOf(Results::class);
});

test('getPickupPoints includes optional product parameter', function (): void {
    $xmlResponse = loadFixture('service_partners.xml');
    $requestFactory = new HttpFactory;

    $mock = Mockery::mock(ClientInterface::class);
    $mock->shouldReceive('sendRequest')
        ->once()
        ->withArgs(function ($request): bool {
            $query = $request->getUri()->getQuery();

            return str_contains($query, 'product=pakke_i_postkassen');
        })
        ->andReturn(createMockResponse($xmlResponse));

    $partners = new Partners($mock, $requestFactory);
    $partners->getPickupPoints('NO', '0150', 'bring', 'pakke_i_postkassen');
});

test('getPickupPoints parses multiple partners', function (): void {
    $xmlResponse = loadFixture('service_partners.xml');
    $client = mockHttpClient($xmlResponse);

    $partners = new Partners($client);
    $results = $partners->getPickupPoints('NO', '0150', 'bring');

    $servicePartners = $results->getServicePartners();
    $partnerArray = iterator_to_array($servicePartners);
    expect($partnerArray)->toBeArray();
    expect(count($partnerArray))->toBeGreaterThan(0);
});
