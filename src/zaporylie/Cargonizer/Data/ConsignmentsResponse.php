<?php

declare(strict_types=1);

namespace zaporylie\Cargonizer\Data;

/**
 * Class Consignments.
 */
class ConsignmentsResponse extends ObjectsWrapper implements SerializableDataInterface
{
    public function addItem(ConsignmentResponse $consignmentResponse): self
    {
        $this->array[] = $consignmentResponse;

        return $this;
    }

    /**
     * {@inheritdoc}
     */
    #[\Override]
    public static function fromXML(\SimpleXMLElement $xml): self
    {
        $consignmentsResponse = new ConsignmentsResponse;
        /** @var \SimpleXMLElement $consignment */
        foreach ($xml as $consignment) {
            $consignmentsResponse->addItem(ConsignmentResponse::fromXML($consignment));
        }

        return $consignmentsResponse;
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
