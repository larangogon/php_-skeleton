<?php

namespace Larangogon\PhpRabbitmq\Contracts;

interface ResponseContract
{
    public function getMessage(): array;

    public function getResponse(): RequestContract;

    public function getAuth(): array;
}
