<?php

namespace zaporylie\Cargonizer\Data;

class Product implements SerializableDataInterface {

  /**
   * @var string
   */
  protected ?string $identifier = null;

  /**
   * @var string
   */
  protected ?string $name = null;

  /**
   * @var int
   */
  protected ?int $minItems = null;

  /**
   * @var int
   */
  protected ?int $maxItems = null;

  /**
   * @var int
   */
  protected ?int $minWeight = null;

  /**
   * @var int
   */
  protected ?int $maxWeight = null;

  /**
   * @var \zaporylie\Cargonizer\Data\Services
   */
  protected ?Services $services = null;

  /**
   * @param string $identifier
   */
  public function setIdentifier(?string $identifier): self {
    $this->identifier = $identifier;
    return $this;
  }

  /**
   * @param int $maxItems
   */
  public function setMaxItems(?int $maxItems): self {
    $this->maxItems = $maxItems;
    return $this;
  }

  /**
   * @param int $maxWeight
   */
  public function setMaxWeight(?int $maxWeight): self {
    $this->maxWeight = $maxWeight;
    return $this;
  }

  /**
   * @param int $minItems
   */
  public function setMinItems(?int $minItems): self {
    $this->minItems = $minItems;
    return $this;
  }

  /**
   * @param int $minWeight
   */
  public function setMinWeight(?int $minWeight): self {
    $this->minWeight = $minWeight;
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
   * @param \zaporylie\Cargonizer\Data\Services $services
   */
  public function setServices(?Services $services): self {
    $this->services = $services;
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
  public function getMaxItems(): ?int {
    return $this->maxItems;
  }

  /**
   * @return int
   */
  public function getMaxWeight(): ?int {
    return $this->maxWeight;
  }

  /**
   * @return int
   */
  public function getMinItems(): ?int {
    return $this->minItems;
  }

  /**
   * @return int
   */
  public function getMinWeight(): ?int {
    return $this->minWeight;
  }

  /**
   * @return \zaporylie\Cargonizer\Data\Services
   */
  public function getServices(): ?Services {
    return $this->services;
  }

  /**
   * Product constructor.
   */
  public function __construct() {
  }

  /**
   * @param \SimpleXMLElement $xml
   *
   * @return \zaporylie\Cargonizer\Data\Product
   */
  public static function fromXML(\SimpleXMLElement $xml): self {
    $product = new Product();
    $product->setIdentifier((string) $xml->identifier);
    $product->setName((string) $xml->name);
    $product->setMinItems((int) $xml->min_items);
    $product->setMaxItems((int) $xml->max_items);
    $product->setMinWeight((int) $xml->min_weight);
    $product->setMaxWeight((int) $xml->max_weight);
    if (isset($xml->services->service)) {
      $product->setServices(Services::fromXML($xml->services->service));
    }
    return $product;
  }

  /**
   * {@inheritdoc}
   */
  public function toXML(\SimpleXMLElement $xml): \SimpleXMLElement {
    $product = $xml->addChild('product');
    $product->addChild('identifier', $this->getIdentifier() ?? '');
    $product->addChild('name', $this->getName() ?? '');
    $product->addChild('max_items', (string)($this->getMaxItems() ?? ''));
    $product->addChild('min_items', (string)($this->getMinItems() ?? ''));
    $product->addChild('max_weight', (string)($this->getMaxWeight() ?? ''));
    $product->addChild('min_weight', (string)($this->getMinWeight() ?? ''));
    if ($this->getServices() !== null) {
      $this->getServices()->toXML($product);
    }
    return $xml;
  }
}
