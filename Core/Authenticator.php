<?php

namespace Core;

class Authenticator
{
    public function attempt($email, $password): bool
    {
        $db   = App::retrieve(Database::class);
        $user = $db->query('SELECT * FROM users WHERE email = :email', [
            'email' => $email
        ])->first();

        if ($user && password_verify($password, $user['password'])) {
            $this->login($email);

            return true;
        }

        return false;
    }

    public function login($email): void
    {
        $_SESSION['user'] = [
            'email' => $email,
        ];

        session_regenerate_id(true);
    }

    public function logout(): void
    {
        Session::destroy();
    }
}
