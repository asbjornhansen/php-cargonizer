<?php

declare(strict_types=1);

namespace zaporylie\Cargonizer\Data;

class Sender extends Address
{
    protected ?Plan $plan = null;

    protected ?string $contactPerson = null;

    protected ?string $externalNumber = null;

    protected ?int $id = null;

    protected ?string $returnAddress1 = null;

    protected ?string $returnAddress2 = null;

    protected ?string $returnCity = null;

    protected ?string $returnCountry = null;

    protected ?string $returnPostcode = null;

    protected ?string $label = null;

    public function getPlan(): ?Plan
    {
        return $this->plan;
    }

    public function getContactPerson(): ?string
    {
        return $this->contactPerson;
    }

    public function getExternalNumber(): ?string
    {
        return $this->externalNumber;
    }

    public function getId(): ?int
    {
        return $this->id;
    }

    public function getReturnAddress1(): ?string
    {
        return $this->returnAddress1;
    }

    public function getReturnAddress2(): ?string
    {
        return $this->returnAddress2;
    }

    public function getReturnCity(): ?string
    {
        return $this->returnCity;
    }

    public function getReturnCountry(): ?string
    {
        return $this->returnCountry;
    }

    public function getReturnPostcode(): ?string
    {
        return $this->returnPostcode;
    }

    public function getLabel(): ?string
    {
        return $this->label;
    }

    public function setPlan(?Plan $plan): self
    {
        $this->plan = $plan;

        return $this;
    }

    public function setContactPerson(?string $contactPerson): self
    {
        $this->contactPerson = $contactPerson;

        return $this;
    }

    public function setExternalNumber(?string $externalNumber): self
    {
        $this->externalNumber = $externalNumber;

        return $this;
    }

    public function setId(?int $id): self
    {
        $this->id = $id;

        return $this;
    }

    public function setLabel(?string $label): self
    {
        $this->label = $label;

        return $this;
    }

    public function setReturnAddress1(?string $returnAddress1): self
    {
        $this->returnAddress1 = $returnAddress1;

        return $this;
    }

    public function setReturnAddress2(?string $returnAddress2): self
    {
        $this->returnAddress2 = $returnAddress2;

        return $this;
    }

    public function setReturnCity(?string $returnCity): self
    {
        $this->returnCity = $returnCity;

        return $this;
    }

    public function setReturnCountry(?string $returnCountry): self
    {
        $this->returnCountry = $returnCountry;

        return $this;
    }

    public function setReturnPostcode(?string $returnPostcode): self
    {
        $this->returnPostcode = $returnPostcode;

        return $this;
    }

    /**
     * {@inheritdoc}
     */
    #[\Override]
    public static function fromXML(\SimpleXMLElement $xml, ?AddressInterface $address = null): self
    {
        $sender = new Sender;
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
    #[\Override]
    public function toXML(\SimpleXMLElement $xml): \SimpleXMLElement
    {
        $sender = $xml->addChild('sender');
        parent::toXML($sender);
        $sender->addChild('contact-person', $this->getContactPerson() ?? '');
        $sender->addChild('external-number', $this->getExternalNumber() ?? '');
        $sender->addChild('id', (string) ($this->getId() ?? ''))->addAttribute('type', 'integer');
        $sender->addChild('return-address1', $this->getReturnAddress1() ?? '');
        $sender->addChild('return-address2', $this->getReturnAddress2() ?? '');
        $sender->addChild('return-city', $this->getReturnCity() ?? '');
        $sender->addChild('return-country', $this->getReturnCountry() ?? '');
        $sender->addChild('return-postcode', $this->getReturnPostcode() ?? '');
        if ($this->getPlan() instanceof Plan) {
            $this->getPlan()->toXML($sender);
        }

        return $xml;
    }
}
