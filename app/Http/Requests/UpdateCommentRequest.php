<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class UpdateCommentRequest extends FormRequest
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
            'product_id'=>'required _without:post_id|integer|exists:products,id',
            'article_id'=>'required _without:product_id|integer|exists:articles,id',
            'user_id'=>'required|integer|exists:users,id',
            'body' => 'required|string|min:6|max:50',
            'visible' => 'required|boolean',
        ];
    }
}
