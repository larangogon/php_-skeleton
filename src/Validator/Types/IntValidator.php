<?php

namespace Larangogon\PhpRabbitmq\Validator\Types;

use Larangogon\PhpRabbitmq\Validator\Contracts\TypeValidatorContract;

class IntValidator implements TypeValidatorContract
{
    public static function validate($param): bool
    {
        return is_int($param);
    }
}
