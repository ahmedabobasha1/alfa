<?php

namespace App\Http\Requests\Dashboard\Settings;

use App\Rules\ValidPhoneByCountry;
use Illuminate\Foundation\Http\FormRequest;

class SettingsRequest extends FormRequest
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
            'site_email' => 'nullable|email|max:255',
            'mail_from_address' => 'nullable|email|max:255',
            'cc_emails' => 'nullable|string|max:500',
            'phone' => 'nullable|string|max:20',

            'site_facebook' => 'nullable|string|max:255',
            'site_twitter' => 'nullable|string|max:255',
            'site_instagram' => 'nullable|string|max:255',
            'site_linkedin' => 'nullable|string|max:255',
            'site_youtube' => 'nullable|string|max:255',
            'site_snapchat' => 'nullable|string|max:255',
            'site_tiktok' => 'nullable|string|max:255',
            'site_pinterest' => 'nullable|string|max:255',
            'site_telegram' => 'nullable|string|max:255',
            'site_map' => 'nullable|string',
            'google_analytics_id' => 'nullable|string|max:255|regex:/^G-[A-Z0-9]{10}$/',
            'google_tag_manager_id' => 'nullable|string|max:255|regex:/^GTM-[A-Z0-9]{7,10}$/',
            'country_code' => ['required', 'string'],

            'site_whatsapp' => [
                'nullable',
                'string',
                new ValidPhoneByCountry($this->input('country_code')),
            ],

            'phone' => [
                'nullable',
                'string',
                new ValidPhoneByCountry($this->input('country_code')),
            ],
            'opening_hours_weekdays' => 'nullable|string|max:100',
            'opening_hours_weekdays_time' => 'nullable|string|max:100',
            'opening_hours_friday' => 'nullable|string|max:100',
            'opening_hours_friday_time' => 'nullable|string|max:100',
        ];
    }

    /**
     * Get custom messages for validator errors.
     */
    public function messages(): array
    {
        return [
            'google_analytics_id.regex' => app()->getLocale() === 'ar'
                ? 'معرف جوجل أناليتكس يجب أن يكون بالتنسيق G-XXXXXXXXXX (10 أحرف بعد G-)'
                : 'Google Analytics ID must be in the format G-XXXXXXXXXX (10 characters after G-)',
            'google_tag_manager_id.regex' => app()->getLocale() === 'ar'
                ? 'معرف جوجل تاج مانجر يجب أن يكون بالتنسيق GTM-XXXXXXX إلى GTM-XXXXXXXXXX (7-10 أحرف بعد GTM-)'
                : 'Google Tag Manager ID must be in the format GTM-XXXXXXX to GTM-XXXXXXXXXX (7-10 characters after GTM-)',
        ];
    }
}
