<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Project;
use Illuminate\Support\Facades\Session;
use App\Helper\MHelper;

class ProjectController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $rows = Project::latest()->get();
        $projectsTimes = Project::with("tmas")->latest()->get();
        $totalTimesPerProject = MHelper::totalTimesPerProject($projectsTimes);

        return view("projects.index", compact('rows', 'totalTimesPerProject'));
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        return view('projects.create');
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        $request->validate([
            'name' => 'required',
        ]);

        Project::create([
            'name' => $request->name,
        ]);

        return redirect()->route('projects.index')->with('create', 'Project Successfully Created');
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit($id)
    {
        $row = Project::findOrFail($id);
        return view('projects.edit', compact('row'));
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, $id)
    {
        // Validate the data
        $request->validate([
            'name' => 'required|max:100',
        ]);

        $project = Project::findOrFail($id);
        $project->update(['name' => $request->name]);

        return redirect()->route('projects.index')->with('update', 'Project updated successfully');
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy($id)
    {
        $project = Project::findOrFail($id);

        try {
            $project->delete();
        } catch (\Illuminate\Database\QueryException $e) {
            if ($e->errorInfo[1] == 1451) {
                return redirect()->route('projects.index')->with('error', 'Cannot delete or update project: it is referenced by one or more TMA records.');
            } else {
                return redirect()->route('projects.index')->with('error', 'Database error occurred.');
            }
        }

        return redirect()->route('projects.index')->with('delete', 'Successfully deleted');
    }
}
