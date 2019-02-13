<?php

declare(strict_types=1);

namespace Shelf\Framework\App\Http;

use Shelf\Framework\Api\Http\ResponseInterface;

/**
 * Class HtmlResponse
 * @package Shelf\Framework\App\Http
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
