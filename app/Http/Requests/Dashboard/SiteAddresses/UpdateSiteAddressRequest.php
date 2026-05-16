<?php

namespace App\Http\Requests\Dashboard\SiteAddresses;

use App\Rules\ValidPhoneByCountry;
use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Validation\Rule;

class UpdateSiteAddressRequest extends FormRequest
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
            'type' => ['required', Rule::in(\App\Models\SiteAddress::TYPES)],
            'title_en' => 'nullable|string|max:255',
            'title_ar' => 'nullable|string|max:255',
            'address_ar' => 'nullable|string|max:4294967295',
            'address_en' => 'nullable|string|max:4294967295',
            'working_hours_ar' => 'nullable|string|max:4294967295',
            'working_hours_en' => 'nullable|string|max:4294967295',
            'email' => 'nullable|email',
            'code' => 'required_with:phone',
            'phone' => [
                'nullable',
                new ValidPhoneByCountry($this->input('code')),
            ],
            'phone2' => [
                'nullable',
                new ValidPhoneByCountry($this->input('code2')),
            ],

            'code2' => 'required_with:phone2',
            'map_url' => 'nullable|string',
            'map_link' => 'nullable|string',
            'order' => 'nullable|integer',
            'status' => 'nullable|boolean',
        ];
    }
}
