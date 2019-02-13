<?php

declare(strict_types=1);

namespace Shelf\Framework\Controller\Api;

use Shelf\Framework\Api\Http\ResponseInterface;

/**
 * Interface ActionInterface
 * @package Shelf\Framework\Api\Http
 */
interface ActionInterface
{
    /**
     * @return ResponseInterface
     */
    public function __invoke() : ResponseInterface;
}
