<?php

namespace zaporylie\Cargonizer\Data;

class Item implements SerializableDataInterface {

  /**
   * @var string
   */
  protected ?string $package = null;

  /**
   * Required. Amount of parcels.
   *
   * @var int
   */
  protected ?int $amount = null;

  /**
   * Required.
   *
   * @var float
   */
  protected ?float $weight = null;

  /**
   * Required.
   *
   * @var float
   */
  protected ?float $volume = null;

  /**
   * Optional.
   *
   * @var float
   */
  protected ?float $length = null;

  /**
   * Optional.
   *
   * @var float
   */
  protected ?float $height = null;

  /**
   * Optional.
   *
   * @var float
   */
  protected ?float $width = null;

  /**
   * Optional.
   *
   * @var float
   */
  protected ?float $loadMeter = null;

  /**
   * Optional.
   *
   * @var string
   */
  protected ?string $description = null;

  /**
   * @param string $description
   */
  public function setDescription(?string $description): self {
    $this->description = $description;
    return $this;
  }

  /**
   * @param int $amount
   */
  public function setAmount(?int $amount): self {
    $this->amount = $amount;
    return $this;
  }

  /**
   * @param float $height
   */
  public function setHeight(?float $height): self {
    $this->height = $height;
    return $this;
  }

  /**
   * @param float $length
   */
  public function setLength(?float $length): self {
    $this->length = $length;
    return $this;
  }

  /**
   * @param float $loadMeter
   */
  public function setLoadMeter(?float $loadMeter): self {
    $this->loadMeter = $loadMeter;
    return $this;
  }

  /**
   * @param string $package
   */
  public function setPackage(?string $package): self {
    $this->package = $package;
    return $this;
  }

  /**
   * @param float $volume
   */
  public function setVolume(?float $volume): self {
    $this->volume = $volume;
    return $this;
  }

  /**
   * @param float $weight
   */
  public function setWeight(?float $weight): self {
    $this->weight = $weight;
    return $this;
  }

  /**
   * @param float $width
   */
  public function setWidth(?float $width): self {
    $this->width = $width;
    return $this;
  }

  /**
   * @return string
   */
  public function getDescription(): ?string {
    return $this->description;
  }

  /**
   * @return int
   */
  public function getAmount(): ?int {
    return $this->amount;
  }

  /**
   * @return float
   */
  public function getHeight(): ?float {
    return $this->height;
  }

  /**
   * @return float
   */
  public function getLength(): ?float {
    return $this->length;
  }

  /**
   * @return float
   */
  public function getLoadMeter(): ?float {
    return $this->loadMeter;
  }

  /**
   * @return string
   */
  public function getPackage(): ?string {
    return $this->package;
  }

  /**
   * @return float
   */
  public function getVolume(): ?float {
    return $this->volume;
  }

  /**
   * @return float
   */
  public function getWeight(): ?float {
    return $this->weight;
  }

  /**
   * @return float
   */
  public function getWidth(): ?float {
    return $this->width;
  }

  /**
   * {@inheritdoc}
   */
  public static function fromXML(\SimpleXMLElement $xml): self {
    $item = new Item();
    return $item;
  }


  /**
   * {@inheritdoc}
   */
  public function toXML(\SimpleXMLElement $xml): \SimpleXMLElement {
    $item = $xml->addChild('item');
    $item->addAttribute('type', $this->getPackage() ?? '');
    $item->addAttribute('amount', (string)($this->getAmount() ?? ''));
    $item->addAttribute('weight', (string)($this->getWeight() ?? ''));
    $item->addAttribute('description', $this->getDescription() ?? '');

    return $xml;
  }
}
