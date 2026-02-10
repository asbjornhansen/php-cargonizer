<?php

namespace zaporylie\Cargonizer\Data;

/**
 * Interface SerializableDataInterface
 *
 * @package zaporylie\Consignor\Data
 */
interface SerializableDataInterface {

  /**
   * @param \SimpleXMLElement $xml
   *
   * @return self
   */
  public static function fromXML(\SimpleXMLElement $xml): self;

  /**
   * @param \SimpleXMLElement
   *
   * @return \SimpleXMLElement
   */
  public function toXML(\SimpleXMLElement $xml): \SimpleXMLElement;
}
