<?php

use Shelf\Framework\View\Api\TemplateRendererInterface;
use Shelf\Framework\View\Template\TwigRenderer;
use Zend\ServiceManager\AbstractFactory\ReflectionBasedAbstractFactory;
use Zend\ServiceManager\ServiceManager;

return [
    'dependencies' => [
        'abstract_factories' => [
            ReflectionBasedAbstractFactory::class
        ],
        'factories' => [
            TwigRenderer::class => function (ServiceManager $sm) {
                $config = $sm->get('config');
                return new TwigRenderer($config['view']);
            }
        ],
        'aliases' => [
            TemplateRendererInterface::class => TwigRenderer::class
        ]
    ]
];
