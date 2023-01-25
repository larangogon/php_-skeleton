<?php

namespace Larangogon\PhpRabbitmq\Contracts;

interface RequestContract
{
    public function getRequest(array $auth);
}
