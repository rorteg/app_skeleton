<?php

return [
    'view' => [
        // Twig Cache
        //'cache' => false,
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
