<?php

declare(strict_types=1);

namespace MadeiraMadeira\Framework\Session;

/**
 * Class Session
 * @package MadeiraMadeira\Framework\Session
 */
class Session
{
    /**
     * Session Start
     */
    public static function sessionStart() : void
    {
        if (! self::checkStatus()) {
            session_start();
        }
    }

    public static function checkStatus()
    {
        return (session_status() !== PHP_SESSION_NONE);
    }
}
