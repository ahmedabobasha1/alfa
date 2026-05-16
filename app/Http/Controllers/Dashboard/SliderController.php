<?php

namespace App\Http\Controllers\Dashboard;

use App\Http\Controllers\Controller;
use App\Http\Requests\Dashboard\Sliders\DeleteSliderRequest;
use App\Http\Requests\Dashboard\Sliders\StoreSliderRequest;
use App\Http\Requests\Dashboard\Sliders\UpdateSliderRequest;
use App\Models\Slider;
use App\Services\Dashboard\SliderService;

class SliderController extends Controller
{
    public function __construct(private SliderService $sliderService) {}

    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $this->authorize('sliders.view');

        $sliders = Slider::all();

        return view('Dashboard.Sliders.index', compact('sliders'));
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        $this->authorize('sliders.create');

        return view('Dashboard.Sliders.create');
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(StoreSliderRequest $request)
    {
        $this->authorize('sliders.store');

        try {
            $data = $request->validated();

            $response = $this->sliderService->store($data, $request);
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
    public function edit(Slider $slider)
    {
        $this->authorize('sliders.edit');

        return view('Dashboard.Sliders.edit', compact('slider'));
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(UpdateSliderRequest $request, Slider $slider)
    {

        $this->authorize('sliders.update');

        try {
            $data = $request->validated();

            $response = $this->sliderService->update($request, $data, $slider);
            if (! $response) {
                return redirect()->back()->with(['error' => __('dashboard.failed_to_update_item')]);
            }

            return redirect('dashboard/sliders')->with(['success' => __('dashboard.your_item_updated_successfully')]);
        } catch (\Exception $e) {

            return redirect()->back()->with(['error' => __('dashboard.failed_to_update_item').' '.$e->getMessage()]);
        }
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(DeleteSliderRequest $request)
    {

        $this->authorize('sliders.delete');

        $selectedIds = $request->input('selectedIds');

        $data = $request->validated();

        $deleted = $this->sliderService->delete($selectedIds, $data);

        if (request()->ajax()) {
            if (! $deleted) {
                return response()->json(['message' => $deleted ?? __('dashboard.an messages.error entering data')], 422);
            }

            return response()->json(['success' => true, 'message' => __('dashboard.your_items_deleted_successfully')]);
        }
        if (! $deleted) {
            return redirect()->back()->withErrors($delete ?? __('dashboard.an error has occurred. Please contact the developer to resolve the issue'));
        }
    }
}
