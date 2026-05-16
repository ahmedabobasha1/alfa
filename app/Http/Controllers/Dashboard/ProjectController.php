<?php

namespace App\Http\Controllers\Dashboard;

use App\Http\Controllers\Controller;
use App\Http\Requests\Dashboard\Projects\DeleteProjectRequest;
use App\Http\Requests\Dashboard\Projects\StoreProjectRequest;
use App\Http\Requests\Dashboard\Projects\UpdateProjectRequest;
use App\Models\Category;
use App\Models\Project;
use App\Services\Dashboard\ProjectService;
use Illuminate\Support\Facades\Log;

class ProjectController extends Controller
{
    public function __construct(private ProjectService $projectService) {}

    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $this->authorize('projects.view');
        try {

            $projects = Project::with(['parent', 'category'])->orderBy('id', 'desc')->get();

            return view('Dashboard.Projects.index', compact('projects'));
        } catch (\Exception $e) {
            return redirect()->back()->withErrors(__('dashboard.an error has occurred').' '.$e->getMessage());
        }
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        $this->authorize('projects.create');
        try {

            $data['projects'] = Project::with(['parent', 'category'])->get();
            $data['categories'] = Category::with('parent')->get();

            return view('Dashboard.Projects.create', $data);
        } catch (\Exception $e) {
            Log::error('Error accessing project create form: '.$e->getMessage());

            return redirect()->back()->withErrors(__('dashboard.an error has occurred').' '.$e->getMessage());
        }
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(StoreProjectRequest $request)
    {
        $this->authorize('projects.store');
        try {
            $data = $request->validated();

            $response = $this->projectService->store($request, $data);

            if (! $response) {

                return redirect()->back()->with(['error' => __('dashboard.failed_to_create_item')]);
            }

            return redirect()->route('dashboard.projects.index')->with(['success' => __('dashboard.your_item_created_successfully')]);
        } catch (\Exception $e) {
            Log::error('Error creating project: '.$e->getMessage());

            return redirect()->back()->with('error', $e->getMessage());
        }
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(Project $project)
    {
        $this->authorize('projects.edit');
        try {
            $data['project'] = $project;
            $data['projects'] = Project::with(['parent', 'category'])->get();

            $data['categories'] = Category::with('parent')->get();

            return view('Dashboard.Projects.edit', $data);
        } catch (\Exception $e) {

            return redirect()->back()->withErrors(__('dashboard.an error has occurred').' '.$e->getMessage());
        }
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(UpdateProjectRequest $request, Project $project)
    {
        $this->authorize('projects.update');

        try {
            $data = $request->validated();

            $response = $this->projectService->update($request, $data, $project);

            if (! $response) {
                return redirect()->back()->with(['error' => __('dashboard.failed_to_update_item')]);
            }

            return redirect()->route('dashboard.projects.index')->with(['success' => __('dashboard.your_item_updated_successfully')]);
        } catch (\Exception $e) {
            Log::error('Error updating project: '.$e->getMessage(), ['project_id' => $project->id]);

            return redirect()->back()->with('error', $e->getMessage());
        }
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(DeleteProjectRequest $request, string $id)
    {
        $this->authorize('projects.delete');

        $selectedIds = $request->input('selectedIds', [$id]);

        try {
            $deleted = $this->projectService->delete($selectedIds);

            if (request()->ajax()) {
                return response()->json([
                    'success' => true,
                    'message' => __('dashboard.your_items_deleted_successfully'),
                ]);
            }

            return redirect()->back()
                ->with('success', __('dashboard.your_items_deleted_successfully'));
        } catch (\Exception $e) {

            if (request()->ajax()) {
                return response()->json([
                    'success' => false,
                    'message' => __('dashboard.an_error_occurred'.' '.$e->getMessage()),
                ], 500);
            }

            return redirect()->back()
                ->withErrors(__('dashboard.an_error_occurred'));
        }
    }
}
