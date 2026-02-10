<?php

namespace zaporylie\Cargonizer\Data;

class Results implements SerializableDataInterface {


  /**
   * @var \zaporylie\Cargonizer\Data\Location
   */
  protected ?Location $location = null;

  /**
   * @var \zaporylie\Cargonizer\Data\ServicePartners
   */
  protected ?ServicePartners $servicePartners = null;

  /**
   * @param \zaporylie\Cargonizer\Data\Location $location
   */
  public function setLocation(?Location $location): self {
    $this->location = $location;
    return $this;
  }

  /**
   * @param \zaporylie\Cargonizer\Data\ServicePartners $servicePartners
   */
  public function setServicePartners(?ServicePartners $servicePartners): self {
    $this->servicePartners = $servicePartners;
    return $this;
  }

  /**
   * @return \zaporylie\Cargonizer\Data\Location
   */
  public function getLocation(): ?Location {
    return $this->location;
  }

  /**
   * @return \zaporylie\Cargonizer\Data\ServicePartners
   */
  public function getServicePartners(): ?ServicePartners {
    return $this->servicePartners;
  }

  /**
   * @param \SimpleXMLElement $xml
   *
   * @return \zaporylie\Cargonizer\Data\Results
   */
  public static function fromXML(\SimpleXMLElement $xml): self {
    $results = new Results();
    $results->setLocation(Location::fromXML($xml->location));
    $results->setServicePartners(ServicePartners::fromXML($xml->{'service-partners'}));
    return $results;
  }

  /**
   * {@inheritdoc}
   */
  public function toXML(?\SimpleXMLElement $xml = null): \SimpleXMLElement {

    if ($xml === null) {
      $xml = $results = new \SimpleXMLElement("<?xml version=\"1.0\" encoding=\"UTF-8\"?><results></results>");
    }
    else {
      $results = $xml->addChild('results');
    }
    if ($this->getLocation() !== null) {
      $this->getLocation()->toXML($results);
    }
    if ($this->getServicePartners() !== null) {
      $this->getServicePartners()->toXML($results);
    }
    return $xml;
  }
}
