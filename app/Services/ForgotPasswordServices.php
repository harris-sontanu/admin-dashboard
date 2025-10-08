<?php

namespace App\Services;

use App\Mail\SendMailForgotPassword;
use App\Repositories\ForgotPasswordRepository;
use Illuminate\Support\Facades\Mail;

class ForgotPasswordServices
{
    protected $forgotPasswordRepository;

    public function __construct(ForgotPasswordRepository $forgotPasswordRepository)
    {
        $this->forgotPasswordRepository = $forgotPasswordRepository;
    }

    public function sendResetLink($email)
    {
        $link = $this->forgotPasswordRepository->sendResetLink($email);
        if ($link) {
            Mail::to($email)->send(new SendMailForgotPassword($link, $email));
            return true;
        }
        return false;
    }

    public function validateToken($token)
    {
        $reset = $this->forgotPasswordRepository->getResetToken($token);

        if (!$reset) {
            session()->flash('error', 'Token tidak valid.');
            return ['status' => false, 'message' => 'Token tidak valid.'];
        }

        if ($this->forgotPasswordRepository->isTokenExpired($reset->created_at)) {
            session()->flash('error', 'Token telah kadaluarsa.');
            return ['status' => false, 'message' => 'Token telah kadaluarsa.'];
        }

        return ['status' => true, 'data' => $reset];
    }

    public function updatePassword($token, $newPassword)
    {
        $reset = $this->forgotPasswordRepository->getResetToken($token);

        if (!$reset) {
            return ['status' => false, 'message' => 'Token tidak valid.'];
        }

        if ($this->forgotPasswordRepository->isTokenExpired($reset->created_at)) {
            return ['status' => false, 'message' => 'Token telah kadaluarsa.'];
        }

        $updated = $this->forgotPasswordRepository->updatePassword($reset->email, $newPassword);

        if ($updated) {
            return ['status' => true, 'message' => 'Password berhasil diupdate.'];
        }

        return ['status' => false, 'message' => 'Gagal mengupdate password.'];
    }
}