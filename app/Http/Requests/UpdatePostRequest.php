<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Support\Facades\Auth;
use Illuminate\Validation\Rule;

class UpdatePostRequest extends FormRequest
{
    /**
     * Determine if the user is authorized to make this request.
     */
    public function authorize(): bool
    {
        // return Auth::id() === 1; // true only user 1 can update posts
        return $this->post?->user_id === Auth::id(); // any user can update posts
    }

    /**
     * Get the validation rules that apply to the request.
     *
     * @return array<string, \Illuminate\Contracts\Validation\ValidationRule|array<mixed>|string>
     */
    public function rules(): array
    {

        return [
            'title' => ['required', 'min:5', 'max:50', Rule::unique('posts')->ignore($this->post)],
            'content' => ['nullable'],
            'category_id' => ['nullable', 'exists:categories,id'],
            'cover_image' => ['nullable', 'image', 'max:800']
        ];
    }
}
