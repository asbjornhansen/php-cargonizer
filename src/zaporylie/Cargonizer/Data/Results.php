<?php

declare(strict_types=1);

namespace zaporylie\Cargonizer\Data;

class Results implements SerializableDataInterface
{
    protected ?Location $location = null;

    protected ?ServicePartners $servicePartners = null;

    public function setLocation(?Location $location): self
    {
        $this->location = $location;

        return $this;
    }

    public function setServicePartners(?ServicePartners $servicePartners): self
    {
        $this->servicePartners = $servicePartners;

        return $this;
    }

    public function getLocation(): ?Location
    {
        return $this->location;
    }

    public function getServicePartners(): ?ServicePartners
    {
        return $this->servicePartners;
    }

    #[\Override]
    public static function fromXML(\SimpleXMLElement $xml): self
    {
        $results = new Results;
        $results->setLocation(Location::fromXML($xml->location));
        $results->setServicePartners(ServicePartners::fromXML($xml->{'service-partners'}));

        return $results;
    }

    /**
     * {@inheritdoc}
     */
    #[\Override]
    public function toXML(?\SimpleXMLElement $xml = null): \SimpleXMLElement
    {

        if (! $xml instanceof \SimpleXMLElement) {
            $xml = new \SimpleXMLElement('<?xml version="1.0" encoding="UTF-8"?><results></results>');
            $results = $xml;
        } else {
            $results = $xml->addChild('results');
        }

        if ($this->getLocation() instanceof Location) {
            $this->getLocation()->toXML($results);
        }

        if ($this->getServicePartners() instanceof ServicePartners) {
            $this->getServicePartners()->toXML($results);
        }

        return $xml;
    }
}
