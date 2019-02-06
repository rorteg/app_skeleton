<?php

declare(strict_types=1);

namespace MadeiraMadeira\Auth\Controllers\Auth;

use MadeiraMadeira\Admin\Controllers\AdminActionAbstract;
use MadeiraMadeira\Framework\Api\Http\ResponseInterface;

class LogoutAction extends AdminActionAbstract
{
    /**
     * @return ResponseInterface
     */
    public function __invoke(): ResponseInterface
    {
        $this->getAuthenticate()->clearIdentity();
        $this->redirect('/');
    }
}