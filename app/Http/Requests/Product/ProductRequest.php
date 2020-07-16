<?php

namespace App\Http\Requests\Product;

use Illuminate\Foundation\Http\FormRequest;

class ProductRequest extends FormRequest
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
            'name' => 'required|max:255|unique:products',
            'code' => 'required|unique:products',
            'slug' => 'required|max:255|unique:products',
            'description' => 'required',
            'price' =>  'required|regex:/^\d+(\.\d{0,2})?$/',
            'category_id' => 'required|integer'
        ];
    }
}
