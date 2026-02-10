<?php

namespace zaporylie\Cargonizer\Data;

class Parts implements SerializableDataInterface {

  /**
   * @var \zaporylie\Cargonizer\Data\Consignee
   */
  protected ?Consignee $consignee = null;

  /**
   * @var \zaporylie\Cargonizer\Data\ServicePartner
   */
  protected ?ServicePartner $servicePartner = null;

  /**
   * @var \zaporylie\Cargonizer\Data\ReturnAddress
   */
  protected ?ReturnAddress $returnAddress = null;

  /**
   * @return \zaporylie\Cargonizer\Data\ReturnAddress
   */
  public function getReturnAddress(): ?ReturnAddress {
    return $this->returnAddress;
  }

  /**
   * @param \zaporylie\Cargonizer\Data\ReturnAddress $returnAddress
   */
  public function setReturnAddress(?ReturnAddress $returnAddress): self {
    $this->returnAddress = $returnAddress;
    return $this;
  }

  /**
   * @param \zaporylie\Cargonizer\Data\Consignee $consignee
   */
  public function setConsignee(?Consignee $consignee): self {
    $this->consignee = $consignee;
    return $this;
  }

  /**
   * @param \zaporylie\Cargonizer\Data\ServicePartner $servicePartner
   */
  public function setServicePartner(?ServicePartner $servicePartner): self {
    $this->servicePartner = $servicePartner;
    return $this;
  }

  /**
   * @return \zaporylie\Cargonizer\Data\Consignee
   */
  public function getConsignee(): ?Consignee {
    return $this->consignee;
  }

  /**
   * @return \zaporylie\Cargonizer\Data\ServicePartner
   */
  public function getServicePartner(): ?ServicePartner {
    return $this->servicePartner;
  }

  /**
   * @param \SimpleXMLElement $xml
   *
   * @return \zaporylie\Cargonizer\Data\Parts
   */
  public static function fromXML(\SimpleXMLElement $xml): self {
    $parts = new Parts();
    $parts->setConsignee(Consignee::fromXML($xml->{'consignee'}));
    $parts->setServicePartner(ServicePartner::fromXML($xml->{'service-partner'}));
    return $parts;
  }

  /**
   * {@inheritdoc}
   */
  public function toXML(\SimpleXMLElement $xml): \SimpleXMLElement {
    $parts = $xml->addChild('parts');
    if ($this->getConsignee()) {
      $this->getConsignee()->toXML($parts);
    }
    if ($this->getServicePartner()) {
      $this->getServicePartner()->toXML($parts);
    }
    if ($this->getReturnAddress()) {
      $this->getReturnAddress()->toXML($parts);
    }
    return $xml;
  }
}
