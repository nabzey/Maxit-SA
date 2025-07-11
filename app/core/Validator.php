<?php

namespace App\Core;

class Validator
{
    public static function isEmail($key, $value, $message)
    {
        if (!filter_var($value, FILTER_VALIDATE_EMAIL)) {
            self::addError($key, $message);
            return false;
        }
        return true;
    }

    public static function isEmpty($key, $value, $message)
    {
        if (empty($value)) {
            self::addError($key, $message);
            return false;
        }
        return true;
    }

    function getErrors(): array
    {
        return $_SESSION['errors'] ?? [];
    }

    public static function addError($key, $message)
    {
        $_SESSION['errors'][$key] = $message;
    }

    function isValid(): bool
    {
        return empty($this->getErrors());
    }
}
    