<?php

namespace zaporylie\Cargonizer\Data;

class ServicePartners extends ObjectsWrapper implements SerializableDataInterface {


  /**
   * @param \zaporylie\Cargonizer\Data\ServicePartner $item
   *
   * @return self
   */
  public function addItem(ServicePartner $item): self {
    $this->array[$item->getNumber()] = $item;
    return $this;
  }

  /**
   * {@inheritdoc}
   */
  public static function fromXML(\SimpleXMLElement $xml): self {
    $servicePartners = new ServicePartners();

    if (isset($xml->{'service-partner'})) {
      foreach ($xml->{'service-partner'} as $partner) {
        $servicePartners->addItem(ServicePartner::fromXML($partner));
      }
    }

    return $servicePartners;
  }

  /**
   * {@inheritdoc}
   */
  public function toXML(\SimpleXMLElement $xml): \SimpleXMLElement {
    $partners = $xml->addChild('service-partners');
    $partners->addAttribute('type', 'array');
    /** @var \zaporylie\Cargonizer\Data\ServicePartner $partner */
    foreach ($this as $partner) {
      $partner->toXML($xml);
    }
    return $xml;
  }
}
