<?php

declare(strict_types=1);

namespace Shelf\Auth\Controllers\Auth;

use Shelf\Framework\Api\Http\ResponseInterface;
use Shelf\Framework\App\Http\HtmlResponse;
use Shelf\Framework\Controller\ActionAbstract;
use Shelf\Framework\View\Api\TemplateRendererInterface;

/**
 * Class LoginAction
 * @package Shelf\Auth\Controllers\Auth
 */
class LoginAction extends ActionAbstract
{
    /**
     * @var TemplateRendererInterface
     */
    private $templateRenderer;

    /**
     * LoginAction constructor.
     * @param TemplateRendererInterface $templateRenderer
     */
    public function __construct(TemplateRendererInterface $templateRenderer)
    {
        $this->templateRenderer = $templateRenderer;
    }

    /**
     * @return ResponseInterface
     */
    public function __invoke() : ResponseInterface
    {
        $html = $this->templateRenderer->render('@shelf_auth/login.html');
        return new HtmlResponse($html);
    }
}
