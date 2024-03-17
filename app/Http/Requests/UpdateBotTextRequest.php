<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class UpdateBotTextRequest extends FormRequest
{
    const TEXT = 'text';

    public function authorize(): bool
    {
        return true;
    }

    public function rules(): array
    {
        return [
            self::TEXT => [
                'required',
            ],
        ];
    }

    public function getText()
    {
        return $this->get(self::TEXT);
    }
}
