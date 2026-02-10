<?php

namespace zaporylie\Cargonizer\Data;

/**
 * Class Location
 *
 * @package zaporylie\Cargonizer\Data
 */
class Location implements SerializableDataInterface {

  /**
   * @var int
   */
  protected ?int $id = null;

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
   * @return int
   */
  public function getId(): ?int {
    return $this->id;
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
   * @param int $id
   */
  public function setId(?int $id): self {
    $this->id = $id;
    return $this;
  }

  /**
   * {@inheritdoc}
   */
  public static function fromXML(\SimpleXMLElement $xml): self {
    $location = new Location();
    $location->setCity((string) $xml->city);
    $location->setPostcode((string) $xml->postcode);
    $location->setCountry((string) $xml->country);
    $location->setId((int) $xml->id);
    return $location;
  }

  /**
   * {@inheritdoc}
   */
  public function toXML(\SimpleXMLElement $xml): \SimpleXMLElement {
    $location = $xml->addChild('location');
    $location->addChild('id', (string)($this->getId() ?? ''));
    $location->addChild('postcode', $this->getPostcode() ?? '');
    $location->addChild('city', $this->getCity() ?? '');
    $location->addChild('country', $this->getCountry() ?? '');
    return $xml;
  }
}
