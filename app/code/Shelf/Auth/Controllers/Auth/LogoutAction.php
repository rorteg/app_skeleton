<?php

declare(strict_types=1);

namespace Shelf\Auth\Controllers\Auth;

use Psr\Http\Message\ResponseInterface;
use Psr\Http\Message\ServerRequestInterface;
use Shelf\Auth\Api\AuthenticateInterface;
use Zend\Diactoros\Response\RedirectResponse;

class LogoutAction
{
    /**
     * @var AuthenticateInterface
     */
    private $authenticate;

    /**
     * LogoutAction constructor.
     * @param AuthenticateInterface $authenticate
     */
    public function __construct(
        AuthenticateInterface $authenticate
    ) {
        $this->authenticate = $authenticate;
    }

    /**
     * @param ServerRequestInterface $request
     * @return ResponseInterface
     */
    public function __invoke(ServerRequestInterface $request) : ResponseInterface
    {
        $this->authenticate->clearIdentity();
        return new RedirectResponse('/');
    }
}
