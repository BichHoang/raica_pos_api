<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;
use App\Utils\ConstDefinition;

class BaseFormRequest extends FormRequest
{
    /**
     * Modify the input values
     *
     * @return void
     */
    protected function prepareForValidation()
    {
        $input = array_map('htmlspecialchars', $this->except([
            'password',
            'password_confirmation',
            'token',
        ]));
        $input = array_merge($input, $this->only([
            'password',
            'password_confirmation',
            'token',
        ]));

        $this->replace($input);
        $this->merge([
            'limit' => (!empty($this->limit) && $this->limit !== "0") ? $this->limit : ConstDefinition::PAGE_LIMIT,
        ]);
    }
}
