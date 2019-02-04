<?php

declare(strict_types=1);

namespace MadeiraMadeira\Framework\App\Http;

/**
 * Class JsonResponse
 * @package MadeiraMadeira\Framework\App\Htt
 */
class JsonResponse
{
    /**
     * @var string
     */
    private $code;

    /**
     * @var array
     */
    private $data;

    /**
     * JsonResponse constructor.
     * @param array $data
     * @param int $code
     */
    public function __construct($data = [], $code = 200)
    {
        $this->data = $data;
        $this->setCode($code);
    }

    /**
     * @param string $code
     */
    public function setCode($code)
    {
        $this->code = $code;
    }

    /**
     * @return string
     */
    public function getCode()
    {
        return $this->code;
    }

    /**
     * @return string
     */
    public function sendResponse()
    {
        // clear the old headers
        header_remove();
        // set the actual code
        http_response_code($this->getCode());
        // set the header to make sure cache is forced
        header("Cache-Control: no-transform,public,max-age=300,s-maxage=900");
        // treat this as json
        header('Content-Type: application/json');
        $status = array(
            200 => '200 OK',
            201 => 'Created',
            400 => '400 Bad Request',
            422 => 'Unprocessable Entity',
            500 => '500 Internal Server Error'
        );
        // ok, validation error, or failure
        header('Status: '.$status[$this->getCode()]);
        // return the encoded json
        return json_encode(array(
            'status' => $this->getCode() < 300, // success or not?
            'data' => $this->data
        ));
    }
}