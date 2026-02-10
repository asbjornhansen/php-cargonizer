<?php

declare(strict_types=1);

namespace zaporylie\Cargonizer\Data;

/**
 * Class TransportAgreements.
 */
class TransportAgreements extends ObjectsWrapper implements SerializableDataInterface
{
    public function addItem(TransportAgreement $transportAgreement): self
    {
        $this->array[$transportAgreement->getId()] = $transportAgreement;

        return $this;
    }

    /**
     * {@inheritdoc}
     */
    #[\Override]
    public static function fromXML(\SimpleXMLElement $xml): self
    {
        $transportAgreements = new TransportAgreements;

        /** @var \SimpleXMLElement $agreement */
        foreach ($xml as $agreement) {
            $transportAgreements->addItem(TransportAgreement::fromXML($agreement));
        }

        return $transportAgreements;
    }

    /**
     * {@inheritdoc}
     */
    #[\Override]
    public function toXML(?\SimpleXMLElement $xml = null): \SimpleXMLElement
    {

        if (! $xml instanceof \SimpleXMLElement) {
            $xml = new \SimpleXMLElement('<?xml version="1.0" encoding="UTF-8"?><transport-agreements type="array"></transport-agreements>');
        }

        // TODO: Implement toXML() method.
        /** @var TransportAgreement $agreement */
        foreach ($this as $agreement) {
            //      $x = $xml->addChild('transport_agreement');
            $agreement->toXML($xml);
        }

        return $xml;
    }
}
