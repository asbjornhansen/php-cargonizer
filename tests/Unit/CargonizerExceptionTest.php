<?php

declare(strict_types=1);

use GuzzleHttp\Psr7\HttpFactory;
use Psr\Http\Client\ClientExceptionInterface;
use zaporylie\Cargonizer\CargonizerException;

test('implements PSR-18 ClientExceptionInterface', function (): void {
    $exception = new CargonizerException('Test error');
    expect($exception)->toBeInstanceOf(ClientExceptionInterface::class);
});

test('extends RuntimeException', function (): void {
    $exception = new CargonizerException('Test error');
    expect($exception)->toBeInstanceOf(\RuntimeException::class);
});

test('can store and retrieve request', function (): void {
    $requestFactory = new HttpFactory;
    $request = $requestFactory->createRequest('GET', 'https://example.com');

    $exception = new CargonizerException('Test error', $request);

    expect($exception->getRequest())->toBe($request);
    expect($exception->getMessage())->toBe('Test error');
});

test('request is optional', function (): void {
    $exception = new CargonizerException('Test error');
    expect($exception->getRequest())->toBeNull();
});

test('supports previous exception', function (): void {
    $previous = new \RuntimeException('Previous error');
    $exception = new CargonizerException('Test error', null, 500, $previous);

    expect($exception->getPrevious())->toBe($previous);
    expect($exception->getCode())->toBe(500);
});

test('can set custom error code', function (): void {
    $exception = new CargonizerException('Test error', null, 404);
    expect($exception->getCode())->toBe(404);
});

test('default error code is zero', function (): void {
    $exception = new CargonizerException('Test error');
    expect($exception->getCode())->toBe(0);
});

test('message is required', function (): void {
    $exception = new CargonizerException('Required message');
    expect($exception->getMessage())->toBe('Required message');
});
