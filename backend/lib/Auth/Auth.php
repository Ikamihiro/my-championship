<?php

namespace Lib\Auth;

use Firebase\JWT\JWT;

class Auth
{
    protected string $key;
    protected string $algoritm;
    protected static Auth $instance;

    public function __construct(string $key)
    {
        $this->key = $key;
        $this->algoritm = 'sha256';
    }

    public static function getInstance()
    {
        if (is_null(self::$instance)) {
            self::$instance = new Auth($_ENV['JWT_KEY']);
        }

        return self::$instance;
    }

    public function getKey()
    {
        return $this->key;
    }

    public function getAlgorithm()
    {
        return $this->algoritm;
    }

    public function encode(array $payload)
    {
        return JWT::encode($payload, $this->getKey());
    }

    public function decode(string $token)
    {
        return JWT::decode($token, $this->getKey(), [$this->getAlgorithm()]);
    }
}
