<?php

namespace App\Http\Controllers\Dashboard;

use App\Http\Controllers\Controller;
use App\Http\Requests\Dashboard\Teams\DeleteTeamRequest;
use App\Http\Requests\Dashboard\Teams\StoreTeamRequest;
use App\Http\Requests\Dashboard\Teams\UpdateTeamRequest;
use App\Models\Team;
use App\Services\Dashboard\TeamService;

class TeamController extends Controller
{
    public function __construct(private TeamService $teamService) {}

    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        try {
            $this->authorize('teams.view');

            $teams = Team::orderBy('order')->get();

            return view('Dashboard.Teams.index', compact('teams'));
        } catch (\Exception $e) {
            return redirect()->back()->withErrors(__('dashboard.an error has occurred'));
        }
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        try {
            $this->authorize('teams.create');

            return view('Dashboard.Teams.create');
        } catch (\Exception $e) {
            return redirect()->back()->withErrors(__('dashboard.an error has occurred'));
        }
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(StoreTeamRequest $request)
    {
        $this->authorize('teams.store');

        try {
            $data = $request->validated();

            $response = $this->teamService->store($request, $data);

            if (! $response) {
                return redirect()->back()->with(['error' => __('dashboard.failed_to_add_item')]);
            }

            return redirect()->route('dashboard.teams.index')->with(['success' => __('dashboard.your_item_added_successfully')]);
        } catch (\Exception $e) {
            return redirect()->back()->with(['error' => __('dashboard.failed_to_add_item').' '.$e->getMessage()]);
        }
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(Team $team)
    {
        try {
            $this->authorize('teams.edit');

            return view('Dashboard.Teams.edit', compact('team'));
        } catch (\Exception $e) {
            return redirect()->back()->withErrors(__('dashboard.an error has occurred'));
        }
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(UpdateTeamRequest $request, Team $team)
    {
        $this->authorize('teams.update');

        try {
            $data = $request->validated();

            $response = $this->teamService->update($request, $data, $team);

            if (! $response) {
                return redirect()->back()->with(['error' => __('dashboard.failed_to_update_item')]);
            }

            return redirect()->route('dashboard.teams.index')->with(['success' => __('dashboard.your_item_updated_successfully')]);
        } catch (\Exception $e) {
            return redirect()->back()->with(['error' => __('dashboard.failed_to_update_item')]);
        }
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(DeleteTeamRequest $request, string $id)
    {
        $this->authorize('teams.delete');

        $selectedIds = $request->input('selectedIds');

        try {
            $deleted = $this->teamService->delete($selectedIds);

            if (request()->ajax()) {
                return response()->json(['success' => true, 'message' => __('dashboard.your_items_deleted_successfully')]);
            }

            return redirect()->back()->with(['success' => __('dashboard.your_items_deleted_successfully')]);
        } catch (\Exception $e) {
            if (request()->ajax()) {
                return response()->json(['success' => false, 'message' => __('dashboard.an error has occurred')], 422);
            }

            return redirect()->back()->withErrors(__('dashboard.an error has occurred'));
        }
    }
}
