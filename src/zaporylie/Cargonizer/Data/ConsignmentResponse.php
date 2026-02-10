<?php

declare(strict_types=1);

namespace zaporylie\Cargonizer\Data;

class ConsignmentResponse implements SerializableDataInterface
{
    protected ?int $id = null;

    protected ?string $number = null;

    protected ?string $numberWithChecksum = null;

    protected ?string $consignmentPdf = null;

    protected ?string $waybillPdf = null;

    protected ?string $trackingUrl = null;

    protected ?TransportAgreement $transportAgreement = null;

    protected ?bool $bookingRequest = null;

    protected bool|string|null $transfer = null;

    protected array $values = [];

    protected ?Product $product = null;

    public function setId(int $id): self
    {
        $this->id = $id;

        return $this;
    }

    public function getId(): ?int
    {
        return $this->id;
    }

    public function setNumber(string $number): self
    {
        $this->number = $number;

        return $this;
    }

    public function getNumber(): ?string
    {
        return $this->number;
    }

    public function setTransfer(bool|string $transfer): self
    {
        $this->transfer = $transfer;

        return $this;
    }

    public function getTransfer(): bool|string|null
    {
        return $this->transfer;
    }

    public function setNumberWithChecksum(string $numberWithChecksum): self
    {
        $this->numberWithChecksum = $numberWithChecksum;

        return $this;
    }

    public function getNumberWithChecksum(): ?string
    {
        return $this->numberWithChecksum;
    }

    public function setConsignmentPdf(string $consignmentPdf): self
    {
        $this->consignmentPdf = $consignmentPdf;

        return $this;
    }

    public function getConsignmentPdf(): ?string
    {
        return $this->consignmentPdf;
    }

    public function setWaybillPdf(string $waybillPdf): self
    {
        $this->waybillPdf = $waybillPdf;

        return $this;
    }

    public function getWaybillPdf(): ?string
    {
        return $this->waybillPdf;
    }

    public function setTrackingUrl(string $trackingUrl): self
    {
        $this->trackingUrl = $trackingUrl;

        return $this;
    }

    public function getTrackingUrl(): ?string
    {
        return $this->trackingUrl;
    }

    public function setTransportAgreement(TransportAgreement $transportAgreement): self
    {
        $this->transportAgreement = $transportAgreement;

        return $this;
    }

    public function getTransportAgreement(): ?TransportAgreement
    {
        return $this->transportAgreement;
    }

    public function setProduct(Product $product): self
    {
        $this->product = $product;

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

    public function getProduct(): ?Product
    {
        return $this->product;
    }

    public function setBookingRequest(bool $bookingRequest): self
    {
        $this->bookingRequest = $bookingRequest;

        return $this;
    }

    public function getBookingRequest(): ?bool
    {
        return $this->bookingRequest;
    }

    #[\Override]
    public static function fromXML(\SimpleXMLElement $xml): self
    {
        $consignmentResponse = new ConsignmentResponse;
        $consignmentResponse->setId((int) $xml->{'id'});
        $consignmentResponse->setNumber((string) $xml->{'number'});
        $consignmentResponse->setTransfer((string) $xml->{'transfer'} === 'true');
        $consignmentResponse->setNumberWithChecksum((string) $xml->{'number-with-checksum'});
        $consignmentResponse->setConsignmentPdf((string) $xml->{'consignment-pdf'});
        $consignmentResponse->setWaybillPdf((string) $xml->{'waybill-pdf'});
        $consignmentResponse->setTrackingUrl((string) $xml->{'tracking-url'});
        $consignmentResponse->setBookingRequest((string) $xml->{'booking-request'} === 'true');
        if ($xml->product instanceof \SimpleXMLElement) {
            $consignmentResponse->setProduct(Product::fromXML($xml->product));
        }

        if ($xml->{'transport-agreement'} instanceof \SimpleXMLElement) {
            $consignmentResponse->setTransportAgreement(TransportAgreement::fromXML($xml->{'transport-agreement'}));
        }

        return $consignmentResponse;
    }

    #[\Override]
    public function toXML(\SimpleXMLElement $xml): \SimpleXMLElement
    {
        return $xml;
    }
}
