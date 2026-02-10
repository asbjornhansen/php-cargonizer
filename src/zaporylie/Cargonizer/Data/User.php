<?php

namespace zaporylie\Cargonizer\Data;

class User implements SerializableDataInterface {

  /**
   * @var string
   */
  protected ?string $email = null;

  /**
   * @var string
   */
  protected ?string $firstName = null;

  /**
   * @var string
   */
  protected ?string $lastName = null;

  /**
   * @var string
   */
  protected ?string $username = null;

  /**
   * @var \zaporylie\Cargonizer\Data\Managerships
   */
  protected ?Managerships $managerships = null;

  /**
   * @return string
   */
  public function getEmail(): ?string {
    return $this->email;
  }

  /**
   * @return string
   */
  public function getFirstName(): ?string {
    return $this->firstName;
  }

  /**
   * @return string
   */
  public function getLastName(): ?string {
    return $this->lastName;
  }

  /**
   * @return \zaporylie\Cargonizer\Data\Managerships
   */
  public function getManagerships(): ?Managerships {
    return $this->managerships;
  }

  /**
   * @return string
   */
  public function getUsername(): ?string {
    return $this->username;
  }

  /**
   * @param string $email
   */
  public function setEmail(?string $email): self {
    $this->email = $email;
    return $this;
  }

  /**
   * @param string $firstName
   */
  public function setFirstName(?string $firstName): self {
    $this->firstName = $firstName;
    return $this;
  }

  /**
   * @param string $lastName
   */
  public function setLastName(?string $lastName): self {
    $this->lastName = $lastName;
    return $this;
  }

  /**
   * @param \zaporylie\Cargonizer\Data\Managerships $managerships
   */
  public function setManagerships(?Managerships $managerships): self {
    $this->managerships = $managerships;
    return $this;
  }

  /**
   * @param string $username
   */
  public function setUsername(?string $username): self {
    $this->username = $username;
    return $this;
  }

  /**
   * {@inheritdoc}
   */
  public static function fromXML(\SimpleXMLElement $xml): self {
    $user = new User();
    $user->setEmail((string) $xml->{'email'});
    $user->setFirstName((string) $xml->{'first-name'});
    $user->setLastName((string) $xml->{'last-name'});
    $user->setUsername((string) $xml->{'username'});
    $user->setManagerships(Managerships::fromXML($xml->{'managerships'}));
    return $user;
  }

  /**
   * {@inheritdoc}
   */
  public function toXML(?\SimpleXMLElement $xml = null): \SimpleXMLElement {
    if ($xml === null) {
      $user = $xml = new \SimpleXMLElement("<?xml version=\"1.0\" encoding=\"UTF-8\"?><user></user>");
    }
    else {
      $user = $xml->addChild('user');
    }
    $user->addChild('first-name', $this->getFirstName() ?? '');
    $user->addChild('last-name', $this->getLastName() ?? '');
    $user->addChild('username', $this->getUsername() ?? '');
    $user->addChild('email', $this->getEmail() ?? '');
    return $xml;
  }
}
