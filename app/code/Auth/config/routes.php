<?php

return [
    'routes' => [
        ['GET', '/login', \MadeiraMadeira\Auth\Controllers\Auth\LoginAction::class],
        ['POST', '/loginPost', \MadeiraMadeira\Auth\Controllers\Auth\LoginPostAction::class],
        ['GET', '/logout', \MadeiraMadeira\Auth\Controllers\Auth\LogoutAction::class]
    ]
];
