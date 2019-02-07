<?php

return [
    'routes' => [
        /* ['POST', '/v1/user/register', \MadeiraMadeira\User\Controllers\User\RegisterAction::class],
        ['PUT', '/v1/user/update/[i:id]', \MadeiraMadeira\User\Controllers\User\UpdateAction::class], */
        ['GET', '/admin/user', \MadeiraMadeira\User\Controllers\Admin\UserListAction::class],
        ['GET', '/admin/user/delete/[i:id]', \MadeiraMadeira\User\Controllers\Admin\UserDeleteAction::class],
        ['GET', '/admin/user/new', \MadeiraMadeira\User\Controllers\Admin\UserNewOrUpdateAction::class],
        ['POST', '/admin/user/new', \MadeiraMadeira\User\Controllers\Admin\UserNewOrUpdateAction::class],
        ['GET', '/admin/user/edit/[i:id]', \MadeiraMadeira\User\Controllers\Admin\UserNewOrUpdateAction::class],
        ['POST', '/admin/user/edit/[i:id]', \MadeiraMadeira\User\Controllers\Admin\UserNewOrUpdateAction::class]
    ]
];
