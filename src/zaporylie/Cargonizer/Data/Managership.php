<?php

declare(strict_types=1);

namespace zaporylie\Cargonizer\Data;

class Managership implements SerializableDataInterface
{
    protected ?int $id = null;

    protected ?Sender $sender = null;

    public function getId(): ?int
    {
        return $this->id;
    }

    public function getSender(): ?Sender
    {
        return $this->sender;
    }

    public function setId(?int $id): self
    {
        $this->id = $id;

        return $this;
    }

    public function setSender(?Sender $sender): self
    {
        $this->sender = $sender;

        return $this;
    }

    /**
     * {@inheritdoc}
     */
    #[\Override]
    public static function fromXML(\SimpleXMLElement $xml): self
    {
        $managership = new Managership;
        $managership->setID((int) $xml->{'id'});
        $managership->setSender(Sender::fromXML($xml->{'sender'}));

        return $managership;
    }

    /**
     * {@inheritdoc}
     */
    #[\Override]
    public function toXML(\SimpleXMLElement $xml): \SimpleXMLElement
    {
        $managership = $xml->addChild('managership');
        $managership->addChild('id', (string) ($this->getID() ?? ''))->addAttribute('type', 'integer');
        if ($this->getSender() instanceof Sender) {
            $this->getSender()->toXML($managership);
        }

        return $xml;
    }
}
