<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Validation\Rule;

class ProductAdd extends FormRequest
{
    public function authorize()
    {
        return true;
    }

    public function rules()
    {
        return [
            'product_name' => [
                'required',
                'string',
                'max:255',
                Rule::unique('products', 'product_name')
                    ->where(function ($query) {
                        return $query->where('user_id', session('login_id'));
                    }),
            ],

            'product_price' => 'required|numeric',
            'product_description' => 'required',
        ];
    }

    public function messages()
    {
        return [
            'product_name.required' => 'Product name is required',
            'product_name.unique'   => 'Name already exists',
            'product_price.required' => 'Product price is required',
            'product_price.numeric'  => 'Product price must be a number',
            'product_description.required' => 'Product description is required',
        ];
    }
}