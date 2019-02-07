<?php

return [
    'view' => [
        // Twig Cache
        'cache' => false,
        // Twig Debug
        'debug' => true,
        'twig_extensions' => [
            // Twig Assets
            \Odan\Twig\TwigAssetsExtension::class => [
                'cache_lifetime' => 0,
                'minify' => 1
            ]
        ]
    ]
];
