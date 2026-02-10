<?php

declare(strict_types=1);

namespace zaporylie\Cargonizer\Data;

/**
 * Class Products.
 */
class Products extends ObjectsWrapper implements SerializableDataInterface
{
    public function addItem(Product $product): self
    {
        $this->array[$product->getIdentifier()] = $product;

        return $this;
    }

    /**
     * {@inheritdoc}
     */
    #[\Override]
    public static function fromXML(\SimpleXMLElement $xml): self
    {
        $products = new Products;
        /** @var \SimpleXMLElement $product */
        foreach ($xml as $product) {
            $products->addItem(Product::fromXML($product));
        }

        return $products;
    }

    /**
     * {@inheritdoc}
     */
    #[\Override]
    public function toXML(\SimpleXMLElement $xml): \SimpleXMLElement
    {
        // TODO: Implement toXML() method.
        $products = $xml->addChild('products');
        $products->addAttribute('type', 'array');
        foreach ($this as $product) {
            $product->toXML($products);
        }

        return $xml;
    }
}
