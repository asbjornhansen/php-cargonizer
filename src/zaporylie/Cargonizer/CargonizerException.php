<?php

declare(strict_types=1);

namespace zaporylie\Cargonizer;

use Psr\Http\Client\ClientExceptionInterface;
use Psr\Http\Message\RequestInterface;

class CargonizerException extends \RuntimeException implements ClientExceptionInterface
{
    public function __construct(
        string $message,
        private readonly ?RequestInterface $request = null,
        int $code = 0,
        ?\Throwable $throwable = null
    ) {
        parent::__construct($message, $code, $throwable);
    }

    public function getRequest(): ?RequestInterface
    {
        return $this->request;
    }
}
