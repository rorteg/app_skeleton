<?php

declare(strict_types=1);

namespace Shelf\Auth\Controllers\Auth;

use Psr\Http\Message\ResponseInterface;
use Psr\Http\Message\ServerRequestInterface;
use Zend\Diactoros\Response\HtmlResponse;
use Shelf\Framework\View\Api\TemplateRendererInterface;

/**
 * Class LoginAction
 * @package Shelf\Auth\Controllers\Auth
 */
class LoginAction
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
     * @param ServerRequestInterface $request
     * @return ResponseInterface
     */
    public function __invoke(ServerRequestInterface $request) : ResponseInterface
    {
        $html = $this->templateRenderer->render('@shelf_auth/login.html');
        return new HtmlResponse($html);
    }
}
