<?php

namespace Larangogon\PhpRabbitmq;

use Larangogon\PhpRabbitmq\Contracts\ResponseContract;
use Larangogon\PhpRabbitmq\Request\AuthRequest;
use Larangogon\PhpRabbitmq\Request\DataRequest;
use Larangogon\PhpRabbitmq\Request\SendRequest;
use Larangogon\PhpRabbitmq\Services\RabbitMQ\Auth;

class RabbitMQService
{
    use SendRequest;

    protected Auth $auth;

    public function __construct(protected AuthRequest $authData, protected $client)
    {
        $this->auth = new Auth($authData->getCredentials());
    }

    public function consultMessage(DataRequest $request): ResponseContract
    {
        return $this->sendRequest($request);
    }

    public function addMessage(DataRequest $request): ResponseContract
    {
        return $this->sendRequest($request);
    }
}
