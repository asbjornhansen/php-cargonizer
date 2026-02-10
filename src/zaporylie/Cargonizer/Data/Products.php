<?php

namespace zaporylie\Cargonizer\Data;

use zaporylie\Cargonizer\Data\SerializableDataInterface;

/**
 * Class Products.
 *
 * @package zaporylie\Cargonizer\Data
 */
class Products extends ObjectsWrapper implements SerializableDataInterface {

  /**
   * @param \zaporylie\Cargonizer\Data\Product $item
   *
   * @return self
   */
  public function addItem(Product $item): self {
    $this->array[$item->getIdentifier()] = $item;
    return $this;
  }

  /**
   * {@inheritdoc}
   */
  public static function fromXML(\SimpleXMLElement $xml): self {
    $products = new Products();
    /** @var \SimpleXMLElement $product */
    foreach ($xml as $product) {
      $products->addItem(Product::fromXML($product));
    }
    return $products;
  }

  /**
   * {@inheritdoc}
   */
  public function toXML(\SimpleXMLElement $xml): \SimpleXMLElement {
    // TODO: Implement toXML() method.
    $products = $xml->addChild('products');
    $products->addAttribute('type', 'array');
    foreach ($this as $product) {
      $product->toXML($products);
    }
    return $xml;
  }
}
