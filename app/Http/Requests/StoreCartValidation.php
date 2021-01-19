<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class StoreCartValidation extends FormRequest
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
            'quantity' => 'numeric|required|max:100|min:1',
        ];
    }


    public function messages() 
    {
        return [
            'quantity.numeric' => 'Invalid quantity',
            'quantity.required' => 'Quantity is required',
            'quantity.max' => 'Maximum of 100 only'
        ];
    }
}
