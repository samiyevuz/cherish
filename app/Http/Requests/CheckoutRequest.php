<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class CheckoutRequest extends FormRequest
{
    public function authorize(): bool
    {
        return auth()->check();
    }

    public function rules(): array
    {
        return [
            'full_name'      => ['required', 'string', 'max:255'],
            'phone'          => ['required', 'string', 'max:20'],
            'city'           => ['required', 'string', 'max:100'],
            'address'        => ['required', 'string', 'max:500'],
            'payment_method' => ['required', 'string', 'in:cash,click,payme,uzum'],
        ];
    }

    public function messages(): array
    {
        return [
            'full_name.required'      => 'To\'liq ism majburiy.',
            'phone.required'          => 'Telefon raqam majburiy.',
            'city.required'           => 'Shahar majburiy.',
            'address.required'        => 'Manzil majburiy.',
            'payment_method.required' => 'To\'lov usulini tanlang.',
            'payment_method.in'       => 'Noto\'g\'ri to\'lov usuli.',
        ];
    }
}
