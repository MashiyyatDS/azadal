<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class UserUpdateValidation extends FormRequest
{
    /**
     * Determine if the user is authorized to make this request.
     *
     * @return bool
     */
    public function authorize()
    {
        return true;
    }

    /**
     * Get the validation rules that apply to the request.
     *
     * @return array
     */
    public function rules()
    {
        return [
            'name' => 'required|max:50',
            'lastname' => 'required|max:50',
            'middlename' => 'required|string|max:50',
            'contact' => 'required|max:255',
            'email' => 'required|email|max:255',
            'profile' => 'image|mimes:png,jpeg,jpg'
        ];
    }

    public function messages()
    {
        return [
            'name.required' => 'Please put your firstname',
            'lastname.required' => 'Please put your lastname',
            'middlename.required' => 'Please put your middlename',
            'contact.required' => 'Please put your contact number',
            'email.required' => 'Please provide an email',
            'profile.image' => 'Profile must be an image'
        ];
    }
}
