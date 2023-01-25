<?php

namespace Larangogon\PhpRabbitmq\Contracts;

interface RequestContract
{
    public function getData(array $auth);
}
