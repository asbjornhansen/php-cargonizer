<?php

declare(strict_types=1);

namespace zaporylie\Cargonizer\Data;

class Items extends ObjectsWrapper implements SerializableDataInterface
{
    public function addItem(Item $item): self
    {
        $this->array[] = $item;

        return $this;
    }

    /**
     * {@inheritdoc}
     */
    #[\Override]
    public static function fromXML(\SimpleXMLElement $xml): self
    {
        $items = new Items;

        foreach ($xml as $item) {
            $items->addItem(Item::fromXML($item));
        }

        return $items;
    }

    /**
     * {@inheritdoc}
     */
    #[\Override]
    public function toXML(\SimpleXMLElement $xml): \SimpleXMLElement
    {
        $items = $xml->addChild('items');
        foreach ($this as $item) {
            $item->toXML($items);
        }

        return $xml;
    }
}
