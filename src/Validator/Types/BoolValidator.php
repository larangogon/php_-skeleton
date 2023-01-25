<?php

namespace Larangogon\PhpRabbitmq\Validator\Types;

use Larangogon\PhpRabbitmq\Validator\Contracts\TypeValidatorContract;

class BoolValidator implements TypeValidatorContract
{
    public static function validate($param): bool
    {
        return is_bool($param);
    }
}
