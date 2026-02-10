<?php

declare(strict_types=1);

namespace zaporylie\Cargonizer\Data;

class Hours implements SerializableDataInterface
{
    protected ?string $from = null;

    protected ?string $to = null;

    /**
     * Gets from value.
     */
    public function getFrom(): ?string
    {
        return $this->from;
    }

    /**
     * Gets to value.
     */
    public function getTo(): ?string
    {
        return $this->to;
    }

    /**
     * {@inheritdoc}
     */
    #[\Override]
    public static function fromXML(\SimpleXMLElement $xml): self
    {
        $hours = new Hours;
        $hours->from = (string) $xml->attributes()->from;
        $hours->to = (string) $xml->attributes()->to;

        return $hours;
    }

    /**
     * {@inheritdoc}
     */
    #[\Override]
    public function toXML(\SimpleXMLElement $xml): \SimpleXMLElement
    {
        $item = $xml->addChild('item');
        $item->addAttribute('from', $this->from ?? '');
        $item->addAttribute('to', $this->to ?? '');

        return $xml;
    }
}
