<?php

namespace Http\Requests;

use Core\Exceptions\ValidationException;
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

    /**
     * @throws ValidationException
     */
    public static function validate(array $data): static
    {
        $instance = new static($data);

        if ($instance->failed()) {
            ValidationException::throw($instance->errors(), $instance->attributes);
        }

        return $instance;
    }
}
