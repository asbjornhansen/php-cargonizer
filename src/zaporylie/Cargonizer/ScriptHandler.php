<?php

declare(strict_types=1);

/**
 * Composer scripts.
 *
 * Helper class with static methods which can react to composer events.
 */

namespace zaporylie\Cargonizer;

use Symfony\Component\Filesystem\Filesystem;
use Symfony\Component\Yaml\Yaml;

/**
 * Class ScriptHandler
 */
class ScriptHandler
{
    /**
     * Generate dummy yaml.
     */
    public static function createExamplesConfigFile(): void
    {
        $filesystem = new Filesystem;
        $root = __DIR__.'/../../../examples/';
        if (! $filesystem->exists($root.'config.yml')) {
            $settings = [
                'endpoint' => '',
                'secret' => '',
                'sender' => '',
            ];
            $content = Yaml::dump($settings);
            $filesystem->dumpFile($root.'config.yml', $content);
        }
    }
}
