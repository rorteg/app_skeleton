<?php

declare(strict_types=1);

namespace MadeiraMadeira\User\Controllers\Admin;

use MadeiraMadeira\Admin\Controllers\AdminActionAbstract;
use MadeiraMadeira\Auth\Api\AuthenticateInterface;
use MadeiraMadeira\Db\Api\ConnectionInterface;
use MadeiraMadeira\Framework\Api\Http\ResponseInterface;
use MadeiraMadeira\Framework\App\Http\HtmlResponse;
use MadeiraMadeira\Framework\View\Api\TemplateRendererInterface;

/**
 * Class UserListAction
 * @package MadeiraMadeira\User\Controllers\Admin
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
