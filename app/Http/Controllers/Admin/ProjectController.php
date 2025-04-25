<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Resume;
use App\Models\Project;
use Illuminate\Http\Request;

class ProjectController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index(Resume $resume)
    {
        try {
            $projects = $resume->projects()->orderBy('order')->get();
            return view('admin.resume.project.index', compact('resume', 'projects'));
        } catch (\Exception $e) {
            return redirect()->back()->with('error', 'Error fetching projects: ' . $e->getMessage());
        }
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create(Resume $resume)
    {
        try {
            return view('admin.resume.project.create', compact('resume'));
        } catch (\Exception $e) {
            return redirect()->back()->with('error', 'Error loading create form: ' . $e->getMessage());
        }
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request, Resume $resume)
    {
        try {
            // Ensure technologies is an array if it exists
            if ($request->has('technologies') && !is_array($request->technologies)) {
                try {
                    $request->merge(['technologies' => json_decode($request->technologies, true)]);
                    if ($request->has('technologies') && !is_array($request->technologies)) {
                        throw new \Exception("The technologies field must be an array.");
                    }
                } catch (\Exception $e) {
                    throw new \Exception("The technologies field must be a valid JSON array.");
                }
            }

            $validated = $request->validate([
                'name' => 'required|string|max:255',
                'description' => 'required|string',
                'url' => 'nullable|url|max:255',
                'technologies' => 'nullable|array',
                'order' => 'integer',
            ]);

            $resume->projects()->create($validated);

            return redirect()->route('admin.resume.project.index', $resume)
                ->with('success', 'Project added successfully');
        } catch (\Exception $e) {
            return redirect()->back()->with('error', 'Error creating project: ' . $e->getMessage())
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
    public function edit(Resume $resume, Project $project)
    {
        try {
            return view('admin.resume.project.edit', compact('resume', 'project'));
        } catch (\Exception $e) {
            return redirect()->back()->with('error', 'Error loading edit form: ' . $e->getMessage());
        }
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, Resume $resume, Project $project)
    {
        try {
            // Ensure technologies is an array if it exists
            if ($request->has('technologies') && !is_array($request->technologies)) {
                try {
                    $request->merge(['technologies' => json_decode($request->technologies, true)]);
                    if ($request->has('technologies') && !is_array($request->technologies)) {
                        throw new \Exception("The technologies field must be an array.");
                    }
                } catch (\Exception $e) {
                    throw new \Exception("The technologies field must be a valid JSON array.");
                }
            }

            $validated = $request->validate([
                'name' => 'required|string|max:255',
                'description' => 'required|string',
                'url' => 'nullable|url|max:255',
                'technologies' => 'nullable|array',
                'order' => 'integer',
            ]);

            $project->update($validated);

            return redirect()->route('admin.resume.project.index', $resume)
                ->with('success', 'Project updated successfully');
        } catch (\Exception $e) {
            return redirect()->back()->with('error', 'Error updating project: ' . $e->getMessage())
                ->withInput();
        }
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Resume $resume, Project $project)
    {
        try {
            $project->delete();

            return redirect()->route('admin.resume.project.index', $resume)
                ->with('success', 'Project deleted successfully');
        } catch (\Exception $e) {
            return redirect()->back()->with('error', 'Error deleting project: ' . $e->getMessage());
        }
    }
}
