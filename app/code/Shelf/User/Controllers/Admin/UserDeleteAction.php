<?php

declare(strict_types=1);

namespace Shelf\User\Controllers\Admin;

use Psr\Http\Message\ResponseInterface;
use Psr\Http\Message\ServerRequestInterface;
use Zend\Diactoros\Response\HtmlResponse;
use Shelf\Framework\Session\FlashMessage;
use Shelf\User\Api\Data\UserInterface;
use Zend\Diactoros\Response\RedirectResponse;

/**
 * Class UserDeleteAction
 * @package Shelf\User\Controllers\Admin
 */
class UserDeleteAction
{
    /**
     * @var UserInterface
     */
    private $user;

    /**
     * UserDeleteAction constructor.
     * @param UserInterface $user
     */
    public function __construct(
        UserInterface $user
    ) {
        $this->user = $user;
    }

    /**
     * @param ServerRequestInterface $request
     * @param array $args
     * @return ResponseInterface
     */
    public function __invoke(ServerRequestInterface $request, array $args) : ResponseInterface
    {
        $id = $args['id'];
        if ($id == '') {
            return new RedirectResponse('/');
        }

        $user = $this->user->load($id);

        if ($user->getId()) {
            if ($user->delete()) {
                FlashMessage::addNotificationMessage(
                    FlashMessage::TYPE_SUCCESS,
                    'Deleted user successfully!'
                );

                if ($id == $_SESSION['user']['id']) {
                    unset($_SESSION['user']);
                }
            } else {
                FlashMessage::addNotificationMessage(
                    FlashMessage::TYPE_DANGER,
                    'There was a problem deleting the user.'
                );
            }
        }

        return new RedirectResponse('/admin/user');
    }
}
