<?php

return [
    'view' => [
        'paths' => [
            'shelf_admin' => [
                BP . '/app/code/Shelf/Admin/view/templates'
            ]
        ],
        'twig_functions' => [
            'flash_message_notification' => function () {
                return \Shelf\Framework\Session\FlashMessage::flashNotification();
            }
        ]
    ]
];
