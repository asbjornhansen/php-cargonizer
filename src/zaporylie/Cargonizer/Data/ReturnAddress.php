<?php

declare(strict_types=1);

namespace zaporylie\Cargonizer\Data;

class ReturnAddress implements SerializableDataInterface
{
    /**
     * Required.
     */
    protected ?string $name = null;

    /**
     * Optional.
     */
    protected ?string $address1 = null;

    /**
     * Optional.
     */
    protected ?string $address2 = null;

    /**
     * Required.
     */
    protected ?string $postcode = null;

    /**
     * Optional.
     */
    protected ?string $city = null;

    /**
     * Required. Only ISO 3166-1 (2-alpha) is supported.
     */
    protected ?string $country = null;

    public function setName(?string $name): self
    {
        $this->name = $name;

        return $this;
    }

    public function setAddress1(?string $address1): self
    {
        $this->address1 = $address1;

        return $this;
    }

    public function setAddress2(?string $address2): self
    {
        $this->address2 = $address2;

        return $this;
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

    public function getName(): ?string
    {
        return $this->name;
    }

    public function getAddress1(): ?string
    {
        return $this->address1;
    }

    public function getAddress2(): ?string
    {
        return $this->address2;
    }

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

    /**
     * {@inheritdoc}
     */
    #[\Override]
    public static function fromXML(\SimpleXMLElement $xml): self
    {
        $returnAddress = new ReturnAddress;
        $returnAddress->setName((string) $xml->name);
        $returnAddress->setPostcode((string) $xml->postcode);
        $returnAddress->setCity((string) $xml->city);
        $returnAddress->setCountry((string) $xml->country);
        $returnAddress->setAddress1((string) $xml->address1);
        $returnAddress->setAddress2((string) $xml->address2);

        return $returnAddress;
    }

    /**
     * {@inheritdoc}
     */
    #[\Override]
    public function toXML(\SimpleXMLElement $xml): \SimpleXMLElement
    {
        $return_address = $xml->addChild('return_address');
        $return_address->addChild('name', $this->getName() ?? '');
        $return_address->addChild('country', $this->getCountry() ?? '');
        $return_address->addChild('postcode', $this->getPostcode() ?? '');
        $return_address->addChild('city', $this->getCity() ?? '');
        $return_address->addChild('address1', $this->getAddress1() ?? '');
        $return_address->addChild('address2', $this->getAddress2() ?? '');

        return $xml;
    }
}
