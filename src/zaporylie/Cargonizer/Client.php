<?php

declare(strict_types=1);

namespace zaporylie\Cargonizer;

use GuzzleHttp\Psr7\HttpFactory;
use Http\Discovery\Psr17FactoryDiscovery;
use Psr\Http\Client\ClientExceptionInterface;
use Psr\Http\Client\ClientInterface;
use Psr\Http\Message\RequestFactoryInterface;
use Psr\Http\Message\StreamFactoryInterface;

/**
 * Class Client
 */
abstract class Client
{
    protected $resource;

    protected $method;

    /**
     * @var ClientInterface PSR-18 HTTP Client
     */
    protected ClientInterface $client;

    /**
     * @var RequestFactoryInterface PSR-17 Request Factory
     */
    protected RequestFactoryInterface $requestFactory;

    /**
     * @var StreamFactoryInterface PSR-17 Stream Factory
     */
    protected StreamFactoryInterface $streamFactory;

    public function __construct(
        $client = null,
        ?RequestFactoryInterface $requestFactory = null,
        ?StreamFactoryInterface $streamFactory = null
    ) {
        $this->client = Config::clientFactory($client);
        $this->requestFactory = $requestFactory ?? $this->discoverRequestFactory();
        $this->streamFactory = $streamFactory ?? $this->discoverStreamFactory();
    }

    /**
     * @throws \Exception
     */
    public function getResource(): string
    {
        if ($this->resource === null) {
            throw new \Exception('Undefined resource');
        }

        return $this->resource;
    }

    /**
     * @throws \Exception
     */
    public function getMetod(): string
    {
        if ($this->method === null) {
            throw new \Exception('Undefined method');
        }

        return $this->method;
    }

    /**
     * @throws \Exception
     */
    protected function request(array $headers = [], $data = null): \SimpleXMLElement|false
    {
        $headers += [
            'X-Cargonizer-Key' => Config::get('secret'),
            'X-Cargonizer-Sender' => Config::get('sender'),
        ];

        try {
            $method = $this->getMetod();
            $uri = Config::get('endpoint').$this->getResource();

            // Append query string for GET requests
            if ($method === 'GET' && ! empty($data)) {
                $uri .= '?'.http_build_query($data);
            }

            // Create PSR-7 request using PSR-17 factory (2 parameters only)
            $request = $this->requestFactory->createRequest($method, $uri);

            // Add headers using immutable PSR-7 pattern
            foreach ($headers as $name => $value) {
                $request = $request->withHeader($name, $value);
            }

            // Add body for non-GET requests
            if ($method !== 'GET' && $data !== null) {
                $stream = $this->streamFactory->createStream($data);
                $request = $request->withBody($stream);
            }

            // Make PSR-18 request
            $response = $this->client->sendRequest($request);
            $content = $response->getBody()->getContents();
            $xml = @simplexml_load_string($content);
            // Handle errors
            if ($response->getStatusCode() === 400 && ! isset($xml->error) && ! isset($xml->consignment->errors->error)) {
                throw new CargonizerException($content, $request);
            }

            if (isset($xml->error)) {
                throw new CargonizerException((string) $xml->error, $request);
            }

            // Handle errors
            if (isset($xml->consignment->errors->error)) {
                throw new CargonizerException((string) $xml->consignment->errors->error, $request);
            }

            return $xml;
        } catch (CargonizerException $e) {
            throw $e;
        } catch (ClientExceptionInterface $e) {
            // Wrap PSR-18 exceptions
            throw new CargonizerException($e->getMessage(), null, $e->getCode(), $e);
        } catch (\Exception $e) {
            throw new \Exception($e->getMessage(), $e->getCode(), $e);
        }
    }

    /**
     * Discover PSR-17 Request Factory.
     */
    protected function discoverRequestFactory(): RequestFactoryInterface
    {
        // Try php-http/discovery (backward compatibility)
        if (class_exists('\Http\Discovery\Psr17FactoryDiscovery')) {
            return Psr17FactoryDiscovery::findRequestFactory();
        }

        // Fallback: Use Guzzle PSR-7
        if (class_exists(HttpFactory::class)) {
            return new HttpFactory;
        }

        throw new \LogicException(
            'No PSR-17 Request Factory found. Install guzzlehttp/psr7 or provide a factory explicitly.'
        );
    }

    /**
     * Discover PSR-17 Stream Factory.
     */
    protected function discoverStreamFactory(): StreamFactoryInterface
    {
        // Try php-http/discovery (backward compatibility)
        if (class_exists('\Http\Discovery\Psr17FactoryDiscovery')) {
            return Psr17FactoryDiscovery::findStreamFactory();
        }

        // Fallback: Use Guzzle PSR-7
        if (class_exists(HttpFactory::class)) {
            return new HttpFactory;
        }

        throw new \LogicException(
            'No PSR-17 Stream Factory found. Install guzzlehttp/psr7 or provide a factory explicitly.'
        );
    }
}
