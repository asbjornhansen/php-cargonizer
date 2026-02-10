<?php

declare(strict_types=1);

use zaporylie\Cargonizer\Data\SerializableDataInterface;
use zaporylie\Cargonizer\Data\Tod;

test('can instantiate Tod', function (): void {
    $tod = new Tod;
    expect($tod)->toBeInstanceOf(Tod::class);
});

test('implements SerializableDataInterface', function (): void {
    $tod = new Tod;
    expect($tod)->toBeInstanceOf(SerializableDataInterface::class);
});

test('can set and get code', function (): void {
    $tod = new Tod;
    $tod->setCode('EXW');

    expect($tod->getCode())->toBe('EXW');
});

test('can set and get country', function (): void {
    $tod = new Tod;
    $tod->setCountry('SE');

    expect($tod->getCountry())->toBe('SE');
});

test('can set and get postcode', function (): void {
    $tod = new Tod;
    $tod->setPostcode('100 05');

    expect($tod->getPostcode())->toBe('100 05');
});

test('can set and get city', function (): void {
    $tod = new Tod;
    $tod->setCity('Stockholm');

    expect($tod->getCity())->toBe('Stockholm');
});

test('setters return self for fluent interface', function (): void {
    $tod = new Tod;
    expect($tod->setCode('EXW'))->toBe($tod);
    expect($tod->setCountry('SE'))->toBe($tod);
    expect($tod->setPostcode('100 05'))->toBe($tod);
    expect($tod->setCity('Stockholm'))->toBe($tod);
});

test('handles null values gracefully', function (): void {
    $tod = new Tod;
    expect($tod->getCode())->toBeNull();
    expect($tod->getCountry())->toBeNull();
    expect($tod->getPostcode())->toBeNull();
    expect($tod->getCity())->toBeNull();
});

test('can serialize to XML with attributes', function (): void {
    $tod = new Tod;
    $tod->setCode('EXW')
        ->setCountry('SE')
        ->setPostcode('100 05')
        ->setCity('Stockholm');

    $xmlRoot = new \SimpleXMLElement('<consignment/>');
    $result = $tod->toXML($xmlRoot);

    expect($result->asXML())->toBeValidXml();
    expect((string) $result->tod['code'])->toBe('EXW');
    expect((string) $result->tod['country'])->toBe('SE');
    expect((string) $result->tod['postcode'])->toBe('100 05');
    expect((string) $result->tod['city'])->toBe('Stockholm');
});

test('fromXML returns new instance', function (): void {
    $xml = new \SimpleXMLElement('<tod/>');
    $tod = Tod::fromXML($xml);
    expect($tod)->toBeInstanceOf(Tod::class);
});
