<?php

namespace Larangogon\PhpRabbitmq\Request;

use Larangogon\PhpRabbitmq\Entities\RabbitMQ\ValidateData;
use Larangogon\PhpRabbitmq\Validator\Exceptions\LarangogonException;

class DataRequest extends BaseRequest
{
    public function __construct(private array $data)
    {
    }

    /**
     * @throws LarangogonException
     */
    public function getRequest(array $auth)
    {
        $this->validate()->setAuth($auth);

        return $this->createRequest('$uri', json_encode($this->data));
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
