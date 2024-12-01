<?php

namespace Http\Requests;

use Core\Validator;

class LoginRequest
{
    protected array $errors = [];

    public function validate($email, $password): bool
    {
        if (Validator::required($email)) {
            $this->errors['email'] = 'The email field is required';
        }

        if (Validator::required($password)) {
            $this->errors['password'] = 'The password field is required';
        }

        return empty($this->errors);
    }

    public function errors(): array
    {
        return $this->errors;
    }
}
