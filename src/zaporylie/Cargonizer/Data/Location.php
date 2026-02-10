<?php

declare(strict_types=1);

namespace zaporylie\Cargonizer\Data;

/**
 * Class Location
 */
class Location implements SerializableDataInterface
{
    protected ?int $id = null;

    protected ?string $postcode = null;

    protected ?string $city = null;

    protected ?string $country = null;

    public function getCity(): ?string
    {
        return $this->city;
    }

    public function getCountry(): ?string
    {
        return $this->country;
    }

    public function getPostcode(): ?string
    {
        return $this->postcode;
    }

    public function getId(): ?int
    {
        return $this->id;
    }

    public function setCity(?string $city): self
    {
        $this->city = $city;

        return $this;
    }

    public function setCountry(?string $country): self
    {
        $this->country = $country;

        return $this;
    }

    public function setPostcode(?string $postcode): self
    {
        $this->postcode = $postcode;

        return $this;
    }

    public function setId(?int $id): self
    {
        $this->id = $id;

        return $this;
    }

    /**
     * {@inheritdoc}
     */
    #[\Override]
    public static function fromXML(\SimpleXMLElement $xml): self
    {
        $location = new Location;
        $location->setCity((string) $xml->city);
        $location->setPostcode((string) $xml->postcode);
        $location->setCountry((string) $xml->country);
        $location->setId((int) $xml->id);

        return $location;
    }

    /**
     * {@inheritdoc}
     */
    #[\Override]
    public function toXML(\SimpleXMLElement $xml): \SimpleXMLElement
    {
        $location = $xml->addChild('location');
        $location->addChild('id', (string) ($this->getId() ?? ''));
        $location->addChild('postcode', $this->getPostcode() ?? '');
        $location->addChild('city', $this->getCity() ?? '');
        $location->addChild('country', $this->getCountry() ?? '');

        return $xml;
    }
}
