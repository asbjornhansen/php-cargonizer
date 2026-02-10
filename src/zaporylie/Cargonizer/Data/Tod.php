<?php

declare(strict_types=1);

namespace zaporylie\Cargonizer\Data;

class Tod implements SerializableDataInterface
{
    protected ?string $code = null;

    protected ?string $country = null;

    protected ?string $postcode = null;

    protected ?string $city = null;

    public function getCode(): ?string
    {
        return $this->code;
    }

    public function setCode(?string $code): self
    {
        $this->code = $code;

        return $this;
    }

    public function getCountry(): ?string
    {
        return $this->country;
    }

    public function setCountry(?string $country): self
    {
        $this->country = $country;

        return $this;
    }

    public function getPostcode(): ?string
    {
        return $this->postcode;
    }

    public function setPostcode(?string $postcode): self
    {
        $this->postcode = $postcode;

        return $this;
    }

    public function getCity(): ?string
    {
        return $this->city;
    }

    public function setCity(?string $city): self
    {
        $this->city = $city;

        return $this;
    }

    #[\Override]
    public static function fromXML(\SimpleXMLElement $xml): self
    {
        return new Tod;
    }

    #[\Override]
    public function toXML(\SimpleXMLElement $xml): \SimpleXMLElement
    {
        $tod = $xml->addChild('tod');
        $tod->addAttribute('code', $this->getCode() ?? '');
        $tod->addAttribute('country', $this->getCountry() ?? '');
        $tod->addAttribute('postcode', $this->getPostcode() ?? '');
        $tod->addAttribute('city', $this->getCity() ?? '');

        return $xml;
    }
}
