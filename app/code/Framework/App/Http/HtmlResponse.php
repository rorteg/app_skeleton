<?php

declare(strict_types=1);

namespace MadeiraMadeira\Framework\App\Http;

use MadeiraMadeira\Framework\Api\Http\ResponseInterface;

/**
 * Class HtmlResponse
 * @package MadeiraMadeira\Framework\App\Http
 */
class HtmlResponse extends ResponseAbstract implements ResponseInterface
{
    /**
     * @var string
     */
    protected $data;

    /**
     * HtmlResponse constructor.
     * @param string $data
     */
    public function __construct($data)
    {
        $this->data = $data;
    }

    /**
     * @return mixed
     */
    public function sendResponse() : string
    {
        return $this->data;
    }
}
