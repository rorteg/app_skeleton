<?php

declare(strict_types=1);

namespace Shelf\Admin\Controllers\Admin;

use Shelf\Admin\Controllers\AdminActionAbstract;
use Shelf\Auth\Api\AuthenticateInterface;
use Shelf\Framework\Api\Http\ResponseInterface;
use Shelf\Framework\App\Http\HtmlResponse;
use Shelf\Framework\Session\FlashMessage;
use Shelf\Framework\View\Api\TemplateRendererInterface;

/**
 * Class IndexAction
 * @package Shelf\Admin\Controllers
 */
class IndexAction extends AdminActionAbstract
{
    /**
     * @var TemplateRendererInterface
     */
    private $templateRenderer;

    /**
     * IndexAction constructor.
     * @param AuthenticateInterface $authenticate
     * @param TemplateRendererInterface $templateRenderer
     */
    public function __construct(
        AuthenticateInterface $authenticate,
        TemplateRendererInterface $templateRenderer
    ) {
        parent::__construct($authenticate);
        $this->templateRenderer = $templateRenderer;
    }

    /**
     * @return ResponseInterface
     */
    public function __invoke(): ResponseInterface
    {
        FlashMessage::addNotificationMessage(
            FlashMessage::TYPE_INFO,
            'Welcome!',
            '',
            'Project Example'
        );
        $html = $this->templateRenderer->render('@admin/index.html');
        return new HtmlResponse($html);
    }
}
