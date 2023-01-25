<?php

namespace Larangogon\PhpRabbitmq\Tests\Feature\Validator;

use Larangogon\PhpRabbitmq\Validator\Types\ArrayValidator;
use Larangogon\PhpRabbitmq\Validator\Types\BoolValidator;
use Larangogon\PhpRabbitmq\Validator\Types\FloatValidator;
use Larangogon\PhpRabbitmq\Validator\Types\IntValidator;
use Larangogon\PhpRabbitmq\Validator\Types\StringValidator;
use PHPUnit\Framework\TestCase;

class TypeValidatorContractTest extends TestCase
{
    /**
     * @test
     * @dataProvider correctDataProvider
     */
    public function itMustReturnTrueWhenValidateDataSuccessfully(string $validator, $field): void
    {
        $this->assertTrue($validator::validate($field));
    }

    /**
     * @test
     * @dataProvider incorrectDataProvider
     */
    public function itMustReturnFalseWhenValidateDataFailed(string $validator, $field): void
    {
        $this->assertFalse($validator::validate($field));
    }

    public function incorrectDataProvider(): array
    {
        return [
            'data type string' => [StringValidator::class, 10],
            'data type integer' => [IntValidator::class, 'i am not integer'],
            'data type boolean' => [BoolValidator::class, 'false'],
            'data type array' => [ArrayValidator::class, 'i am not array'],
            'data type float' => [FloatValidator::class, '1.0'],
        ];
    }

    public function correctDataProvider(): array
    {
        return [
            'data type string' => [StringValidator::class, 'i am string'],
            'data type integer' => [IntValidator::class, 10],
            'data type boolean' => [BoolValidator::class, false],
            'data type array' => [ArrayValidator::class, ['i', 'am', 'array']],
            'data type float' => [FloatValidator::class, 1.0],
        ];
    }
}
