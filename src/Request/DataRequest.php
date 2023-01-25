<?php

namespace Larangogon\PhpRabbitmq\Request;

use Exception;
use Larangogon\PhpRabbitmq\Entities\RabbitMQ\ValidateData;
use Larangogon\PhpRabbitmq\Validator\Exceptions\LarangogonException;

class DataRequest extends BaseRequest
{
    public function __construct(private readonly array $data)
    {
    }

    /**
     * @throws LarangogonException
     * @throws Exception
     */
    public function getData(array $auth): bool|string
    {
        $this->validate()->setAuth($auth);

        return json_encode($this->data);
    }

    /**
     * @throws LarangogonException
     */
    public function validate(): self
    {
        (new ValidateData())->validate($this->data);

        return $this;
    }
}
