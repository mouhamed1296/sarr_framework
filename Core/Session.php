<?php


namespace App\Core;


class Session
{
    protected const FLASH_KEY = 'flash_messages';

    public function __construct()
    {
        //$this->sessionStart();
        session_start();
        $flashMessages = $_SESSION[self::FLASH_KEY] ?? [];
        foreach ($flashMessages as $key => &$flashMessage) {
            $flashMessage['remove'] = true;
        }
        unset($flashMessage);
        $_SESSION[self::FLASH_KEY] = $flashMessages;
        //Debug::varDump(false, $_SESSION[self::FLASH_KEY]);
    }

    public function setFlash($key, $message): void
    {
        $_SESSION[self::FLASH_KEY][$key] = [
            'remove' => false,
            'value' => $message
        ];
    }

    public function getFlash($key)
    {
        return $_SESSION[self::FLASH_KEY][$key]['value'] ?? false;
    }

    public function get(string $key)
    {
        return $_SESSION[$key] ?? false;
    }

    public function set(string $key, $value): void
    {
        $_SESSION[$key] = $value;
    }

    public function remove($key): void
    {
        unset($_SESSION[$key]);
    }

    protected function sessionStart(): void
    {
        if (version_compare(PHP_VERSION, '7.0.0') >= 0) {
            if (session_status() === PHP_SESSION_NONE) {
                session_start(array(
                    'cache_limiter' => 'private',
                    'read_and_close' => true,
                ));
            }
        } elseif (version_compare(PHP_VERSION, '5.4.0') >= 0) {
            if (session_status() === PHP_SESSION_NONE) {
                session_start();
            }
        } elseif (session_id() === '') {
            session_start();
        }
    }

    public function __destruct()
    {
        $flashMessages = $_SESSION[self::FLASH_KEY] ?? [];
        foreach ($flashMessages as $key => &$flashMessage) {
           if ($flashMessage['remove']) {
               unset($flashMessages[$key]);
           }
        }
        unset($flashMessage);
        $_SESSION[self::FLASH_KEY] = $flashMessages;
    }
}