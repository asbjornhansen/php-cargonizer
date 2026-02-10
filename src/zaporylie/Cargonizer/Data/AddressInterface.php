<?php

namespace zaporylie\Cargonizer\Data;

interface AddressInterface {

  /**
   * @param string $name
   */
  public function setName(?string $name): self;

  /**
   * @param string $postcode
   */
  public function setPostcode(?string $postcode): self;

  /**
   * @param string $country
   */
  public function setCountry(?string $country): self;

  /**
   * @param string $city
   */
  public function setCity(?string $city): self;

  /**
   * @param string $address1
   */
  public function setAddress1(?string $address1): self;

  /**
   * @param string $address2
   */
  public function setAddress2(?string $address2): self;

  /**
   * @param string $fax
   */
  public function setFax(?string $fax): self;

  /**
   * @param string $phone
   */
  public function setPhone(?string $phone): self;

  /**
   * @param string $mobile
   */
  public function setMobile(?string $mobile): self;

  /**
   * @return string
   */
  public function getName(): ?string;

  /**
   * @return string
   */
  public function getPostcode(): ?string;

  /**
   * @return string
   */
  public function getCountry(): ?string;

  /**
   * @return string
   */
  public function getCity(): ?string;

  /**
   * @return string
   */
  public function getAddress1(): ?string;

  /**
   * @return string
   */
  public function getAddress2(): ?string;

  /**
   * @return string
   */
  public function getFax(): ?string;

  /**
   * @return string
   */
  public function getPhone(): ?string;

  /**
   * @return string
   */
  public function getMobile(): ?string;
}
