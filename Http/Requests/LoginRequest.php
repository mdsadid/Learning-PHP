<?php

namespace Http\Requests;

use Core\Validator;

class LoginRequest extends FormRequest
{
    public function validate(array $data): bool
    {
        $email    = $data['email'] ?? null;
        $password = $data['password'] ?? null;

        if (Validator::required($email)) {
            $this->errors['email'] = 'The email field is required';
        }

        if (Validator::required($password)) {
            $this->errors['password'] = 'The password field is required';
        }

        return empty($this->errors);
    }
}
