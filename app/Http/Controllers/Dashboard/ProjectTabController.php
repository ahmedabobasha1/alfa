<?php

namespace App\Http\Controllers\Dashboard;

use App\Http\Controllers\Controller;
use App\Http\Requests\Dashboard\Tabs\DeleteTabRequest;
use App\Http\Requests\Dashboard\Tabs\StoreTabRequest;
use App\Http\Requests\Dashboard\Tabs\UpdateTabRequest;
use App\Models\Project;
use App\Models\Tab;
use App\Services\Dashboard\TabService;

class ProjectTabController extends Controller
{
    protected $tabService;

    public function __construct(TabService $tabService)
    {
        $this->tabService = $tabService;
    }

    /**
     * Display a listing of the resource.
     */
    public function index(Project $project)
    {
        $project->load('tabs');

        return view('Dashboard.Projects.Tabs.index', compact('project'));
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create(Project $project)
    {
        $project->load('tabs');

        return view('Dashboard.Projects.Tabs.create', compact('project'));
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(StoreTabRequest $request, Project $project)
    {
        $this->tabService->store($project, $request->validated());

        return redirect()->route('dashboard.projects.tabs.index', $project->id)->with('success', __('dashboard.tab_created_successfully'));
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(Project $project, Tab $tab)
    {
        // Ensure the tab belongs to this project
        if ($tab->tabbable_id !== $project->id || $tab->tabbable_type !== Project::class) {
            abort(404);
        }

        $project->load('tabs');

        return view('Dashboard.Projects.Tabs.edit', compact('project', 'tab'));
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(UpdateTabRequest $request, Project $project, Tab $tab)
    {
        // Ensure the tab belongs to this project
        if ($tab->tabbable_id !== $project->id || $tab->tabbable_type !== Project::class) {
            abort(404);
        }

        $this->tabService->update($tab, $request->validated());

        return redirect()->route('dashboard.projects.tabs.index', $project->id)->with('success', __('dashboard.tab_updated_successfully'));
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(DeleteTabRequest $request, Project $project, Tab $tab)
    {
        // Ensure the tab belongs to this project
        if ($tab->tabbable_id !== $project->id || $tab->tabbable_type !== Project::class) {
            abort(404);
        }

        $this->tabService->delete($tab);

        return redirect()->route('dashboard.projects.tabs.index', $project->id)->with('success', __('dashboard.tab_deleted_successfully'));
    }
}
