<?php

declare(strict_types=1);

namespace MadeiraMadeira\Framework\Controller;

use MadeiraMadeira\Framework\Controller\Api\ActionInterface;

abstract class ActionAbstract implements ActionInterface
{
    /**
     * @param string $route
     * @param bool $permanent
     */
    public function redirect($route, $permanent = false)
    {
        if (headers_sent() === false) {
            header(
                'Location: '
                . $this->getBaseUrl()
                . $route,
                true,
                ($permanent === true) ? 301 : 302
            );
        }

        exit(1);
    }

    protected function getBaseUrl()
    {

        return sprintf(
            "%s://%s%s",
            isset($_SERVER['HTTPS']) && $_SERVER['HTTPS'] != 'off' ? 'https' : 'http',
            $_SERVER['SERVER_NAME'],
            isset($_SERVER['SERVER_PORT']) ? ':' . $_SERVER['SERVER_PORT'] : ''
        );
    }
}
