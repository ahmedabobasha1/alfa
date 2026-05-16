<?php

namespace App\Http\Requests\Dashboard\Benefits;

use Illuminate\Foundation\Http\FormRequest;

class StoreBenefitRequest extends FormRequest
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
            'title_en' => 'required|string|max:255',
            'title_ar' => 'required|string|max:255',
            'short_description_en' => 'nullable|string',
            'short_description_ar' => 'nullable|string',
            'long_description_en' => 'nullable|string',
            'long_description_ar' => 'nullable|string',
            'image' => 'nullable|image|mimes:jpeg,png,jpg,gif,svg,webp|max:2048',
            'alt_image' => 'nullable|string|max:255',
            'icon' => 'nullable|image|mimes:jpeg,png,jpg,gif,svg,webp|max:2048',
            'alt_icon' => 'nullable|string|max:255',
            'status' => 'nullable|boolean',
            'order' => 'nullable|integer|min:0',
        ];
    }

    /**
     * Get custom messages for validator errors.
     */
    public function messages(): array
    {
        return [
            'title_en.required' => __('dashboard.title_en').' '.__('dashboard.is_required'),
            'title_ar.required' => __('dashboard.title_ar').' '.__('dashboard.is_required'),
            'title_en.max' => __('dashboard.title_en').' '.__('dashboard.max_255'),
            'title_ar.max' => __('dashboard.title_ar').' '.__('dashboard.max_255'),
            'image.image' => __('dashboard.image').' '.__('dashboard.must_be_image'),
            'image.mimes' => __('dashboard.image').' '.__('dashboard.must_be_valid_format'),
            'image.max' => __('dashboard.image').' '.__('dashboard.max_size_2mb'),
            'icon.image' => __('dashboard.icon').' '.__('dashboard.must_be_image'),
            'icon.mimes' => __('dashboard.icon').' '.__('dashboard.must_be_valid_format'),
            'icon.max' => __('dashboard.icon').' '.__('dashboard.max_size_2mb'),
            'order.integer' => __('dashboard.order').' '.__('dashboard.must_be_integer'),
            'order.min' => __('dashboard.order').' '.__('dashboard.must_be_positive'),
        ];
    }

    /**
     * Prepare the data for validation.
     */
    protected function prepareForValidation(): void
    {
        $this->merge([
            'status' => $this->has('status') ? 1 : 0,
        ]);
    }
}
