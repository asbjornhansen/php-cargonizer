<?php

declare(strict_types=1);

namespace zaporylie\Cargonizer;

use zaporylie\Cargonizer\Data\TransportAgreements;

class Agreements extends Client
{
    protected string $resource = '/transport_agreements.xml';

    protected string $method = 'GET';

    public function getAgreements(): TransportAgreements
    {
        $xml = $this->request();

        return TransportAgreements::fromXML($xml);
    }
}
