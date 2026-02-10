<?php

declare(strict_types=1);

namespace zaporylie\Cargonizer\Data;

class Carrier implements SerializableDataInterface
{
    protected ?string $identifier = null;

    protected ?string $name = null;

    public function setName(?string $name): self
    {
        $this->name = $name;

        return $this;
    }

    public function setIdentifier(?string $identifier): self
    {
        $this->identifier = $identifier;

        return $this;
    }

    public function getName(): ?string
    {
        return $this->name;
    }

    public function getIdentifier(): ?string
    {
        return $this->identifier;
    }

    #[\Override]
    public static function fromXML(\SimpleXMLElement $xml): self
    {
        $carrier = new Carrier;
        $carrier->setName((string) $xml->name);
        $carrier->setIdentifier((string) $xml->identifier);

        return $carrier;
    }

    #[\Override]
    public function toXML(\SimpleXMLElement $xml): \SimpleXMLElement
    {
        $carrier = $xml->addChild('carrier');
        $carrier->addChild('identifier', $this->getIdentifier() ?? '');
        $carrier->addChild('name', $this->getName() ?? '');

        return $xml;
    }
}
