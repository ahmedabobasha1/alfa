<?php

namespace App\Http\Requests\Dashboard\Sections;

use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Validation\Rule;

class UpdateSectionRequest extends FormRequest
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
            'key' => ['required', Rule::in(array_column(\App\Enums\SectionType::cases(), 'value')), 'unique:sections,key,'.$this->section->id],
            'title_en' => ['nullable', 'string'],
            'title_ar' => ['nullable', 'string'],
            'second_title_en' => ['nullable', 'string'],
            'second_title_ar' => ['nullable', 'string'],
            'short_desc_en' => ['nullable', 'string'],
            'short_desc_ar' => ['nullable', 'string'],
            'long_desc_en' => ['nullable', 'string'],
            'long_desc_ar' => ['nullable', 'string'],
            'image' => ['nullable', 'image', 'mimes:jpg,jpeg,png,gif,webp'],
            'alt_image' => ['nullable', 'string'],
            'icon' => ['nullable', 'image', 'mimes:jpg,jpeg,png,gif,webp'],
            'alt_icon' => ['nullable', 'string'],
            'status' => ['nullable', 'boolean'],

        ];
    }
}
