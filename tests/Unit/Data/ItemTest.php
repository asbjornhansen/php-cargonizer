<?php

declare(strict_types=1);

use zaporylie\Cargonizer\Data\DangerousGoods;
use zaporylie\Cargonizer\Data\Item;
use zaporylie\Cargonizer\Data\SerializableDataInterface;

test('can instantiate Item', function (): void {
    $item = new Item;
    expect($item)->toBeInstanceOf(Item::class);
});

test('implements SerializableDataInterface', function (): void {
    $item = new Item;
    expect($item)->toBeInstanceOf(SerializableDataInterface::class);
});

test('can set and get dangerousGoods', function (): void {
    $item = new Item;
    $dg = new DangerousGoods;
    $item->setDangerousGoods($dg);
    expect($item->getDangerousGoods())->toBe($dg);
});

test('setDangerousGoods returns self for fluent interface', function (): void {
    $item = new Item;
    $dg = new DangerousGoods;
    expect($item->setDangerousGoods($dg))->toBe($item);
});

test('dangerousGoods is null by default', function (): void {
    $item = new Item;
    expect($item->getDangerousGoods())->toBeNull();
});

test('can set dangerousGoods to null', function (): void {
    $item = new Item;
    $item->setDangerousGoods(new DangerousGoods);
    $item->setDangerousGoods(null);

    expect($item->getDangerousGoods())->toBeNull();
});

test('toXML nests dangerous_goods inside item', function (): void {
    $dg = new DangerousGoods;
    $dg->setName('Flammable liquid')
        ->setUnNumber('1203')
        ->setTunnelCode('D/E')
        ->setLabels('3')
        ->setNetWeight(20.0);

    $item = new Item;
    $item->setPackage('parcel')
        ->setAmount(1)
        ->setWeight(25.0)
        ->setDangerousGoods($dg);

    $xmlRoot = new \SimpleXMLElement('<items/>');
    $result = $item->toXML($xmlRoot);

    expect($result->asXML())->toBeValidXml();
    expect((string) $result->item['type'])->toBe('parcel');
    expect((string) $result->item->dangerous_goods['name'])->toBe('Flammable liquid');
    expect((string) $result->item->dangerous_goods['un_number'])->toBe('1203');
});

test('toXML works without dangerousGoods', function (): void {
    $item = new Item;
    $item->setPackage('parcel')
        ->setAmount(1)
        ->setWeight(25.0);

    $xmlRoot = new \SimpleXMLElement('<items/>');
    $result = $item->toXML($xmlRoot);

    expect($result->asXML())->toBeValidXml();
    expect((string) $result->item['type'])->toBe('parcel');
    expect(count($result->item->dangerous_goods))->toBe(0);
});
