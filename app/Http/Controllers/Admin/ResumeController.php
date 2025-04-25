<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Resume;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;
use Exception;

class ResumeController extends Controller
{
    public function index()
    {
        try {
            $resumes = Resume::all();
            return view('admin.resume.index', compact('resumes'));
        } catch (Exception $e) {
            return redirect()->back()->with('error', 'Error fetching resumes: ' . $e->getMessage());
        }
    }

    public function create()
    {
        try {
            return view('admin.resume.create');
        } catch (Exception $e) {
            return redirect()->back()->with('error', 'Error loading create form: ' . $e->getMessage());
        }
    }

    public function store(Request $request)
    {
        try {
            // Ensure skills is an array
            if ($request->has('skills') && !is_array($request->skills)) {
                try {
                    $request->merge(['skills' => json_decode($request->skills, true)]);
                    if (!is_array($request->skills)) {
                        throw new \Exception("The skills field must be an array.");
                    }
                } catch (\Exception $e) {
                    throw new \Exception("The skills field must be a valid JSON array.");
                }
            }

            $validated = $request->validate([
                'full_name' => 'required|string|max:255',
                'title' => 'required|string|max:255',
                'email' => 'required|email|max:255',
                'phone' => 'required|string|max:255',
                'location' => 'required|string|max:255',
                'website' => 'nullable|url|max:255',
                'about_me' => 'required|string',
                'photo' => 'nullable|image|max:1024',
                'social_links' => 'nullable|array',
                'skills' => 'nullable|array',
                'languages' => 'nullable|array',
                'is_active' => 'boolean',
            ]);

            if ($request->hasFile('photo')) {
                $path = $request->file('photo')->store('resume', 'public');
                $validated['photo_path'] = $path;
            }

            $resume = Resume::create($validated);

            return redirect()->route('admin.resume.index')
                ->with('success', 'Resume created successfully');
        } catch (Exception $e) {
            return redirect()->back()->with('error', 'Error creating resume: ' . $e->getMessage())
                ->withInput();
        }
    }

    public function show(Resume $resume)
    {
        try {
            return view('admin.resume.show', compact('resume'));
        } catch (Exception $e) {
            return redirect()->back()->with('error', 'Error showing resume: ' . $e->getMessage());
        }
    }

    public function edit(Resume $resume)
    {
        try {
            return view('admin.resume.edit', compact('resume'));
        } catch (Exception $e) {
            return redirect()->back()->with('error', 'Error loading edit form: ' . $e->getMessage());
        }
    }

    public function update(Request $request, Resume $resume)
    {
        try {
            // Ensure skills is an array
            if ($request->has('skills') && !is_array($request->skills)) {
                try {
                    $request->merge(['skills' => json_decode($request->skills, true)]);
                    if (!is_array($request->skills)) {
                        throw new \Exception("The skills field must be an array.");
                    }
                } catch (\Exception $e) {
                    throw new \Exception("The skills field must be a valid JSON array.");
                }
            }

            $validated = $request->validate([
                'full_name' => 'required|string|max:255',
                'title' => 'required|string|max:255',
                'email' => 'required|email|max:255',
                'phone' => 'required|string|max:255',
                'location' => 'required|string|max:255',
                'website' => 'nullable|url|max:255',
                'about_me' => 'required|string',
                'photo' => 'nullable|image|max:1024',
                'social_links' => 'nullable|array',
                'skills' => 'nullable|array',
                'languages' => 'nullable|array',
                'is_active' => 'boolean',
            ]);

            if ($request->hasFile('photo')) {
                if ($resume->photo_path) {
                    Storage::disk('public')->delete($resume->photo_path);
                }
                $path = $request->file('photo')->store('resume', 'public');
                $validated['photo_path'] = $path;
            }

            $resume->update($validated);

            return redirect()->route('admin.resume.index')
                ->with('success', 'Resume updated successfully');
        } catch (Exception $e) {
            return redirect()->back()->with('error', 'Error updating resume: ' . $e->getMessage())
                ->withInput();
        }
    }

    public function destroy(Resume $resume)
    {
        try {
            if ($resume->photo_path) {
                Storage::disk('public')->delete($resume->photo_path);
            }

            $resume->delete();

            return redirect()->route('admin.resume.index')
                ->with('success', 'Resume deleted successfully');
        } catch (Exception $e) {
            return redirect()->back()->with('error', 'Error deleting resume: ' . $e->getMessage());
        }
    }
}
