<?php

namespace App\Services;

use App\Models\User;
use App\Notifications\AdminPasswordResetNotification;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Str;

class AdminPasswordResetService
{
    protected int $otpExpiry = 900; // 15 minutes

    public function sendOtp(string $email): array
    {
        $user = User::where('email', $email)->first();

        if (! $user) {
            return [
                'success' => false,
                'message' => 'User not found.',
            ];
        }

        $otp = $this->generateOtp();
        $token = $this->generateToken();

        cache()->put("password_reset.otp.{$email}", $otp, $this->otpExpiry);
        cache()->put("password_reset.token.{$email}", $token, $this->otpExpiry);

        $user->notify(new AdminPasswordResetNotification($otp));

        return [
            'success' => true,
            'message' => 'OTP sent to your email.',
            'token' => $token,
        ];
    }

    public function verifyOtp(string $email, string $otp, string $token): array
    {
        $storedOtp = cache()->get("password_reset.otp.{$email}");
        $storedToken = cache()->get("password_reset.token.{$email}");

        if (! $storedOtp || ! $storedToken) {
            return [
                'success' => false,
                'message' => 'OTP expired. Please request a new one.',
            ];
        }

        if ($storedOtp !== $otp || $storedToken !== $token) {
            return [
                'success' => false,
                'message' => 'Invalid OTP or token.',
            ];
        }

        cache()->put("password_reset.verified.{$email}", true, 300); // 5 minutes

        return [
            'success' => true,
            'message' => 'OTP verified.',
        ];
    }

    public function resetPassword(string $email, string $password): array
    {
        $verified = cache()->get("password_reset.verified.{$email}");

        if (! $verified) {
            return [
                'success' => false,
                'message' => 'OTP not verified.',
            ];
        }

        $user = User::where('email', $email)->first();

        if (! $user) {
            return [
                'success' => false,
                'message' => 'User not found.',
            ];
        }

        $user->password = Hash::make($password);
        $user->save();

        $this->clearResetData($email);

        return [
            'success' => true,
            'message' => 'Password reset successfully.',
        ];
    }

    public function clearResetData(string $email): void
    {
        cache()->forget("password_reset.otp.{$email}");
        cache()->forget("password_reset.token.{$email}");
        cache()->forget("password_reset.verified.{$email}");
    }

    protected function generateOtp(): string
    {
        return str_pad(random_int(0, 999999), 6, '0', STR_PAD_LEFT);
    }

    protected function generateToken(): string
    {
        return Str::random(64);
    }
}
