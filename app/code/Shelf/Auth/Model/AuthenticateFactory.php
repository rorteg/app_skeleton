<?php

declare(strict_types=1);

namespace Shelf\Auth\Model;

use Interop\Container\ContainerInterface;
use Shelf\Auth\Api\AuthenticateInterface;
use Shelf\User\Api\Data\UserInterface;
use Zend\ServiceManager\Exception\ServiceNotCreatedException;
use Zend\ServiceManager\Exception\ServiceNotFoundException;
use Zend\ServiceManager\Factory\FactoryInterface;

class AuthenticateFactory implements FactoryInterface
{
    /**
     * Create an object
     *
     * @param  ContainerInterface $container
     * @param  string $requestedName
     * @param  null|array $options
     * @return AuthenticateInterface
     * @throws ServiceNotFoundException if unable to resolve the service.
     * @throws ServiceNotCreatedException if an exception is raised when
     *     creating a service.
     */
    public function __invoke(
        ContainerInterface $container,
        $requestedName,
        array $options = null
    ) : AuthenticateInterface {
        $user = $container->get(UserInterface::class);
        return new Authenticate($user);
    }
}
