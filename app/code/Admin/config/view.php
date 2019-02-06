<?php

return [
    'view' => [
        'paths' => [
            'admin' => [
                BP . '/app/code/Admin/view/templates'
            ]
        ],
        'twig_functions' => [
            'flash_message_notification' => function () {
                return \MadeiraMadeira\Framework\Session\FlashMessage::flashNotification();
            }
        ]
    ]
];
