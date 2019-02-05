<?php

declare(strict_types=1);

namespace MadeiraMadeira\Framework\Api\Http;

interface ResponseInterface
{
    /**
     * @return null|int
     */
    public function getCode() : ?int;

    /**
     * @param null|int $code
     * @return ResponseInterface
     */
    public function setCode($code) : ResponseInterface;

    /**
     * @return mixed
     */
    public function sendResponse() : string;
}
