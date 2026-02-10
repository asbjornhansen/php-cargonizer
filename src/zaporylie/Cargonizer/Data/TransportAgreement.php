<?php

declare(strict_types=1);

namespace zaporylie\Cargonizer\Data;

class TransportAgreement implements SerializableDataInterface
{
    protected ?string $description = null;

    protected ?int $id = null;

    protected ?int $number = null;

    protected ?Carrier $carrier = null;

    protected ?Products $products = null;

    public function setDescription(?string $description): self
    {
        $this->description = $description;

        return $this;
    }

    public function setCarrier(?Carrier $carrier): self
    {
        $this->carrier = $carrier;

        return $this;
    }

    public function setId(?int $id): self
    {
        $this->id = $id;

        return $this;
    }

    public function setNumber(?int $number): self
    {
        $this->number = $number;

        return $this;
    }

    public function setProducts(?Products $products): self
    {
        $this->products = $products;

        return $this;
    }

    public function getId(): ?int
    {
        return $this->id;
    }

    public function getCarrier(): ?Carrier
    {
        return $this->carrier;
    }

    public function getDescription(): ?string
    {
        return $this->description;
    }

    public function getNumber(): ?int
    {
        return $this->number;
    }

    public function getProducts(): ?Products
    {
        return $this->products;
    }

    /**
     * {@inheritdoc}
     */
    #[\Override]
    public static function fromXML(\SimpleXMLElement $xml): self
    {
        $transportAgreement = new TransportAgreement;
        $transportAgreement->setDescription((string) $xml->description);
        $transportAgreement->setId((int) $xml->id);
        $transportAgreement->setNumber((int) $xml->number);
        if ($xml->carrier instanceof \SimpleXMLElement) {
            $transportAgreement->setCarrier(Carrier::fromXML($xml->carrier));
        }

        if (isset($xml->products->product)) {
            $transportAgreement->setProducts(Products::fromXML($xml->products->product));
        }

        return $transportAgreement;
    }

    /**
     * {@inheritdoc}
     */
    #[\Override]
    public function toXML(\SimpleXMLElement $xml): \SimpleXMLElement
    {
        $agreement = $xml->addChild('transport-agreement');
        $agreement->addChild('description', $this->getDescription() ?? '');
        $agreement->addChild('id', (string) ($this->getId() ?? ''));
        $agreement->addChild('number', (string) ($this->getNumber() ?? ''));
        if ($this->getCarrier() instanceof Carrier) {
            $this->getCarrier()->toXML($agreement);
        }

        if ($this->getProducts() instanceof Products) {
            $this->getProducts()->toXML($agreement);
        }

        //    $agreement->addChild('products', $this->get);
        //    $agreement->addChild('', $this->get);

        return $xml;
    }
}
