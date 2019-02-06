<?php

declare(strict_types=1);

namespace MadeiraMadeira\Auth\Controllers\Auth;

use MadeiraMadeira\Framework\Api\Http\ResponseInterface;
use MadeiraMadeira\Framework\App\Http\HtmlResponse;
use MadeiraMadeira\Framework\Controller\ActionAbstract;
use MadeiraMadeira\Framework\View\Api\TemplateRendererInterface;

/**
 * Class LoginAction
 * @package MadeiraMadeira\Auth\Controllers\Auth
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
        $html = $this->templateRenderer->render('@auth/login.html');
        return new HtmlResponse($html);
    }
}
