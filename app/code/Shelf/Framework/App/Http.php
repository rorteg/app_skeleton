<?php

declare(strict_types=1);

namespace Shelf\Framework\App;

use League\Route\RouteGroup;
use League\Route\Router;
use League\Route\Strategy\ApplicationStrategy;
use Shelf\Framework\Api\AppInterface;
use Zend\Diactoros\ServerRequestFactory;
use Zend\HttpHandlerRunner\Emitter\SapiEmitter;
use Zend\ServiceManager\ServiceManager;

/**
 * Class Http
 * @package Shelf\Framework\App
 */
class Http implements AppInterface
{
    /**
     * @var array
     */
    private $routeConfig = [];

    /**
     * @var ServiceManager
     */
    private $serviceManager;

    /**
     * @var Router
     */
    private $router;

    /**
     * Http constructor.
     * @param $routeConfig
     * @param ServiceManager $serviceManager
     */
    public function __construct(
        ServiceManager $serviceManager,
        $routeConfig
    ) {
        $this->routeConfig = $routeConfig;
        $this->serviceManager = $serviceManager;

        /** @var ApplicationStrategy $strategy */
        $strategy = (new ApplicationStrategy)->setContainer($serviceManager);
        $this->router = (new Router)->setStrategy($strategy);
    }

    /**
     * Launch application
     * @return void
     */
    public function launch()
    {
        $request = ServerRequestFactory::fromGlobals(
            $_SERVER,
            $_GET,
            $_POST,
            $_COOKIE,
            $_FILES
        );

        // Add Routes Groups
        if (isset($this->routeConfig['groups'])) {
            foreach ($this->routeConfig['groups'] as $key => $routes) {
                $group = $this->router->group($key, function (RouteGroup $routeGroup) use ($routes) {
                    $this->addRoutesFromArray($routes['routes'], $routeGroup);
                });

                if (isset($routes['middlewares'])) {
                    foreach ($routes['middlewares'] as $middleware) {
                        if ($this->serviceManager->has($middleware)) {
                            $middleware = $this->serviceManager->get($middleware);
                        } else {
                            $middleware = new $middleware;
                        }

                        $group->middleware($middleware);
                    }
                }
            }

            unset($this->routeConfig['groups']);
        }

        // Add single routes
        $this->addRoutesFromArray($this->routeConfig);

        $response = $this->router->dispatch($request);

        (new SapiEmitter())->emit($response);
    }

    /**
     * @param array $routesArray
     * @param null $router
     */
    private function addRoutesFromArray(array $routesArray, $router = null) : void
    {
        if (is_null($router)) {
            $router = $this->router;
        }

        foreach ($routesArray as $route) {
            $router->map($route[0], $route[1], $route[2]);
        }
    }
}
