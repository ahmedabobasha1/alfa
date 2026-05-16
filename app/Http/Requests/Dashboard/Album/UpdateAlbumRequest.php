<?php

namespace App\Http\Requests\Dashboard\Album;

use App\Enums\AlbumType;
use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Validation\Rule;

class UpdateAlbumRequest extends FormRequest
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
            'name_en' => ['nullable'],
            'name_ar' => ['nullable'],
            'order' => ['nullable'],
            'type' => ['nullable', Rule::in(array_column(AlbumType::cases(), 'value'))],
            'status' => ['nullable', 'boolean'],
            'show_in_home' => ['nullable', 'boolean'],
            'show_in_header' => ['nullable', 'boolean'],
            'show_in_footer' => ['nullable', 'boolean'],
            'slug_en' => ['nullable'],
            'slug_ar' => ['nullable'],
            'meta_title_en' => ['nullable'],
            'meta_title_ar' => ['nullable'],
            'meta_desc_en' => ['nullable'],
            'meta_desc_ar' => ['nullable'],
            'short_desc_en' => ['nullable'],
            'short_desc_ar' => ['nullable'],
            'long_desc_en' => ['nullable'],
            'image' => ['nullable', 'image', 'mimes:jpeg,png,gif,bmp,webp', 'max:1024'],
            'alt_image' => ['nullable', 'string', 'max:255'],
            'album_images.*' => 'image|max:1024',
        ];
    }
}
