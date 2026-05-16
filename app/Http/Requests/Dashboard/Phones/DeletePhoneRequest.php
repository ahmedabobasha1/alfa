<?php

namespace App\Http\Requests\Dashboard\Phones;

use Illuminate\Foundation\Http\FormRequest;

class DeletePhoneRequest extends FormRequest
{
    /**
     * Determine if the user is authorized to make this request.
     */
    public function authorize(): bool
    {
        return true;
    }

    /**
     * Get the validation rules that apply to the request.
     *
     * @return array<string, \Illuminate\Contracts\Validation\ValidationRule|array<mixed>|string>
     */
    public function rules(): array
    {
        return [
            'selectedIds' => ['sometimes', 'array', 'min:1'],
            'selectedIds.*' => ['required', 'integer', 'exists:phones,id'],
        ];
    }

    protected function prepareForValidation()
    {
        if (! $this->has('selectedIds')) {
            // Try to get the ID from route parameter (could be model instance or ID)
            $phone = $this->route('phone');
            if ($phone) {
                $id = $phone instanceof \App\Models\Phone ? $phone->id : $phone;
                $this->merge([
                    'selectedIds' => [$id],
                ]);
            }
        }
    }
}
