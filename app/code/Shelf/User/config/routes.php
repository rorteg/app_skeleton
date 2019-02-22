<?php

return [
    'routes' => [
        /* ['POST', '/v1/user/register', \Shelf\User\Controllers\User\RegisterAction::class],
        ['PUT', '/v1/user/update/[i:id]', \Shelf\User\Controllers\User\UpdateAction::class], */
        'groups' => [
            'admin' => [
                'routes' => [
                    ['GET', '/user', \Shelf\User\Controllers\Admin\UserListAction::class],
                    ['GET', '/user/delete/{id}', \Shelf\User\Controllers\Admin\UserDeleteAction::class],
                    ['GET', '/user/new', \Shelf\User\Controllers\Admin\UserNewOrUpdateAction::class],
                    ['POST', '/user/new', \Shelf\User\Controllers\Admin\UserNewOrUpdateAction::class],
                    ['GET', '/user/edit/{id}', \Shelf\User\Controllers\Admin\UserNewOrUpdateAction::class],
                    ['POST', '/user/edit/{id}', \Shelf\User\Controllers\Admin\UserNewOrUpdateAction::class],
                ]
            ]
        ]

    ]
];
