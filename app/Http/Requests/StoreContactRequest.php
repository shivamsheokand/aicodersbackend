<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;
use App\Models\Contact;

class StoreContactRequest extends FormRequest
{
    public function authorize(): bool
    {
        return true;
    }

    public function rules(): array
    {
        return [
            'name' => 'required|string|min:3|max:255',
            'email' => 'required|email|max:255',
            'mobile' => 'required|string|digits:10',
            'purpose' => 'required|string|in:' . implode(',', array_keys(Contact::PURPOSE_OPTIONS)),
            'message' => 'required|string|min:10'
        ];
    }

    public function messages(): array
    {
        return [
            'name.required' => 'Name cannot be empty',
            'name.min' => 'Name must be at least 3 characters',
            'email.required' => 'Email cannot be empty',
            'email.email' => 'Please enter a valid email address',
            'mobile.required' => 'Mobile number cannot be empty',
            'mobile.digits' => 'Mobile number must be 10 digits',
            'purpose.required' => 'Purpose cannot be empty',
            'purpose.in' => 'Please select a valid purpose',
            'message.required' => 'Message cannot be empty',
            'message.min' => 'Message must be at least 10 characters'
        ];
    }
}
