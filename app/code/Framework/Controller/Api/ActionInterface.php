<?php

declare(strict_types=1);

namespace MadeiraMadeira\Framework\Controller\Api;

use MadeiraMadeira\Framework\Api\Http\ResponseInterface;

/**
 * Interface ActionInterface
 * @package MadeiraMadeira\Framework\Api\Http
 */
interface ActionInterface
{
    /**
     * @return ResponseInterface
     */
    public function __invoke() : ResponseInterface;
}
