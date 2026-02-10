<?php

namespace zaporylie\Cargonizer\Data;

class ReturnAddress implements SerializableDataInterface {

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
   * @return string
   */
  public function getName(): ?string {
    return $this->name;
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
   * {@inheritdoc}
   */
  public static function fromXML(\SimpleXMLElement $xml): self {
    $consignee = new ReturnAddress();
    $consignee->setName((string) $xml->name);
    $consignee->setPostcode((string) $xml->postcode);
    $consignee->setCity((string) $xml->city);
    $consignee->setCountry((string) $xml->country);
    $consignee->setAddress1((string) $xml->address1);
    $consignee->setAddress2((string) $xml->address2);
    return $consignee;
  }

  /**
   * {@inheritdoc}
   */
  public function toXML(\SimpleXMLElement $xml): \SimpleXMLElement {
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
