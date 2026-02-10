<?php

declare(strict_types=1);

namespace Tests;

use Mockery;
use PHPUnit\Framework\TestCase as BaseTestCase;
use zaporylie\Cargonizer\Config;

abstract class TestCase extends BaseTestCase
{
    #[\Override]
    protected function tearDown(): void
    {
        Mockery::close();
        parent::tearDown();
    }

    /**
     * Set Config values for testing
     */
    protected function setTestConfig(): void
    {
        Config::set('endpoint', Config::SANDBOX);
        Config::set('secret', 'test-secret-key');
        Config::set('sender', 'test-sender');
    }
}
