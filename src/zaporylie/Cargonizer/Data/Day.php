<?php

declare(strict_types=1);

namespace zaporylie\Cargonizer\Data;

class Day implements SerializableDataInterface
{
    protected ?string $name = null;

    protected ?int $number = null;

    /**
     * @var Hours[]
     */
    protected array $hours = [];

    /**
     * Gets name value.
     */
    public function getName(): ?string
    {
        return $this->name;
    }

    /**
     * Gets number value.
     */
    public function getNumber(): ?int
    {
        return $this->number;
    }

    /**
     * {@inheritdoc}
     */
    #[\Override]
    public static function fromXML(\SimpleXMLElement $xml): self
    {
        $day = new Day;
        $day->name = (string) $xml->attributes()->name;
        $day->number = (int) $xml->attributes()->number;
        $hours = [];
        if (property_exists($xml, 'hours') && $xml->hours !== null) {
            foreach ($xml->hours as $hour) {
                $hours[] = Hours::fromXML($hour);
            }
        }

        $day->hours = $hours;

        return $day;
    }

    /**
     * {@inheritdoc}
     */
    #[\Override]
    public function toXML(\SimpleXMLElement $xml): \SimpleXMLElement
    {
        $item = $xml->addChild('item');
        $item->addAttribute('name', $this->name ?? '');
        $item->addAttribute('number', (string) ($this->number ?? ''));

        return $xml;
    }
}
