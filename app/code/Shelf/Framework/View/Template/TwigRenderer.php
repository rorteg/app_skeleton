<?php

declare(strict_types=1);

namespace Shelf\Framework\View\Template;

use Shelf\Framework\View\Api\TemplateRendererInterface;
use Twig\Environment;
use Twig\Loader\FilesystemLoader;
use Twig\TwigFunction;

class TwigRenderer implements TemplateRendererInterface
{
    /**
     * @var string
     */
    private $suffix;

    /**
     * @var FilesystemLoader
     */
    protected $twigLoader;

    /**
     * @var Environment
     */
    protected $template;

    /**
     * @var array
     */
    protected $viewConfig;

    /**
     * TwigRenderer constructor.
     * @param array $viewConfig
     * @throws \Twig_Error_Loader
     */
    public function __construct($viewConfig)
    {
        $this->suffix = 'html';
        $this->viewConfig = $viewConfig;
        $this->template = $this->createTemplate($this->getDefaultLoader());
        $this->twigLoader = $this->template->getLoader();
        $this->addTwigExtensions();
        $this->addTwigFunctions();
        $this->addConfigPaths();
    }

    /**
     * Twig Extensions by config
     */
    private function addTwigExtensions() : void
    {
        $config = $this->viewConfig;

        if (isset($config['twig_extensions'])) {
            foreach ($config['twig_extensions'] as $extension => $options) {
                $this->template->addExtension(new $extension($this->template, $options));
            }
        }
    }

    /**
     * Twig Functions by config
     */
    private function addTwigFunctions() : void
    {
        $config = $this->viewConfig;

        if (isset($config['twig_functions'])) {
            foreach ($config['twig_functions'] as $name => $function) {
                if (is_callable($function)) {
                    $fn = new TwigFunction($name, $function);
                    $this->template->addFunction($fn);
                }
            }
        }
    }

    /**
     * @param FilesystemLoader $loader
     * @return Environment
     */
    private function createTemplate(FilesystemLoader $loader) : Environment
    {
        if (! isset($this->viewConfig['suffix'])) {
            $this->viewConfig['suffix'] = $this->suffix;
        }

        return new Environment($loader, $this->viewConfig);
    }

    /**
     * Get the default loader for template
     */
    private function getDefaultLoader() : FilesystemLoader
    {
        return new FilesystemLoader();
    }

    /**
     * Render a template, optionally with parameters.
     *
     * @param string $name
     * @param array|object $params
     * @return string
     * @throws \Twig_Error_Loader
     * @throws \Twig_Error_Runtime
     * @throws \Twig_Error_Syntax
     */
    public function render(string $name, $params = []): ?string
    {
        return $this->template->render($name, $params);
    }

    /**
     * Add a template path to the engine.
     *
     * Adds a template path, with optional namespace the templates in that path
     * provide.
     * @param string $path
     * @param string|null $namespace
     * @throws \Twig_Error_Loader
     */
    public function addPath(string $path, string $namespace = null): void
    {
        $namespace = $namespace ?: FilesystemLoader::MAIN_NAMESPACE;
        $this->twigLoader->addPath($path, $namespace);
    }

    /**
     * Retrieve configured paths from the engine.
     *
     * @return array
     */
    public function getPaths(): array
    {
        $paths = [];
        foreach ($this->twigLoader->getNamespaces() as $namespace) {
            $name = ($namespace !== FilesystemLoader::MAIN_NAMESPACE) ? $namespace : null;
            foreach ($this->twigLoader->getPaths($namespace) as $path) {
                $paths[] = new TemplatePath($path, $name);
            }
        }
        return $paths;
    }

    /**
     * @throws \Twig_Error_Loader
     */
    private function addConfigPaths(): void
    {
        $allPaths = isset($this->viewConfig['paths']) && is_array($this->viewConfig['paths'])
            ? $this->viewConfig['paths'] : [];

        foreach ($allPaths as $namespace => $paths) {
            $namespace = is_numeric($namespace) ? null : $namespace;
            $namespace = $namespace ?: FilesystemLoader::MAIN_NAMESPACE;
            foreach ((array)$paths as $path) {
                $this->twigLoader->addPath($path, $namespace);
            }
        }
    }
}
