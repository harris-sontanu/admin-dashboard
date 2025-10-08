<?php

namespace App\Repositories;

use App\Models\User;
use Illuminate\Support\Str;
use Illuminate\Support\Carbon;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Log;

class ForgotPasswordRepository
{
    public function sendResetLink($email)
    {
        $cek_email = User::where('email', $email)->first();
        if ($cek_email){
            $token = Str::random(64);
            DB::table('password_reset_tokens')->updateOrInsert(
                ['email' => $cek_email->email],
                [
                    'token' => $token,
                    'created_at' => Carbon::now()
                ]
            );
            $link = route('password.reset', ['token' => $token]);
            return $link;
        }
        return false;
        
    }

    public function getResetToken($token)
    {
        return DB::table('password_reset_tokens')->where('token', $token)->first();
    }

    public function isTokenExpired($createdAt, $hours = 1)
    {
        return Carbon::parse($createdAt)->addHours($hours)->isPast();
    }

    public function updatePassword($email, $newPassword)
    {
        $user = User::where('email', $email)->first();
        if ($user) {
            $user->password = bcrypt($newPassword);
            $user->save();
            DB::table('password_reset_tokens')->where('email', $email)->delete();
            return true;
        }
        log::info('User tidak ditemukan');
        return false;
    }
}