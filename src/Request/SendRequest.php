<?php

namespace Larangogon\PhpRabbitmq\Request;

use Larangogon\PhpRabbitmq\Contracts\RequestContract;
use Larangogon\PhpRabbitmq\Contracts\ResponseContract;
use Larangogon\PhpRabbitmq\Response\DataResponse;
use PhpAmqpLib\Connection\AMQPStreamConnection;
use PhpAmqpLib\Exception\AMQPLogicException;
use PhpAmqpLib\Message\AMQPMessage;
use Throwable;

trait SendRequest
{
    protected function sendRequest(RequestContract $request): ResponseContract
    {
        try {
            $connection = new AMQPStreamConnection(
                $this->authData->getHost(),
                $this->authData->getPort(),
                $this->authData->getUser(),
                $this->authData->getPassword()
            );

            $channel = $connection->channel();
            $response = $this->getResponse($request, $channel);
            $connection->close();
        } catch (Throwable $e) {
            //poner en la cola de nuevo el mensaje
        }

        return new DataResponse($response, $this->authData->getCredentials(), $request);
    }

    private function getResponse(RequestContract $request, $channel): string
    {
        $channel->queue_declare($this->authData->getUser(), false, false, false, false);

        $msg = new AMQPMessage($request->getData($this->authData->getCredentials()));
        $channel->basic_publish($msg, '', $this->authData->getUser());
        $channel->close();

        return "Sent message";
    }
}
