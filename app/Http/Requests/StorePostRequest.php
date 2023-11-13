<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Support\Facades\Auth;

class StorePostRequest extends FormRequest
{
    /**
     * Determine if the user is authorized to make this request.
     */
    public function authorize(): bool
    {
        //return Auth::id() === 1; // only the user with id 1 can create posts
        return true; // all users can create posts
    }

    /**
     * Get the validation rules that apply to the request.
     *
     * @return array<string, \Illuminate\Contracts\Validation\ValidationRule|array<mixed>|string>
     */
    public function rules(): array
    {
        return [
            'title' => ['required', 'min:5', 'max:50', 'unique:posts'],
            'content' => ['nullable'],
            'category_id' => ['nullable', 'exists:categories,id'],
            'cover_image' => ['nullable', 'image', 'max:500']
        ];
    }
}
