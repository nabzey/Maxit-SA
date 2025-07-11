<?php
namespace App\Core;

class Session
{
    public function __construct()
    {
        if (session_status() === PHP_SESSION_NONE) {
            session_start();
        }
    }

    public function has(string $key): bool
    {
        return isset($_SESSION[$key]);
    }

    public function get(string $key, $default = null)
    {
        return $this->has($key) ? $_SESSION[$key] : $default;
    }

    public function set(string $key, $value): void
    {
        $_SESSION[$key] = $value;
    }

    public function destroy(): void
    {
        session_destroy();
    }
}
