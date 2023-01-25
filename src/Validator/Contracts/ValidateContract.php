<?php

namespace Larangogon\PhpRabbitmq\Validator\Contracts;

interface ValidateContract
{
    public function validate(array $data): void;
}
