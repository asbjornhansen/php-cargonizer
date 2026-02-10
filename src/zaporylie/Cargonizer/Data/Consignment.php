<?php

declare(strict_types=1);

namespace zaporylie\Cargonizer\Data;

class Consignment implements SerializableDataInterface
{
    protected ?int $transportAgreement = null;

    protected ?bool $estimate = null;

    protected bool|string|null $transfer = null;

    protected ?bool $bookingRequest = null;

    protected bool $print = false;

    protected array $values = [];

    protected ?string $product = null;

    protected ?Parts $parts = null;

    protected ?Items $items = null;

    protected array $services = [];

    protected ?References $references = null;

    protected ?string $message = null;

    public function getTransfer(): bool|string|null
    {
        return $this->transfer;
    }

    public function setTransfer(bool|string|null $transfer): self
    {
        $this->transfer = $transfer;

        return $this;
    }

    public function getPrint(): bool
    {
        return $this->print;
    }

    public function setPrint(bool $print): self
    {
        $this->print = $print;

        return $this;
    }

    public function getEstimate(): ?bool
    {
        return $this->estimate;
    }

    public function setEstimate(?bool $estimate): self
    {
        $this->estimate = $estimate;

        return $this;
    }

    public function setReferences(References $references): self
    {
        $this->references = $references;

        return $this;
    }

    public function setTransportAgreement(int $transportAgreement): self
    {
        $this->transportAgreement = $transportAgreement;

        return $this;
    }

    public function setItems(Items $items): self
    {
        $this->items = $items;

        return $this;
    }

    public function addItem(Item $item): self
    {
        $this->items[] = $item;

        return $this;
    }

    public function setProduct(string $product): self
    {
        $this->product = $product;

        return $this;
    }

    public function setParts(Parts $parts): self
    {
        $this->parts = $parts;

        return $this;
    }

    public function getValues(): array
    {
        return $this->values;
    }

    public function addValue(string $key, mixed $value): self
    {
        $this->values[$key] = $value;

        return $this;
    }

    public function setValues(array $values): self
    {
        $this->values = $values;

        return $this;
    }

    public function getServices(): array
    {
        return $this->services;
    }

    public function addService(string|int $id): self
    {
        $this->services[] = $id;

        return $this;
    }

    public function setServices(array $values): self
    {
        $this->services = $values;

        return $this;
    }

    public function getProduct(): ?string
    {
        return $this->product;
    }

    public function getParts(): ?Parts
    {
        return $this->parts;
    }

    public function getItems(): ?Items
    {
        return $this->items;
    }

    public function getTransportAgreement(): ?int
    {
        return $this->transportAgreement;
    }

    #[\Override]
    public static function fromXML(\SimpleXMLElement $xml): self
    {
        return new Consignment;
    }

    public function getReferences(): ?References
    {
        return $this->references;
    }

    #[\Override]
    public function toXML(\SimpleXMLElement $xml): \SimpleXMLElement
    {
        $consignment = $xml->addChild('consignment');
        $consignment->addAttribute('transport_agreement', (string) ($this->getTransportAgreement() ?? ''));
        if ($this->getPrint()) {
            $consignment->addAttribute('print', 'true');
        } else {
            $consignment->addAttribute('print', 'false');
        }

        if ($this->getEstimate() === true) {
            $consignment->addAttribute('estimate', 'true');
            // I have also seen this variant.
            $consignment->addAttribute('cost_estimate', 'true');
        }

        $values = $consignment->addChild('values');
        foreach ($this->values as $key => $value) {
            $value_el = $values->addChild('value');
            $value_el->addAttribute('name', $key);
            $value_el->addAttribute('value', $value ?? '');
        }

        if ($this->getTransfer()) {
            $consignment->addChild('transfer', 'true');
        }

        $consignment->addChild('product', $this->getProduct() ?? '');
        $this->getReferences()?->toXML($consignment);
        $this->getParts()?->toXML($consignment);
        $this->getItems()?->toXML($consignment);
        $services = $consignment->addChild('services');
        foreach ($this->getServices() as $service) {
            $service_el = $services->addChild('service');
            $service_el->addAttribute('id', (string) $service);
        }

        return $xml;
    }
}
