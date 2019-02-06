<?php

declare(strict_types=1);

namespace MadeiraMadeira\User\Controllers\Admin;

use MadeiraMadeira\Admin\Controllers\AdminActionAbstract;
use MadeiraMadeira\Auth\Api\AuthenticateInterface;
use MadeiraMadeira\Framework\Api\Http\ResponseInterface;
use MadeiraMadeira\Framework\Session\FlashMessage;
use MadeiraMadeira\User\Api\Data\UserInterface;

/**
 * Class UserDeleteAction
 * @package MadeiraMadeira\User\Controllers\Admin
 */
class UserDeleteAction extends AdminActionAbstract
{
    /**
     * @var UserInterface
     */
    private $user;

    /**
     * UserDeleteAction constructor.
     * @param UserInterface $user
     * @param AuthenticateInterface $authenticate
     */
    public function __construct(
        UserInterface $user,
        AuthenticateInterface $authenticate
    ) {
        parent::__construct($authenticate);
        $this->user = $user;
    }

    /**
     * @return ResponseInterface
     */
    public function __invoke() : ResponseInterface
    {
        $id = func_get_arg(0);
        if ($id == '') {
            $this->redirect('/');
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

        $this->redirect('/admin/user');
    }
}
