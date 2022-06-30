<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Support\Facades\Auth;

class StorePostRequest extends FormRequest
{
    /**
     * Determine if the user is authorized to make this request.
     *
     * @return bool
     */
    public function authorize()
    {
        return Auth::check();
    }

    /**
     * Get the validation rules that apply to the request.
     *
     * @return array
     */
    public function rules()
    {
        return [
            'title' => 'required|min:5|max:255',
            'body' => 'required|min:5|max:65535',
            'is_premium' => '',
            'category' => 'required|array',
            'category.*' => 'required|exists:categories,id',
            'image' => 'nullable|image|max:2048'
        ];
    }
}
