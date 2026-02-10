<?php

namespace zaporylie\Cargonizer;

use Psr\Http\Client\ClientExceptionInterface;
use Psr\Http\Message\RequestInterface;

class CargonizerException extends \RuntimeException implements ClientExceptionInterface
{
    private ?RequestInterface $request;

    public function __construct(
        string $message,
        ?RequestInterface $request = null,
        int $code = 0,
        ?\Throwable $previous = null
    ) {
        parent::__construct($message, $code, $previous);
        $this->request = $request;
    }

    public function getRequest(): ?RequestInterface
    {
        return $this->request;
    }
}
