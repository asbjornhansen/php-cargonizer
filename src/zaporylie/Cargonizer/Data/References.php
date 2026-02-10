<?php

declare(strict_types=1);

namespace zaporylie\Cargonizer\Data;

class References extends ObjectsWrapper implements SerializableDataInterface
{
    private ?string $consigneeReference = null;

    private ?string $consignorReference = null;

    public function addConsignorReference(?string $reference): self
    {
        $this->consignorReference = $reference;

        return $this;
    }

    public function addConsigneeReference(?string $reference): self
    {
        $this->consigneeReference = $reference;

        return $this;
    }

    /**
     * {@inheritdoc}
     */
    #[\Override]
    public static function fromXML(\SimpleXMLElement $xml): self
    {
        return new References;
    }

    /**
     * {@inheritdoc}
     */
    #[\Override]
    public function toXML(\SimpleXMLElement $xml): \SimpleXMLElement
    {
        $references = $xml->addChild('references');
        $references->addChild('consignor', $this->consignorReference ?? '');
        $references->addChild('consignee', $this->consigneeReference ?? '');

        return $xml;
    }
}
