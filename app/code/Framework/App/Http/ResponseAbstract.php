<?php

declare(strict_types=1);

namespace MadeiraMadeira\Framework\App\Http;

use MadeiraMadeira\Framework\Api\Http\ResponseInterface;

abstract class ResponseAbstract implements ResponseInterface
{
    /**
     * @var null|int
     */
    protected $code;

    /**
     * @param null|int $code
     * @return ResponseInterface
     */
    public function setCode($code): ResponseInterface
    {
        $this->code = $code;
        return $this;
    }

    /**
     * @return null|int
     */
    public function getCode(): ?int
    {
        return $this->code;
    }
}
