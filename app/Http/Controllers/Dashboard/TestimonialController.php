<?php

namespace App\Http\Controllers\Dashboard;

use App\Http\Controllers\Controller;
use App\Http\Requests\Dashboard\Testimonials\DeleteTestimonialsRequest;
use App\Http\Requests\Dashboard\Testimonials\StoreTestimonialsRequest;
use App\Http\Requests\Dashboard\Testimonials\UpdateTestimonialsRequest;
use App\Models\Testimonial;
use App\Services\Dashboard\TestimonialService;

class TestimonialController extends Controller
{
    public function __construct(private TestimonialService $testimonial_service) {}

    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $this->authorize('testimonials.update');

        $testimonials = Testimonial::all();

        return view('Dashboard.Testimonials.index', compact('testimonials'));
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        $this->authorize('testimonials.create');

        return view('Dashboard.Testimonials.create');
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(StoreTestimonialsRequest $request)
    {

        $this->authorize('testimonials.store');

        try {

            $data = $request->validated();

            $response = $this->testimonial_service->store($request, $data);

            if ($response) {
                return redirect()->route('dashboard.testimonials.index')->with('success', 'Testimonial created successfully.');
            } else {
                return redirect()->back()->with('error', 'Error occurred while creating testimonial.');
            }

        } catch (\Exception $e) {

            return redirect()->back()->with('error', 'Error occurred while creating testimonial: '.$e->getMessage());
        }
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(Testimonial $testimonial)
    {

        $this->authorize('testimonials.edit');

        return view('Dashboard.Testimonials.edit', compact('testimonial'));
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(UpdateTestimonialsRequest $request, Testimonial $testimonial)
    {
        $this->authorize('testimonials.update');

        try {

            $data = $request->validated();

            $response = $this->testimonial_service->update($request, $data, $testimonial);

            if ($response) {
                return redirect()->route('dashboard.testimonials.index')->with('success', 'Testimonial updated successfully.');
            } else {
                return redirect()->back()->with('error', 'Error occurred while updating testimonial.');
            }

        } catch (\Exception $e) {
            return redirect()->back()->with('error', 'Error occurred while updating testimonial: '.$e->getMessage());
        }
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(DeleteTestimonialsRequest $request)
    {

        $this->authorize('testimonials.delete');

        $selectedIds = $request->input('selectedIds');

        $data = $request->validated();

        $deleted = $this->testimonial_service->delete($selectedIds, $data);

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
