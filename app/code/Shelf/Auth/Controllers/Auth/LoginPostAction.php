<?php

declare(strict_types=1);

namespace Shelf\Auth\Controllers\Auth;

use Shelf\Auth\Api\AuthenticateInterface;
use Shelf\Framework\Api\Http\ResponseInterface;
use Shelf\Framework\Controller\ActionAbstract;
use Shelf\Framework\Session\FlashMessage;

class LoginPostAction extends ActionAbstract
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
     * @return ResponseInterface
     */
    public function __invoke(): ResponseInterface
    {
        $postParams = filter_input_array(INPUT_POST);

        if (! isset($postParams['username']) || ! isset($postParams['password'])) {
            $this->redirect('/');
        }

        $auth = $this->authenticate;
        $auth
            ->setIdentity($postParams['username'])
            ->setCredential($postParams['password']);

        $user = $auth->authenticate();

        if (! $user) {
            FlashMessage::addMessage(FlashMessage::TYPE_DANGER, 'Login ou Senha inválidos.');
            $this->redirect('/login');
        }

        $this->redirect('/admin');
    }
}
