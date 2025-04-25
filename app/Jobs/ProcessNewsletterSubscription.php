<?php

namespace App\Jobs;

use App\Mail\WelcomeEmail;
use App\Models\Newsletter;
use Illuminate\Bus\Queueable;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Foundation\Bus\Dispatchable;
use Illuminate\Queue\InteractsWithQueue;
use Illuminate\Queue\SerializesModels;
use Illuminate\Support\Facades\Log;
use Illuminate\Support\Facades\Mail;

class ProcessNewsletterSubscription implements ShouldQueue
{
    use Dispatchable, InteractsWithQueue, Queueable, SerializesModels;

    protected $email;

    public function __construct(string $email)
    {
        $this->email = $email;
    }

    public function handle(): void
    {
        try {
            // Create or update the newsletter subscription
            $subscriber = Newsletter::updateOrCreate(
                ['email' => $this->email],
                ['is_active' => true]
            );
            
            // Send a welcome email to the subscriber
            Mail::to($this->email)->send(new WelcomeEmail($this->email));
            
            Log::info('Newsletter subscription processed successfully', [
                'email' => $this->email,
                'welcome_email_sent' => true
            ]);
        } catch (\Exception $e) {
            Log::error('Failed to process newsletter subscription', [
                'email' => $this->email,
                'error' => $e->getMessage()
            ]);
        }
    }
}
