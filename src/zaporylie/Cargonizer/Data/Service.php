<?php

declare(strict_types=1);

namespace zaporylie\Cargonizer\Data;

class Service implements SerializableDataInterface
{
    protected ?string $identifier = null;

    protected ?string $name = null;

    /**
     * @var Attribute[]
     */
    protected array $attributes = [];

    public function setIdentifier(?string $identifier): self
    {
        $this->identifier = $identifier;

        return $this;
    }

    public function setName(?string $name): self
    {
        $this->name = $name;

        return $this;
    }

    /**
     * @param  Attribute[]  $attributes
     */
    public function setAttributes(array $attributes): self
    {
        $this->attributes = $attributes;

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

    /**
     * @return Attribute[]
     */
    public function getAttributes(): array
    {
        return $this->attributes;
    }

    /**
     * {@inheritdoc}
     */
    #[\Override]
    public static function fromXML(\SimpleXMLElement $xml): self
    {
        $service = new Service;
        $service->setIdentifier((string) $xml->identifier);
        $service->setName((string) $xml->name);

        $attributes = [];
        if (isset($xml->attributes->attribute)) {
            foreach ($xml->attributes->attribute as $attribute) {
                $attributes[] = Attribute::fromXML($attribute);
            }
        }

        $service->setAttributes($attributes);

        return $service;
    }

    /**
     * {@inheritdoc}
     */
    #[\Override]
    public function toXML(\SimpleXMLElement $xml): \SimpleXMLElement
    {
        return $xml;
    }
}
