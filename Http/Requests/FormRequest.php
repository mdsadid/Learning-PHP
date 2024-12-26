<?php

namespace Http\Requests;

use Core\Exceptions\ValidationException;

class FormRequest
{
    protected array $errors = [];

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

    public function failed(): int
    {
        return count($this->errors);
    }

    public function errors(): array
    {
        return $this->errors;
    }
}
