<?php

namespace App\Http\Requests\Admin;

use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Validation\Rule;

class CategoryRequest extends FormRequest
{
    public function authorize(): bool
    {
        return auth()->check() && auth()->user()->isAdmin();
    }

    public function rules(): array
    {
        $categoryId = $this->route('category')?->id;

        return [
            'name'  => ['required', 'string', 'max:255'],
            'slug'  => ['required', 'string', 'max:255', Rule::unique('categories', 'slug')->ignore($categoryId)],
            'type'  => ['required', Rule::in(['men', 'women', 'new', 'sale'])],
            'image' => ['nullable', 'image', 'max:2048'],
        ];
    }
}
