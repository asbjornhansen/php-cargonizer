<?php

declare(strict_types=1);

namespace zaporylie\Cargonizer\Data;

class Managerships extends ObjectsWrapper implements SerializableDataInterface
{
    public function addItem(Managership $managership): self
    {
        $this->array[$managership->getId()] = $managership;

        return $this;
    }

    /**
     * {@inheritdoc}
     */
    #[\Override]
    public static function fromXML(\SimpleXMLElement $xml): self
    {
        $managerships = new Managerships;

        foreach ($xml as $managership) {
            $managerships->addItem(Managership::fromXML($managership->{'managership'}));
        }

        return $managerships;
    }

    /**
     * {@inheritdoc}
     */
    #[\Override]
    public function toXML(\SimpleXMLElement $xml): \SimpleXMLElement
    {
        $partners = $xml->addChild('managerships');
        $partners->addAttribute('type', 'array');
        /** @var Managership $managership */
        foreach ($this as $managership) {
            $managership->toXML($xml);
        }

        return $xml;
    }
}
