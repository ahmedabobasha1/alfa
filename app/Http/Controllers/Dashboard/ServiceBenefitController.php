<?php

namespace App\Http\Controllers\Dashboard;

use App\Http\Controllers\Controller;
use App\Http\Requests\Dashboard\Benefits\DeleteBenefitRequest;
use App\Http\Requests\Dashboard\Benefits\StoreBenefitRequest;
use App\Http\Requests\Dashboard\Benefits\UpdateBenefitRequest;
use App\Models\Benefit;
use App\Models\Service;
use App\Services\Dashboard\BenefitService;

class ServiceBenefitController extends Controller
{
    protected $benefitService;

    public function __construct(BenefitService $benefitService)
    {
        $this->benefitService = $benefitService;
    }

    /**
     * Display a listing of the resource.
     */
    public function index(Service $service)
    {
        $service->load('benefits');

        return view('Dashboard.Services.Benefits.index', compact('service'));
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create(Service $service)
    {
        $service->load('benefits');

        return view('Dashboard.Services.Benefits.create', compact('service'));
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(StoreBenefitRequest $request, Service $service)
    {
        $this->benefitService->store($service, $request->validated());

        return redirect()->route('dashboard.services.benefits.index', $service->id)->with('success', __('dashboard.benefit_created_successfully'));
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(Service $service, Benefit $benefit)
    {
        // Ensure the benefit belongs to this service
        if ($benefit->benefitable_id !== $service->id || $benefit->benefitable_type !== Service::class) {
            abort(404);
        }

        $service->load('benefits');

        return view('Dashboard.Services.Benefits.edit', compact('service', 'benefit'));
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(UpdateBenefitRequest $request, Service $service, Benefit $benefit)
    {
        // Ensure the benefit belongs to this service
        if ($benefit->benefitable_id !== $service->id || $benefit->benefitable_type !== Service::class) {
            abort(404);
        }

        $this->benefitService->update($benefit, $request->validated());

        return redirect()->route('dashboard.services.benefits.index', $service->id)->with('success', __('dashboard.benefit_updated_successfully'));
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(DeleteBenefitRequest $request, Service $service, Benefit $benefit)
    {
        // Ensure the benefit belongs to this service
        if ($benefit->benefitable_id !== $service->id || $benefit->benefitable_type !== Service::class) {
            abort(404);
        }

        $this->benefitService->delete($benefit);

        return redirect()->route('dashboard.services.benefits.index', $service->id)->with('success', __('dashboard.benefit_deleted_successfully'));
    }
}
