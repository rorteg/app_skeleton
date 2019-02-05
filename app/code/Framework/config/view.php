<?php

return [
    'view' => [
        'cache' => BP . '/var/cache',
        'debug' => false,
        'twig_extensions' => [
            \Odan\Twig\TwigAssetsExtension::class => [
                'path' => BP . '/pub/assets/cache',
                'path_chmod' => 0750,
                'url_base_path' => 'assets/cache/',
                'cache_path' => BP . '/pub/assets/temp',
                'cache_name' => 'assets-cache',
                'cache_lifetime' => 0,
                'minify' => 1
            ]
        ]
    ]
];
