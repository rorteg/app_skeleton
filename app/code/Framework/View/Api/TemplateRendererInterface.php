<?php

declare(strict_types=1);

namespace MadeiraMadeira\Framework\View\Api;

interface TemplateRendererInterface
{
    /**
     * Render a template, optionally with parameters.
     *
     * @param string $name
     * @param array|object $params
     * @return null|string
     */
    public function render(string $name, $params = []) : ?string;

    /**
     * Add a template path to the engine.
     *
     * Adds a template path, with optional namespace the templates in that path
     * provide.
     * @param string $path
     * @param string|null $namespace
     */
    public function addPath(string $path, string $namespace = null) : void;

    /**
     * Retrieve configured paths from the engine.
     *
     * @return array
     */
    public function getPaths() : array;
}
