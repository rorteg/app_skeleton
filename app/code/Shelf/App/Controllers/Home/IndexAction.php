<?php

declare(strict_types=1);

namespace Shelf\App\Controllers\Home;

use Shelf\Framework\Api\Http\ResponseInterface;
use Shelf\Framework\App\Http\HtmlResponse;
use Shelf\Framework\Controller\ActionAbstract;
use Shelf\Framework\View\Api\TemplateRendererInterface;

/**
 * Class IndexAction
 * @package Shelf\App\Controllers\Home
 */
class IndexAction extends ActionAbstract
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
     * @return ResponseInterface
     */
    public function __invoke(): ResponseInterface
    {
        $html = $this->templateRenderer->render('@shelf_app/home/index.html', [
            'name' => 'Rafael Ortega Bueno'
        ]);
        return new HtmlResponse($html);
    }
}
