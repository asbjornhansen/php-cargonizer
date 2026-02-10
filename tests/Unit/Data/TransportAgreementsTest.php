<?php

declare(strict_types=1);

use zaporylie\Cargonizer\Data\TransportAgreement;
use zaporylie\Cargonizer\Data\TransportAgreements;

test('can instantiate TransportAgreements', function (): void {
    $agreements = new TransportAgreements;
    expect($agreements)->toBeInstanceOf(TransportAgreements::class);
});

test('can deserialize from XML fixture', function (): void {
    $xml = simplexml_load_string(loadFixture('transport_agreements.xml'));
    $transportAgreements = TransportAgreements::fromXML($xml);

    expect($transportAgreements)->toBeInstanceOf(TransportAgreements::class);
    $agreementArray = iterator_to_array($transportAgreements);
    expect($agreementArray)->toBeArray();
    expect(count($agreementArray))->toBeGreaterThan(0);
});

test('agreements are TransportAgreement instances', function (): void {
    $xml = simplexml_load_string(loadFixture('transport_agreements.xml'));
    $transportAgreements = TransportAgreements::fromXML($xml);

    $agreementList = iterator_to_array($transportAgreements);
    expect($agreementList[array_key_first($agreementList)])->toBeInstanceOf(TransportAgreement::class);
});

test('parses multiple agreements correctly', function (): void {
    $xml = simplexml_load_string(loadFixture('transport_agreements.xml'));
    $transportAgreements = TransportAgreements::fromXML($xml);

    $agreementList = iterator_to_array($transportAgreements);
    expect(count($agreementList))->toBe(2);

    // Agreements are keyed by ID, so get them by ID
    expect($agreementList[123]->getId())->toBe(123);
    expect($agreementList[456]->getId())->toBe(456);
});
