<?php

declare(strict_types=1);

namespace zaporylie\Cargonizer\Data;

/**
 * Class ServicePartner
 */
class ServicePartner implements SerializableDataInterface
{
    protected ?string $number = null;

    protected ?string $name = null;

    protected ?string $address1 = null;

    protected ?string $address2 = null;

    protected ?string $postcode = null;

    protected ?string $city = null;

    protected ?string $country = null;

    protected ?OpeningHours $openingHours = null;

    public function getName(): ?string
    {
        return $this->name;
    }

    public function getPostcode(): ?string
    {
        return $this->postcode;
    }

    public function getCountry(): ?string
    {
        return $this->country;
    }

    public function getCity(): ?string
    {
        return $this->city;
    }

    public function getAddress2(): ?string
    {
        return $this->address2;
    }

    public function getAddress1(): ?string
    {
        return $this->address1;
    }

    public function getNumber(): ?string
    {
        return $this->number;
    }

    /**
     * Gets openingHours value.
     */
    public function getOpeningHours(): ?OpeningHours
    {
        return $this->openingHours;
    }

    public function setPostcode(?string $postcode): self
    {
        $this->postcode = $postcode;

        return $this;
    }

    public function setCountry(?string $country): self
    {
        $this->country = $country;

        return $this;
    }

    public function setCity(?string $city): self
    {
        $this->city = $city;

        return $this;
    }

    public function setAddress2(?string $address2): self
    {
        $this->address2 = $address2;

        return $this;
    }

    public function setAddress1(?string $address1): self
    {
        $this->address1 = $address1;

        return $this;
    }

    public function setName(?string $name): self
    {
        $this->name = $name;

        return $this;
    }

    /**
     * @param  int  $number
     */
    public function setNumber(?string $number): self
    {
        $this->number = $number;

        return $this;
    }

    /**
     * @param  OpeningHours  $openingHours
     *                                      The opening hours.
     */
    public function setOpeningHours(?OpeningHours $openingHours): self
    {
        $this->openingHours = $openingHours;

        return $this;
    }

    /**
     * {@inheritdoc}
     */
    #[\Override]
    public static function fromXML(\SimpleXMLElement $xml): self
    {
        $servicePartner = new ServicePartner;
        $servicePartner->setPostcode((string) $xml->postcode);
        $servicePartner->setCountry((string) $xml->country);
        $servicePartner->setName((string) $xml->name);
        $servicePartner->setAddress1((string) $xml->address1);
        $servicePartner->setAddress2((string) $xml->address2);
        $servicePartner->setCity((string) $xml->city);
        $servicePartner->setNumber((string) $xml->number);
        if ($xml->{'opening-hours'} instanceof \SimpleXMLElement) {
            $servicePartner->setOpeningHours(OpeningHours::fromXML($xml));
        }

        return $servicePartner;
    }

    /**
     * {@inheritdoc}
     */
    #[\Override]
    public function toXML(\SimpleXMLElement $xml): \SimpleXMLElement
    {
        $partner = $xml->addChild('service-partner');
        $partner->addChild('number', $this->getNumber() ?? '');
        $partner->addChild('name', $this->getName() ?? '');
        $partner->addChild('address1', $this->getAddress1() ?? '');
        $partner->addChild('address2', $this->getAddress2() ?? '');
        $partner->addChild('postcode', $this->getPostcode() ?? '');
        $partner->addChild('city', $this->getCity() ?? '');
        $partner->addChild('country', $this->getCountry() ?? '');

        return $xml;
    }
}
