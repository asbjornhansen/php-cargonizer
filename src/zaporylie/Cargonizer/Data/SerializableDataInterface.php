<?php

declare(strict_types=1);

namespace zaporylie\Cargonizer\Data;

/**
 * Interface SerializableDataInterface
 */
interface SerializableDataInterface
{
    public static function fromXML(\SimpleXMLElement $xml): self;

    /**
     * @param \SimpleXMLElement
     */
    public function toXML(\SimpleXMLElement $xml): \SimpleXMLElement;
}
