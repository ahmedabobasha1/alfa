<?php

namespace App\Http\Requests\Dashboard\Admins;

use Illuminate\Foundation\Http\FormRequest;

class UpdateAdminRequest extends FormRequest
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
    public function rules()
    {
        // Assuming you are passing the admin ID via route model binding
        $adminId = $this->route('admin')->id;  // Get the admin ID from the route

        return [
            'name' => 'required|string|max:255',
            'email' => 'required|string|email|max:255|unique:admins,email,'.$adminId, // Exclude the current admin from unique validation
            'permissions' => ['nullable'],
            'password' => 'nullable|string|min:6|confirmed',  // Make password nullable if not changing
        ];
    }
}
