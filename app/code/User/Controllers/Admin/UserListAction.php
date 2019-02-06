<?php

declare(strict_types=1);

namespace MadeiraMadeira\User\Controllers\Admin;

use MadeiraMadeira\Admin\Controllers\AdminActionAbstract;
use MadeiraMadeira\Auth\Api\AuthenticateInterface;
use MadeiraMadeira\Framework\Api\Http\ResponseInterface;
use MadeiraMadeira\User\Api\Data\UserInterface;

/**
 * Class UserListAction
 * @package MadeiraMadeira\User\Controllers\Admin
 */
class UserListAction extends AdminActionAbstract
{
    /**
     * @var UserInterface
     */
    private $user;

    /**
     * UserListAction constructor.
     * @param UserInterface $user
     * @param AuthenticateInterface $authenticate
     */
    public function __construct(
        UserInterface $user,
        AuthenticateInterface $authenticate
    )
    {
        parent::__construct($authenticate);
        $this->user = $user;
    }

    /**
     * @return ResponseInterface
     */
    public function __invoke(): ResponseInterface
    {
        // TODO: Implement __invoke() method.
    }
}