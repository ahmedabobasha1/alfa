<?php

namespace App\Http\Requests\Dashboard\Menus;

use App\Enums\MenuRouteName;
use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Validation\Rule;

class StoreMenuRequest extends FormRequest
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
            'name_en' => ['required', 'string'],
            'name_ar' => ['required', 'string'],
            'parent_id' => ['nullable'],
            'route_name' => ['required', Rule::in(array_column(MenuRouteName::cases(), 'value'))],
            'status' => ['nullable', 'boolean'],
            'order' => ['nullable', 'integer'],
        ];
    }
}
