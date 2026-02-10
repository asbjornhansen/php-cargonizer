<?php

declare(strict_types=1);

use zaporylie\Cargonizer\Data\Results;
use zaporylie\Cargonizer\Data\ServicePartner;
use zaporylie\Cargonizer\Data\ServicePartners;

test('can instantiate Results', function (): void {
    $results = new Results;
    expect($results)->toBeInstanceOf(Results::class);
});

test('can deserialize from XML fixture', function (): void {
    $xml = simplexml_load_string(loadFixture('service_partners.xml'));
    $results = Results::fromXML($xml);

    expect($results)->toBeInstanceOf(Results::class);
    // Results has getServicePartners()
    $servicePartners = $results->getServicePartners();
    expect($servicePartners)->toBeInstanceOf(ServicePartners::class);
});

test('results are ServicePartner instances', function (): void {
    $xml = simplexml_load_string(loadFixture('service_partners.xml'));
    $results = Results::fromXML($xml);

    $servicePartners = $results->getServicePartners();
    $partnerArray = iterator_to_array($servicePartners);
    if ($partnerArray !== []) {
        expect($partnerArray[array_key_first($partnerArray)])->toBeInstanceOf(ServicePartner::class);
    }
});

test('parses service partners correctly', function (): void {
    $xml = simplexml_load_string(loadFixture('service_partners.xml'));
    $results = Results::fromXML($xml);

    $servicePartners = $results->getServicePartners();
    expect($servicePartners)->toBeInstanceOf(ServicePartners::class);

    $partnerArray = iterator_to_array($servicePartners);
    expect(count($partnerArray))->toBeGreaterThan(0);
});
