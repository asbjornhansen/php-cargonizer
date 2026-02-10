<?php

namespace zaporylie\Cargonizer\Data;

/**
 * Class TransportAgreements.
 *
 * @package zaporylie\Cargonizer\Data
 */
class TransportAgreements extends ObjectsWrapper implements SerializableDataInterface {

  /**
   * @param \zaporylie\Cargonizer\Data\TransportAgreement $item
   *
   * @return self
   */
  public function addItem(TransportAgreement $item): self {
    $this->array[$item->getId()] = $item;
    return $this;
  }

  /**
   * {@inheritdoc}
   */
  public static function fromXML(\SimpleXMLElement $xml): self {
    $transportAgreements = new TransportAgreements();

    /** @var \SimpleXMLElement $agreement */
    foreach ($xml as $agreement) {
      $transportAgreements->addItem(TransportAgreement::fromXML($agreement));
    }

    return $transportAgreements;
  }

  /**
   * {@inheritdoc}
   */
  public function toXML(?\SimpleXMLElement $xml = null): \SimpleXMLElement {

    if ($xml === null) {
      $xml = new \SimpleXMLElement("<?xml version=\"1.0\" encoding=\"UTF-8\"?><transport-agreements type=\"array\"></transport-agreements>");
    }

    // TODO: Implement toXML() method.
    /** @var \zaporylie\Cargonizer\Data\TransportAgreement $agreement */
    foreach ($this as $agreement) {
//      $x = $xml->addChild('transport_agreement');
      $agreement->toXML($xml);
    }
    return $xml;
  }
}
