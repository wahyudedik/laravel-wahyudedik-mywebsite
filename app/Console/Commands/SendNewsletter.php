<?php

namespace App\Console\Commands;

use App\Models\Newsletter;
use Illuminate\Console\Command;
use Illuminate\Support\Facades\Log;
use Illuminate\Support\Facades\Mail;
use App\Mail\NewsletterMail;


class SendNewsletter extends Command
{
    /**
     * The name and signature of the console command.
     *
     * @var string
     */
    protected $signature = 'newsletter:send {subject} {--message=} {--file=}';

    /**
     * The console command description.
     *
     * @var string
     */
    protected $description = 'Send newsletter to all active subscribers';

    /**
     * Execute the console command.
     */
    public function handle()
    {
        $subject = $this->argument('subject');
        $message = $this->option('message');
        $file = $this->option('file');
        
        if (!$message && !$file) {
            $this->error('You must provide either a message or a file path.');
            return 1;
        }
        
        if ($file && !file_exists($file)) {
            $this->error("File not found: {$file}");
            return 1;
        }
        
        $content = $message ?: file_get_contents($file);
        
        $subscribers = Newsletter::where('is_active', true)->get();
        $count = $subscribers->count();
        
        if ($count === 0) {
            $this->info('No active subscribers found.');
            return 0;
        }
        
        $this->info("Preparing to send newsletter to {$count} subscribers...");
        $bar = $this->output->createProgressBar($count);
        $bar->start();

        foreach ($subscribers as $subscriber) {
            try {
                // Send the newsletter email using Laravel's Mail facade
                Mail::to($subscriber->email)->send(new NewsletterMail($subject, $content));

                // Log successful sending
                Log::info("Newsletter sent to: {$subscriber->email}", [
                    'subject' => $subject
                ]);

                // Advance the progress bar
                $bar->advance();

                // Add a small delay to prevent overwhelming the mail server
                usleep(100000); // 100ms delay

            } catch (\Exception $e) {
                // Log the error
                Log::error("Failed to send newsletter to: {$subscriber->email}", [
                    'error' => $e->getMessage(),
                    'trace' => $e->getTraceAsString()
                ]);

                // Report the error to the console
                $this->error("Failed to send to {$subscriber->email}: {$e->getMessage()}");

                // Still advance the progress bar
                $bar->advance();
            }
        }

        $bar->finish();
        $this->newLine();
        $this->info('Newsletter sending process completed!');
        
        return 0;
    }
}
