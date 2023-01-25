<?php

namespace Larangogon\PhpRabbitmq\Tests\Mocks;

use Larangogon\PhpRabbitmq\Request\AuthRequest;

trait MockDataRabbitMQRequests
{
    public function authMastercard(): AuthRequest
    {
        return  new AuthRequest(
            'https://sandbox.api.mastercard.com',
            'defaultsandboxsigningkey', //Encryption Key password
            'PsY8yacmAaiCT0zBAy8v', //OAuth key alias password
            '8xUolaDasYtB-37NbllWxLw51SGQ00000000',
        );
    }

    public function data(): array
    {
        return [
            'data' => 'SECURE_COF_MERCHANT_OBO#PSTP2P-TESTPROGRAMNAMEPSTP2P1#01',
            'message' => 'f0ef4628-b28c-4fdf-9518-0934fe1ba17e',
            'eventType' => 'f0ef4628-b28c-4fdf-9518-0934fe1ba17e_dpa1',
        ];
    }
}
