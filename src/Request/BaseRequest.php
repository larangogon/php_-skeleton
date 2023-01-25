<?php

namespace Larangogon\PhpRabbitmq\Request;

use Larangogon\PhpRabbitmq\Contracts\RequestContract;

abstract class BaseRequest implements RequestContract
{
    protected array $auth;
    public function setAuth(array $auth): self
    {
        $this->auth = $auth;

        return $this;
    }

    abstract protected function validate(): self;
}
