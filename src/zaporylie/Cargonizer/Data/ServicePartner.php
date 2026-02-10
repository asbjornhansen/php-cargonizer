<?php

namespace zaporylie\Cargonizer\Data;

/**
 * Class ServicePartner
 *
 * @package zaporylie\Cargonizer\Data
 */
class ServicePartner implements SerializableDataInterface {

  /**
   * @var string
   */
  protected ?string $number = null;

  /**
   * @var string
   */
  protected ?string $name = null;

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
  protected ?string $postcode = null;

  /**
   * @var string
   */
  protected ?string $city = null;

  /**
   * @var string
   */
  protected ?string $country = null;

  /**
   * @var \zaporylie\Cargonizer\Data\OpeningHours
   */
  protected ?OpeningHours $openingHours = null;

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
  public function getAddress2(): ?string {
    return $this->address2;
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
  public function getNumber(): ?string {
    return $this->number;
  }

  /**
   * Gets openingHours value.
   *
   * @return \zaporylie\Cargonizer\Data\OpeningHours
   */
  public function getOpeningHours(): ?OpeningHours {
    return $this->openingHours;
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
   * @param string $address2
   */
  public function setAddress2(?string $address2): self {
    $this->address2 = $address2;
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
   * @param string $name
   */
  public function setName(?string $name): self {
    $this->name = $name;
    return $this;
  }

  /**
   * @param int $number
   */
  public function setNumber(?string $number): self {
    $this->number = $number;
    return $this;
  }

  /**
   * @param \zaporylie\Cargonizer\Data\OpeningHours $openingHours
   *   The opening hours.
   */
  public function setOpeningHours(?OpeningHours $openingHours): self {
    $this->openingHours = $openingHours;
    return $this;
  }

  /**
   * {@inheritdoc}
   */
  public static function fromXML(\SimpleXMLElement $xml): self {
    $partner = new ServicePartner();
    $partner->setPostcode((string) $xml->postcode);
    $partner->setCountry((string) $xml->country);
    $partner->setName((string) $xml->name);
    $partner->setAddress1((string) $xml->address1);
    $partner->setAddress2((string) $xml->address2);
    $partner->setCity((string) $xml->city);
    $partner->setNumber((string) $xml->number);
    if ($xml->{'opening-hours'} instanceof \SimpleXMLElement) {
      $partner->setOpeningHours(OpeningHours::fromXML($xml));
    }
    return $partner;
  }

  /**
   * {@inheritdoc}
   */
  public function toXML(\SimpleXMLElement $xml): \SimpleXMLElement {
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
