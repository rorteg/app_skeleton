<?php

use Shelf\Auth\Api\AuthenticateInterface;
use Shelf\Auth\Model\Authenticate;
use Shelf\Auth\Model\AuthenticateFactory;

return [
    'dependencies' => [
        'factories' => [
            Authenticate::class => AuthenticateFactory::class
        ],
        'aliases' => [
            AuthenticateInterface::class => Authenticate::class
        ]
    ]
];
