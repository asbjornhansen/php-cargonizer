<?php

namespace zaporylie\Cargonizer\Data;

class TransportAgreement implements SerializableDataInterface {

  /**
   * @var string
   */
  protected ?string $description = null;

  /**
   * @var int
   */
  protected ?int $id = null;

  /**
   * @var int
   */
  protected ?int $number = null;

  /**
   * @var \zaporylie\Cargonizer\Data\Carrier
   */
  protected ?Carrier $carrier = null;

  /**
   * @var \zaporylie\Cargonizer\Data\Products
   */
  protected ?Products $products = null;

  /**
   * @param string $description
   */
  public function setDescription(?string $description): self {
    $this->description = $description;
    return $this;
  }

  /**
   * @param \zaporylie\Cargonizer\Data\Carrier $carrier
   */
  public function setCarrier(?Carrier $carrier): self {
    $this->carrier = $carrier;
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
   * @param int $number
   */
  public function setNumber(?int $number): self {
    $this->number = $number;
    return $this;
  }

  /**
   * @param \zaporylie\Cargonizer\Data\Products $products
   */
  public function setProducts(?Products $products): self {
    $this->products = $products;
    return $this;
  }

  /**
   * @return int
   */
  public function getId(): ?int {
    return $this->id;
  }

  /**
   * @return \zaporylie\Cargonizer\Data\Carrier
   */
  public function getCarrier(): ?Carrier {
    return $this->carrier;
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
  public function getNumber(): ?int {
    return $this->number;
  }

  /**
   * @return \zaporylie\Cargonizer\Data\Products
   */
  public function getProducts(): ?Products {
    return $this->products;
  }

  /**
   * {@inheritdoc}
   */
  public static function fromXML(\SimpleXMLElement $xml): self {
    $transportAgreement = new TransportAgreement();
    $transportAgreement->setDescription((string) $xml->description);
    $transportAgreement->setId((int) $xml->id);
    $transportAgreement->setNumber((int) $xml->number);
    if ($xml->carrier instanceof \SimpleXMLElement) {
      $transportAgreement->setCarrier(Carrier::fromXML($xml->carrier));
    }
    if (isset($xml->products->product)) {
      $transportAgreement->setProducts(Products::fromXML($xml->products->product));
    }
    return $transportAgreement;
  }

  /**
   * {@inheritdoc}
   */
  public function toXML(\SimpleXMLElement $xml): \SimpleXMLElement {
    $agreement = $xml->addChild('transport-agreement');
    $agreement->addChild('description', $this->getDescription() ?? '');
    $agreement->addChild('id', (string)($this->getId() ?? ''));
    $agreement->addChild('number', (string)($this->getNumber() ?? ''));
    if ($this->getCarrier() !== null) {
      $this->getCarrier()->toXML($agreement);
    }
    if ($this->getProducts() !== null) {
      $this->getProducts()->toXML($agreement);
    }
//    $agreement->addChild('products', $this->get);
//    $agreement->addChild('', $this->get);

    return $xml;
  }
}
