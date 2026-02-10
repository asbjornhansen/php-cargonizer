<?php

namespace zaporylie\Cargonizer\Data;

class Estimation implements SerializableDataInterface {

  /**
   * @var float
   */
  protected ?float $gross = null;

  /**
   * @var float
   */
  protected ?float $net = null;

  /**
   * @var float
   */
  protected ?float $estimated = null;

  /**
   * @param float $estimated
   */
  public function setEstimated(?float $estimated): self {
    $this->estimated = $estimated;
    return $this;
  }

  /**
   * @param float $gross
   */
  public function setGross(?float $gross): self {
    $this->gross = $gross;
    return $this;
  }

  /**
   * @param float $net
   */
  public function setNet(?float $net): self {
    $this->net = $net;
    return $this;
  }

  /**
   * @return float
   */
  public function getEstimated(): ?float {
    return $this->estimated;
  }

  /**
   * @return float
   */
  public function getGross(): ?float {
    return $this->gross;
  }

  /**
   * @return float
   */
  public function getNet(): ?float {
    return $this->net;
  }

  /**
   * {@inheritdoc}
   */
  public static function fromXML(\SimpleXMLElement $xml): self {
    $estimation = new Estimation();
    $estimation->setEstimated((float) $xml->{'estimated-cost'});
    $estimation->setGross((float) $xml->{'gross-amount'});
    $estimation->setNet((float) $xml->{'net-amount'});
    return $estimation;
  }

  /**
   * {@inheritdoc}
   */
  public function toXML(?\SimpleXMLElement $xml = null): \SimpleXMLElement {
    if ($xml === null) {
      $xml = new \SimpleXMLElement("<?xml version=\"1.0\" encoding=\"UTF-8\"?><hash></hash>");
    }
    $xml->addChild('gross-amount', (string)($this->getGross() ?? ''))->addAttribute("type", "float");
    $xml->addChild('net-amount', (string)($this->getNet() ?? ''))->addAttribute("type", "float");
    $xml->addChild('estimated-amount', (string)($this->getEstimated() ?? ''))->addAttribute("type", "float");
    return $xml;
  }
}
