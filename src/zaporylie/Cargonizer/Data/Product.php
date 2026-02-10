<?php

declare(strict_types=1);

namespace zaporylie\Cargonizer\Data;

class Product implements SerializableDataInterface
{
    protected ?string $identifier = null;

    protected ?string $name = null;

    protected ?int $minItems = null;

    protected ?int $maxItems = null;

    protected ?int $minWeight = null;

    protected ?int $maxWeight = null;

    protected ?Services $services = null;

    public function setIdentifier(?string $identifier): self
    {
        $this->identifier = $identifier;

        return $this;
    }

    public function setMaxItems(?int $maxItems): self
    {
        $this->maxItems = $maxItems;

        return $this;
    }

    public function setMaxWeight(?int $maxWeight): self
    {
        $this->maxWeight = $maxWeight;

        return $this;
    }

    public function setMinItems(?int $minItems): self
    {
        $this->minItems = $minItems;

        return $this;
    }

    public function setMinWeight(?int $minWeight): self
    {
        $this->minWeight = $minWeight;

        return $this;
    }

    public function setName(?string $name): self
    {
        $this->name = $name;

        return $this;
    }

    public function setServices(?Services $services): self
    {
        $this->services = $services;

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

    public function getMaxItems(): ?int
    {
        return $this->maxItems;
    }

    public function getMaxWeight(): ?int
    {
        return $this->maxWeight;
    }

    public function getMinItems(): ?int
    {
        return $this->minItems;
    }

    public function getMinWeight(): ?int
    {
        return $this->minWeight;
    }

    public function getServices(): ?Services
    {
        return $this->services;
    }

    #[\Override]
    public static function fromXML(\SimpleXMLElement $xml): self
    {
        $product = new Product;
        $product->setIdentifier((string) $xml->identifier);
        $product->setName((string) $xml->name);
        $product->setMinItems((int) $xml->min_items);
        $product->setMaxItems((int) $xml->max_items);
        $product->setMinWeight((int) $xml->min_weight);
        $product->setMaxWeight((int) $xml->max_weight);
        if (isset($xml->services->service)) {
            $product->setServices(Services::fromXML($xml->services->service));
        }

        return $product;
    }

    /**
     * {@inheritdoc}
     */
    #[\Override]
    public function toXML(\SimpleXMLElement $xml): \SimpleXMLElement
    {
        $product = $xml->addChild('product');
        $product->addChild('identifier', $this->getIdentifier() ?? '');
        $product->addChild('name', $this->getName() ?? '');
        $product->addChild('max_items', (string) ($this->getMaxItems() ?? ''));
        $product->addChild('min_items', (string) ($this->getMinItems() ?? ''));
        $product->addChild('max_weight', (string) ($this->getMaxWeight() ?? ''));
        $product->addChild('min_weight', (string) ($this->getMinWeight() ?? ''));
        if ($this->getServices() instanceof Services) {
            $this->getServices()->toXML($product);
        }

        return $xml;
    }
}
