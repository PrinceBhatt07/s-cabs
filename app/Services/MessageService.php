<?php

namespace App\Services;

use App\Mail\EmailNotification;
use Exception;
use Illuminate\Support\Facades\Log;
use Illuminate\Support\Facades\Mail;
use Twilio\Rest\Client;

class MessageService
{
    public static function sendSms($mobile_no, $message)
    {
        try {
            $twilio = new Client(config('app.twilio.sid'), config('app.twilio.token'));

            $message =  $twilio->messages->create(
                $mobile_no,
                [
                    'from' => config('app.twilio.from'),
                    'body' => $message,
                ]
            );

            Log::info($message);
            return $message;
        } catch (Exception $e) {
            Log::error($e->getMessage(), [
                'line' => $e->getLine(),
                'file' => $e->getFile(),
                'trace' => $e->getTraceAsString(),
            ]);
        }
    }

    public static function sendEmail($email, $subject, $message)
    {
        try{
            $sendMail = Mail::to($email)->send(new EmailNotification($subject, $message));
            return $sendMail;
        }
        catch(Exception $e){
            Log::error($e->getMessage());
        }
    }
}
