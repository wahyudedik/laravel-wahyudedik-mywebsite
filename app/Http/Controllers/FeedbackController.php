<?php

namespace App\Http\Controllers;

use App\Models\Feedback;
use Illuminate\Http\Request;

class FeedbackController extends Controller
{
    public function edit($token)
    {
        $feedback = Feedback::where('token', $token)->firstOrFail();
        return view('feedback.edit', compact('feedback'));
    }
    
    public function update(Request $request, $token)
    {
        $feedback = Feedback::where('token', $token)->firstOrFail();
        
        $request->validate([
            'content' => 'required|string|min:10',
            'rating' => 'required|integer|min:1|max:5',
        ]);
        
        $feedback->update([
            'content' => $request->content,
            'rating' => $request->rating,
        ]);
        
        return redirect()->route('feedback.thank-you');
    }
    
    public function thankYou()
    {
        return view('feedback.thank-you');
    }
}
