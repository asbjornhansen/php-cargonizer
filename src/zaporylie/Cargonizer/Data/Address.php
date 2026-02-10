<?php

declare(strict_types=1);

namespace zaporylie\Cargonizer\Data;

abstract class Address implements AddressInterface, SerializableDataInterface
{
    protected ?string $address1 = null;

    protected ?string $address2 = null;

    protected ?string $city = null;

    protected ?string $country = null;

    protected ?string $fax = null;

    protected ?string $mobile = null;

    protected ?string $name = null;

    protected ?string $phone = null;

    protected ?string $postcode = null;

    #[\Override]
    public function setName(?string $name): self
    {
        $this->name = $name;

        return $this;
    }

    #[\Override]
    public function setPostcode(?string $postcode): self
    {
        $this->postcode = $postcode;

        return $this;
    }

    #[\Override]
    public function setCountry(?string $country): self
    {
        $this->country = $country;

        return $this;
    }

    #[\Override]
    public function setCity(?string $city): self
    {
        $this->city = $city;

        return $this;
    }

    #[\Override]
    public function setAddress1(?string $address1): self
    {
        $this->address1 = $address1;

        return $this;
    }

    #[\Override]
    public function setAddress2(?string $address2): self
    {
        $this->address2 = $address2;

        return $this;
    }

    #[\Override]
    public function setFax(?string $fax): self
    {
        $this->fax = $fax;

        return $this;
    }

    #[\Override]
    public function setPhone(?string $phone): self
    {
        $this->phone = $phone;

        return $this;
    }

    #[\Override]
    public function setMobile(?string $mobile): self
    {
        $this->mobile = $mobile;

        return $this;
    }

    #[\Override]
    public function getName(): ?string
    {
        return $this->name;
    }

    #[\Override]
    public function getPostcode(): ?string
    {
        return $this->postcode;
    }

    #[\Override]
    public function getCountry(): ?string
    {
        return $this->country;
    }

    #[\Override]
    public function getCity(): ?string
    {
        return $this->city;
    }

    #[\Override]
    public function getAddress1(): ?string
    {
        return $this->address1;
    }

    #[\Override]
    public function getAddress2(): ?string
    {
        return $this->address2;
    }

    #[\Override]
    public function getFax(): ?string
    {
        return $this->fax;
    }

    #[\Override]
    public function getPhone(): ?string
    {
        return $this->phone;
    }

    #[\Override]
    public function getMobile(): ?string
    {
        return $this->mobile;
    }

    /**
     * {@inheritdoc}
     */
    #[\Override]
    public static function fromXML(\SimpleXMLElement $xml, ?AddressInterface $address = null): SerializableDataInterface
    {
        $address->setName((string) $xml->name);
        $address->setPostcode((string) $xml->postcode);
        $address->setCity((string) $xml->city);
        $address->setCountry((string) $xml->country);
        $address->setAddress1((string) $xml->address1);
        $address->setAddress2((string) $xml->address2);
        $address->setMobile((string) $xml->mobile);
        $address->setPhone((string) $xml->phone);
        $address->setFax((string) $xml->fax);

        return $address;
    }

    /**
     * {@inheritdoc}
     */
    #[\Override]
    public function toXML(\SimpleXMLElement $xml): \SimpleXMLElement
    {
        $xml->addChild('name', $this->getName() ?? '');
        $xml->addChild('country', $this->getCountry() ?? '');
        $xml->addChild('postcode', $this->getPostcode() ?? '');
        $xml->addChild('city', $this->getCity() ?? '');
        $xml->addChild('address1', $this->getAddress1() ?? '');
        $xml->addChild('address2', $this->getAddress2() ?? '');
        $xml->addChild('mobile', $this->getMobile() ?? '');
        $xml->addChild('phone', $this->getPhone() ?? '');
        $xml->addChild('fax', $this->getFax() ?? '');

        return $xml;
    }
}
