<?php

namespace Larangogon\PhpRabbitmq\Validator\Contracts;

interface TypeValidatorContract
{
    public static function validate($param): bool;
}
