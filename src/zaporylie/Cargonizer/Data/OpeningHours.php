<?php

declare(strict_types=1);

namespace zaporylie\Cargonizer\Data;

class OpeningHours extends ObjectsWrapper implements SerializableDataInterface
{
    public function addItem(Day $day): self
    {
        $this->array[] = $day;

        return $this;
    }

    /**
     * {@inheritdoc}
     */
    #[\Override]
    public static function fromXML(\SimpleXMLElement $xml): self
    {
        $openingHours = new OpeningHours;

        if (isset($xml->{'opening-hours'}->{'day'})) {
            foreach ($xml->{'opening-hours'}->{'day'} as $day) {
                $openingHours->addItem(Day::fromXML($day));
            }
        }

        return $openingHours;
    }

    /**
     * {@inheritdoc}
     */
    #[\Override]
    public function toXML(\SimpleXMLElement $xml): \SimpleXMLElement
    {
        $openingHours = $xml->addChild('opening-hours');
        $openingHours->addAttribute('type', 'array');
        /** @var Day $day */
        foreach ($this as $day) {
            $openingHours->toXML($day);
        }

        return $xml;
    }
}
