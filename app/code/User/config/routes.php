<?php

return [
    'routes' => [
        ['POST', '/v1/user/register', \MadeiraMadeira\User\Controllers\User\RegisterAction::class],
        ['PUT', '/v1/user/update/[i:id]', \MadeiraMadeira\User\Controllers\User\UpdateAction::class],
        ['GET', '/admin/user', ]
    ]
];
