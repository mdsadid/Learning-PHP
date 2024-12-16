<?php

namespace Http\Requests;

use Core\Validator;

class NoteRequest extends FormRequest
{
    public function validate(array $data): bool
    {
        $body = $data['body'] ?? null;

        if (Validator::required($body)) {
            $this->errors['body'] = 'Body is required';
        }

        if (Validator::max($body, 1000)) {
            $this->errors['body'] = 'The body cannot be more than 1,000 characters';
        }

        return empty($this->errors);
    }
}
