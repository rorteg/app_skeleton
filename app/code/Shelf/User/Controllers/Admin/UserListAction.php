<?php

declare(strict_types=1);

namespace Shelf\User\Controllers\Admin;

use Shelf\Admin\Controllers\AdminActionAbstract;
use Shelf\Auth\Api\AuthenticateInterface;
use Shelf\Db\Api\ConnectionInterface;
use Shelf\Framework\Api\Http\ResponseInterface;
use Shelf\Framework\App\Http\HtmlResponse;
use Shelf\Framework\View\Api\TemplateRendererInterface;

/**
 * Class UserListAction
 * @package Shelf\User\Controllers\Admin
 */
class UserListAction extends AdminActionAbstract
{
    /**
     * @var TemplateRendererInterface
     */
    private $templateRenderer;

    /**
     * @var ConnectionInterface
     */
    private $connection;

    /**
     * UserListAction constructor
     * @param TemplateRendererInterface $templateRenderer
     * @param ConnectionInterface $connection
     * @param AuthenticateInterface $authenticate
     */
    public function __construct(
        TemplateRendererInterface $templateRenderer,
        ConnectionInterface $connection,
        AuthenticateInterface $authenticate
    ) {
        parent::__construct($authenticate);
        $this->templateRenderer = $templateRenderer;
        $this->connection = $connection;
    }

    /**
     * @return ResponseInterface
     */
    public function __invoke(): ResponseInterface
    {
        $users = $this->connection->query(
            'SELECT id, username, email, first_name, last_name from users',
            []
        )->fetchAll();

        return new HtmlResponse(
            $this->templateRenderer->render(
                '@user/admin/user_list.html',
                [
                    'users' => $users
                ]
            )
        );
    }
}
