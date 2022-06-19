<?php

namespace App\Http\Controllers;

use Inertia\Inertia;
use App\Models\Project;
use Illuminate\Http\Request;
use Illuminate\Validation\Rule;
use Illuminate\Support\Facades\File;

class ProjectController extends Controller
{
    public function index()
    {
        return Inertia::render('Projects/All', [
            'projects' => Project::all(),
            'availableColors' => Project::getAvailableTextColors(),
            'availableIcons' => Project::getAvailableIcons(),
        ]);
    }

    public function store(Request $request)
    {
        $request->validate([
            'title' => [
                'required',
                'max:255',
                Rule::unique(Project::class)
            ],
            'description' => [
                'required',
                'max:255',
            ],
            'link' => [
                'required',
                'max:255',
            ],
            'logo' => [
                'required',
                'image',
            ],
        ]);

        $project = Project::create($request->all());

        if($request->hasFile('logo')) {
            $path = 'storage/' . $request->logo->store('project-logos', 'public');
            $project->logo_path = $path;
            $project->save();
        }

        return redirect()->route('projects.index');
    }

    public function update(Request $request, Project $project)
    {
        $request->validate([
            'title' => [
                'required',
                'max:255',
                Rule::unique(Project::class)->ignore($project->id)
            ],
            'description' => [
                'required',
                'max:255',
            ],
            'link' => [
                'required',
                'max:255',
            ],
            'logo' => [
                'nullable',
                'image',
            ],
        ]);

        $project->update($request->all());

        if($request->hasFile('logo')) {
            File::delete($project->logo_path); 
            $path = 'storage/' . $request->logo->store('project-logos', 'public');
            
            $project->logo_path = $path;
            $project->save();
        }

        return redirect()->route('projects.index');
    }

    public function destroy(Project $project)
    {
        $project->delete();

        return redirect()->route('projects.index');
    }
}
