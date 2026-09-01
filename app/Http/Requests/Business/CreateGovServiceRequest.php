<?php

namespace App\Http\Requests\Business;

use Illuminate\Contracts\Validation\ValidationRule;
use Illuminate\Foundation\Http\FormRequest;

class CreateGovServiceRequest extends FormRequest
{
    /**
     * Determine if the user is authorized to make this request.
     */
    public function authorize(): bool
    {
        return true;
    }

    public function rules(): array
    {
        return [
            'entity_id'      => ['required', 'integer'],
            'name_ar'        => ['required', 'string', 'max:200'],
            'name_en'        => ['required', 'string', 'max:200'],
            'icon'           => ['required', 'string', 'max:100'],
            'price'          => ['required', 'numeric', 'min:0'],
            'estimated_days' => ['required', 'integer', 'min:1'],
            'description_ar' => ['nullable', 'string', 'max:1000'],
            'description_en' => ['nullable', 'string', 'max:1000'],
            'sort_order'     => ['nullable', 'integer', 'min:0'],
        ];
    }
}
