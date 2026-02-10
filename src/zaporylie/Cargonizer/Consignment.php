<?php

declare(strict_types=1);

namespace zaporylie\Cargonizer;

use zaporylie\Cargonizer\Data\Consignments;
use zaporylie\Cargonizer\Data\ConsignmentsResponse;

/**
 * Class Consigment
 */
class Consignment extends Client
{
    protected string $resource = '/consignments.xml';

    protected string $method = 'POST';

    public function createConsignments(Consignments $consignments): ConsignmentsResponse
    {
        $xml = $consignments->toXML();
        $response_xml = $this->request([], $xml->asXML());

        return ConsignmentsResponse::fromXML($response_xml);
    }

    /**
     * @deprecated The name was misleading. Use createConsignments instead.
     */
    public function requestConsigment(Consignments $consignments): ConsignmentsResponse
    {
        return $this->createConsignments($consignments);
    }
}
