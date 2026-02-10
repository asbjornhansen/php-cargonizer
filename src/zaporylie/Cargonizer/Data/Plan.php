<?php

declare(strict_types=1);

namespace zaporylie\Cargonizer\Data;

class Plan implements SerializableDataInterface
{
    protected ?string $name = null;

    protected ?int $itemLimit = null;

    protected ?int $itemCounter = null;

    public function getName(): ?string
    {
        return $this->name;
    }

    public function getItemCounter(): ?int
    {
        return $this->itemCounter;
    }

    public function getItemLimit(): ?int
    {
        return $this->itemLimit;
    }

    public function setName(?string $name): self
    {
        $this->name = $name;

        return $this;
    }

    public function setItemCounter(?int $itemCounter): self
    {
        $this->itemCounter = $itemCounter;

        return $this;
    }

    public function setItemLimit(?int $itemLimit): self
    {
        $this->itemLimit = $itemLimit;

        return $this;
    }

    /**
     * {@inheritdoc}
     */
    #[\Override]
    public static function fromXML(\SimpleXMLElement $xml): self
    {
        $plan = new Plan;
        $plan->setName((string) $xml->{'name'});
        $plan->setItemLimit((int) $xml->{'item_limit'});
        $plan->setItemCounter((int) $xml->{'item_counter'});

        return $plan;
    }

    /**
     * {@inheritdoc}
     */
    #[\Override]
    public function toXML(\SimpleXMLElement $xml): \SimpleXMLElement
    {
        $xml->addChild('plan');
        $xml->addChild('plan', $this->getName() ?? '');
        $xml->addChild('item_limit', (string) ($this->getItemLimit() ?? ''));
        $xml->addChild('item_counter', (string) ($this->getItemCounter() ?? ''));

        return $xml;
    }
}
