<?php

declare(strict_types=1);

use zaporylie\Cargonizer\Data\DangerousGoods;
use zaporylie\Cargonizer\Data\SerializableDataInterface;

test('can instantiate DangerousGoods', function (): void {
    $dg = new DangerousGoods;
    expect($dg)->toBeInstanceOf(DangerousGoods::class);
});

test('implements SerializableDataInterface', function (): void {
    $dg = new DangerousGoods;
    expect($dg)->toBeInstanceOf(SerializableDataInterface::class);
});

test('can set and get name', function (): void {
    $dg = new DangerousGoods;
    $dg->setName('Flammable liquid');

    expect($dg->getName())->toBe('Flammable liquid');
});

test('can set and get type', function (): void {
    $dg = new DangerousGoods;
    $dg->setType('Drum');

    expect($dg->getType())->toBe('Drum');
});

test('can set and get amount', function (): void {
    $dg = new DangerousGoods;
    $dg->setAmount(5);

    expect($dg->getAmount())->toBe(5);
});

test('can set and get description', function (): void {
    $dg = new DangerousGoods;
    $dg->setDescription('Handle with care');

    expect($dg->getDescription())->toBe('Handle with care');
});

test('can set and get unNumber', function (): void {
    $dg = new DangerousGoods;
    $dg->setUnNumber('1203');

    expect($dg->getUnNumber())->toBe('1203');
});

test('can set and get tunnelCode', function (): void {
    $dg = new DangerousGoods;
    $dg->setTunnelCode('D/E');

    expect($dg->getTunnelCode())->toBe('D/E');
});

test('can set and get labels', function (): void {
    $dg = new DangerousGoods;
    $dg->setLabels('3');

    expect($dg->getLabels())->toBe('3');
});

test('can set and get packingGroup', function (): void {
    $dg = new DangerousGoods;
    $dg->setPackingGroup('II');

    expect($dg->getPackingGroup())->toBe('II');
});

test('can set and get grossWeight', function (): void {
    $dg = new DangerousGoods;
    $dg->setGrossWeight(25.5);

    expect($dg->getGrossWeight())->toBe(25.5);
});

test('can set and get netWeight', function (): void {
    $dg = new DangerousGoods;
    $dg->setNetWeight(20.0);

    expect($dg->getNetWeight())->toBe(20.0);
});

test('can set and get points', function (): void {
    $dg = new DangerousGoods;
    $dg->setPoints(10);

    expect($dg->getPoints())->toBe(10);
});

test('setters return self for fluent interface', function (): void {
    $dg = new DangerousGoods;
    expect($dg->setName('Test'))->toBe($dg);
    expect($dg->setType('Box'))->toBe($dg);
    expect($dg->setAmount(1))->toBe($dg);
    expect($dg->setDescription('Desc'))->toBe($dg);
    expect($dg->setUnNumber('1203'))->toBe($dg);
    expect($dg->setTunnelCode('D/E'))->toBe($dg);
    expect($dg->setLabels('3'))->toBe($dg);
    expect($dg->setPackingGroup('II'))->toBe($dg);
    expect($dg->setGrossWeight(25.0))->toBe($dg);
    expect($dg->setNetWeight(20.0))->toBe($dg);
    expect($dg->setPoints(10))->toBe($dg);
});

test('handles null values gracefully', function (): void {
    $dg = new DangerousGoods;
    expect($dg->getName())->toBeNull();
    expect($dg->getType())->toBeNull();
    expect($dg->getAmount())->toBeNull();
    expect($dg->getDescription())->toBeNull();
    expect($dg->getUnNumber())->toBeNull();
    expect($dg->getTunnelCode())->toBeNull();
    expect($dg->getLabels())->toBeNull();
    expect($dg->getPackingGroup())->toBeNull();
    expect($dg->getGrossWeight())->toBeNull();
    expect($dg->getNetWeight())->toBeNull();
    expect($dg->getPoints())->toBeNull();
});

test('can serialize to XML with attributes', function (): void {
    $dg = new DangerousGoods;
    $dg->setName('Flammable liquid')
        ->setUnNumber('1203')
        ->setTunnelCode('D/E')
        ->setLabels('3')
        ->setNetWeight(20.0)
        ->setPackingGroup('II')
        ->setAmount(5)
        ->setGrossWeight(25.5);

    $xmlRoot = new \SimpleXMLElement('<item/>');
    $result = $dg->toXML($xmlRoot);

    expect($result->asXML())->toBeValidXml();
    expect((string) $result->dangerous_goods['name'])->toBe('Flammable liquid');
    expect((string) $result->dangerous_goods['un_number'])->toBe('1203');
    expect((string) $result->dangerous_goods['tunnel_code'])->toBe('D/E');
    expect((string) $result->dangerous_goods['labels'])->toBe('3');
    expect((string) $result->dangerous_goods['net_weight'])->toBe('20');
    expect((string) $result->dangerous_goods['packing_group'])->toBe('II');
    expect((string) $result->dangerous_goods['amount'])->toBe('5');
    expect((string) $result->dangerous_goods['gross_weight'])->toBe('25.5');
});

test('toXML omits optional attributes when null', function (): void {
    $dg = new DangerousGoods;
    $dg->setName('Test')
        ->setUnNumber('1203')
        ->setTunnelCode('D/E')
        ->setLabels('3')
        ->setNetWeight(20.0);

    $xmlRoot = new \SimpleXMLElement('<item/>');
    $result = $dg->toXML($xmlRoot);

    expect(isset($result->dangerous_goods['type']))->toBeFalse();
    expect(isset($result->dangerous_goods['amount']))->toBeFalse();
    expect(isset($result->dangerous_goods['description']))->toBeFalse();
    expect(isset($result->dangerous_goods['packing_group']))->toBeFalse();
    expect(isset($result->dangerous_goods['gross_weight']))->toBeFalse();
    expect(isset($result->dangerous_goods['points']))->toBeFalse();
});

test('fromXML returns new instance', function (): void {
    $xml = new \SimpleXMLElement('<dangerous_goods/>');
    $dangerousGoods = DangerousGoods::fromXML($xml);
    expect($dangerousGoods)->toBeInstanceOf(DangerousGoods::class);
});
