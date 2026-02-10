<?php

namespace zaporylie\Cargonizer\Data;

class Hours implements SerializableDataInterface {

  /**
   * @var string
   */
  protected ?string $from = null;

  /**
   * @var string
   */
  protected ?string $to = null;

  /**
   * Gets from value.
   *
   * @return string
   */
  public function getFrom(): ?string {
    return $this->from;
  }

  /**
   * Gets to value.
   *
   * @return string
   */
  public function getTo(): ?string {
    return $this->to;
  }

  /**
   * {@inheritdoc}
   */
  public static function fromXML(\SimpleXMLElement $xml): self {
    $item = new Hours();
    $item->from = (string) $xml->attributes()->from;
    $item->to = (string) $xml->attributes()->to;
    return $item;
  }


  /**
   * {@inheritdoc}
   */
  public function toXML(\SimpleXMLElement $xml): \SimpleXMLElement {
    $item = $xml->addChild('item');
    $item->addAttribute('from', $this->from ?? '');
    $item->addAttribute('to', $this->to ?? '');

    return $xml;
  }
}
