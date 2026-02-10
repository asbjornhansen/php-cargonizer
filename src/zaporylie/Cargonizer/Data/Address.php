<?php

namespace zaporylie\Cargonizer\Data;

abstract class Address implements AddressInterface, SerializableDataInterface {

  /**
   * @var string
   */
  protected ?string $address1 = null;

  /**
   * @var string
   */
  protected ?string $address2 = null;

  /**
   * @var string
   */
  protected ?string $city = null;

  /**
   * @var string
   */
  protected ?string $country = null;

  /**
   * @var string
   */
  protected ?string $fax = null;

  /**
   * @var string
   */
  protected ?string $mobile = null;

  /**
   * @var string
   */
  protected ?string $name = null;

  /**
   * @var string
   */
  protected ?string $phone = null;

  /**
   * @var string
   */
  protected ?string $postcode = null;

  /**
   * @param string $name
   */
  public function setName(?string $name): self {
    $this->name = $name;
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
   * @param string $country
   */
  public function setCountry(?string $country): self {
    $this->country = $country;
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
   * @param string $fax
   */
  public function setFax(?string $fax): self {
    $this->fax = $fax;
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
   * @param string $mobile
   */
  public function setMobile(?string $mobile): self {
    $this->mobile = $mobile;
    return $this;
  }

  /**
   * @return string
   */
  public function getName(): ?string {
    return $this->name;
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
  public function getCountry(): ?string {
    return $this->country;
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
  public function getFax(): ?string {
    return $this->fax;
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
  public function getMobile(): ?string {
    return $this->mobile;
  }

  /**
   * {@inheritdoc}
   */
  public static function fromXML(\SimpleXMLElement $xml, AddressInterface $address = null) {
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
  public function toXML(\SimpleXMLElement $xml): \SimpleXMLElement {
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
