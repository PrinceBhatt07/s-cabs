<?php

namespace App\Http\Controllers\Api\Auth;

use App\Http\Controllers\Controller;
use App\Http\Requests\ResendOTPRequest;
use App\Http\Requests\UploadCustomerIDRequest;
use App\Http\Requests\VerifyOTPRequest;
use App\Services\Api\VerifyOTPService;
use Illuminate\Http\Request;
use Twilio\Rest\Verify;

class VerificationController extends Controller
{
    public function verifyOTP(VerifyOTPRequest $request)
    {
        return (new VerifyOTPService())->verifyOTP($request);
    }

    public function resendOTP(ResendOTPRequest $request)
    {
        return (new VerifyOTPService())->resendOTP($request);
    }

    public function uploadID(UploadCustomerIDRequest $request)
    {
        return (new VerifyOTPService())->uploadID($request);
    }
}
