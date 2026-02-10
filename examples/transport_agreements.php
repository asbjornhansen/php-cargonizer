<?php

declare(strict_types=1);

include __DIR__.'/../vendor/autoload.php';

$yaml = new \Symfony\Component\Yaml\Parser;
$settings = \Symfony\Component\Yaml\Yaml::parse(file_get_contents(__DIR__.'/config.yml'));

try {
    \zaporylie\Cargonizer\Config::set('endpoint', $settings['endpoint']);
    \zaporylie\Cargonizer\Config::set('secret', $settings['secret']);
    \zaporylie\Cargonizer\Config::set('sender', $settings['sender']);

    /** @var \zaporylie\Cargonizer\Data\ServicePartners $agreements */
    $agreements = (new \zaporylie\Cargonizer\Agreements)->getAgreements();
    foreach ($agreements as $agreement) {
        echo '<strong>'.$agreement->getCarrier()->getName().' ('.$agreement->getId().'):</strong><br>';

        /** @var \zaporylie\Cargonizer\Data\Product $product */
        foreach ($agreement->getProducts() as $product) {
            echo $product->getIdentifier().' - '.$product->getName().'<br>';
        }
    }

} catch (\Exception $e) {
    var_dump($e->getMessage());
    var_dump($e->getTraceAsString());
}
