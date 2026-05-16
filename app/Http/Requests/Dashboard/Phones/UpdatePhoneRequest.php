<?php

namespace App\Http\Requests\Dashboard\Phones;

use Illuminate\Foundation\Http\FormRequest;

class UpdatePhoneRequest extends FormRequest
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
            'name_ar' => 'nullable|string|max:255',
            'name_en' => 'nullable|string|max:255',
            'phone' => 'required|string|max:20',
            'code' => 'required|string|max:5',
            'email' => 'nullable|email|max:255',
            'description_ar' => 'nullable|string|max:1000',
            'description_en' => 'nullable|string|max:1000',
            'status' => 'boolean',
            'order' => 'nullable|integer',
        ];
    }

    /**
     * Get custom messages for validator errors.
     */
    public function messages(): array
    {
        return [
            'name_ar.required' => 'اسم الهاتف بالعربية مطلوب',
            'name_ar.string' => 'اسم الهاتف بالعربية يجب أن يكون نص',
            'name_ar.max' => 'اسم الهاتف بالعربية لا يمكن أن يتجاوز 255 حرف',
            'name_en.required' => 'اسم الهاتف بالإنجليزية مطلوب',
            'name_en.string' => 'اسم الهاتف بالإنجليزية يجب أن يكون نص',
            'name_en.max' => 'اسم الهاتف بالإنجليزية لا يمكن أن يتجاوز 255 حرف',
            'phone.required' => 'رقم الهاتف مطلوب',
            'phone.string' => 'رقم الهاتف يجب أن يكون نص',
            'phone.max' => 'رقم الهاتف لا يمكن أن يتجاوز 20 حرف',
            'email.email' => 'البريد الإلكتروني يجب أن يكون صحيح',
            'email.max' => 'البريد الإلكتروني لا يمكن أن يتجاوز 255 حرف',
            'description_ar.max' => 'الوصف بالعربية لا يمكن أن يتجاوز 1000 حرف',
            'description_en.max' => 'الوصف بالإنجليزية لا يمكن أن يتجاوز 1000 حرف',
            'code.max' => 'يجب اضافة + قبل رمز الدولة لا يمكن أن يتجاوز 5 حرف',
            'order.integer' => 'يجب أن يكون الترتيب رقمي',
        ];
    }
}
