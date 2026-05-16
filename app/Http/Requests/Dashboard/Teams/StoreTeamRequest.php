<?php

namespace App\Http\Requests\Dashboard\Teams;

use Illuminate\Foundation\Http\FormRequest;

class StoreTeamRequest extends FormRequest
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
            'name_en' => ['required', 'string', 'max:255'],
            'name_ar' => ['required', 'string', 'max:255'],
            'position_en' => ['required', 'string', 'max:255'],
            'position_ar' => ['required', 'string', 'max:255'],
            'text_en' => ['nullable', 'string'],
            'text_ar' => ['nullable', 'string'],
            'bio_en' => ['nullable', 'string'],
            'bio_ar' => ['nullable', 'string'],
            'order' => ['nullable', 'integer', 'min:0'],
            'image' => ['nullable', 'image', 'mimes:jpeg,png,gif,bmp,webp', 'max:2048'],
            'alt_image' => ['nullable', 'string', 'max:255'],
            'facebook' => ['nullable', 'url', 'max:255'],
            'twitter' => ['nullable', 'url', 'max:255'],
            'linkedin' => ['nullable', 'url', 'max:255'],
            'instagram' => ['nullable', 'url', 'max:255'],
            'status' => ['nullable', 'boolean'],
            'show_in_home' => ['nullable', 'boolean'],
        ];
    }
}
