<?php

namespace Larangogon\PhpRabbitmq\Tests\Feature\Validator;

use Larangogon\PhpRabbitmq\Request\DataRequest;
use Larangogon\PhpRabbitmq\Tests\Mocks\MockDataRabbitMQRequests;
use Larangogon\PhpRabbitmq\Validator\Exceptions\MissingFieldException;
use Larangogon\PhpRabbitmq\Validator\Exceptions\WrongDataTypeException;
use PHPUnit\Framework\TestCase;

class ValidateDataTest extends TestCase
{
    use MockDataRabbitMQRequests;

    /**
     * @test
     * @dataProvider dataProvider
     */
    public function itExpectsMissingFieldExceptionWhenAFieldIsMissing(
        array $data,
        string $request,
        string $missingField
    ): void {
        $this->expectException(MissingFieldException::class);
        $this->expectExceptionMessage("the field $missingField is missing");

        unset($data[$missingField]);

        $tspClient = new $request($data);

        $tspClient->validate();
    }

    /**
     * @test
     * @dataProvider dataProvider
     */
    public function itExpectsWrongDataTypeExceptionWhenTypeIsWrong(array $data, string $request, string $field): void
    {
        $this->expectException(WrongDataTypeException::class);
        $this->expectExceptionMessage("the field $field must be string");

        $data[$field] = 2345423;
        $tspClient = new $request($data);

        $tspClient->validate();
    }

    /**
     * @test
     * @dataProvider optionalDataProvider
     */
    public function itReturnTheRequestIfTheOptionalDataDoesNotCome(
        array $data,
        string $request,
        string $optionalField
    ): void {
        unset($data[$optionalField]);

        $tspClient = new $request($data);
        $tspClient->validate();

        $this->assertInstanceOf($request, $tspClient->validate());
    }

    public function dataProvider(): array
    {
        return [
            'DataRequest' => [$this->data(), DataRequest::class, 'data'],
        ];
    }

    public function optionalDataProvider(): array
    {
        return [
            'DataRequest' => [$this->data(), DataRequest::class, 'correlationId'],
        ];
    }
}
