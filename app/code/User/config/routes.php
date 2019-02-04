<?php

return [
    'routes' => [
        ['GET', '/', function () {echo 'Welcome!';}],
        ['POST', '/v1/user/register', \MadeiraMadeira\User\Controllers\User\RegisterAction::class],
        ['PUT', '/v1/user/update/[i:id]', \MadeiraMadeira\User\Controllers\User\UpdateAction::class]
    ]
];