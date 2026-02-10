<?php

namespace zaporylie\Cargonizer\Data;

class Sender extends Address {

  /**
   * @var \zaporylie\Cargonizer\Data\Plan
   */
  protected ?Plan $plan = null;

  /**
   * @var string
   */
  protected ?string $contactPerson = null;

  /**
   * @var string
   */
  protected ?string $externalNumber = null;

  /**
   * @var int
   */
  protected ?int $id = null;

  /**
   * @var string
   */
  protected ?string $returnAddress1 = null;

  /**
   * @var string
   */
  protected ?string $returnAddress2 = null;

  /**
   * @var string
   */
  protected ?string $returnCity = null;

  /**
   * @var string
   */
  protected ?string $returnCountry = null;

  /**
   * @var string
   */
  protected ?string $returnPostcode = null;

  /**
   * @var string
   */
  protected ?string $label = null;

  /**
   * @return \zaporylie\Cargonizer\Data\Plan
   */
  public function getPlan(): ?Plan {
    return $this->plan;
  }

  /**
   * @return string
   */
  public function getContactPerson(): ?string {
    return $this->contactPerson;
  }

  /**
   * @return string
   */
  public function getExternalNumber(): ?string {
    return $this->externalNumber;
  }

  /**
   * @return int
   */
  public function getId(): ?int {
    return $this->id;
  }

  /**
   * @return string
   */
  public function getReturnAddress1(): ?string {
    return $this->returnAddress1;
  }

  /**
   * @return string
   */
  public function getReturnAddress2(): ?string {
    return $this->returnAddress2;
  }

  /**
   * @return string
   */
  public function getReturnCity(): ?string {
    return $this->returnCity;
  }

  /**
   * @return string
   */
  public function getReturnCountry(): ?string {
    return $this->returnCountry;
  }

  /**
   * @return string
   */
  public function getReturnPostcode(): ?string {
    return $this->returnPostcode;
  }

  /**
   * @return string
   */
  public function getLabel(): ?string {
    return $this->label;
  }

  /**
   * @param \zaporylie\Cargonizer\Data\Plan $plan
   */
  public function setPlan(?Plan $plan): self {
    $this->plan = $plan;
    return $this;
  }

  /**
   * @param string $contactPerson
   */
  public function setContactPerson(?string $contactPerson): self {
    $this->contactPerson = $contactPerson;
    return $this;
  }

  /**
   * @param string $externalNumber
   */
  public function setExternalNumber(?string $externalNumber): self {
    $this->externalNumber = $externalNumber;
    return $this;
  }

  /**
   * @param int $id
   */
  public function setId(?int $id): self {
    $this->id = $id;
    return $this;
  }

  /**
   * @param string $label
   */
  public function setLabel(?string $label): self {
    $this->label = $label;
    return $this;
  }

  /**
   * @param string $returnAddress1
   */
  public function setReturnAddress1(?string $returnAddress1): self {
    $this->returnAddress1 = $returnAddress1;
    return $this;
  }

  /**
   * @param string $returnAddress2
   */
  public function setReturnAddress2(?string $returnAddress2): self {
    $this->returnAddress2 = $returnAddress2;
    return $this;
  }

  /**
   * @param string $returnCity
   */
  public function setReturnCity(?string $returnCity): self {
    $this->returnCity = $returnCity;
    return $this;
  }

  /**
   * @param string $returnCountry
   */
  public function setReturnCountry(?string $returnCountry): self {
    $this->returnCountry = $returnCountry;
    return $this;
  }

  /**
   * @param string $returnPostcode
   */
  public function setReturnPostcode(?string $returnPostcode): self {
    $this->returnPostcode = $returnPostcode;
    return $this;
  }

  /**
   * {@inheritdoc}
   */
  public static function fromXML(\SimpleXMLElement $xml): self {
    $sender = new Sender();
    parent::fromXML($xml, $sender);
    $sender->setPlan(Plan::fromXML($xml->{'plan'}));
    $sender->setContactPerson((string) $xml->{'contact-person'});
    $sender->setExternalNumber((string) $xml->{'external-number'});
    $sender->setId((int) $xml->{'id'});
    $sender->setLabel((string) $xml->{'label'});
    $sender->setReturnAddress1((string) $xml->{'return-address1'});
    $sender->setReturnAddress2((string) $xml->{'return-address2'});
    $sender->setReturnCity((string) $xml->{'return-city'});
    $sender->setReturnCountry((string) $xml->{'return-country'});
    $sender->setReturnPostcode((string) $xml->{'return-postcode'});
    return $sender;
  }

  /**
   * {@inheritdoc}
   */
  public function toXML(\SimpleXMLElement $xml): \SimpleXMLElement {
    $sender = $xml->addChild('sender');
    parent::toXML($sender);
    $sender->addChild('contact-person', $this->getContactPerson() ?? '');
    $sender->addChild('external-number', $this->getExternalNumber() ?? '');
    $sender->addChild('id', (string)($this->getId() ?? ''))->addAttribute('type', 'integer');
    $sender->addChild('return-address1', $this->getReturnAddress1() ?? '');
    $sender->addChild('return-address2', $this->getReturnAddress2() ?? '');
    $sender->addChild('return-city', $this->getReturnCity() ?? '');
    $sender->addChild('return-country', $this->getReturnCountry() ?? '');
    $sender->addChild('return-postcode', $this->getReturnPostcode() ?? '');
    if ($this->getPlan() !== null) {
      $this->getPlan()->toXML($sender);
    }
    return $xml;
  }
}
