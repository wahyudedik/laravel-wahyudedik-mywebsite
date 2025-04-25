<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Resume;
use App\Models\WorkExperience;
use Illuminate\Http\Request;
use Exception;

class WorkExperienceController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index(Resume $resume)
    {
        try {
            $experiences = $resume->workExperiences()->orderBy('order')->get();
            return view('admin.resume.experience.index', compact('resume', 'experiences'));
        } catch (Exception $e) {
            return redirect()->back()->with('error', 'Error fetching work experiences: ' . $e->getMessage());
        }
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create(Resume $resume)
    {
        try {
            return view('admin.resume.experience.create', compact('resume'));
        } catch (Exception $e) {
            return redirect()->back()->with('error', 'Error loading create form: ' . $e->getMessage());
        }
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request, Resume $resume)
    {
        try {
            // Ensure responsibilities is an array if it exists
            if ($request->has('responsibilities') && !is_array($request->responsibilities)) {
                try {
                    $request->merge(['responsibilities' => json_decode($request->responsibilities, true)]);
                    if ($request->has('responsibilities') && !is_array($request->responsibilities)) {
                        throw new \Exception("The responsibilities field must be an array.");
                    }
                } catch (\Exception $e) {
                    throw new \Exception("The responsibilities field must be a valid JSON array.");
                }
            }

            $validated = $request->validate([
                'position' => 'required|string|max:255',
                'company' => 'required|string|max:255',
                'start_date' => 'required|string|max:255',
                'end_date' => 'nullable|string|max:255',
                'current_job' => 'boolean',
                'description' => 'required|string',
                'responsibilities' => 'nullable|array',
                'order' => 'integer',
            ]);

            $resume->workExperiences()->create($validated);

            return redirect()->route('admin.resume.experience.index', $resume)
                ->with('success', 'Work experience added successfully');
        } catch (Exception $e) {
            return redirect()->back()->with('error', 'Error creating work experience: ' . $e->getMessage())
                ->withInput();
        }
    }

    /**
     * Display the specified resource.
     */
    public function show(string $id)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(Resume $resume, WorkExperience $experience)
    {
        try {
            return view('admin.resume.experience.edit', compact('resume', 'experience'));
        } catch (Exception $e) {
            return redirect()->back()->with('error', 'Error loading edit form: ' . $e->getMessage());
        }
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, Resume $resume, WorkExperience $experience)
    {
        try {
            // Ensure responsibilities is an array if it exists
            if ($request->has('responsibilities') && !is_array($request->responsibilities)) {
                try {
                    $request->merge(['responsibilities' => json_decode($request->responsibilities, true)]);
                    if ($request->has('responsibilities') && !is_array($request->responsibilities)) {
                        throw new \Exception("The responsibilities field must be an array.");
                    }
                } catch (\Exception $e) {
                    throw new \Exception("The responsibilities field must be a valid JSON array.");
                }
            }

            $validated = $request->validate([
                'position' => 'required|string|max:255',
                'company' => 'required|string|max:255',
                'start_date' => 'required|string|max:255',
                'end_date' => 'nullable|string|max:255',
                'current_job' => 'boolean',
                'description' => 'required|string',
                'responsibilities' => 'nullable|array',
                'order' => 'integer',
            ]);

            $experience->update($validated);

            return redirect()->route('admin.resume.experience.index', $resume)
                ->with('success', 'Work experience updated successfully');
        } catch (Exception $e) {
            return redirect()->back()->with('error', 'Error updating work experience: ' . $e->getMessage())
                ->withInput();
        }
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Resume $resume, WorkExperience $experience)
    {
        try {
            $experience->delete();

            return redirect()->route('admin.resume.experience.index', $resume)
                ->with('success', 'Work experience deleted successfully');
        } catch (Exception $e) {
            return redirect()->back()->with('error', 'Error deleting work experience: ' . $e->getMessage());
        }
    }
}
