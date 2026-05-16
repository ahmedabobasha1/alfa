<?php

namespace App\Rules;

use Illuminate\Contracts\Validation\Rule;

class ValidPhoneByCountry implements Rule
{
    protected $countryCode;

    protected $message;

    public function __construct($countryCode)
    {
        $this->countryCode = $countryCode;
    }

    public function passes($attribute, $value)
    {
        $patterns = [
            '+1' => '/^\d{10}$/',
            '+44' => '/^\d{10}$/',
            '+971' => '/^\d{9}$/',
            '+20' => '/^\d{10}$/',
            '+91' => '/^\d{10}$/',
            '+966' => '/^\d{9}$/',
            '+33' => '/^\d{9}$/',
            '+49' => '/^\d{10}$/',
            '+81' => '/^\d{10}$/',
            '+86' => '/^\d{11}$/',
            '+55' => '/^\d{10,11}$/',
            '+7' => '/^\d{10}$/',
            '+61' => '/^\d{9}$/',
            '+34' => '/^\d{9}$/',
            '+39' => '/^\d{9,10}$/',
            '+62' => '/^\d{9,13}$/',
            '+234' => '/^\d{10}$/',
            '+92' => '/^\d{10}$/',
            '+27' => '/^\d{9}$/',
        ];

        if (! isset($patterns[$this->countryCode])) {
            $this->message = __('Invalid country code.');

            return false;
        }

        if (! preg_match($patterns[$this->countryCode], $value)) {
            $this->message = __('Invalid phone number format for ').$this->countryCode;

            return false;
        }

        return true;
    }

    public function message()
    {
        return $this->message;
    }
}
