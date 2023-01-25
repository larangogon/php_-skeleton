<?php

namespace Larangogon\PhpRabbitmq\Entities\RabbitMQ;

use Larangogon\PhpRabbitmq\Validator\Constants\DataTypes;
use Larangogon\PhpRabbitmq\Validator\Validate;

class ValidateData extends Validate
{
    protected array $required = [
        'date' => DataTypes::STRING_TYPE,
        'message' => DataTypes::STRING_TYPE,
        'eventType' => DataTypes::STRING_TYPE,
    ];

    protected array $optional = [
        'correlationId' => DataTypes::STRING_TYPE,
        'ProcessId' => DataTypes::STRING_TYPE,
    ];
}
