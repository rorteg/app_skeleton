<?php

declare(strict_types=1);

namespace MadeiraMadeira\Framework\App;

use MadeiraMadeira\Framework\Api\AppInterface;

/**
 * Class Http
 * @package MadeiraMadeira\Framework\App
 */
class Http implements AppInterface
{
    /**
     * @var array
     */
    private $routeConfig = [];

    /**
     * Http constructor.
     * @param $routeConfig
     */
    public function __construct($routeConfig)
    {
        $this->routeConfig = $routeConfig;
    }

    /**
     * Launch application
     * @return void
     * @throws \Exception
     */
    public function launch()
    {
        $router = new \AltoRouter();

        $router->addRoutes($this->routeConfig);

        // match current request url
        $match = $router->match();

        // call closure or throw 404 status
        if( $match && is_callable( $match['target'] ) ) {
            call_user_func_array( $match['target'], $match['params'] );
        } else {
            // no route was matched
            header( $_SERVER["SERVER_PROTOCOL"] . ' 404 Not Found');
        }
    }
}