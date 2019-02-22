<?php

declare(strict_types=1);

namespace Shelf\Auth\Controllers\Auth;

use Shelf\Auth\Api\AuthenticateInterface;
use Psr\Http\Message\ResponseInterface;
use Psr\Http\Message\ServerRequestInterface;
use Shelf\Framework\Session\FlashMessage;
use Zend\Diactoros\Response\RedirectResponse;

class LoginPostAction
{
    /**
     * @var AuthenticateInterface
     */
    private $authenticate;

    /**
     * LoginPostAction constructor.
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
        $postParams = $request->getParsedBody();


        if (! isset($postParams['username']) || ! isset($postParams['password'])) {
            return new RedirectResponse('/');
        }

        $auth = $this->authenticate;
        $auth
            ->setIdentity($postParams['username'])
            ->setCredential($postParams['password']);

        $user = $auth->authenticate();

        if (! $user) {
            FlashMessage::addMessage(FlashMessage::TYPE_DANGER, 'Login ou Senha inválidos.');
            return new RedirectResponse('/login');
        }

        return new RedirectResponse('/admin');
    }
}
