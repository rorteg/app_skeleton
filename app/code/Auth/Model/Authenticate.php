<?php

declare(strict_types=1);

namespace MadeiraMadeira\Auth\Model;

use MadeiraMadeira\Auth\Api\AuthenticateInterface;
use MadeiraMadeira\Framework\Session\Session;
use MadeiraMadeira\User\Api\Data\UserInterface;

class Authenticate implements AuthenticateInterface
{
    /**
     * @var UserInterface
     */
    private $user;

    /**
     * @var string
     */
    private $identity;

    /**
     * @var string
     */
    private $credential;

    /**
     * Authenticate constructor.
     * @param UserInterface $user
     */
    public function __construct(
        UserInterface $user
    ) {
        $this->user = $user;
    }

    /**
     * @param string $identity
     * @return AuthenticateInterface
     */
    public function setIdentity($identity): AuthenticateInterface
    {
        $this->identity = $identity;
        return $this;
    }

    /**
     * @param string $credential
     * @return AuthenticateInterface
     */
    public function setCredential($credential): AuthenticateInterface
    {
        $this->credential = $credential;
        return $this;
    }

    /**
     * @return mixed
     */
    public function authenticate()
    {
        $user = $this->user->load($this->identity, 'username');

        if ($user->getId()) {
            if (! password_verify($this->credential, $user->getPassword())) {
                return false;
            }

            Session::sessionStart();
            $userData = [
                'username' => $user->getUsername(),
                'first_name' => $user->getFirstName(),
                'last_name' => $user->getLastName(),
                'email' => $user->getEmail(),
                'id' => $user->getId()
            ];

            $_SESSION['user'] = $userData;

            return $userData;
        }

        return false;
    }

    /**
     * @return bool
     */
    public function isValid() : bool
    {
        Session::sessionStart();

        if (! isset($_SESSION['user'])) {
            return false;
        }

        return true;
    }

    /**
     * @return void
     */
    public function clearIdentity() : void
    {
        Session::sessionStart();

        if (isset($_SESSION['user'])) {
            unset($_SESSION['user']);
        }
    }
}
