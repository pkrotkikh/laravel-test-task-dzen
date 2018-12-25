<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class ArticleRequest extends FormRequest
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
            'user_name'=>'required',
            'email'=>'required|email',
            'homepage'=>'url|string|nullable',
            'text'=>'required',
            'captcha' => 'required|captcha',
            'file' => 'mimes:jpeg,png,jpg,gif|max:500|nullable',
        ];
    }
}
