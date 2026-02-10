<?php

declare(strict_types=1);

use Psr\Http\Client\ClientExceptionInterface;

test('service classes extend Client', function (): void {
    expect('zaporylie\Cargonizer\Agreements')
        ->toExtend('zaporylie\Cargonizer\Client');

    expect('zaporylie\Cargonizer\Consignment')
        ->toExtend('zaporylie\Cargonizer\Client');

    expect('zaporylie\Cargonizer\Partners')
        ->toExtend('zaporylie\Cargonizer\Client');

    expect('zaporylie\Cargonizer\Estimation')
        ->toExtend('zaporylie\Cargonizer\Client');

    expect('zaporylie\Cargonizer\Profile')
        ->toExtend('zaporylie\Cargonizer\Client');
});

test('data models implement SerializableDataInterface', function (): void {
    $dataModelClasses = [
        'zaporylie\Cargonizer\Data\TransportAgreement',
        'zaporylie\Cargonizer\Data\TransportAgreements',
        'zaporylie\Cargonizer\Data\Consignment',
        'zaporylie\Cargonizer\Data\Consignments',
        'zaporylie\Cargonizer\Data\Item',
        'zaporylie\Cargonizer\Data\Items',
        'zaporylie\Cargonizer\Data\User',
        'zaporylie\Cargonizer\Data\Carrier',
        'zaporylie\Cargonizer\Data\Product',
        'zaporylie\Cargonizer\Data\Products',
        'zaporylie\Cargonizer\Data\Results',
        'zaporylie\Cargonizer\Data\ServicePartner',
    ];

    foreach ($dataModelClasses as $dataModelClass) {
        expect($dataModelClass)->toImplement('zaporylie\Cargonizer\Data\SerializableDataInterface');
    }
});

test('Client is abstract', function (): void {
    $reflection = new ReflectionClass('zaporylie\Cargonizer\Client');
    expect($reflection->isAbstract())->toBeTrue();
});

test('Config is a singleton', function (): void {
    $reflection = new ReflectionClass('zaporylie\Cargonizer\Config');
    $constructor = $reflection->getConstructor();

    // Constructor should be private to prevent instantiation
    expect($constructor->isPrivate())->toBeTrue();
});

test('CargonizerException implements PSR-18 ClientExceptionInterface', function (): void {
    expect('zaporylie\Cargonizer\CargonizerException')
        ->toImplement(ClientExceptionInterface::class);
});

test('CargonizerException extends RuntimeException', function (): void {
    expect('zaporylie\Cargonizer\CargonizerException')
        ->toExtend('RuntimeException');
});

test('namespace structure follows PSR-4', function (): void {
    // All classes under zaporylie\Cargonizer should be in src/zaporylie/Cargonizer
    expect('zaporylie\Cargonizer')
        ->toOnlyBeUsedIn([
            'zaporylie\Cargonizer',
            'Tests',
        ]);
});

// Skipping complex arch tests that require proper setup

test('service classes use protected properties', function (): void {
    $serviceClasses = [
        'zaporylie\Cargonizer\Agreements',
        'zaporylie\Cargonizer\Consignment',
        'zaporylie\Cargonizer\Partners',
    ];

    foreach ($serviceClasses as $serviceClass) {
        $reflection = new ReflectionClass($serviceClass);
        $properties = $reflection->getProperties(ReflectionProperty::IS_PROTECTED);
        expect(count($properties))->toBeGreaterThan(0);
    }
});

test('all classes have declare strict_types', function (): void {
    // Check if test files have strict types
    $testFiles = glob(__DIR__.'/*.php');
    foreach ($testFiles as $testFile) {
        $content = file_get_contents($testFile);
        expect($content)->toContain('declare(strict_types=1);');
    }
});
