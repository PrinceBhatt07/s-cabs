<?php

namespace App\Services\Api;
use App\Services\BaseService;

use App\Jobs\SendNotification;
use App\Models\User;

use Exception;
use Illuminate\Support\Facades\Log;
use Illuminate\Support\Facades\DB;

class RegisterService extends BaseService
{
    public function register($request)
    {
        try {

            DB::beginTransaction();

            $smsOtp = rand(100000, 999999);
            $emailOtp = rand(100000, 999999);

            $user = User::updateOrCreate([
                'phone' => $request->phone,
                'email' => $request->email,
            ],[
                'name' => $request->name,
                'role' => $request->role,
                'sms_otp' => $smsOtp,
                'email_otp' => $emailOtp,
                'otp_expires_at' => now()->addMinutes(10),
            ]);

            if (!$user) {
                DB::rollBack();
                return $this->jsonResponse(false, 'Something went wrong');
            }

            $smsMessage = "Your OTP is: $smsOtp";

            $emailMessage = "Your OTP is: $emailOtp";

            $message = [
                'smsMessage' => $smsMessage,
                'emailMessage' => $emailMessage,
                'subject' => 'Email Verification',
            ];

            SendNotification::dispatch($message, $user->phone, $user->email);

            DB::commit();
            return $this->jsonResponse(true, 'Verify your Email and Mobile number');
        } catch (Exception $e) {
            DB::rollBack();
            Log::error('RegisterService Error:', [
                'line' => $e->getLine(),
                'file' => $e->getFile(),
                'trace' => $e->getTraceAsString(),
            ]);
            
            return $this->jsonResponse(false, $e->getMessage());
        }
    }
}
