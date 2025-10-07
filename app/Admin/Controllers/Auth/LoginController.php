<?php

namespace App\Admin\Controllers\Auth;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Http;
class LoginController extends Controller
{
    public function showLoginForm()
    {
        return view('admin.auth.login');
    }

    public function login(Request $request)
    {
        $credentials = $request->validate([
            'email'    => ['required', 'email'],
            'password' => ['required'],
            'g-recaptcha-response' => ['required'],
        ]);

        $recaptchaResponse = Http::asForm()->post('https://www.google.com/recaptcha/api/siteverify', [
            'secret' => config('services.recaptcha.secret_key'),
            'response' => $request->input('g-recaptcha-response'),
            'remoteip' => $request->ip(),
        ]);

        $recaptchaResult = $recaptchaResponse->json();

        if (!($recaptchaResult['success'] ?? false) || ($recaptchaResult['score'] ?? 0) < 0.5) {
            return back()->withErrors([
                'captcha' => 'Verifikasi reCAPTCHA gagal. Silakan coba lagi.',
            ])->withInput();
        }

        if (Auth::attempt(['email' => $credentials['email'], 'password' => $credentials['password']])) {
            $request->session()->regenerate();
            return redirect()->intended('admin/dashboard');
        }

        return back()->withErrors([
            'email' => 'Email atau password salah.',
        ])->onlyInput('email');
    }

    public function showForgotPasswordForm()
    {
        return view('admin.auth.forgot');
    }
}
