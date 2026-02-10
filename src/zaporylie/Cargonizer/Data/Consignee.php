<?php

namespace zaporylie\Cargonizer\Data;

class Consignee implements SerializableDataInterface {

  /**
   * Optional.
   *
   * @var bool
   */
  protected ?bool $freightPayer = null;

  /**
   * Optional.
   *
   * @var int
   */
  protected ?int $number = null;

  /**
   * Required.
   *
   * @var string
   */
  protected ?string $name = null;

  /**
   * Optional.
   *
   * @var string
   */
  protected ?string $address1 = null;

  /**
   * Optional.
   *
   * @var string
   */
  protected ?string $address2 = null;

  /**
   * Required.
   *
   * @var string
   */
  protected ?string $postcode = null;

  /**
   * Optional.
   *
   * @var string
   */
  protected ?string $city = null;

  /**
   * Required. Only ISO 3166-1 (2-alpha) is supported.
   *
   * @var string
   */
  protected ?string $country = null;

  /**
   * Optional.
   *
   * @var string
   */
  protected ?string $email = null;

  /**
   * Optional.
   *
   * @var string
   */
  protected ?string $mobile = null;

  /**
   * Optional.
   *
   * @var string
   */
  protected ?string $phone = null;

  /**
   * Optional.
   *
   * @var string
   */
  protected ?string $fax = null;

  /**
   * Optional.
   *
   * @var string
   */
  protected ?string $contactPerson = null;

  /**
   * Optional.
   *
   * @var int
   */
  protected ?int $customerNumber = null;

  /**
   * @param int $number
   */
  public function setNumber(?int $number): self {
    $this->number = $number;
    return $this;
  }

  /**
   * @param string $name
   */
  public function setName(?string $name): self {
    $this->name = $name;
    return $this;
  }

  /**
   * @param string $address1
   */
  public function setAddress1(?string $address1): self {
    $this->address1 = $address1;
    return $this;
  }

  /**
   * @param string $address2
   */
  public function setAddress2(?string $address2): self {
    $this->address2 = $address2;
    return $this;
  }

  /**
   * @param string $city
   */
  public function setCity(?string $city): self {
    $this->city = $city;
    return $this;
  }

  /**
   * @param string $country
   */
  public function setCountry(?string $country): self {
    $this->country = $country;
    return $this;
  }

  /**
   * @param string $postcode
   */
  public function setPostcode(?string $postcode): self {
    $this->postcode = $postcode;
    return $this;
  }

  /**
   * @param string $contactPerson
   */
  public function setContactPerson(?string $contactPerson): self {
    $this->contactPerson = $contactPerson;
    return $this;
  }

  /**
   * @param int $customerNumber
   */
  public function setCustomerNumber(?int $customerNumber): self {
    $this->customerNumber = $customerNumber;
    return $this;
  }

  /**
   * @param string $email
   */
  public function setEmail(?string $email): self {
    $this->email = $email;
    return $this;
  }

  /**
   * @param string $mobile
   */
  public function setMobile(?string $mobile): self {
    $this->mobile = $mobile;
    return $this;
  }

  /**
   * @param string $phone
   */
  public function setPhone(?string $phone): self {
    $this->phone = $phone;
    return $this;
  }

  /**
   * @param string $fax
   */
  public function setFax(?string $fax): self {
    $this->fax = $fax;
    return $this;
  }

  /**
   * @param bool $freightPayer
   */
  public function setFreightPayer(?bool $freightPayer): self {
    $this->freightPayer = $freightPayer;
    return $this;
  }

  /**
   * @return string
   */
  public function getName(): ?string {
    return $this->name;
  }

  /**
   * @return int
   */
  public function getNumber(): ?int {
    return $this->number;
  }

  /**
   * @return string
   */
  public function getAddress1(): ?string {
    return $this->address1;
  }

  /**
   * @return string
   */
  public function getAddress2(): ?string {
    return $this->address2;
  }

  /**
   * @return string
   */
  public function getCity(): ?string {
    return $this->city;
  }

  /**
   * @return string
   */
  public function getCountry(): ?string {
    return $this->country;
  }

  /**
   * @return string
   */
  public function getPostcode(): ?string {
    return $this->postcode;
  }

  /**
   * @return string
   */
  public function getContactPerson(): ?string {
    return $this->contactPerson;
  }

  /**
   * @return int
   */
  public function getCustomerNumber(): ?int {
    return $this->customerNumber;
  }

  /**
   * @return string
   */
  public function getEmail(): ?string {
    return $this->email;
  }

  /**
   * @return string
   */
  public function getMobile(): ?string {
    return $this->mobile;
  }

  /**
   * @return string
   */
  public function getPhone(): ?string {
    return $this->phone;
  }

  /**
   * @return string
   */
  public function getFax(): ?string {
    return $this->fax;
  }

  /**
   * {@inheritdoc}
   */
  public static function fromXML(\SimpleXMLElement $xml): self {
    $consignee = new Consignee();
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
  public function toXML(\SimpleXMLElement $xml): \SimpleXMLElement {
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
    $consignee->addChild('customer-number', (string)($this->getCustomerNumber() ?? ''));
    return $xml;
  }
}
