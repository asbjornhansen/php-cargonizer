<?php

namespace zaporylie\Cargonizer\Data;

class OpeningHours extends ObjectsWrapper implements SerializableDataInterface {


  /**
   * @param \zaporylie\Cargonizer\Data\Day $item
   *
   * @return self
   */
  public function addItem(Day $item): self {
    $this->array[] = $item;
    return $this;
  }

  /**
   * {@inheritdoc}
   */
  public static function fromXML(\SimpleXMLElement $xml): self {
    $openingHours = new OpeningHours();

    if (isset($xml->{'opening-hours'}->{'day'})) {
      foreach ($xml->{'opening-hours'}->{'day'} as $day) {
        $openingHours->addItem(Day::fromXML($day));
      }
    }

    return $openingHours;
  }

  /**
   * {@inheritdoc}
   */
  public function toXML(\SimpleXMLElement $xml): \SimpleXMLElement {
    $openingHours = $xml->addChild('opening-hours');
    $openingHours->addAttribute('type', 'array');
    /** @var \zaporylie\Cargonizer\Data\Day $day */
    foreach ($this as $day) {
      $openingHours->toXML($day);
    }
    return $xml;
  }
}
