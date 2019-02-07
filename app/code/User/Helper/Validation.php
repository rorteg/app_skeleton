<?php

declare(strict_types=1);

namespace MadeiraMadeira\User\Helper;

/**
 * Class Validation
 * @package MadeiraMadeira\User\Helper
 */
class Validation
{
    /**
     * @var array
     */
    protected $messages = [];

    /**
     * @return array
     */
    public function getMessages() : array
    {
        return $this->messages;
    }

    /**
     * @param string $message
     */
    private function addMessage($message)
    {
        $this->messages[] = $message;
    }

    /**
     * @param array $postParams
     * @return bool
     */
    public function validate($postParams) : bool
    {
        $return = true;

        if (! isset($postParams['first_name'])
            || $postParams['first_name'] == ''
            || ! isset($postParams['last_name'])
            || $postParams['last_name'] == ''
            || ! isset($postParams['username'])
            || $postParams['username'] == ''
            || ! isset($postParams['email'])
            || $postParams['email'] == ''
            || ! isset($postParams['password'])
            || $postParams['password'] == ''
        ) {
            $return = false;
            $this->addMessage('Some required fields are empty.');
        }

        if (! filter_var($postParams['email'], FILTER_VALIDATE_EMAIL)) {
            $return = false;
            $this->addMessage('Not a valid email.');
        }

        return $return;
    }
}
