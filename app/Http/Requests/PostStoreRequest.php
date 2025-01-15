<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class PostStoreRequest extends FormRequest
{
    /**
     * Determine if the user is authorized to make this request.
     */
    public function authorize(): bool
    {
        return true;
    }

    /**
     * Get the validation rules that apply to the request.
     *
     * @return array<string, \Illuminate\Contracts\Validation\ValidationRule|array<mixed>|string>
     */
    public function rules(): array
    {
        return [
            'title' => 'required|string|max:255',
            'slug' => 'required|string|max:255|unique:posts,slug',
            'category_id' => 'required|exists:categories,id',
        ];
    }

    /**
     * Get the custom messages for validator errors.
     */
    public function messages(): array
    {
        return [
            'title.required' => 'فیلد عنوان الزامی است.',
            'slug.required' => 'فیلد slug الزامی است.',
            'slug.unique' => 'مقدار slug باید یکتا باشد.',
            'category_id.required' => 'لطفاً یک دسته‌بندی انتخاب کنید.',
            'category_id.exists' => 'دسته‌بندی انتخاب‌شده نامعتبر است.',
        ];
    }
}