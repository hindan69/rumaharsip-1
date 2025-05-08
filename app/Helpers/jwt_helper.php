<?php

use Firebase\JWT\JWT;
use Firebase\JWT\Key;

if (!function_exists('generateJWT')) {
    function generateJWT($userData)
    {
        $key = "sEt!tj3N2025";
        $payload = [
            'iss' => base_url(),
            'iat' => time(),
            'exp' => time() + (60 * 60 * 24 * 90), // 3 bulan
            'data' => $userData
        ];

        return JWT::encode($payload, $key, 'HS256');
    }
}

if (!function_exists('validateJWT')) {
    function validateJWT($token)
    {
        try {
            $key = "sEt!tj3N2025";
            $decoded = JWT::decode($token, new Key($key, 'HS256'));
            return (array) $decoded->data;
        } catch (Exception $e) {
            return null;
        }
    }
}
