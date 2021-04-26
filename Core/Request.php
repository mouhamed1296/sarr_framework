<?php

/**
 * User: Mamadou Sarr
 * Date: 25/12/2020
 *Time: 21:36
 */

namespace App\Core;

class Request
{

    /**
     * @return string
     */
    public function method(): string
    {
        return strtolower($_SERVER['REQUEST_METHOD']);
    }

    public function isGet(): bool
    {
        return $this->method() === "get";
    }
    public function isPost(): bool
    {
        return $this->method() === "post";
    }

    /**
     * @return string
     */
    public function getPath(): string
    {
        $path = $_SERVER['REQUEST_URI'] ?? '/';
        $position = strpos($path, '?');
        if ($position === false) {
            return $path;
        }
        return substr($path, 0, $position);
    }

    public function getBody(): array
    {
        $body = [];
        if ($this->isGet()) {
            $keys = array_keys($_GET);
            foreach ($keys as $key) {
                $body[$key] = filter_input(INPUT_GET, $key, FILTER_SANITIZE_SPECIAL_CHARS);
            }
            unset($keys);
        }
        if ($this->isPost()) {
            $keys = array_keys($_POST);
            foreach ($keys as $key) {
                $body[$key] = filter_input(INPUT_POST, $key, FILTER_SANITIZE_SPECIAL_CHARS);
            }
            unset($keys);
        }

        return $body;
    }
}
