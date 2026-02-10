<?php

namespace zaporylie\Cargonizer;

use Psr\Http\Client\ClientInterface;
use Psr\Http\Message\RequestFactoryInterface;
use Psr\Http\Message\StreamFactoryInterface;

/**
 * Class Client
 *
 * @package zaporylie\Cargonizer
 */
abstract class Client {

  protected $resource = NULL;
  protected $method = NULL;

  /**
   * @var ClientInterface PSR-18 HTTP Client
   */
  protected $client;

  /**
   * @var RequestFactoryInterface PSR-17 Request Factory
   */
  protected $requestFactory;

  /**
   * @var StreamFactoryInterface PSR-17 Stream Factory
   */
  protected $streamFactory;

  public function __construct(
    $client = NULL,
    ?RequestFactoryInterface $requestFactory = NULL,
    ?StreamFactoryInterface $streamFactory = NULL
  ) {
    $this->client = Config::clientFactory($client);
    $this->requestFactory = $requestFactory ?? $this->discoverRequestFactory();
    $this->streamFactory = $streamFactory ?? $this->discoverStreamFactory();
  }

  /**
   * @return mixed
   * @throws \Exception
   */
  public function getResource() {
    if (!isset($this->resource)) {
      throw new \Exception('Undefined resource');
    }
    return $this->resource;
  }

  /**
   * @return null
   * @throws \Exception
   */
  public function getMetod() {
    if (!isset($this->method)) {
      throw new \Exception('Undefined method');
    }
    return $this->method;
  }

  /**
   * @param array $headers
   * @param null $data
   *
   * @return mixed
   * @throws \Exception
   */
  protected function request(array $headers = [], $data = NULL) {
    $headers += [
      'X-Cargonizer-Key' => Config::get('secret'),
      'X-Cargonizer-Sender' => Config::get('sender'),
    ];

    try {
      $method = $this->getMetod();
      $uri = Config::get('endpoint') . $this->getResource();

      // Append query string for GET requests
      if ($method === 'GET' && !empty($data)) {
        $uri .= '?' . http_build_query($data);
      }

      // Create PSR-7 request using PSR-17 factory (2 parameters only)
      $request = $this->requestFactory->createRequest($method, $uri);

      // Add headers using immutable PSR-7 pattern
      foreach ($headers as $name => $value) {
        $request = $request->withHeader($name, $value);
      }

      // Add body for non-GET requests
      if ($method !== 'GET' && $data !== NULL) {
        $stream = $this->streamFactory->createStream($data);
        $request = $request->withBody($stream);
      }

      // Make PSR-18 request
      $response = $this->client->sendRequest($request);
      $content = $response->getBody()->getContents();
      $xml = @simplexml_load_string($content);

      // Handle errors
      if ($response->getStatusCode() === 400 && !isset($xml->error) && !isset($xml->consignment->errors->error)) {
        throw new CargonizerException((string) $content, $request);
      } elseif (isset($xml->error)) {
        throw new CargonizerException((string) $xml->error, $request);
      } elseif (isset($xml->consignment->errors->error)) {
        throw new CargonizerException((string) $xml->consignment->errors->error, $request);
      }

      return $xml;
    } catch (CargonizerException $e) {
      throw $e;
    } catch (\Psr\Http\Client\ClientExceptionInterface $e) {
      // Wrap PSR-18 exceptions
      throw new CargonizerException($e->getMessage(), null, $e->getCode(), $e);
    } catch (\Exception $e) {
      throw new \Exception($e->getMessage(), $e->getCode(), $e);
    }
  }

  /**
   * Discover PSR-17 Request Factory.
   *
   * @return RequestFactoryInterface
   */
  protected function discoverRequestFactory(): RequestFactoryInterface {
    // Try php-http/discovery (backward compatibility)
    if (class_exists('\Http\Discovery\Psr17FactoryDiscovery')) {
      return \Http\Discovery\Psr17FactoryDiscovery::findRequestFactory();
    }

    // Fallback: Use Guzzle PSR-7
    if (class_exists('\GuzzleHttp\Psr7\HttpFactory')) {
      return new \GuzzleHttp\Psr7\HttpFactory();
    }

    throw new \LogicException(
      'No PSR-17 Request Factory found. Install guzzlehttp/psr7 or provide a factory explicitly.'
    );
  }

  /**
   * Discover PSR-17 Stream Factory.
   *
   * @return StreamFactoryInterface
   */
  protected function discoverStreamFactory(): StreamFactoryInterface {
    // Try php-http/discovery (backward compatibility)
    if (class_exists('\Http\Discovery\Psr17FactoryDiscovery')) {
      return \Http\Discovery\Psr17FactoryDiscovery::findStreamFactory();
    }

    // Fallback: Use Guzzle PSR-7
    if (class_exists('\GuzzleHttp\Psr7\HttpFactory')) {
      return new \GuzzleHttp\Psr7\HttpFactory();
    }

    throw new \LogicException(
      'No PSR-17 Stream Factory found. Install guzzlehttp/psr7 or provide a factory explicitly.'
    );
  }

}
