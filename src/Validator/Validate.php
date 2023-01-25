<?php

namespace Larangogon\PhpRabbitmq\Validator;

use Larangogon\PhpRabbitmq\Validator\Constants\DataTypes;
use Larangogon\PhpRabbitmq\Validator\Contracts\TypeValidatorContract;
use Larangogon\PhpRabbitmq\Validator\Contracts\ValidateContract;
use Larangogon\PhpRabbitmq\Validator\Exceptions\LarangogonException;
use Larangogon\PhpRabbitmq\Validator\Exceptions\MissingFieldException;
use Larangogon\PhpRabbitmq\Validator\Exceptions\WrongDataTypeException;
use Larangogon\PhpRabbitmq\Validator\Types\ArrayValidator;
use Larangogon\PhpRabbitmq\Validator\Types\BoolValidator;
use Larangogon\PhpRabbitmq\Validator\Types\FloatValidator;
use Larangogon\PhpRabbitmq\Validator\Types\IntValidator;
use Larangogon\PhpRabbitmq\Validator\Types\StringValidator;

abstract class Validate implements ValidateContract
{
    public const TYPE_VALIDATORS = [
        DataTypes::STRING_TYPE => StringValidator::class,
        DataTypes::ARRAY_TYPE => ArrayValidator::class,
        DataTypes::BOOL_TYPE => BoolValidator::class,
        DataTypes::INT_TYPE => IntValidator::class,
        DataTypes::FLOAT_TYPE => FloatValidator::class,
    ];

    protected array $required = [];

    protected array $optional = [];

    protected array $sharedReset = [];

    protected array $shared = [];

    /**
     * @throws LarangogonException
     */
    public function validate(array $data): void
    {
        $this->required($data);
        $this->optional($data);
        $this->shared($data);
        $this->sharedReset($data);
    }

    /**
     * @throws MissingFieldException|WrongDataTypeException
     */
    private function required(array $data): void
    {
        foreach ($this->required as $field => $typeData) {
            if (!isset($data[$field])) {
                $this->missing($field);
            }
            $this->validateTypeData($data, $typeData, $field);
        }
    }

    /**
     * @throws WrongDataTypeException
     */
    private function optional($data): void
    {
        foreach ($this->optional as $field => $typeData) {
            if (isset($data[$field])) {
                $this->validateTypeData($data, $typeData, $field);
            }
        }
    }

    private function shared($data): void
    {
        foreach ($this->shared as $field => $class) {
            if (isset($data[$field])) {
                /** @var ValidateContract $validate */
                $validate = new $class();
                $validate->validate($data[$field]);
            }
        }
    }

    private function sharedReset($data): void
    {
        foreach ($this->sharedReset as $field => $class) {
            if (isset($data[$field])) {
                /** @var ValidateContract $validate */
                $validate = new $class();
                $validate->validate(reset($data[$field]));
            }
        }
    }

    /**
     * @throws WrongDataTypeException
     */
    private function validateTypeData($data, $typeData, $field): void
    {
        /** @var TypeValidatorContract $class */
        $class = self::TYPE_VALIDATORS[$typeData];

        if (!$class::validate($data[$field])) {
            $this->wrongDataType($field, $typeData);
        }
    }

    /**
     * @throws MissingFieldException
     */
    private function missing($field): void
    {
        throw new MissingFieldException(
            'the field ' . $field . ' is missing'
        );
    }

    /**
     * @throws WrongDataTypeException
     */
    private function wrongDataType($field, $typeData): void
    {
        throw new WrongDataTypeException(
            'the field ' . $field . ' must be ' . $typeData
        );
    }
}
