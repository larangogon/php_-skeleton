<?php

namespace Larangogon\PhpRabbitmq\Services\RabbitMQ;

class Auth
{
    public function __construct(private readonly array $authData)
    {
    }

    public function singRequest($request): void
    {
        //
    }
}
