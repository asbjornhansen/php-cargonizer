<?php

declare(strict_types=1);

namespace zaporylie\Cargonizer\Data;

/**
 * Class Consignments.
 */
class Consignments extends ObjectsWrapper implements SerializableDataInterface
{
    public function addItem(Consignment $consignment): self
    {
        $this->array[] = $consignment;

        return $this;
    }

    /**
     * {@inheritdoc}
     */
    #[\Override]
    public static function fromXML(\SimpleXMLElement $xml): self
    {
        $consignments = new Consignments;
        /** @var \SimpleXMLElement $consignment */
        foreach ($xml as $consignment) {
            $consignments->addItem(Consignment::fromXML($consignment));
        }

        return $consignments;
    }

    /**
     * {@inheritdoc}
     */
    #[\Override]
    public function toXML(?\SimpleXMLElement $xml = null): \SimpleXMLElement
    {
        if (! $xml instanceof \SimpleXMLElement) {
            $xml = new \SimpleXMLElement('<?xml version="1.0" encoding="UTF-8"?><consignments></consignments>');
        }

        foreach ($this as $consignment) {
            $consignment->toXML($xml);
        }

        return $xml;
    }
}
