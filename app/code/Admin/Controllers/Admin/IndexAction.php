<?php

declare(strict_types=1);

namespace MadeiraMadeira\Admin\Controllers\Admin;

use MadeiraMadeira\Admin\Controllers\AdminActionAbstract;
use MadeiraMadeira\Framework\Api\Http\ResponseInterface;
use MadeiraMadeira\Framework\App\Http\HtmlResponse;

/**
 * Class IndexAction
 * @package MadeiraMadeira\Admin\Controllers
 */
class IndexAction extends AdminActionAbstract
{
    /**
     * @return ResponseInterface
     */
    public function __invoke(): ResponseInterface
    {
        return new HtmlResponse('okok');
    }
}
