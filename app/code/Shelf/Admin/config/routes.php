<?php

return [
    'routes' => [
        'groups' => [
            'admin' => [
                'routes' => [
                    ['GET', '/', \Shelf\Admin\Controllers\Admin\IndexAction::class]
                ]
            ]
        ]
    ]
];
