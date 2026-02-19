<?php

namespace App\Http\Requests\Admin;

use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Validation\Rule;

class ProductRequest extends FormRequest
{
    public function authorize(): bool
    {
        return auth()->check() && auth()->user()->isAdmin();
    }

    public function rules(): array
    {
        $productId = $this->route('product')?->id;

        return [
            'name'        => ['required', 'string', 'max:255'],
            'slug'        => ['required', 'string', 'max:255', Rule::unique('products', 'slug')->ignore($productId)],
            'category_id' => ['nullable', 'exists:categories,id'],
            'description' => ['nullable', 'string'],
            'price'       => ['required', 'numeric', 'min:0'],
            'sale_price'  => ['nullable', 'numeric', 'min:0', 'lt:price'],
            'is_new'      => ['boolean'],
            'is_featured' => ['boolean'],
            'images.*'    => ['nullable', 'image', 'max:5120'],
            'sizes'       => ['nullable', 'array'],
            'sizes.*.size'  => ['required_with:sizes', 'string', 'max:10'],
            'sizes.*.stock' => ['required_with:sizes', 'integer', 'min:0'],
        ];
    }
}
