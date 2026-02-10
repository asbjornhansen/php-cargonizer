<?php

declare(strict_types=1);

use Psr\Http\Client\ClientInterface;
use zaporylie\Cargonizer\Config;

test('can set and get config values', function (): void {
    Config::set('endpoint', Config::SANDBOX);
    Config::set('secret', 'test-secret');
    Config::set('sender', 'test-sender');

    expect(Config::get('endpoint'))->toBe(Config::SANDBOX);
    expect(Config::get('secret'))->toBe('test-secret');
    expect(Config::get('sender'))->toBe('test-sender');
});

test('has sandbox constant', function (): void {
    expect(Config::SANDBOX)->toBe('https://sandbox.cargonizer.no');
});

test('has production constant', function (): void {
    expect(Config::PRODUCTION)->toBe('https://cargonizer.no');
});

test('clientFactory returns PSR-18 client', function (): void {
    $client = Config::clientFactory();
    expect($client)->toBeInstanceOf(ClientInterface::class);
});

test('clientFactory accepts explicit client', function (): void {
    $mockClient = Mockery::mock(ClientInterface::class);
    $client = Config::clientFactory($mockClient);
    expect($client)->toBe($mockClient);
});

test('clientFactory throws exception for invalid client', function (): void {
    Config::clientFactory(new \stdClass);
})->throws(\LogicException::class, 'HttpClient must be instance of');

test('can update config values', function (): void {
    Config::set('endpoint', Config::SANDBOX);
    expect(Config::get('endpoint'))->toBe(Config::SANDBOX);

    Config::set('endpoint', Config::PRODUCTION);
    expect(Config::get('endpoint'))->toBe(Config::PRODUCTION);
});

test('can set null values', function (): void {
    Config::set('secret', 'test-value');
    expect(Config::get('secret'))->toBe('test-value');

    Config::set('secret', null);
    expect(Config::get('secret'))->toBeNull();
});
