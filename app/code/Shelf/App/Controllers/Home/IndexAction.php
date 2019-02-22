<?php

declare(strict_types=1);

namespace Shelf\App\Controllers\Home;

use Psr\Http\Message\ResponseInterface;
use Psr\Http\Message\ServerRequestInterface;
use Zend\Diactoros\Response\HtmlResponse;
use Shelf\Framework\View\Api\TemplateRendererInterface;

/**
 * Class IndexAction
 * @package Shelf\App\Controllers\Home
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
        $html = $this->templateRenderer->render('@shelf_app/home/index.html', [
            'name' => 'Rafael Ortega Bueno'
        ]);
        return new HtmlResponse($html);
    }
}
