<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Feedback;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\URL;

class FeedbackController extends Controller
{
    public function index()
    {
        $feedbacks = Feedback::latest()->paginate(10);
        return view('admin.feedback.index', compact('feedbacks'));
    }
    
    public function create()
    {
        return view('admin.feedback.create');
    }
    
    public function store(Request $request)
    {
        $request->validate([
            'name' => 'required|string|max:255',
            'position' => 'nullable|string|max:255',
        ]);
        
        $feedback = Feedback::create([
            'name' => $request->name,
            'position' => $request->position,
            'content' => '',
            'token' => Feedback::generateToken(),
            'is_published' => false,
        ]);
        
        return redirect()->route('admin.feedback.show', $feedback)
            ->with('success', 'Feedback link created successfully.');
    }
    
    public function show(Feedback $feedback)
    {
        $feedbackUrl = URL::signedRoute('feedback.edit', ['token' => $feedback->token]);
        return view('admin.feedback.show', compact('feedback', 'feedbackUrl'));
    }
    
    public function edit(Feedback $feedback)
    {
        return view('admin.feedback.edit', compact('feedback'));
    }
    
    public function update(Request $request, Feedback $feedback)
    {
        $request->validate([
            'name' => 'required|string|max:255',
            'position' => 'nullable|string|max:255',
            'content' => 'nullable|string',
            'rating' => 'nullable|integer|min:1|max:5',
            'is_published' => 'nullable|boolean',
        ]);
        
        $feedback->update($request->all());
        
        return redirect()->route('admin.feedback.index')
            ->with('success', 'Feedback updated successfully.');
    }
    
    public function destroy(Feedback $feedback)
    {
        $feedback->delete();
        
        return redirect()->route('admin.feedback.index')
            ->with('success', 'Feedback deleted successfully.');
    }
}
