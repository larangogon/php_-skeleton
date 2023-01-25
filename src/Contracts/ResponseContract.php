<?php

namespace Larangogon\PhpRabbitmq\Contracts;

interface ResponseContract
{
    public function getHeader(): array;

    public function getBody(): array;

    public function getCode(): int;
}
