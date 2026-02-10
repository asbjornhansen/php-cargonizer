<?php

declare(strict_types=1);

namespace zaporylie\Cargonizer;

/**
 * Class ConsignmentPrinter
 */
class ConsignmentPrinter extends Client
{
    protected $resourceTemplate = '/consignments/label_direct?consignment_ids[]=@consignment_id&printer_id=@printer_id';

    protected $method = 'POST';

    /**
     * Print a consignment.
     */
    public function printConsigment($consignment_id, $printer_id)
    {
        $this->resource = strtr($this->resourceTemplate, [
            '@consignment_id' => $consignment_id,
            '@printer_id' => $printer_id,
        ]);

        return $this->request();
    }
}
