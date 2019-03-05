<?php

declare(strict_types=1);

namespace Shelf\Framework\App;

use Shelf\Framework\Api\AppInterface;
use Symfony\Component\Console\Application;
use Zend\ServiceManager\ServiceLocatorInterface;

/**
 * Class Console
 * @package Shelf\Framework\App
 */
class Console implements AppInterface
{

    /**
     * @var ServiceLocatorInterface
     */
    private $serviceManager;

    /**
     * Console constructor.
     * @param ServiceLocatorInterface $serviceManager
     */
    public function __construct(ServiceLocatorInterface $serviceManager)
    {
        $this->serviceManager = $serviceManager;
    }

    /**
     * Launch application
     *
     */
    public function launch()
    {
        $config = $this->serviceManager->get('config');
        $applicationName = 'Shelf';
        $applicationVersion = '1.0.0';

        if (isset($config['console'])) {
            $applicationName = isset($config['console']['application_name']) ?
                $config['console']['application_name'] : $applicationName;
            $applicationVersion = isset($config['console']['application_version']) ?
                $config['console']['application_name'] : $applicationVersion;
        }

        $application = new Application($applicationName, $applicationVersion);

        if (isset($config['console']['commands'])) {
            foreach ($config['console']['commands'] as $command) {
                $commandInstance = $this->serviceManager->has($command) ?
                    $this->serviceManager->get($command) : new $command;

                $application->add($commandInstance);
            }
        }


        return $application->run();
    }
}
