<?php

namespace zaporylie\Cargonizer\Data;

class Plan implements SerializableDataInterface {

  /**
   * @var string
   */
  protected ?string $name = null;

  /**
   * @var int
   */
  protected ?int $itemLimit = null;

  /**
   * @var int
   */
  protected ?int $itemCounter = null;

  /**
   * @return string
   */
  public function getName(): ?string {
    return $this->name;
  }

  /**
   * @return int
   */
  public function getItemCounter(): ?int {
    return $this->itemCounter;
  }

  /**
   * @return int
   */
  public function getItemLimit(): ?int {
    return $this->itemLimit;
  }

  /**
   * @param string $name
   */
  public function setName(?string $name): self {
    $this->name = $name;
    return $this;
  }

  /**
   * @param int $itemCounter
   */
  public function setItemCounter(?int $itemCounter): self {
    $this->itemCounter = $itemCounter;
    return $this;
  }

  /**
   * @param int $itemLimit
   */
  public function setItemLimit(?int $itemLimit): self {
    $this->itemLimit = $itemLimit;
    return $this;
  }

  /**
   * {@inheritdoc}
   */
  public static function fromXML(\SimpleXMLElement $xml): self {
    $plan = new Plan();
    $plan->setName((string) $xml->{'name'});
    $plan->setItemLimit((int) $xml->{'item_limit'});
    $plan->setItemCounter((int) $xml->{'item_counter'});
    return $plan;
  }

  /**
   * {@inheritdoc}
   */
  public function toXML(\SimpleXMLElement $xml): \SimpleXMLElement {
    $plan = $xml->addChild('plan');
    $xml->addChild('plan', $this->getName() ?? '');
    $xml->addChild('item_limit', (string)($this->getItemLimit() ?? ''));
    $xml->addChild('item_counter', (string)($this->getItemCounter() ?? ''));
    return $xml;
  }
}
