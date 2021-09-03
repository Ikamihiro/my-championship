<?php

namespace Lib\Auth;

use Firebase\JWT\JWT;

class JWTToken
{
    public static function encode(array $payload, string $key, string $algorithm)
    {
        return JWT::encode($payload, $key, $algorithm);
    }

    public static function decode(string $token, string $key, string $algorithm)
    {
        return JWT::decode($token, $key, [$algorithm]);
    }
}
