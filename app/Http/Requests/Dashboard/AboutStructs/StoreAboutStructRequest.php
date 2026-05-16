<?php

namespace App\Http\Requests\Dashboard\AboutStructs;

use Illuminate\Foundation\Http\FormRequest;

class StoreAboutStructRequest extends FormRequest
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
            'title_en' => ['nullable', 'string'],
            'title_ar' => ['nullable', 'string'],
            'text_en' => ['nullable', 'string'],
            'text_ar' => ['nullable', 'string'],
            'icon' => ['nullable', 'image', 'mimes:jpeg,png,gif,bmp,webp', 'max:1024'],
            'alt_icon' => ['nullable', 'string', 'max:255'],
            'status' => ['nullable', 'boolean'],
            'order' => ['nullable', 'integer'],

        ];
    }
}
