<?php

namespace App\Http\Requests\Dashboard\Sliders;

use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Validation\Rule;

class StoreSliderRequest extends FormRequest
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
            'type' => ['required', Rule::in(array_column(\App\Enums\SliderType::cases(), 'value'))],
            'title_en' => ['nullable', 'string'],
            'title_ar' => ['nullable', 'string'],
            'title2_en' => ['nullable', 'string'],
            'title2_ar' => ['nullable', 'string'],
            'text_en' => ['nullable', 'string'],
            'text_ar' => ['nullable', 'string'],
            'second_text_en' => ['nullable', 'string'],
            'second_text_ar' => ['nullable', 'string'],
            'image_en' => ['nullable', 'image', 'mimes:jpeg,png,gif,bmp,webp', 'max:1024'],
            'image_ar' => ['nullable', 'image', 'mimes:jpeg,png,gif,bmp,webp', 'max:1024'],
            'alt_image_en' => ['nullable', 'string', 'max:255'],
            'alt_image_ar' => ['nullable', 'string', 'max:255'],
            'mobile_image_en' => ['nullable', 'image', 'mimes:jpeg,png,gif,bmp,webp', 'max:1024'],
            'mobile_image_ar' => ['nullable', 'image', 'mimes:jpeg,png,gif,bmp,webp', 'max:1024'],
            'mobile_alt_image_en' => ['nullable', 'string', 'max:255'],
            'mobile_alt_image_ar' => ['nullable', 'string', 'max:255'],
            'status' => ['nullable', 'boolean'],
            'order' => ['nullable', 'integer'],

        ];
    }
}
