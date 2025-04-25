<?php

namespace App\Jobs;

use Illuminate\Bus\Queueable;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Foundation\Bus\Dispatchable;
use Illuminate\Queue\InteractsWithQueue;
use Illuminate\Queue\SerializesModels;
use App\Services\MessageService;
use Exception;
use Illuminate\Support\Facades\Log;

class SendNotification implements ShouldQueue
{
    use Dispatchable, InteractsWithQueue, Queueable, SerializesModels;

    protected $phone;
    protected $email;
    protected $message;

    /**
     * Create a new job instance.
     */
    public function __construct(array $message, ?string $phone = null, ?string $email = null)
    {
        $this->message = $message;
        $this->phone = $phone;
        $this->email = $email;

    }

    /**
     * Execute the job.
     */
    public function handle(MessageService $messageService): void
    {
        try {
            if ($this->phone && isset($this->message['smsMessage'])) {
                Log::info('Sending SMS to ' . $this->phone);
                Log::info('SMS Message: ' . $this->message['smsMessage']);
                
                $messageService->sendSms($this->phone, $this->message['smsMessage']);
            }

            if ($this->email && isset($this->message['emailMessage'], $this->message['subject'])) {
                $messageService->sendEmail($this->email, $this->message['subject'], $this->message['emailMessage']);
            }

            Log::info('Notification sent successfully');
        } catch (Exception $e) {
            Log::error('Notification failed: ' . $e->getMessage() . ' ' . $e->getLine());
        }
    }
}
