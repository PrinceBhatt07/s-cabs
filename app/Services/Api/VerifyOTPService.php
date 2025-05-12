<?php

namespace App\Services\Api;

use App\Http\Resources\UserResource;
use App\Services\BaseService;

use App\Models\User;
use App\Services\MessageService;
use Exception;

class VerifyOTPService extends BaseService
{
    public function verifyOTP($request)
    {
        try {
            $user = null;
            $token = null;

            if ($request->has('phone')) {
                $user = User::where('phone', $request->phone)->first();
                if (!$user) {
                    return $this->jsonResponse(false, 'User not found' , [] , 404);
                }

                if ($user->sms_otp !== $request->otp) {
                    return $this->jsonResponse(false, 'Invalid OTP', [] , 401);
                }

                if ($user->otp_expires_at < now()) {
                    return $this->jsonResponse(false, 'OTP expired' , [] , 401);
                }

                if($user->is_verified != 1){
                    return $this->jsonResponse(false, 'User is not verified Yet By the Admin' , [] , 401);
                }
                else{
                    $token = $user->createToken('auth_token')->accessToken;
                }

            
                $user->phone_verified = true;
                $user->sms_otp = null;

            }

            elseif ($request->has('email')) {
                $user = User::where('email', $request->email)->first();
                if (!$user) {
                    return $this->jsonResponse(false, 'User not found ', [] , 404);
                }

                if ($user->email_otp !== $request->otp) {
                    return $this->jsonResponse(false, 'Invalid OTP' , [] , 401);
                }

                if ($user->otp_expires_at < now()) {
                    return $this->jsonResponse(false, 'OTP expired' , [] , 401);
                }


                $user->email_verified = true;
                $user->email_otp = null;
            } else {
                return $this->jsonResponse(false, 'Email or phone is required');
            }

            if ($user->email_verified && $user->phone_verified) {
                $user->otp_expires_at = null;
            }

            $user->save();

            $responseData = [
                'customer_id' => $user->id,
                'email_verified' => $user->email_verified,
                'phone_verified' => $user->phone_verified == 1 ? true : false,
                'email' => $user->email,
                'phone' => $user->phone,
                'role' => $user->role,
                'name' => $user->name,
            ];

            if ($token != null) {
                $responseData['token'] = $token;
            }

            return $this->jsonResponse(true, 'OTP verified successfully', $responseData);
        } catch (Exception $e) {
            return $this->jsonResponse(false, 'Something went wrong');
        }
    }

    public function resendOTP($request)
    {
        try {
            $user = null;
    
            if ($request->has('phone')) {
                $user = User::where('phone', $request->phone)->first();
    
                if (!$user) {
                    return $this->jsonResponse(false, 'User not found');
                }
    
                $smsOtp = rand(100000, 999999);
                $user->sms_otp = $smsOtp;
                $user->otp_expires_at = now()->addMinutes(10);
                $user->save();
    
                MessageService::sendSMS($user->phone, "Your OTP is: $smsOtp");
    
                return $this->jsonResponse(true, 'OTP sent to phone successfully');
            }
    
            if ($request->has('email')) {
                $user = User::where('email', $request->email)->first();
    
                if (!$user) {
                    return $this->jsonResponse(false, 'User not found');
                }
    
                $emailOtp = rand(100000, 999999);
                $user->email_otp = $emailOtp;
                $user->otp_expires_at = now()->addMinutes(10);
                $user->save();
    
                MessageService::sendEmail($user->email, 'Email Verification', "Your OTP is: $emailOtp");
    
                return $this->jsonResponse(true, 'OTP sent to email successfully');
            }
    
            return $this->jsonResponse(false, 'Email or phone is required');
        } catch (Exception $e) {
            return $this->jsonResponse(false, 'Something went wrong');
        }
    }

    public function uploadID($request)
    {
        try {
            $user = User::find($request->customer_id);
    
            if (!$user) {
                return $this->jsonResponse(false, 'User not found');
            }
    
            if ($request->hasFile('id_image')) {
                $file = $request->file('id_image');
                $filename = uniqid() . '.' . $file->getClientOriginalExtension();
                
                $path = $file->storeAs('customer/IdProof', $filename, 'public'); 
                
                $token = $user->createToken('auth_token')->accessToken;

                $user->id_proof_path = $path;
                $user->id_proof_status = 'pending';
                $user->fcm_token = $request->fcm_token;
                $user->save();

                $user['token'] = $token;
                
                // $responseData = [
                //     'customer_id' => $user->id,
                //     'email_verified' => $user->email_verified == 1 ? true : false,
                //     'phone_verified' => $user->phone_verified == 1 ? true : false,
                //     'email' => $user->email,
                //     'phone' => $user->phone,
                //     'role' => $user->role,
                //     'name' => $user->name,
                //     'token' => $token,
                // ];

                $responseData = new UserResource($user);
          
                return $this->jsonResponse(true, 'ID proof submitted. You can start your trip after admin approval.', $responseData);
            }
    
            return $this->jsonResponse(false, 'No ID proof file found');
        } catch (Exception $e) {
            return $this->jsonResponse(false, $e->getMessage());
        }
    }
    
    
}
