<?php

declare(strict_types=1);

namespace MadeiraMadeira\Auth\Api;

interface AuthenticateInterface
{
    /**
     * @param string $identity
     * @return AuthenticateInterface
     */
    public function setIdentity($identity) : AuthenticateInterface;

    /**
     * @param string $credential
     * @return AuthenticateInterface
     */
    public function setCredential($credential) : AuthenticateInterface;

    /**
     * @return mixed
     */
    public function authenticate();

    /**
     * @return bool
     */
    public function isValid() : bool;

    /**
     * @return void
     */
    public function clearIdentity() : void;
}
