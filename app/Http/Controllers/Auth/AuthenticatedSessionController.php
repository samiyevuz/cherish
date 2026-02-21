<?php

namespace App\Http\Controllers\Auth;

use App\Http\Controllers\Controller;
use App\Models\User;
use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;
use Illuminate\View\View;

class AuthenticatedSessionController extends Controller
{
    public function create(): View
    {
        return view('auth.login');
    }

    public function store(Request $request): RedirectResponse
    {
        $request->validate([
            'login'    => ['required', 'string'],
            'password' => ['required'],
        ], [
            'login.required'    => 'Email yoki telefon raqam majburiy.',
            'password.required' => 'Parol majburiy.',
        ]);

        $login    = trim($request->login);
        $password = $request->password;
        $remember = $request->boolean('remember');

        $user = null;

        if (str_contains($login, '@')) {
            // Email login
            $user = User::where('email', $login)->first();
        } else {
            // Phone login — normalize to +998XXXXXXXXX
            $digits = preg_replace('/\D/', '', $login);
            if (str_starts_with($digits, '998')) {
                $digits = substr($digits, 3);
            }
            $phone = '+998' . $digits;
            $user  = User::where('phone', $phone)->first();
        }

        if (!$user || !Hash::check($password, $user->password)) {
            return back()
                ->withErrors(['login' => 'Email/telefon yoki parol noto\'g\'ri.'])
                ->onlyInput('login');
        }

        Auth::login($user, $remember);
        $request->session()->regenerate();

        if ($user->isAdmin()) {
            return redirect()->intended(route('admin.dashboard'));
        }

        return redirect()->intended(route('home'));
    }

    public function destroy(Request $request): RedirectResponse
    {
        Auth::guard('web')->logout();
        $request->session()->invalidate();
        $request->session()->regenerateToken();
        return redirect('/');
    }
}
