<?php

declare(strict_types=1);

namespace Shelf\Auth\Controllers\Auth;

use Shelf\Admin\Controllers\AdminActionAbstract;
use Shelf\Framework\Api\Http\ResponseInterface;

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
