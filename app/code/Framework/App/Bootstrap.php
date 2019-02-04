<?php

declare(strict_types=1);

namespace MadeiraMadeira\Framework\App;

use MadeiraMadeira\Framework\Api\AppInterface;
use Psr\Http\Message\ResponseInterface;
use Zend\ServiceManager\ServiceManager;

/**
 * Class Bootstrap
 * @package MadeiraMadeira\Framework\App
 */
class Bootstrap
{
    /**
     * @var ServiceManager
     */
    private $serviceManager;
    private $rootDir;
    private $initParams;

    /**
     * Bootstrap constructor.
     * @param ServiceManager $serviceManager
     * @param string $rootDir
     * @param array $initParams
     */
    public function __construct(ServiceManager $serviceManager, $rootDir, array $initParams = [])
    {
        $this->serviceManager = $serviceManager;
        $this->rootDir = $rootDir;
        $this->initParams = $initParams;
    }

    /**
     * @param ServiceManager $serviceManager
     * @param string $rootDir
     * @param array $initParams
     * @return Bootstrap
     */
    public static function create(ServiceManager $serviceManager, $rootDir, array $initParams = [])
    {
        return new self($serviceManager, $rootDir, $initParams);
    }

    /**
     * @param string $type
     * @param array $arguments
     * @return AppInterface
     * @throws \InvalidArgumentException
     */
    public function createApplication($type, $arguments = [])
    {
        try {
            $application = new $type($arguments);
            if (!($application instanceof AppInterface)) {
                throw new \InvalidArgumentException("The provided class doesn't implement AppInterface: {$type}");
            }

            return $application;
        } catch (\Exception $e) {
            $this->terminate($e);
        }
    }

    /**
     * @param AppInterface $application
     */
    public function run(AppInterface $application)
    {
        try {
            return $application->launch();
        } catch (\Exception $e) {
            $this->terminate($e);
        }
    }

    /**
     * @return array
     */
    public function getRoutes()
    {
        $routes = $this->serviceManager->get('config')['routes'];

        $routesUpdated = array_map(function ($route) {
            if (is_string($route[2])) {
                if ($this->serviceManager->has($route[2])) {
                    $route[2] = $this->serviceManager->get($route[2]);
                } else {
                    $route[2] = new $route[2];
                }
            }

            return $route;
        }, $routes);

        return $routesUpdated;
    }

    /**
     * @param \Exception $e
     */
    protected function terminate(\Exception $e)
    {
        echo $e;
    }
}