<?php

declare(strict_types=1);

namespace zaporylie\Cargonizer;

use zaporylie\Cargonizer\Data\Results;

/**
 * Class Partners
 */
class Partners extends Client
{
    protected string $resource = '/service_partners.xml';

    protected string $method = 'GET';

    /**
     * @param  string  $country
     * @param  string  $postcode
     * @param  string  $carrier
     * @param  string|null  $product
     * @param  string|null  $shop_id
     */
    public function getPickupPoints($country, $postcode, $carrier, $product = null, $shop_id = null): Results
    {
        $options = ['country' => $country, 'postcode' => $postcode, 'carrier' => $carrier];
        if (isset($product)) {
            $options += ['product' => $product];
        }

        if (isset($shop_id)) {
            $options += ['shop_id' => $shop_id];
        }

        $xml = $this->request([], $options);

        return Results::fromXML($xml);
    }
}
