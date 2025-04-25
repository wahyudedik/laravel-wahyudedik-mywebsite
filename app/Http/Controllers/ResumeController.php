<?php

namespace App\Http\Controllers;

use App\Models\Resume;
use Illuminate\Http\Request;

class ResumeController extends Controller
{
    public function index()
    {
        try {
            $resume = Resume::where('is_active', true)
                ->with(['workExperiences', 'education', 'projects'])
                ->first();

            if (!$resume) {
                return view('resume', ['resume' => null]);
            }

            return view('resume', ['resume' => $resume]);
        } catch (\Exception $e) {
            return response()->json(['error' => 'Error retrieving resumes' . ' ' . $e->getMessage()], 500);
        }
    }
}
