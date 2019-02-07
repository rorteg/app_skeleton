<?php

declare(strict_types=1);

namespace MadeiraMadeira\Admin\Controllers\Admin;

use MadeiraMadeira\Admin\Controllers\AdminActionAbstract;
use MadeiraMadeira\Auth\Api\AuthenticateInterface;
use MadeiraMadeira\Framework\Api\Http\ResponseInterface;
use MadeiraMadeira\Framework\App\Http\HtmlResponse;
use MadeiraMadeira\Framework\Session\FlashMessage;
use MadeiraMadeira\Framework\View\Api\TemplateRendererInterface;

/**
 * Class IndexAction
 * @package MadeiraMadeira\Admin\Controllers
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
