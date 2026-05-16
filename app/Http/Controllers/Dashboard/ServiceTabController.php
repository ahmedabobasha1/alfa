<?php

namespace App\Http\Controllers\Dashboard;

use App\Http\Controllers\Controller;
use App\Http\Requests\Dashboard\Tabs\DeleteTabRequest;
use App\Http\Requests\Dashboard\Tabs\StoreTabRequest;
use App\Http\Requests\Dashboard\Tabs\UpdateTabRequest;
use App\Models\Service;
use App\Models\Tab;
use App\Services\Dashboard\TabService;

class ServiceTabController extends Controller
{
    protected $tabService;

    public function __construct(TabService $tabService)
    {
        $this->tabService = $tabService;
    }

    /**
     * Display a listing of the resource.
     */
    public function index(Service $service)
    {
        $service->load('tabs');

        return view('Dashboard.Services.Tabs.index', compact('service'));
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create(Service $service)
    {

        $service->load('tabs');

        return view('Dashboard.Services.Tabs.create', compact('service'));
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(StoreTabRequest $request, Service $service)
    {
        $this->tabService->store($service, $request->validated());

        return redirect()->route('dashboard.services.tabs.index', $service->id)->with('success', __('dashboard.tab_created_successfully'));
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(Service $service, Tab $tab)
    {
        // Ensure the tab belongs to this service
        if ($tab->tabbable_id !== $service->id || $tab->tabbable_type !== Service::class) {
            abort(404);
        }

        $service->load('tabs');

        return view('Dashboard.Services.Tabs.edit', compact('service', 'tab'));
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(UpdateTabRequest $request, Service $service, Tab $tab)
    {
        // Ensure the tab belongs to this service
        if ($tab->tabbable_id !== $service->id || $tab->tabbable_type !== Service::class) {
            abort(404);
        }

        $this->tabService->update($tab, $request->validated());

        return redirect()->route('dashboard.services.tabs.index', $service->id)->with('success', __('dashboard.tab_updated_successfully'));
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(DeleteTabRequest $request, Service $service, Tab $tab)
    {
        // Ensure the tab belongs to this service
        if ($tab->tabbable_id !== $service->id || $tab->tabbable_type !== Service::class) {
            abort(404);
        }

        $this->tabService->delete($tab);

        return redirect()->route('dashboard.services.tabs.index', $service->id)->with('success', __('dashboard.tab_deleted_successfully'));
    }
}
