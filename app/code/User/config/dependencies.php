<?php

use Zend\ServiceManager\AbstractFactory\ReflectionBasedAbstractFactory;

return [
    'dependencies' => [
        'factories' => [
            \MadeiraMadeira\User\Model\User::class => ReflectionBasedAbstractFactory::class
        ],
        'aliases' => [
            \MadeiraMadeira\User\Api\Data\UserInterface::class => \MadeiraMadeira\User\Model\User::class
        ]
    ]
];