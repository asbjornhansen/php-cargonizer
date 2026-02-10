<?php

declare(strict_types=1);

namespace zaporylie\Cargonizer\Data;

class User implements SerializableDataInterface
{
    protected ?string $email = null;

    protected ?string $firstName = null;

    protected ?string $lastName = null;

    protected ?string $username = null;

    protected ?Managerships $managerships = null;

    public function getEmail(): ?string
    {
        return $this->email;
    }

    public function getFirstName(): ?string
    {
        return $this->firstName;
    }

    public function getLastName(): ?string
    {
        return $this->lastName;
    }

    public function getManagerships(): ?Managerships
    {
        return $this->managerships;
    }

    public function getUsername(): ?string
    {
        return $this->username;
    }

    public function setEmail(?string $email): self
    {
        $this->email = $email;

        return $this;
    }

    public function setFirstName(?string $firstName): self
    {
        $this->firstName = $firstName;

        return $this;
    }

    public function setLastName(?string $lastName): self
    {
        $this->lastName = $lastName;

        return $this;
    }

    public function setManagerships(?Managerships $managerships): self
    {
        $this->managerships = $managerships;

        return $this;
    }

    public function setUsername(?string $username): self
    {
        $this->username = $username;

        return $this;
    }

    /**
     * {@inheritdoc}
     */
    #[\Override]
    public static function fromXML(\SimpleXMLElement $xml): self
    {
        $user = new User;
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
    #[\Override]
    public function toXML(?\SimpleXMLElement $xml = null): \SimpleXMLElement
    {
        if (! $xml instanceof \SimpleXMLElement) {
            $user = new \SimpleXMLElement('<?xml version="1.0" encoding="UTF-8"?><user></user>');
            $xml = $user;
        } else {
            $user = $xml->addChild('user');
        }

        $user->addChild('first-name', $this->getFirstName() ?? '');
        $user->addChild('last-name', $this->getLastName() ?? '');
        $user->addChild('username', $this->getUsername() ?? '');
        $user->addChild('email', $this->getEmail() ?? '');

        return $xml;
    }
}
