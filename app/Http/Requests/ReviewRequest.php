<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class ReviewRequest extends FormRequest
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
            'user_id' => 'required|integer',
//            'product_id' => 'required|integer',
            'rating' => 'required|integer|between:1,5',
            'title' => 'required|string|min:3|max:50',
            'description' => 'max:100'
        ];
    }
}
