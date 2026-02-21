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
        $request->validate([
            'name'     => ['required', 'string', 'max:255'],
            'phone'    => ['required', 'string', 'min:9', 'max:13'],
            'email'    => ['nullable', 'string', 'email', 'max:255', 'unique:users'],
            'password' => ['required', 'string', 'min:8', 'confirmed', Rules\Password::defaults()],
        ], [
            'name.required'     => 'Ism majburiy.',
            'phone.required'    => 'Telefon raqam majburiy.',
            'phone.min'         => 'Telefon raqam to\'liq kiritilmagan.',
            'email.email'       => 'Email manzil noto\'g\'ri formatda.',
            'email.unique'      => 'Bu email allaqachon ro\'yxatdan o\'tgan.',
            'password.required' => 'Parol majburiy.',
            'password.min'      => 'Parol kamida 8 belgidan iborat bo\'lishi kerak.',
            'password.confirmed'=> 'Parollar mos kelmadi.',
        ]);

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

        $user = User::create([
            'name'     => $request->name,
            'phone'    => $phone,
            'email'    => $request->email ?: null,
            'password' => Hash::make($request->password),
        ]);

        event(new Registered($user));
        Auth::login($user);

        return redirect(route('home'));
    }
}
