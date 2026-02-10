<?php

declare(strict_types=1);

namespace zaporylie\Cargonizer\Data;

class Estimation implements SerializableDataInterface
{
    protected ?float $gross = null;

    protected ?float $net = null;

    protected ?float $estimated = null;

    public function setEstimated(?float $estimated): self
    {
        $this->estimated = $estimated;

        return $this;
    }

    public function setGross(?float $gross): self
    {
        $this->gross = $gross;

        return $this;
    }

    public function setNet(?float $net): self
    {
        $this->net = $net;

        return $this;
    }

    public function getEstimated(): ?float
    {
        return $this->estimated;
    }

    public function getGross(): ?float
    {
        return $this->gross;
    }

    public function getNet(): ?float
    {
        return $this->net;
    }

    /**
     * {@inheritdoc}
     */
    #[\Override]
    public static function fromXML(\SimpleXMLElement $xml): self
    {
        $estimation = new Estimation;
        $estimation->setEstimated((float) $xml->{'estimated-cost'});
        $estimation->setGross((float) $xml->{'gross-amount'});
        $estimation->setNet((float) $xml->{'net-amount'});

        return $estimation;
    }

    /**
     * {@inheritdoc}
     */
    #[\Override]
    public function toXML(?\SimpleXMLElement $xml = null): \SimpleXMLElement
    {
        if (! $xml instanceof \SimpleXMLElement) {
            $xml = new \SimpleXMLElement('<?xml version="1.0" encoding="UTF-8"?><hash></hash>');
        }

        $xml->addChild('gross-amount', (string) ($this->getGross() ?? ''))->addAttribute('type', 'float');
        $xml->addChild('net-amount', (string) ($this->getNet() ?? ''))->addAttribute('type', 'float');
        $xml->addChild('estimated-amount', (string) ($this->getEstimated() ?? ''))->addAttribute('type', 'float');

        return $xml;
    }
}
