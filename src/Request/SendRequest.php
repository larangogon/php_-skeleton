<?php

namespace Larangogon\PhpRabbitmq\Request;

use Larangogon\PhpRabbitmq\Contracts\RequestContract;
use Larangogon\PhpRabbitmq\Contracts\ResponseContract;
use Larangogon\PhpRabbitmq\Response\DataResponse;
use Throwable;

trait SendRequest
{
    protected function sendRequest(
        RequestContract $request,
        string $dataResponse = DataResponse::class
    ): ResponseContract {
        try {
            $response = $this->getResponse($request);
        } catch (Throwable $e) {
            //poner en la cola de nuevo el mensaje
        }

        return new $dataResponse($response, $this->authData->getCredentials());
    }

    private function getResponse(RequestContract $request)
    {
        return $this->client->send($request->getRequest($this->authData->getCredentials()));
    }
}
