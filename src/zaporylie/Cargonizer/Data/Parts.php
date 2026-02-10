<?php

declare(strict_types=1);

namespace zaporylie\Cargonizer\Data;

class Parts implements SerializableDataInterface
{
    protected ?Consignee $consignee = null;

    protected ?ServicePartner $servicePartner = null;

    protected ?ReturnAddress $returnAddress = null;

    public function getReturnAddress(): ?ReturnAddress
    {
        return $this->returnAddress;
    }

    public function setReturnAddress(?ReturnAddress $returnAddress): self
    {
        $this->returnAddress = $returnAddress;

        return $this;
    }

    public function setConsignee(?Consignee $consignee): self
    {
        $this->consignee = $consignee;

        return $this;
    }

    public function setServicePartner(?ServicePartner $servicePartner): self
    {
        $this->servicePartner = $servicePartner;

        return $this;
    }

    public function getConsignee(): ?Consignee
    {
        return $this->consignee;
    }

    public function getServicePartner(): ?ServicePartner
    {
        return $this->servicePartner;
    }

    #[\Override]
    public static function fromXML(\SimpleXMLElement $xml): self
    {
        $parts = new Parts;
        $parts->setConsignee(Consignee::fromXML($xml->{'consignee'}));
        $parts->setServicePartner(ServicePartner::fromXML($xml->{'service-partner'}));

        return $parts;
    }

    /**
     * {@inheritdoc}
     */
    #[\Override]
    public function toXML(\SimpleXMLElement $xml): \SimpleXMLElement
    {
        $parts = $xml->addChild('parts');
        if ($this->getConsignee() instanceof Consignee) {
            $this->getConsignee()->toXML($parts);
        }

        if ($this->getServicePartner() instanceof ServicePartner) {
            $this->getServicePartner()->toXML($parts);
        }

        if ($this->getReturnAddress() instanceof ReturnAddress) {
            $this->getReturnAddress()->toXML($parts);
        }

        return $xml;
    }
}
