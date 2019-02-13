<?php

use Zend\ServiceManager\AbstractFactory\ReflectionBasedAbstractFactory;

return [
    'dependencies' => [
        'factories' => [
            \Shelf\User\Model\User::class => ReflectionBasedAbstractFactory::class
        ],
        'aliases' => [
            \Shelf\User\Api\Data\UserInterface::class => \Shelf\User\Model\User::class
        ]
    ]
];
