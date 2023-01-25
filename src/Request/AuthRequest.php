<?php

namespace Larangogon\PhpRabbitmq\Request;

use Larangogon\PhpRabbitmq\Contracts\AuthContract;

class AuthRequest implements AuthContract
{
    public function __construct(
        private readonly string $port,
        private readonly string $host,
        private readonly string $user,
        private readonly string $password,
    ) {
    }

    public function getCredentials(): array
    {
        return [
            'port' => $this->port,
            'host' => $this->host,
            'user' => $this->user,
            'password' => $this->password,
        ];
    }

    public function getHost(): string
    {
        return $this->host;
    }

    public function getPort(): string
    {
        return $this->port;
    }

    public function getUser(): string
    {
        return $this->user;
    }

    public function getPassword(): string
    {
        return $this->password;
    }
}
