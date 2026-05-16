<?php

namespace App\Http\Controllers\Dashboard;

use App\Http\Controllers\Controller;
use App\Http\Requests\Dashboard\Services\DeleteServiceRequest;
use App\Http\Requests\Dashboard\Services\StoreServiceRequest;
use App\Http\Requests\Dashboard\Services\UpdateServiceRequest;
use App\Models\Service as ModelsService;
use App\Services\Dashboard\Service;

class ServiceController extends Controller
{
    public function __construct(private Service $service) {}

    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        try {
            $this->authorize('services.view');

            $services = ModelsService::with('parent')->get();

            return view('Dashboard.Services.index', compact('services'));
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
            $this->authorize('services.create');

            $services = ModelsService::with('parent')->get();

            return view('Dashboard.Services.create', compact('services'));

        } catch (\Exception $e) {

            return redirect()->back()->withErrors(__('dashboard.an error has occurred'));
        }
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(StoreServiceRequest $request)
    {
        $this->authorize('services.store');

        try {
            $data = $request->validated();

            $response = $this->service->store($request, $data);

            if (! $response) {

                return redirect()->back()->with(['error' => __('dashboard.failed_to_add_item')]);
            }

            return redirect()->back()->with(['success' => __('dashboard.your_item_added_successfully')]);
        } catch (\Exception $e) {

            return redirect()->back()->with(['error' => __('dashboard.failed_to_add_item').' '.$e->getMessage()]);
        }
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(ModelsService $service)
    {
        try {
            $this->authorize('services.edit');

            $data['service'] = $service->load('images');

            $data['services'] = ModelsService::with('parent')->get();

            return view('Dashboard.Services.edit', $data);
        } catch (\Exception $e) {
            return redirect()->back()->withErrors(__('dashboard.an error has occurred'));
        }
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(UpdateServiceRequest $request, ModelsService $service)
    {
        $this->authorize('services.update');

        try {
            $data = $request->validated();

            $response = $this->service->update($request, $data, $service);

            if (! $response) {
                return redirect()->back()->with(['error' => __('dashboard.failed_to_update_item')]);
            }

            return redirect()->route('dashboard.services.index')->with(['success' => __('dashboard.your_item_updated_successfully')]);
        } catch (\Exception $e) {
            return redirect()->back()->with(['error' => __('dashboard.failed_to_update_item')]);
        }
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(DeleteServiceRequest $request, string $id)
    {
        $this->authorize('services.delete');

        $selectedIds = $request->input('selectedIds');

        try {

            $deleted = $this->service->delete($selectedIds);

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
