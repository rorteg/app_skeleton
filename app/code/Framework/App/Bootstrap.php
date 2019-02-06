<?php

declare(strict_types=1);

namespace MadeiraMadeira\Framework\App;

use MadeiraMadeira\Framework\Api\AppInterface;
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
            $application = new $type($arguments, $this->serviceManager);
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

        return $routes;
    }

    /**
     * @param \Exception $e
     */
    protected function terminate(\Exception $e)
    {
        echo $e;
    }
}
