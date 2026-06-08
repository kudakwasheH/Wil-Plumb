<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Project;
use Illuminate\Http\Request;
use Illuminate\Support\Str;
use Illuminate\Support\Facades\Storage;

class ProjectController extends Controller
{
    public function index()
    {
        $projects = Project::orderBy('completion_date', 'desc')->get();
        return view('admin.projects.index', compact('projects'));
    }

    public function create()
    {
        return view('admin.projects.create');
    }

    public function store(Request $request)
    {
        $request->validate([
            'title' => 'required|string|max:150|unique:projects,title',
            'description' => 'required|string',
            'location' => 'required|string|max:100',
            'category' => 'required|in:Residential,Commercial,Emergency',
            'completion_date' => 'required|date',
            'before_image' => 'required|image|mimes:jpeg,png,jpg,gif,svg|max:2048',
            'after_image' => 'required|image|mimes:jpeg,png,jpg,gif,svg|max:2048',
        ]);

        $beforePath = $request->file('before_image')->store('projects', 'public');
        $afterPath = $request->file('after_image')->store('projects', 'public');

        Project::create([
            'title' => $request->title,
            'slug' => Str::slug($request->title),
            'description' => $request->description,
            'location' => $request->location,
            'category' => $request->category,
            'completion_date' => $request->completion_date,
            'before_image' => $beforePath,
            'after_image' => $afterPath,
            'is_featured' => $request->has('is_featured'),
        ]);

        return redirect()->route('admin.projects.index')->with('success', 'Project created successfully.');
    }

    public function edit(Project $project)
    {
        return view('admin.projects.edit', compact('project'));
    }

    public function update(Request $request, Project $project)
    {
        $request->validate([
            'title' => 'required|string|max:150|unique:projects,title,' . $project->id,
            'description' => 'required|string',
            'location' => 'required|string|max:100',
            'category' => 'required|in:Residential,Commercial,Emergency',
            'completion_date' => 'required|date',
            'before_image' => 'nullable|image|mimes:jpeg,png,jpg,gif,svg|max:2048',
            'after_image' => 'nullable|image|mimes:jpeg,png,jpg,gif,svg|max:2048',
        ]);

        $beforePath = $project->before_image;
        if ($request->hasFile('before_image')) {
            if ($beforePath && Storage::disk('public')->exists($beforePath)) {
                Storage::disk('public')->delete($beforePath);
            }
            $beforePath = $request->file('before_image')->store('projects', 'public');
        }

        $afterPath = $project->after_image;
        if ($request->hasFile('after_image')) {
            if ($afterPath && Storage::disk('public')->exists($afterPath)) {
                Storage::disk('public')->delete($afterPath);
            }
            $afterPath = $request->file('after_image')->store('projects', 'public');
        }

        $project->update([
            'title' => $request->title,
            'slug' => Str::slug($request->title),
            'description' => $request->description,
            'location' => $request->location,
            'category' => $request->category,
            'completion_date' => $request->completion_date,
            'before_image' => $beforePath,
            'after_image' => $afterPath,
            'is_featured' => $request->has('is_featured'),
        ]);

        return redirect()->route('admin.projects.index')->with('success', 'Project updated successfully.');
    }

    public function destroy(Project $project)
    {
        if ($project->before_image && Storage::disk('public')->exists($project->before_image)) {
            Storage::disk('public')->delete($project->before_image);
        }
        if ($project->after_image && Storage::disk('public')->exists($project->after_image)) {
            Storage::disk('public')->delete($project->after_image);
        }
        $project->delete();

        return redirect()->route('admin.projects.index')->with('success', 'Project deleted successfully.');
    }
}
