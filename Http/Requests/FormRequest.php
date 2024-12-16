<?php

namespace Http\Requests;

abstract class FormRequest
{
    protected array $errors = [];

    abstract public function validate(array $data): bool;

    public function errors(): array
    {
        return $this->errors;
    }
}
