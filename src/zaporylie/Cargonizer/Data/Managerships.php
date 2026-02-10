<?php

namespace zaporylie\Cargonizer\Data;

class Managerships extends ObjectsWrapper implements SerializableDataInterface {

  /**
   * @param \zaporylie\Cargonizer\Data\Managership $item
   *
   * @return self
   */
  public function addItem(Managership $item): self {
    $this->array[$item->getId()] = $item;
    return $this;
  }

  /**
   * {@inheritdoc}
   */
  public static function fromXML(\SimpleXMLElement $xml): self {
    $managerships = new Managerships();

    /** @var \SimpleXMLElement $agreement */
    foreach ($xml as $managership) {
      $managerships->addItem(Managership::fromXML($managership->{'managership'}));
    }

    return $managerships;
  }

  /**
   * {@inheritdoc}
   */
  public function toXML(\SimpleXMLElement $xml): \SimpleXMLElement {
    $partners = $xml->addChild('managerships');
    $partners->addAttribute('type', 'array');
    /** @var \zaporylie\Cargonizer\Data\Managership $managership */
    foreach ($this as $managership) {
      $managership->toXML($xml);
    }
    return $xml;
  }
}
