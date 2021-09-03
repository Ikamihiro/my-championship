<?php

namespace Lib\Auth;

use App\Models\User;
use Firebase\JWT\JWT;

class Auth
{
    protected string $key;
    protected string $algoritm;
    private static ?Auth $instance = null;

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

    public static function authenticate(string $email, string $password)
    {
        $instance = self::getInstance();

        $passwordHash = password_hash($password, PASSWORD_BCRYPT);

        $user = User::where([
            'email' => $email,
            'password' => $passwordHash,
        ])->firstOrFail();

        $payload = [
            'user' => $user,
        ];

        return JWTToken::encode($payload, $instance->getKey());
    }

    public static function validate(string $jwtToken)
    {
        $instance = self::getInstance();

        return JWTToken::decode($jwtToken, $instance->getKey(), $instance->getAlgorithm());
    }
}
