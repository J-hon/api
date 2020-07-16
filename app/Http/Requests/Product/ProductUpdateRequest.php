<?php

namespace App\Http\Requests\Product;

use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Validation\Rule;

class ProductUpdateRequest extends FormRequest
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
            'name' => [Rule::unique('products')->ignore($this->id), 'required', 'max:255'],
            'code' => [Rule::unique('products')->ignore($this->id), 'required'],
            'slug' => [Rule::unique('products')->ignore($this->id), 'required', 'max:255'],
            'description' => ['required'],
            'price' =>  ['required', 'regex:/^\d+(\.\d{0,2})?$/'],
            'category_id' => ['required', 'integer']
        ];
    }
}
