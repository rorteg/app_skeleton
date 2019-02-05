<?php

declare(strict_types=1);

namespace MadeiraMadeira\App\Controllers\Home;

use MadeiraMadeira\Framework\Api\Http\ResponseInterface;
use MadeiraMadeira\Framework\App\Http\HtmlResponse;
use MadeiraMadeira\Framework\Controller\ActionAbstract;
use MadeiraMadeira\Framework\View\Api\TemplateRendererInterface;

/**
 * Class IndexAction
 * @package MadeiraMadeira\App\Controllers\Home
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
        $html = $this->templateRenderer->render('@app/home/index.html', [
            'name' => 'Rafael Ortega Bueno'
        ]);
        return new HtmlResponse($html);
    }
}
