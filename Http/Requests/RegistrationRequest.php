<?php

namespace Http\Requests;

use Core\Validator;

class RegistrationRequest extends FormRequest
{
    public function __construct(public array $attributes)
    {
        $email           = $attributes['email'] ?? null;
        $password        = $attributes['password'] ?? null;
        $confirmPassword = $attributes['confirmPassword'] ?? null;

        if (Validator::required($email)) {
            $this->errors['email'] = 'The email field is required';
        } elseif (!Validator::email($email)) {
            $this->errors['email'] = 'The email must be a valid email address';
        } elseif (!Validator::unique('users', 'email', $email)) {
            $this->errors['email'] = 'The email has already been taken';
        }

        if (Validator::required($password)) {
            $this->errors['password'] = 'The password field is required';
        } elseif (Validator::min($password, 5)) {
            $this->errors['password'] = 'The password must be at least 5 characters';
        } elseif (Validator::max($password, 10)) {
            $this->errors['password'] = 'The password must be at most 10 characters';
        } elseif (!Validator::confirmed($password, $confirmPassword)) {
            $this->errors['password'] = 'The password confirmation does not match';
        }

        if (Validator::required($confirmPassword)) {
            $this->errors['confirm_password'] = 'The confirm password field is required';
        }
    }
}
