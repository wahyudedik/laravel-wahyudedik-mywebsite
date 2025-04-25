<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Resume;
use App\Models\Education;
use Illuminate\Http\Request;
use Exception;

class EducationController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index(Resume $resume)
    {
        try {
            $educations = $resume->education()->orderBy('order')->get();
            return view('admin.resume.education.index', compact('resume', 'educations'));
        } catch (Exception $e) {
            return redirect()->back()->with('error', 'Error retrieving education records: ' . $e->getMessage());
        }
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create(Resume $resume)
    {
        try {
            return view('admin.resume.education.create', compact('resume'));
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
            // Check if there are any fields that might be JSON strings but should be arrays
            // This is a generic approach since we don't know which field specifically is causing the issue
            foreach ($request->all() as $key => $value) {
                if (is_string($value) && (strpos($value, '[') === 0 || strpos($value, '{') === 0)) {
                    try {
                        $decoded = json_decode($value, true);
                        if (is_array($decoded)) {
                            $request->merge([$key => $decoded]);
                        }
                    } catch (\Exception $e) {
                        return redirect()->back()->with('error', 'Error decoding JSON string: ' . $e->getMessage());
                    }
                }
            }

            $validated = $request->validate([
                'degree' => 'required|string|max:255',
                'institution' => 'required|string|max:255',
                'start_date' => 'required|string|max:255',
                'end_date' => 'nullable|string|max:255',
                'description' => 'nullable|string',
                'order' => 'integer',
            ]);

            $resume->education()->create($validated);

            return redirect()->route('admin.resume.education.index', $resume)
                ->with('success', 'Education added successfully');
        } catch (Exception $e) {
            return redirect()->back()->with('error', 'Error creating education record: ' . $e->getMessage())
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
    public function edit(Resume $resume, Education $education)
    {
        try {
            return view('admin.resume.education.edit', compact('resume', 'education'));
        } catch (Exception $e) {
            return redirect()->back()->with('error', 'Error loading edit form: ' . $e->getMessage());
        }
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, Resume $resume, Education $education)
    {
        try {
            // Check if there are any fields that might be JSON strings but should be arrays
            foreach ($request->all() as $key => $value) {
                if (is_string($value) && (strpos($value, '[') === 0 || strpos($value, '{') === 0)) {
                    try {
                        $decoded = json_decode($value, true);
                        if (is_array($decoded)) {
                            $request->merge([$key => $decoded]);
                        }
                    } catch (\Exception $e) {
                        return redirect()->back()->with('error', 'Error decoding JSON string: ' . $e->getMessage());
                    }
                }
            }

            $validated = $request->validate([
                'degree' => 'required|string|max:255',
                'institution' => 'required|string|max:255',
                'start_date' => 'required|string|max:255',
                'end_date' => 'nullable|string|max:255',
                'description' => 'nullable|string',
                'order' => 'integer',
            ]);

            $education->update($validated);

            return redirect()->route('admin.resume.education.index', $resume)
                ->with('success', 'Education updated successfully');
        } catch (Exception $e) {
            return redirect()->back()->with('error', 'Error updating education record: ' . $e->getMessage())
                ->withInput();
        }
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Resume $resume, Education $education)
    {
        try {
            $education->delete();

            return redirect()->route('admin.resume.education.index', $resume)
                ->with('success', 'Education deleted successfully');
        } catch (Exception $e) {
            return redirect()->back()->with('error', 'Error deleting education record: ' . $e->getMessage());
        }
    }
}
