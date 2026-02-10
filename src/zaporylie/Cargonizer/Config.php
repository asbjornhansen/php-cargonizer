<?php

namespace zaporylie\Cargonizer;

use Psr\Http\Client\ClientInterface;

/**
 * Class Config
 *
 * @package zaporylie\Cargonizer
 */
class Config
{
  const SANDBOX = 'https://sandbox.cargonizer.no';
  const PRODUCTION = 'https://cargonizer.no';

  protected static $config = [
    'endpoint' => self::SANDBOX,
    'sender' => NULL,
    'secret' => NULL,
  ];

  private function __construct() {} // make this private so we can't instanciate
  private function __wakeup() {} // make this private so we can't instanciate

  public static function set($key, $val)
  {
    self::$config[$key] = $val;
  }

  public static function get($key)
  {
    return self::$config[$key];
  }

  /**
   * Use this static method to get default HTTP Client.
   *
   * @param null|ClientInterface $client
   *
   * @return ClientInterface
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
      return \Http\Discovery\Psr18ClientDiscovery::find();
    }

    // Fallback: instantiate Guzzle directly
    if (class_exists('\GuzzleHttp\Client')) {
      return new \GuzzleHttp\Client();
    }

    throw new \LogicException(
      'No PSR-18 HTTP Client found. Install guzzlehttp/guzzle or provide a client explicitly.'
    );
  }

}
