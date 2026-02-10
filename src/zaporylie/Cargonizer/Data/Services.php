<?php

declare(strict_types=1);

namespace zaporylie\Cargonizer\Data;

class Services extends ObjectsWrapper implements SerializableDataInterface
{
    public function addItem(Service $service): self
    {
        $this->array[$service->getIdentifier()] = $service;

        return $this;
    }

    /**
     * {@inheritdoc}
     */
    #[\Override]
    public static function fromXML(\SimpleXMLElement $xml): self
    {
        $services = new Services;

        foreach ($xml as $item) {
            $services->addItem(Service::fromXML($item));
        }

        return $services;
    }

    /**
     * {@inheritdoc}
     */
    #[\Override]
    public function toXML(\SimpleXMLElement $xml): \SimpleXMLElement
    {
        $attributes = $xml->addChild('attributes');
        $attributes->addAttribute('type', 'array');
        foreach ($this as $attribute) {
            $attribute->toXML($attributes);
        }

        return $xml;
    }
}
