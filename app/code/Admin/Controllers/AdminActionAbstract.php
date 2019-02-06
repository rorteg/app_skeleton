<?php

declare(strict_types=1);

namespace MadeiraMadeira\Admin\Controllers;

use MadeiraMadeira\Auth\Api\AuthenticateInterface;
use MadeiraMadeira\Framework\Controller\ActionAbstract;

abstract class AdminActionAbstract extends ActionAbstract
{
    /**
     * @var AuthenticateInterface
     */
    private $authenticate;

    /**
     * AdminActionAbstract constructor.
     * @param AuthenticateInterface $authenticate
     */
    public function __construct(
        AuthenticateInterface $authenticate
    ) {
        $this->authenticate = $authenticate;
        $this->adminRouteCheck();
    }

    /**
     * @return bool
     */
    public function checkCredentials()
    {
        return $this->authenticate->isValid();
    }

    public function adminRouteCheck()
    {
        if (! $this->checkCredentials()) {
            $this->redirect('/login');
        }
    }

    /**
     * @return AuthenticateInterface
     */
    protected function getAuthenticate()
    {
        return $this->authenticate;
    }
}
