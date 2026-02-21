<?php

namespace App\Http\Controllers\Auth;

use App\Http\Controllers\Controller;
use App\Models\User;
use Illuminate\Auth\Events\Registered;
use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;
use Illuminate\Validation\Rules;
use Illuminate\View\View;

class RegisteredUserController extends Controller
{
    public function create(): View
    {
        return view('auth.register');
    }

    public function store(Request $request): RedirectResponse
    {
        // Determine registration mode: phone or email
        $hasPhone = !empty($request->phone);
        $hasEmail = !empty($request->email);

        if (!$hasPhone && !$hasEmail) {
            return back()->withErrors(['phone' => 'Telefon raqam yoki email majburiy.'])->withInput();
        }

        // Validation rules
        $rules = [
            'name'     => ['required', 'string', 'max:255'],
            'password' => ['required', 'string', 'min:8', 'confirmed', Rules\Password::defaults()],
        ];

        $messages = [
            'name.required'     => 'Ism majburiy.',
            'password.required' => 'Parol majburiy.',
            'password.min'      => 'Parol kamida 8 belgidan iborat bo\'lishi kerak.',
            'password.confirmed'=> 'Parollar mos kelmadi.',
        ];

        if ($hasPhone) {
            $rules['phone'] = ['required', 'string', 'min:9', 'max:13'];
            $messages['phone.required'] = 'Telefon raqam majburiy.';
            $messages['phone.min'] = 'Telefon raqam to\'liq kiritilmagan.';
        }

        if ($hasEmail) {
            $rules['email'] = ['required', 'string', 'email', 'max:255', 'unique:users'];
            $messages['email.required'] = 'Email majburiy.';
            $messages['email.email'] = 'Email manzil noto\'g\'ri formatda.';
            $messages['email.unique'] = 'Bu email allaqachon ro\'yxatdan o\'tgan.';
        } else {
            $rules['email'] = ['nullable', 'string', 'email', 'max:255', 'unique:users'];
            $messages['email.email'] = 'Email manzil noto\'g\'ri formatda.';
            $messages['email.unique'] = 'Bu email allaqachon ro\'yxatdan o\'tgan.';
        }

        $request->validate($rules, $messages);

        $phone = null;
        if ($hasPhone) {
            // Format phone: strip everything except digits, then prepend +998
            $digits = preg_replace('/\D/', '', $request->phone);
            // Remove leading country code if user typed it
            if (str_starts_with($digits, '998')) {
                $digits = substr($digits, 3);
            }
            $phone = '+998' . $digits;

            // Check phone uniqueness
            if (User::where('phone', $phone)->exists()) {
                return back()->withErrors(['phone' => 'Bu telefon raqam allaqachon ro\'yxatdan o\'tgan.'])->withInput();
            }
        }

        $email = $request->email ?: null;

        // Ensure at least one identifier exists
        if (!$phone && !$email) {
            return back()->withErrors(['phone' => 'Telefon raqam yoki email majburiy.'])->withInput();
        }

        $user = User::create([
            'name'     => $request->name,
            'phone'    => $phone,
            'email'    => $email,
            'password' => Hash::make($request->password),
        ]);

        event(new Registered($user));
        Auth::login($user);

        return redirect(route('home'));
    }
}
