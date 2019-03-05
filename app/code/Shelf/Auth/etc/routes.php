<?php

return [
    'routes' => [
        ['GET', '/login', \Shelf\Auth\Controllers\Auth\LoginAction::class],
        ['POST', '/loginPost', \Shelf\Auth\Controllers\Auth\LoginPostAction::class],
        ['GET', '/logout', \Shelf\Auth\Controllers\Auth\LogoutAction::class],
        'groups' => [
            'admin' => [
                'middlewares' => [
                    \Shelf\Auth\Middleware\AuthMiddleware::class
                ]
            ]
        ]
    ]
];
