<?php

namespace zaporylie\Cargonizer\Data;

use zaporylie\Cargonizer\Data\SerializableDataInterface;

/**
 * Class Consignments.
 *
 * @package zaporylie\Cargonizer\Data
 */
class Consignments extends ObjectsWrapper implements SerializableDataInterface {

  /**
   * @param \zaporylie\Cargonizer\Data\Consignment $item
   *
   * @return self
   */
  public function addItem(Consignment $item): self {
    $this->array[] = $item;
    return $this;
  }

  /**
   * {@inheritdoc}
   */
  public static function fromXML(\SimpleXMLElement $xml): self {
    $consignments = new Consignments();
    /** @var \SimpleXMLElement $consignment */
    foreach ($xml as $consignment) {
      $consignments->addItem(Consignment::fromXML($consignment));
    }
    return $consignments;
  }

  /**
   * {@inheritdoc}
   */
  public function toXML(?\SimpleXMLElement $xml = null): \SimpleXMLElement {
    if ($xml === null) {
      $xml = new \SimpleXMLElement("<?xml version=\"1.0\" encoding=\"UTF-8\"?><consignments></consignments>");
    }
    foreach ($this as $consignment) {
      $consignment->toXML($xml);
    }
    return $xml;
  }
}
