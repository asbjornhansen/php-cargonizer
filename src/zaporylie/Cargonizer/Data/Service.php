<?php

namespace zaporylie\Cargonizer\Data;

class Service implements SerializableDataInterface {

  /**
   * @var string
   */
  protected ?string $identifier = null;

  /**
   * @var string
   */
  protected ?string $name = null;

  /**
   * @var \zaporylie\Cargonizer\Data\Attribute[]
   */
  protected array $attributes = [];

  /**
   * @param string $identifier
   */
  public function setIdentifier(?string $identifier): self {
    $this->identifier = $identifier;
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
   * @param \zaporylie\Cargonizer\Data\Attribute[] $attributes
   */
  public function setAttributes(array $attributes): self {
    $this->attributes = $attributes;
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
  public function getIdentifier(): ?string {
    return $this->identifier;
  }

  /**
   * @return \zaporylie\Cargonizer\Data\Attribute[]
   */
  public function getAttributes(): array {
    return $this->attributes;
  }

  /**
   * {@inheritdoc}
   */
  public static function fromXML(\SimpleXMLElement $xml): self {
    $service = new Service();
    $service->setIdentifier((string) $xml->identifier);
    $service->setName((string) $xml->name);
    $attributes = [];
    if (isset($xml->attributes->attribute)) {
      foreach ($xml->attributes->attribute as $attribute) {
        $attributes[] = Attribute::fromXML($attribute);
      }
    }
    $service->setAttributes($attributes);
    return $service;
  }

  /**
   * {@inheritdoc}
   */
  public function toXML(\SimpleXMLElement $xml): \SimpleXMLElement {
    return $xml;
  }
}
