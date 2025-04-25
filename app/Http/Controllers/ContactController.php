<?php

namespace App\Http\Controllers;

use App\Models\User;
use App\Models\Contact;
use App\Mail\ContactReply;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Mail;
use App\Notifications\NewContactMessage;
use App\Jobs\ProcessNewsletterSubscription;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Notification;

class ContactController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        try {
            return view('contact');
        } catch (\Exception $e) {
            return back()->with('error', 'Error loading contact page.' . $e->getMessage());
        }
    }

    public function submit(Request $request)
    {
        // Add rate limiting - 3 submissions per minute
        // $this->middleware('throttle:3,1')->only('submit');

        // If honeypot field is filled, it's likely a bot
        if ($request->filled('website')) {
            return redirect()->back();
        }

        try {
            $validated = $request->validate([
                'name' => 'required|string|max:255',
                'email' => 'required|email|max:255',
                'subject' => 'required|string|max:255',
                'message' => 'required|string',
                // 'newsletter' => 'sometimes|boolean',
            ]);

            // Create contact record
            $contact = Contact::create([
                'name' => $validated['name'],
                'email' => $validated['email'],
                'subject' => $validated['subject'],
                'message' => $validated['message'],
                'newsletter' => $request->has('newsletter'),
            ]);

            // If user subscribed to newsletter, dispatch job
            if ($request->has('newsletter')) {
                ProcessNewsletterSubscription::dispatch($validated['email']);
            }

            // Notify admin(s) about new contact message
            $admins = User::where('is_admin', true)->get();
            foreach ($admins as $admin) {
                $admin->notify(new NewContactMessage($contact));
            }

            return redirect()->back()->with('success', 'Thank you for your message! We will get back to you soon.');
        } catch (\Throwable $th) {
            return redirect()->back()->with('error', 'An error occurred. Please try again later.' . $th->getMessage());
        }
    }

    public function adminIndex()
    {
        try {
            $contacts = Contact::orderBy('created_at', 'desc')->paginate(10);
            return view('admin.contacts.index', compact('contacts'));
        } catch (\Throwable $th) {
            return redirect()->back()->with('error', 'An error occurred while fetching contacts.' . $th->getMessage());
        }
    }

    public function adminShow($id)
    {
        try {
            $contact = Contact::findOrFail($id);

            // Mark as read if not already
            if (!$contact->is_read) {
                $contact->update(['is_read' => true]);
            }

            return view('admin.contacts.show', compact('contact'));
        } catch (\Throwable $th) {
            return redirect()->back()->with('error', 'Contact not found or an error occurred.' . $th->getMessage());
        }
    }

    public function adminDestroy($id)
    {
        try {
            $contact = Contact::findOrFail($id);
            $contact->delete();

            return redirect()->route('admin.contacts.index')
                ->with('success', 'Contact message deleted successfully');
        } catch (\Throwable $th) {
            return redirect()->back()->with('error', 'Failed to delete contact message.' . $th->getMessage());
        }
    }

    public function reply(Request $request, $id)
    {
        try {
            $contact = Contact::findOrFail($id);
            
            $validated = $request->validate([
                'subject' => 'required|string|max:255',
                'message' => 'required|string',
            ]);
            
            // Kirim email menggunakan Mail facade
            Mail::to($contact->email)
                ->send(new ContactReply(
                    $contact->name,
                    $validated['subject'],
                    $validated['message']
                ));
            
            // Log aktivitas reply
            // activity()
            //     ->performedOn($contact)
            //     ->causedBy(Auth::user())
            //     ->log('replied to contact message');
            
            return redirect()->route('admin.contacts.show', $contact->id)
                ->with('success', 'Reply sent successfully to ' . $contact->email);
        } catch (\Exception $e) {
            return redirect()->back()
                ->with('error', 'Failed to send reply: ' . $e->getMessage())
                ->withInput();
        }
    }
}
