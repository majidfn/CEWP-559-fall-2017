<?php

class UserController
{
    private $model;

    public function __construct($model)
    {
        $this->model = $model;
    }

    public function create($payload)
    {
        if (!array_key_exists('username', $payload)) {
            throw new Exception('`username` should be provided!');
        } elseif (!array_key_exists('password', $payload)) {
            throw new Exception('`password` should be provided!');
        }

       $payload->password = password_hash($payload->password, PASSWORD_BCRYPT);

        return $this->model->create($payload);
    }


    public function login($payload)
    {
        if (!array_key_exists('username', $payload)) {
            throw new Exception('`username` should be provided!');
        } elseif (!array_key_exists('password', $payload)) {
            throw new Exception('`password` should be provided!');
        }

        $user = $this->model->getUserByUsername($payload->username);
        
        if (!password_verify($payload->password, $user->password))
        {
            throw new Exception("Invalid username or password!", 401);
        }

        $token = bin2hex(random_bytes(64));

        $this->model->storeToken($user->id, $token);

        return array('token' => $token, 'isAdmin' => $user->isAdmin);
    }

    public function verify($headers){

        if (!array_key_exists('Authorization', $headers)) {
            throw new Exception('`Authorization` should be provided!');
        }

        // "Bearer 16f684f01e6296da3a8364e597a236726d21a38a953cec28a120816115261c2736a86be219124c29a273f7a11d3069bd6572940c1b1f248434f002c9de7d29f6"

        $token = explode(' ', $headers['Authorization'])[1];

        $isValidToken = $this->model->verifyToken($token);

        if (!$isValidToken) {
            throw new Exception("Invalid / Expired Token", 401);
        }
    }


    public function isAdmin($headers) {
        $this->verify($headers);

        // Authorization: Bearer asdasd83024812083102830llasdas
        $token = explode(' ', $headers['Authorization'])[1];

        $user = $this->model->getUserByToken($token);

        if ($user->isAdmin != "1") {
            throw new Exception("Admin Only!", 403);
        }
    }

    public function getUserByToken($headers) {
        $this->verify($headers);

        $token = explode(' ', $headers['Authorization'])[1];

        return $this->model->getUserByToken($token);
    }
}