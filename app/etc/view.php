<?php

return [
    'view' => [
        // Twig Cache
        //'cache' => BP . '/var/cache',
        // Twig Debug
        'debug' => false,
        'twig_extensions' => [
            // Twig Assets
            \Odan\Twig\TwigAssetsExtension::class => [
                'cache_lifetime' => 3000,
                'minify' => 1
            ]
        ]
    ]
];
