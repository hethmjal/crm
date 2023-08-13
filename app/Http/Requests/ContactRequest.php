<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class ContactRequest extends FormRequest
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
     * @return array<string, \Illuminate\Contracts\Validation\ValidationRule|array|string>
     */
    public function rules(): array
    {
        return [
          
                'name' => 'required',
                'email' => 'required|email|unique:contacts',
                'phone' => 'nullable',
       
       
        ];
    }

    public function messages(): array
    {
        return  [
            'name.required' => 'الاسم مطلوب',
            'email.required' => 'البريد الالكتروني مطلوب',
            'phone.required' => 'رقم الهاتف مطلوب',
    
        ];
    }
}
