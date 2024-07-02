<?php

namespace App\Custom;

use App\Models\Role;
use App\Models\User;
use Firebase\JWT\JWT as JWTFirebase;
use Firebase\JWT\Key;

class Jwt
{
    public static function create(User $user)
    {
        $key = (string) env('KEY_JWT');

        $payload = [
            'iat' => time(),
            'exp' => time() + 3600,
            'data' => ['name' => $user->name, 'email' => $user->email]
        ];

        $token = JWTFirebase::encode($payload, $key, 'HS256');

        return $token;
    }

    public static function validate()
    {
        try {
            $authorization = $_SERVER['HTTP_AUTHORIZATION'];

            $key = (string) env('KEY_JWT');

            $token = str_replace('Bearer ', '', $authorization);

            JWTFirebase::decode($token, new Key($key, 'HS256'));

            return true;
        } catch (\Throwable $th) {
            return false;
        }
    }

    public static function decode()
    {
        try {
            $authorization = $_SERVER['HTTP_AUTHORIZATION'];

            $key = (string) env('KEY_JWT');

            $token = str_replace('Bearer ', '', $authorization);

            return JWTFirebase::decode($token, new Key($key, 'HS256'));
        } catch (\Throwable $th) {
            return $th;
        }
    }
}
