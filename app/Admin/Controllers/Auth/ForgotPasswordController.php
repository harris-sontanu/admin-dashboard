<?php

namespace App\Admin\Controllers\Auth;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Services\ForgotPasswordServices;
use Illuminate\Support\Facades\Validator;

class ForgotPasswordController extends Controller
{
    protected $forgotPasswordService;
     public function __construct(ForgotPasswordServices $forgotPasswordService)
    {
        $this->forgotPasswordService = $forgotPasswordService;
    }

    public function showForgotPasswordForm()
    {
        return view('admin.auth.forgot');
    }

    public function checkEmail(Request $request)
    {
        $request->validate([
            'email' => 'required|email'
        ]);

        $result = $this->forgotPasswordService->sendResetLink($request->email);
        if($result){
            session()->flash('success', 'Link reset password telah dikirim ke email Anda.');
            return redirect()->back();
        }else
        {
            session()->flash('error', 'Email Tidak Terdaftar.');
            return redirect()->back();
        }
    }

    public function showResetPasswordForm($token)
    {
        $result = $this->forgotPasswordService->validateToken($token);

        if (!$result['status']) {
            session()->flash('error', $result['message']);
            return redirect()->route('login');
        }

        return view('admin.auth.edit_password', [
            'token' => $token
        ]);
    }

    public function updatePassword(Request $request)
    {
        $validated = Validator::make(request()->all(), [
            'token' => 'required',
            'password' => 'required|confirmed|min:8',
        ],[
            'password.confirmed' => 'Konfirmasi password tidak sesuai.',
            'password.min' => 'Password minimal 8 karakter.',
        ]);

        if ($validated->fails()) {
            session()->flash('error', $validated->errors()->first());
            return redirect()->back()->withErrors($validated)->withInput();
        }

        $result = $this->forgotPasswordService->validateToken($request->token);

        if (!$result['status']) {
            session()->flash('error', $result['message']);
            return redirect()->route('login');
        }

        $this->forgotPasswordService->updatePassword($request->token, $request->password);

        session()->flash('success', 'Password berhasil diubah. Silakan login dengan password baru Anda.');
        return redirect()->route('show.form.login');
    }
}