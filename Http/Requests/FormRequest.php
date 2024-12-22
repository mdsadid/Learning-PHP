<?php

namespace Http\Requests;

abstract class FormRequest
{
    protected array $errors = [];

    abstract public static function validate(array $data);

    public function errors(): array
    {
        return $this->errors;
    }

    public function failed(): int
    {
        return count($this->errors);
    }
}
