<?php

declare(strict_types=1);

namespace zaporylie\Cargonizer\Data;

class DangerousGoods implements SerializableDataInterface
{
    protected ?string $name = null;

    protected ?string $type = null;

    protected ?int $amount = null;

    protected ?string $description = null;

    protected ?string $unNumber = null;

    protected ?string $tunnelCode = null;

    protected ?string $labels = null;

    protected ?string $packingGroup = null;

    protected ?float $grossWeight = null;

    protected ?float $netWeight = null;

    protected ?int $points = null;

    public function getName(): ?string
    {
        return $this->name;
    }

    public function setName(?string $name): self
    {
        $this->name = $name;

        return $this;
    }

    public function getType(): ?string
    {
        return $this->type;
    }

    public function setType(?string $type): self
    {
        $this->type = $type;

        return $this;
    }

    public function getAmount(): ?int
    {
        return $this->amount;
    }

    public function setAmount(?int $amount): self
    {
        $this->amount = $amount;

        return $this;
    }

    public function getDescription(): ?string
    {
        return $this->description;
    }

    public function setDescription(?string $description): self
    {
        $this->description = $description;

        return $this;
    }

    public function getUnNumber(): ?string
    {
        return $this->unNumber;
    }

    public function setUnNumber(?string $unNumber): self
    {
        $this->unNumber = $unNumber;

        return $this;
    }

    public function getTunnelCode(): ?string
    {
        return $this->tunnelCode;
    }

    public function setTunnelCode(?string $tunnelCode): self
    {
        $this->tunnelCode = $tunnelCode;

        return $this;
    }

    public function getLabels(): ?string
    {
        return $this->labels;
    }

    public function setLabels(?string $labels): self
    {
        $this->labels = $labels;

        return $this;
    }

    public function getPackingGroup(): ?string
    {
        return $this->packingGroup;
    }

    public function setPackingGroup(?string $packingGroup): self
    {
        $this->packingGroup = $packingGroup;

        return $this;
    }

    public function getGrossWeight(): ?float
    {
        return $this->grossWeight;
    }

    public function setGrossWeight(?float $grossWeight): self
    {
        $this->grossWeight = $grossWeight;

        return $this;
    }

    public function getNetWeight(): ?float
    {
        return $this->netWeight;
    }

    public function setNetWeight(?float $netWeight): self
    {
        $this->netWeight = $netWeight;

        return $this;
    }

    public function getPoints(): ?int
    {
        return $this->points;
    }

    public function setPoints(?int $points): self
    {
        $this->points = $points;

        return $this;
    }

    #[\Override]
    public static function fromXML(\SimpleXMLElement $xml): self
    {
        return new DangerousGoods;
    }

    #[\Override]
    public function toXML(\SimpleXMLElement $xml): \SimpleXMLElement
    {
        $dg = $xml->addChild('dangerous_goods');
        $dg->addAttribute('name', $this->getName() ?? '');
        $dg->addAttribute('un_number', $this->getUnNumber() ?? '');
        $dg->addAttribute('tunnel_code', $this->getTunnelCode() ?? '');
        $dg->addAttribute('labels', $this->getLabels() ?? '');
        $dg->addAttribute('net_weight', (string) ($this->getNetWeight() ?? ''));

        if ($this->getType() !== null) {
            $dg->addAttribute('type', $this->getType());
        }

        if ($this->getAmount() !== null) {
            $dg->addAttribute('amount', (string) $this->getAmount());
        }

        if ($this->getDescription() !== null) {
            $dg->addAttribute('description', $this->getDescription());
        }

        if ($this->getPackingGroup() !== null) {
            $dg->addAttribute('packing_group', $this->getPackingGroup());
        }

        if ($this->getGrossWeight() !== null) {
            $dg->addAttribute('gross_weight', (string) $this->getGrossWeight());
        }

        if ($this->getPoints() !== null) {
            $dg->addAttribute('points', (string) $this->getPoints());
        }

        return $xml;
    }
}
