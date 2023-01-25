<?php

namespace Larangogon\PhpRabbitmq\Request;

use Larangogon\PhpRabbitmq\Contracts\AuthContract;

class AuthRequest implements AuthContract
{
    public function __construct(
        private readonly string $url,
        private readonly string $apiKey,
        private readonly string $requestId,
        private readonly string $sharedSecret,
    ) {
    }

    public function getCredentials(): array
    {
        return [
            'url' => $this->url,
            'apiKey' => $this->apiKey,
            'requestId' => $this->requestId,
            'sharedSecret' => $this->sharedSecret,
        ];
    }
}
