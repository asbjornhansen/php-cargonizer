<?php

namespace zaporylie\Cargonizer\Data;

class References extends ObjectsWrapper implements SerializableDataInterface {

  private ?string $consigneeReference = null;
  private ?string $consignorReference = null;

  /**
   * @return self
   */
  public function addConsignorReference(?string $reference): self {
    $this->consignorReference = $reference;
    return $this;
  }

  /**
   * @return self
   */
  public function addConsigneeReference(?string $reference): self {
    $this->consigneeReference = $reference;
    return $this;
  }

  /**
   * {@inheritdoc}
   */
  public static function fromXML(\SimpleXMLElement $xml): self {
    $refs = new References();

    return $refs;
  }

  /**
   * {@inheritdoc}
   */
  public function toXML(\SimpleXMLElement $xml): \SimpleXMLElement {
    $references = $xml->addChild('references');
    $references->addChild('consignor', $this->consignorReference ?? '');
    $references->addChild('consignee', $this->consigneeReference ?? '');
    return $xml;
  }

}
