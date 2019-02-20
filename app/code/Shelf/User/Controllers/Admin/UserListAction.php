<?php

declare(strict_types=1);

namespace Shelf\User\Controllers\Admin;

use Shelf\Db\Api\ConnectionInterface;
use Psr\Http\Message\ResponseInterface;
use Psr\Http\Message\ServerRequestInterface;
use Zend\Diactoros\Response\HtmlResponse;
use Shelf\Framework\View\Api\TemplateRendererInterface;

/**
 * Class UserListAction
 * @package Shelf\User\Controllers\Admin
 */
class UserListAction
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
     */
    public function __construct(
        TemplateRendererInterface $templateRenderer,
        ConnectionInterface $connection
    ) {
        $this->templateRenderer = $templateRenderer;
        $this->connection = $connection;
    }

    /**
     * @param ServerRequestInterface $request
     * @return ResponseInterface
     */
    public function __invoke(ServerRequestInterface $request) : ResponseInterface
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
