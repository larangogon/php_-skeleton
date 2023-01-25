<?php

namespace Larangogon\PhpRabbitmq\Response;

use Larangogon\PhpRabbitmq\Contracts\RequestContract;
use Larangogon\PhpRabbitmq\Contracts\ResponseContract;

class DataResponse implements ResponseContract
{
    public function __construct(private $data, protected array $auth, private readonly RequestContract $request)
    {
    }

    public function getMessage(): array
    {
        return $this->data;
    }

    public function getResponse(): RequestContract
    {
        return $this->request;
    }

    public function getAuth(): array
    {
        return $this->auth;
    }
}
