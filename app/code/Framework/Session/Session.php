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
     * @codeCoverageIgnore
     */
    public static function sessionStart() : void
    {
        if (! self::checkStatus()) {
            session_start();
        }
    }

    /**
     * @codeCoverageIgnore
     * @return bool
     */
    public static function checkStatus()
    {
        if (!isset($_SESSION['CREATED'])) {
            $_SESSION['CREATED'] = time();
        } elseif (time() - $_SESSION['CREATED'] > 1800) {
            // session started more than 30 minutes ago
            session_unset();
            session_destroy();
            session_regenerate_id(true);    // change session ID for the current session and invalidate old session ID
            $_SESSION['CREATED'] = time();  // update creation time
        }

        return (session_status() !== PHP_SESSION_NONE);
    }
}
