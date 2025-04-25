<?php

namespace App\Http\Controllers;

use App\Models\Newsletter;
use App\Mail\NewsletterMail;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Mail;

class NewsletterController extends Controller
{
    public function index()
    {
        try {
            $subscribers = Newsletter::orderBy('created_at', 'desc')->paginate(10);
            return view('admin.newsletter.index', compact('subscribers'));
        } catch (\Exception $e) {
            return redirect()->back()->with('error', 'An error occurred while fetching subscribers.' . $e->getMessage());
        }
    }

    public function destroy($id)
    {
        try {
            $subscriber = Newsletter::findOrFail($id);
            $subscriber->delete();

            return redirect()->route('admin.newsletter.index')
                ->with('success', 'Subscriber removed successfully');
        } catch (\Exception $e) {
            return redirect()->back()->with('error', 'An error occurred while removing the subscriber.' . $e->getMessage());
        }
    }

    public function toggleStatus($id)
    {
        try {
            $subscriber = Newsletter::findOrFail($id);
            $subscriber->update(['is_active' => !$subscriber->is_active]);

            $status = $subscriber->is_active ? 'activated' : 'deactivated';
            return redirect()->route('admin.newsletter.index')
                ->with('success', "Subscriber {$status} successfully");
        } catch (\Exception $e) {
            return redirect()->back()->with('error', 'An error occurred while updating subscriber status.' . $e->getMessage());
        }
    }

    public function unsubscribe(Request $request)
    {
        try {
            $validated = $request->validate([
                'email' => 'required|email|exists:newsletters,email',
            ]);

            $subscriber = Newsletter::where('email', $validated['email'])->first();

            if ($subscriber) {
                $subscriber->update(['is_active' => false]);
                return redirect()->back()->with('success', 'You have been successfully unsubscribed from our newsletter.');
            }

            return redirect()->back()->with('error', 'Email not found in our subscriber list.');
        } catch (\Exception $e) {
            return redirect()->back()->with('error', 'An error occurred while processing your unsubscribe request.' . $e->getMessage());
        }
    }

    // Add these methods to the NewsletterController
    public function showSendForm()
    {
        return view('admin.newsletter.send');
    }

    public function send(Request $request)
    {
        $validated = $request->validate([
            'subject' => 'required|string|max:255',
            'content' => 'required|string',
            'test_email' => 'nullable|email',
            'confirm' => 'required|accepted',
        ]);

        $subject = $validated['subject'];
        $content = $validated['content'];
        $testEmail = $request->input('test_email');

        try {
            if ($testEmail) {
                // Send only to test email
                Mail::to($testEmail)->send(new NewsletterMail($subject, $content));
                return redirect()->back()->with('success', "Test newsletter sent to {$testEmail}");
            } else {
                // Get all active subscribers
                $subscribers = Newsletter::where('is_active', true)->get();

                if ($subscribers->isEmpty()) {
                    return redirect()->back()->with('error', 'No active subscribers found.');
                }

                // Queue the newsletter sending process
                foreach ($subscribers as $subscriber) {
                    Mail::to($subscriber->email)->queue(new NewsletterMail($subject, $content));
                }

                return redirect()->back()->with('success', "Newsletter queued for sending to {$subscribers->count()} subscribers.");
            }
        } catch (\Exception $e) {
            return redirect()->back()->with('error', 'Failed to send newsletter: ' . $e->getMessage());
        }
    }
}
