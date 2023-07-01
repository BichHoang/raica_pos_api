<?php

namespace App\Http\Requests\Store;

use Illuminate\Foundation\Http\FormRequest;

class UpdateStoreRequest extends FormRequest
{
    /**
     * Determine if the user is authorized to make this request.
     *
     * @return bool
     */
    public function authorize()
    {
        return true;
    }

    /**
     * Get the validation rules that apply to the request.
     *
     * @return array
     */
    public function rules()
    {
        return [
            'name' => 'required|string',
            'address' => 'required|string',
            'phone' => 'required|string',
            'province_id' => 'nullable|int|exists:provinces,id',
            'city_id' => 'nullable|int|exists:cities,id',
            'district_id' => 'nullable|int|exists:districts,id',
            'ward_id' => 'nullable|int|exists:wards,id',
        ];
    }
}
