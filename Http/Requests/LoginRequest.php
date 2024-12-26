<?php

namespace Http\Requests;

use Core\Validator;

class LoginRequest extends FormRequest
{
    public function __construct(public array $attributes)
    {
        $email    = $attributes['email'] ?? null;
        $password = $attributes['password'] ?? null;

        if (Validator::required($email)) {
            $this->errors['email'] = 'The email field is required';
        }

        if (Validator::required($password)) {
            $this->errors['password'] = 'The password field is required';
        }
    }
}
