<?php

declare(strict_types=1);

namespace zaporylie\Cargonizer;

use zaporylie\Cargonizer\Data\Consignments;

/**
 * Class Estimation
 */
class Estimation extends Client
{
    protected string $resource = '/consignment_costs.xml';

    protected string $method = 'POST';

    public function getEstimation(Consignments $consignments): \zaporylie\Cargonizer\Data\Estimation
    {
        $xml = $consignments->toXML();
        $xml = $this->request([], $xml->asXML());

        return \zaporylie\Cargonizer\Data\Estimation::fromXML($xml);
    }
}
