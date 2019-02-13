<?php

declare(strict_types=1);

namespace Shelf\Framework\App;

use Shelf\Framework\Api\AppInterface;
use Shelf\Framework\Controller\Api\ActionInterface;
use Shelf\Framework\Api\Http\ResponseInterface;
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
     * Http constructor.
     * @param $routeConfig
     * @param ServiceManager $serviceManager
     */
    public function __construct($routeConfig, ServiceManager $serviceManager)
    {
        $this->routeConfig = $routeConfig;
        $this->serviceManager = $serviceManager;
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

        if ($this->serviceManager->has($match['target'])) {
            $match['target'] = $this->serviceManager->get($match['target']);
        }

        // call closure or throw 404 status
        if ($match && is_callable($match['target'])) {
            if (! ($match['target'] instanceof ActionInterface)) {
                throw new \Exception(
                    'The HTTP app expects Actions to implement ActionInterface.'
                );
            }

            $response = call_user_func_array($match['target'], $match['params']);

            if (! ($response instanceof ResponseInterface)) {
                throw new \Exception(
                    'The HTTP app expects the controllers to return an instance that implements the interface: 
                    ResponseInterface'
                );
            }

            echo $response->sendResponse();
            exit(1);
        } else {
            // no route was matched
            header($_SERVER["SERVER_PROTOCOL"] . ' 404 Not Found');
        }
    }
}
