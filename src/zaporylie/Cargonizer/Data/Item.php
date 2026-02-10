<?php

declare(strict_types=1);

namespace zaporylie\Cargonizer\Data;

class Item implements SerializableDataInterface
{
    protected ?string $package = null;

    /**
     * Required. Amount of parcels.
     */
    protected ?int $amount = null;

    /**
     * Required.
     */
    protected ?float $weight = null;

    /**
     * Required.
     */
    protected ?float $volume = null;

    /**
     * Optional.
     */
    protected ?float $length = null;

    /**
     * Optional.
     */
    protected ?float $height = null;

    /**
     * Optional.
     */
    protected ?float $width = null;

    /**
     * Optional.
     */
    protected ?float $loadMeter = null;

    /**
     * Optional.
     */
    protected ?string $description = null;

    public function setDescription(?string $description): self
    {
        $this->description = $description;

        return $this;
    }

    public function setAmount(?int $amount): self
    {
        $this->amount = $amount;

        return $this;
    }

    public function setHeight(?float $height): self
    {
        $this->height = $height;

        return $this;
    }

    public function setLength(?float $length): self
    {
        $this->length = $length;

        return $this;
    }

    public function setLoadMeter(?float $loadMeter): self
    {
        $this->loadMeter = $loadMeter;

        return $this;
    }

    public function setPackage(?string $package): self
    {
        $this->package = $package;

        return $this;
    }

    public function setVolume(?float $volume): self
    {
        $this->volume = $volume;

        return $this;
    }

    public function setWeight(?float $weight): self
    {
        $this->weight = $weight;

        return $this;
    }

    public function setWidth(?float $width): self
    {
        $this->width = $width;

        return $this;
    }

    public function getDescription(): ?string
    {
        return $this->description;
    }

    public function getAmount(): ?int
    {
        return $this->amount;
    }

    public function getHeight(): ?float
    {
        return $this->height;
    }

    public function getLength(): ?float
    {
        return $this->length;
    }

    public function getLoadMeter(): ?float
    {
        return $this->loadMeter;
    }

    public function getPackage(): ?string
    {
        return $this->package;
    }

    public function getVolume(): ?float
    {
        return $this->volume;
    }

    public function getWeight(): ?float
    {
        return $this->weight;
    }

    public function getWidth(): ?float
    {
        return $this->width;
    }

    /**
     * {@inheritdoc}
     */
    #[\Override]
    public static function fromXML(\SimpleXMLElement $xml): self
    {
        return new Item;
    }

    /**
     * {@inheritdoc}
     */
    #[\Override]
    public function toXML(\SimpleXMLElement $xml): \SimpleXMLElement
    {
        $item = $xml->addChild('item');
        $item->addAttribute('type', $this->getPackage() ?? '');
        $item->addAttribute('amount', (string) ($this->getAmount() ?? ''));
        $item->addAttribute('weight', (string) ($this->getWeight() ?? ''));
        $item->addAttribute('description', $this->getDescription() ?? '');

        return $xml;
    }
}
