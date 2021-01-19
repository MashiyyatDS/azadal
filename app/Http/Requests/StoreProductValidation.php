<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class StoreProductValidation extends FormRequest
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
                'description' => 'required|max:500',
                'type' => 'required|max:20',
                'quantity' => 'required|numeric',
                'srp' => 'required|numeric',
                'warranty' => 'required|numeric',
                'delivery_fee' => 'required|numeric',
                'discount' => 'required|numeric|max:100|min:0',
                'original_price' => 'required|numeric',
                'image' => 'nullable',
                'image.*' => 'image|mimes:png,jpeg,jpg|max:2048',
            ];
    }

    public function messages() {
        return [
            'name.required' => 'Product name is required',
            'description.required' => 'Product description is required',
            'description.max' => 'Product description is too large',
            'image.required' => 'Product must have an image',
            'image.*.image' => 'Product image must be an image',
            'image.*.mimes' => 'Product image must be on PNG format'
        ];
    }

}
