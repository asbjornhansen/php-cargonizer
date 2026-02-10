<?php

declare(strict_types=1);

namespace zaporylie\Cargonizer\Data;

class ServicePartners extends ObjectsWrapper implements SerializableDataInterface
{
    public function addItem(ServicePartner $servicePartner): self
    {
        $this->array[$servicePartner->getNumber()] = $servicePartner;

        return $this;
    }

    /**
     * {@inheritdoc}
     */
    #[\Override]
    public static function fromXML(\SimpleXMLElement $xml): self
    {
        $servicePartners = new ServicePartners;

        if (isset($xml->{'service-partner'})) {
            foreach ($xml->{'service-partner'} as $partner) {
                $servicePartners->addItem(ServicePartner::fromXML($partner));
            }
        }

        return $servicePartners;
    }

    /**
     * {@inheritdoc}
     */
    #[\Override]
    public function toXML(\SimpleXMLElement $xml): \SimpleXMLElement
    {
        $partners = $xml->addChild('service-partners');
        $partners->addAttribute('type', 'array');
        /** @var ServicePartner $partner */
        foreach ($this as $partner) {
            $partner->toXML($xml);
        }

        return $xml;
    }
}
