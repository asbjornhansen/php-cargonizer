<?php

declare(strict_types=1);

namespace zaporylie\Cargonizer\Data;

class Consignee implements SerializableDataInterface
{
    /**
     * Optional.
     */
    protected ?bool $freightPayer = null;

    /**
     * Optional.
     */
    protected ?int $number = null;

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

    /**
     * Optional.
     */
    protected ?string $email = null;

    /**
     * Optional.
     */
    protected ?string $mobile = null;

    /**
     * Optional.
     */
    protected ?string $phone = null;

    /**
     * Optional.
     */
    protected ?string $fax = null;

    /**
     * Optional.
     */
    protected ?string $contactPerson = null;

    /**
     * Optional.
     */
    protected ?int $customerNumber = null;

    public function setNumber(?int $number): self
    {
        $this->number = $number;

        return $this;
    }

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

    public function setContactPerson(?string $contactPerson): self
    {
        $this->contactPerson = $contactPerson;

        return $this;
    }

    public function setCustomerNumber(?int $customerNumber): self
    {
        $this->customerNumber = $customerNumber;

        return $this;
    }

    public function setEmail(?string $email): self
    {
        $this->email = $email;

        return $this;
    }

    public function setMobile(?string $mobile): self
    {
        $this->mobile = $mobile;

        return $this;
    }

    public function setPhone(?string $phone): self
    {
        $this->phone = $phone;

        return $this;
    }

    public function setFax(?string $fax): self
    {
        $this->fax = $fax;

        return $this;
    }

    public function setFreightPayer(?bool $freightPayer): self
    {
        $this->freightPayer = $freightPayer;

        return $this;
    }

    public function getName(): ?string
    {
        return $this->name;
    }

    public function getNumber(): ?int
    {
        return $this->number;
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

    public function getContactPerson(): ?string
    {
        return $this->contactPerson;
    }

    public function getCustomerNumber(): ?int
    {
        return $this->customerNumber;
    }

    public function getEmail(): ?string
    {
        return $this->email;
    }

    public function getMobile(): ?string
    {
        return $this->mobile;
    }

    public function getPhone(): ?string
    {
        return $this->phone;
    }

    public function getFax(): ?string
    {
        return $this->fax;
    }

    /**
     * {@inheritdoc}
     */
    #[\Override]
    public static function fromXML(\SimpleXMLElement $xml): self
    {
        $consignee = new Consignee;
        $consignee->setName((string) $xml->name);
        $consignee->setPostcode((string) $xml->postcode);
        $consignee->setCity((string) $xml->city);
        $consignee->setCountry((string) $xml->country);
        $consignee->setAddress1((string) $xml->address1);
        $consignee->setAddress2((string) $xml->address2);
        $consignee->setEmail((string) $xml->email);
        $consignee->setMobile((string) $xml->mobile);
        $consignee->setPhone((string) $xml->phone);
        $consignee->setFax((string) $xml->fax);

        return $consignee;
    }

    /**
     * {@inheritdoc}
     */
    #[\Override]
    public function toXML(\SimpleXMLElement $xml): \SimpleXMLElement
    {
        $consignee = $xml->addChild('consignee');
        $consignee->addChild('name', $this->getName() ?? '');
        $consignee->addChild('country', $this->getCountry() ?? '');
        $consignee->addChild('postcode', $this->getPostcode() ?? '');
        $consignee->addChild('city', $this->getCity() ?? '');
        $consignee->addChild('address1', $this->getAddress1() ?? '');
        $consignee->addChild('address2', $this->getAddress2() ?? '');
        $consignee->addChild('email', $this->getEmail() ?? '');
        $consignee->addChild('mobile', $this->getMobile() ?? '');
        $consignee->addChild('phone', $this->getPhone() ?? '');
        $consignee->addChild('fax', $this->getFax() ?? '');
        $consignee->addChild('customer-number', (string) ($this->getCustomerNumber() ?? ''));

        return $xml;
    }
}
