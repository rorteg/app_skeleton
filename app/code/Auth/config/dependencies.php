<?php

use MadeiraMadeira\Auth\Api\AuthenticateInterface;
use MadeiraMadeira\Auth\Model\Authenticate;
use MadeiraMadeira\Auth\Model\AuthenticateFactory;

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
