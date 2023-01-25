<?php

namespace Larangogon\PhpRabbitmq\Contracts;

interface AuthContract
{
    public function getCredentials(): array;
}
