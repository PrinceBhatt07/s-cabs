<?php

namespace App\Services\Api;
use App\Services\BaseService;
use App\Services\MessageService;
use App\Models\User;
use Exception;
use Illuminate\Support\Facades\Log;
use Illuminate\Support\Facades\DB;

class LoginService extends BaseService
{
    public function login($request)
    {
        try {
            $user = User::where('phone', $request->phone)->first();
            if (!$user) {
                return $this->jsonResponse(false, 'User not found');
            }

            $smsOtp = rand(100000, 999999);
            $user->sms_otp = $smsOtp;
            $user->otp_expires_at = now()->addMinutes(10);
            $user->save();
            $smsMessage = "Your OTP is: $smsOtp";
           
            MessageService::sendSMS($user->phone,$smsMessage);

            $token = $user->createToken('auth_token')->accessToken;

            return $this->jsonResponse(true, 'Verify Your OTP');
            
        } catch (Exception $e) {
            Log::error('LoginService Error:', [
                'line' => $e->getLine(),
                'file' => $e->getFile(),
                'trace' => $e->getTraceAsString(),
            ]);
            return $this->jsonResponse(false, 'Something went wrong');
        }
    }
}