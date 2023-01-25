<?php

namespace Larangogon\PhpRabbitmq\Response;

use Larangogon\PhpRabbitmq\Contracts\ResponseContract;

class DataResponse implements ResponseContract
{
    protected array $body = [];

    public function __construct(private $data, protected array $auth)
    {
        if ($_data = json_decode($data->getBody(), true)) {
            $this->body = $_data;
        }
    }

    public function getBody(): array
    {
        return $this->body;
    }

    public function getHeader(): array
    {
        return $this->data->getHeaders();
    }

    public function getCode(): int
    {
        return $this->data->getStatusCode();
    }
}
