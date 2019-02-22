<?php

declare(strict_types=1);

namespace Shelf\Admin\Controllers\Admin;

use Shelf\Framework\Session\FlashMessage;
use Shelf\Framework\View\Api\TemplateRendererInterface;
use Psr\Http\Message\ResponseInterface;
use Psr\Http\Message\ServerRequestInterface;
use Zend\Diactoros\Response\HtmlResponse;

/**
 * Class IndexAction
 * @package Shelf\Admin\Controllers
 */
class IndexAction
{
    /**
     * @var TemplateRendererInterface
     */
    private $templateRenderer;

    /**
     * IndexAction constructor.
     * @param TemplateRendererInterface $templateRenderer
     */
    public function __construct(
        TemplateRendererInterface $templateRenderer
    ) {
        $this->templateRenderer = $templateRenderer;
    }

    /**
     * @param ServerRequestInterface $request
     * @return ResponseInterface
     */
    public function __invoke(ServerRequestInterface $request) : ResponseInterface
    {
        FlashMessage::addNotificationMessage(
            FlashMessage::TYPE_INFO,
            'Welcome!',
            '',
            'Project Example'
        );
        $html = $this->templateRenderer->render('@shelf_admin/index.html');
        return new HtmlResponse($html);
    }
}
