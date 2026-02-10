<?php

namespace zaporylie\Cargonizer\Data;

class Managership implements SerializableDataInterface {

  /**
   * @var int
   */
  protected ?int $id = null;

  /**
   * @var \zaporylie\Cargonizer\Data\Sender
   */
  protected ?Sender $sender = null;

  /**
   * @return int
   */
  public function getId(): ?int {
    return $this->id;
  }

  /**
   * @return \zaporylie\Cargonizer\Data\Sender
   */
  public function getSender(): ?Sender {
    return $this->sender;
  }

  /**
   * @param int $id
   */
  public function setId(?int $id): self {
    $this->id = $id;
    return $this;
  }

  /**
   * @param \zaporylie\Cargonizer\Data\Sender $sender
   */
  public function setSender(?Sender $sender): self {
    $this->sender = $sender;
    return $this;
  }

  /**
   * {@inheritdoc}
   */
  public static function fromXML(\SimpleXMLElement $xml): self {
    $managership = new Managership();
    $managership->setID((int) $xml->{'id'});
    $managership->setSender(Sender::fromXML($xml->{'sender'}));
    return $managership;
  }

  /**
   * {@inheritdoc}
   */
  public function toXML(\SimpleXMLElement $xml): \SimpleXMLElement {
    $managership = $xml->addChild('managership');
    $managership->addChild('id', (string)($this->getID() ?? ''))->addAttribute('type', 'integer');
    if ($this->getSender() !== null) {
      $this->getSender()->toXML($managership);
    }
    return $xml;
  }
}
