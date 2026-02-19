<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class ContactRequest extends FormRequest
{
    public function authorize(): bool
    {
        return true;
    }

    public function rules(): array
    {
        return [
            'name'    => ['required', 'string', 'max:255'],
            'email'   => ['required', 'email', 'max:255'],
            'phone'   => ['nullable', 'string', 'max:20'],
            'message' => ['required', 'string', 'min:10', 'max:2000'],
        ];
    }

    public function messages(): array
    {
        return [
            'name.required'    => 'Ism majburiy.',
            'email.required'   => 'Email majburiy.',
            'email.email'      => 'Email noto\'g\'ri formatda.',
            'message.required' => 'Xabar majburiy.',
            'message.min'      => 'Xabar kamida 10 ta belgi bo\'lishi kerak.',
        ];
    }
}
