<?php

declare(strict_types=1);

use zaporylie\Cargonizer\Data\Carrier;
use zaporylie\Cargonizer\Data\Products;
use zaporylie\Cargonizer\Data\SerializableDataInterface;
use zaporylie\Cargonizer\Data\TransportAgreement;

test('can instantiate TransportAgreement', function (): void {
    $agreement = new TransportAgreement;
    expect($agreement)->toBeInstanceOf(TransportAgreement::class);
});

test('implements SerializableDataInterface', function (): void {
    $agreement = new TransportAgreement;
    expect($agreement)->toBeInstanceOf(SerializableDataInterface::class);
});

test('can set and get id', function (): void {
    $agreement = new TransportAgreement;
    $agreement->setId(123);

    expect($agreement->getId())->toBe(123);
});

test('can set and get description', function (): void {
    $agreement = new TransportAgreement;
    $agreement->setDescription('Test Agreement');

    expect($agreement->getDescription())->toBe('Test Agreement');
});

test('can set and get number', function (): void {
    $agreement = new TransportAgreement;
    $agreement->setNumber(456);

    expect($agreement->getNumber())->toBe(456);
});

test('can set and get carrier', function (): void {
    $agreement = new TransportAgreement;
    $carrier = new Carrier;
    $agreement->setCarrier($carrier);
    expect($agreement->getCarrier())->toBe($carrier);
});

test('can set and get products', function (): void {
    $agreement = new TransportAgreement;
    $products = new Products;
    $agreement->setProducts($products);
    expect($agreement->getProducts())->toBe($products);
});

test('setters return self for fluent interface', function (): void {
    $agreement = new TransportAgreement;
    $transportAgreement = $agreement->setId(123);
    expect($transportAgreement)->toBe($agreement);
});

test('can deserialize from XML', function (): void {
    $xml = simplexml_load_string(loadFixture('transport_agreement_single.xml'));
    $transportAgreement = TransportAgreement::fromXML($xml);

    expect($transportAgreement)->toBeInstanceOf(TransportAgreement::class);
    expect($transportAgreement->getId())->toBe(123);
    expect($transportAgreement->getDescription())->toBe('Test Agreement');
    expect($transportAgreement->getCarrier())->toBeInstanceOf(Carrier::class);
});

test('can serialize to XML', function (): void {
    $agreement = new TransportAgreement;
    $agreement->setId(123);
    $agreement->setDescription('Test Agreement');

    $xmlRoot = new \SimpleXMLElement('<root/>');
    $result = $agreement->toXML($xmlRoot);

    expect($result->asXML())->toBeValidXml();
    expect((string) $result->{'transport-agreement'}->id)->toBe('123');
    expect((string) $result->{'transport-agreement'}->description)->toBe('Test Agreement');
});

test('handles null values gracefully', function (): void {
    $agreement = new TransportAgreement;
    expect($agreement->getId())->toBeNull();
    expect($agreement->getDescription())->toBeNull();
    expect($agreement->getCarrier())->toBeNull();
    expect($agreement->getProducts())->toBeNull();
});

test('can set null values', function (): void {
    $agreement = new TransportAgreement;
    $agreement->setId(123);
    $agreement->setId(null);

    expect($agreement->getId())->toBeNull();
});
