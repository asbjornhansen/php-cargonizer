<?php

declare(strict_types=1);

include __DIR__.'/../vendor/autoload.php';

$yaml = new \Symfony\Component\Yaml\Parser;
$settings = \Symfony\Component\Yaml\Yaml::parse(file_get_contents(__DIR__.'/config.yml'));

try {
    \zaporylie\Cargonizer\Config::set('endpoint', $settings['endpoint']);
    \zaporylie\Cargonizer\Config::set('secret', $settings['secret']);

    $profile = (new \zaporylie\Cargonizer\Profile)->getProfile();
    var_dump($profile);
} catch (\Exception $e) {
    var_dump($e->getMessage());
    var_dump($e->getTraceAsString());
}
