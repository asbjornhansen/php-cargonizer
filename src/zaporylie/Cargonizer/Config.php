<?php

declare(strict_types=1);

namespace zaporylie\Cargonizer;

use GuzzleHttp\Client;
use Http\Discovery\Psr18ClientDiscovery;
use Psr\Http\Client\ClientInterface;

/**
 * Class Config
 */
class Config
{
    const string SANDBOX = 'https://sandbox.cargonizer.no';

    const string PRODUCTION = 'https://cargonizer.no';

    protected static array $config = [
        'endpoint' => self::SANDBOX,
        'sender' => null,
        'secret' => null,
    ];

    private function __construct() {} // make this private so we can't instanciate

    public static function set($key, $val): void
    {
        self::$config[$key] = $val;
    }

    public static function get($key): mixed
    {
        return self::$config[$key];
    }

    /**
     * Use this static method to get default HTTP Client.
     *
     * @param  null|ClientInterface  $client
     */
    public static function clientFactory($client = null): ClientInterface
    {
        // Accept explicit PSR-18 client
        if ($client instanceof ClientInterface) {
            return $client;
        }

        // Reject invalid types
        if ($client !== null) {
            throw new \LogicException(sprintf(
                'HttpClient must be instance of "%s"',
                ClientInterface::class
            ));
        }

        // Try discovery if available (backward compatibility)
        if (class_exists('\Http\Discovery\Psr18ClientDiscovery')) {
            return Psr18ClientDiscovery::find();
        }

        // Fallback: instantiate Guzzle directly
        if (class_exists(Client::class)) {
            return new Client;
        }

        throw new \LogicException(
            'No PSR-18 HTTP Client found. Install guzzlehttp/guzzle or provide a client explicitly.'
        );
    }
}
