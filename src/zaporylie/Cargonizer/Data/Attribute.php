<?php

namespace zaporylie\Cargonizer\Data;

class Attribute implements SerializableDataInterface {

  /**
   * @var string
   */
  protected ?string $identifier = null;

  /**
   * @var string
   */
  protected ?string $name = null;

  /**
   * @var string
   */
  protected ?string $type = null;

  /**
   * @var bool
   */
  protected ?bool $required = null;

  /**
   * @var int
   */
  protected ?int $min = null;

  /**
   * @var int
   */
  protected ?int $max = null;

  /**
   * @var null|array
   */
  protected ?array $values = null;

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
   * @param int $min
   */
  public function setMin(?int $min): self {
    $this->min = $min;
    return $this;
  }

  /**
   * @param int $max
   */
  public function setMax(?int $max): self {
    $this->max = $max;
    return $this;
  }

  /**
   * @param bool $required
   */
  public function setRequired(?bool $required): self {
    $this->required = $required;
    return $this;
  }

  /**
   * @param string $type
   */
  public function setType(?string $type): self {
    $this->type = $type;
    return $this;
  }

  /**
   * @param array $values
   */
  public function setValues(?array $values): self {
    $this->values = $values;
    return $this;
  }

  /**
   * @return string
   */
  public function getIdentifier(): ?string {
    return $this->identifier;
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
  public function getMax(): ?int {
    return $this->max;
  }

  /**
   * @return int
   */
  public function getMin(): ?int {
    return $this->min;
  }

  /**
   * @return string
   */
  public function getType(): ?string {
    return $this->type;
  }

  /**
   * @return array|null
   */
  public function getValues(): ?array {
    return $this->values;
  }

  /**
   * @param \SimpleXMLElement $xml
   *
   * @return \zaporylie\Cargonizer\Data\Attribute
   */
  public static function fromXML(\SimpleXMLElement $xml): self {
    $attribute = new Attribute();
    $attribute->setIdentifier((string) $xml->identifier);
    $attribute->setName((string) $xml->name);
    $attribute->setType((string) $xml->type);
    $attribute->setRequired((string) $xml->required === 'true');
    $attribute->setMin((int) $xml->min);
    $attribute->setMax((int) $xml->max);
    return $attribute;
  }

  public function toXML(\SimpleXMLElement $xml): \SimpleXMLElement {
    $attribute = $xml->addChild('attribute');
    $attribute->addChild('identifier', $this->getIdentifier() ?? '');
    $attribute->addChild('name', $this->getName() ?? '');
    $attribute->addChild('min', (string)($this->getMin() ?? ''));
    $attribute->addChild('max', (string)($this->getMax() ?? ''));
    return $xml;
  }
}
