<?php

declare(strict_types=1);

namespace zaporylie\Cargonizer\Data;

interface AddressInterface
{
    public function setName(?string $name): self;

    public function setPostcode(?string $postcode): self;

    public function setCountry(?string $country): self;

    public function setCity(?string $city): self;

    public function setAddress1(?string $address1): self;

    public function setAddress2(?string $address2): self;

    public function setFax(?string $fax): self;

    public function setPhone(?string $phone): self;

    public function setMobile(?string $mobile): self;

    public function getName(): ?string;

    public function getPostcode(): ?string;

    public function getCountry(): ?string;

    public function getCity(): ?string;

    public function getAddress1(): ?string;

    public function getAddress2(): ?string;

    public function getFax(): ?string;

    public function getPhone(): ?string;

    public function getMobile(): ?string;
}
