<?php

declare(strict_types=1);

namespace zaporylie\Cargonizer\Data;

class Attribute implements SerializableDataInterface
{
    protected ?string $identifier = null;

    protected ?string $name = null;

    protected ?string $type = null;

    protected ?bool $required = null;

    protected ?int $min = null;

    protected ?int $max = null;

    protected ?array $values = null;

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

    public function setMin(?int $min): self
    {
        $this->min = $min;

        return $this;
    }

    public function setMax(?int $max): self
    {
        $this->max = $max;

        return $this;
    }

    public function setRequired(?bool $required): self
    {
        $this->required = $required;

        return $this;
    }

    public function setType(?string $type): self
    {
        $this->type = $type;

        return $this;
    }

    public function addValue(string $value): self
    {
        $this->values[] = $value;

        return $this;
    }

    public function setValues(?array $values): self
    {
        $this->values = $values;

        return $this;
    }

    public function getIdentifier(): ?string
    {
        return $this->identifier;
    }

    public function getName(): ?string
    {
        return $this->name;
    }

    public function getMax(): ?int
    {
        return $this->max;
    }

    public function getMin(): ?int
    {
        return $this->min;
    }

    public function getType(): ?string
    {
        return $this->type;
    }

    public function getValues(): ?array
    {
        return $this->values;
    }

    #[\Override]
    public static function fromXML(\SimpleXMLElement $xml): self
    {
        $attribute = new Attribute;
        $attribute->setIdentifier((string) $xml->identifier);
        $attribute->setName((string) $xml->name);
        $attribute->setType((string) $xml->type);
        $attribute->setRequired((string) $xml->required === 'true');
        $attribute->setMin((int) $xml->min);
        $attribute->setMax((int) $xml->max);
        if ($xml->values->count()) {
            foreach ($xml->values->value as $value) {
                $attribute->addValue((string) $value);
            }
        }

        return $attribute;
    }

    #[\Override]
    public function toXML(\SimpleXMLElement $xml): \SimpleXMLElement
    {
        $attribute = $xml->addChild('attribute');
        $attribute->addChild('identifier', $this->getIdentifier() ?? '');
        $attribute->addChild('name', $this->getName() ?? '');
        $attribute->addChild('min', (string) ($this->getMin() ?? ''));
        $attribute->addChild('max', (string) ($this->getMax() ?? ''));

        return $xml;
    }
}
