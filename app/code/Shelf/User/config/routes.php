<?php

return [
    'routes' => [
        /* ['POST', '/v1/user/register', \Shelf\User\Controllers\User\RegisterAction::class],
        ['PUT', '/v1/user/update/[i:id]', \Shelf\User\Controllers\User\UpdateAction::class], */
        ['GET', '/admin/user', \Shelf\User\Controllers\Admin\UserListAction::class],
        ['GET', '/admin/user/delete/[i:id]', \Shelf\User\Controllers\Admin\UserDeleteAction::class],
        ['GET', '/admin/user/new', \Shelf\User\Controllers\Admin\UserNewOrUpdateAction::class],
        ['POST', '/admin/user/new', \Shelf\User\Controllers\Admin\UserNewOrUpdateAction::class],
        ['GET', '/admin/user/edit/[i:id]', \Shelf\User\Controllers\Admin\UserNewOrUpdateAction::class],
        ['POST', '/admin/user/edit/[i:id]', \Shelf\User\Controllers\Admin\UserNewOrUpdateAction::class]
    ]
];
