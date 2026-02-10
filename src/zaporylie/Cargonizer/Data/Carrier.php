<?php

namespace zaporylie\Cargonizer\Data;

class Carrier implements SerializableDataInterface {

  /**
   * @var string
   */
  protected ?string $identifier = null;

  /**
   * @var string
   */
  protected ?string $name = null;

  /**
   * @param string $name
   */
  public function setName(?string $name): self {
    $this->name = $name;
    return $this;
  }

  /**
   * @param string $identifier
   */
  public function setIdentifier(?string $identifier): self {
    $this->identifier = $identifier;
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
   * @param \SimpleXMLElement $xml
   *
   * @return \zaporylie\Cargonizer\Data\Carrier
   */
  public static function fromXML(\SimpleXMLElement $xml): self {
    $carrier = new Carrier();
    $carrier->setName((string) $xml->name);
    $carrier->setIdentifier((string) $xml->identifier);
    return $carrier;
  }

  /**
   * @param \SimpleXMLElement $xml
   *
   * @return \SimpleXMLElement
   */
  public function toXML(\SimpleXMLElement $xml): \SimpleXMLElement {
    $carrier = $xml->addChild('carrier');
    $carrier->addChild('identifier', $this->getIdentifier() ?? '');
    $carrier->addChild('name', $this->getName() ?? '');
    return $xml;
  }
}
