<?php

namespace App\Http\Controllers\Dashboard;

use App\Http\Controllers\Controller;
use App\Http\Requests\Dashboard\Faqs\DeleteFaqRequest;
use App\Http\Requests\Dashboard\Faqs\StoreFaqRequest;
use App\Http\Requests\Dashboard\Faqs\UpdateFaqRequest;
use App\Models\Faq;
use App\Services\Dashboard\FaqService;

class FaqController extends Controller
{
    public function __construct(private FaqService $faq_service) {}

    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $this->authorize('faqs.view');

        $faqs = Faq::general()->get();

        return view('Dashboard.Faqs.index', compact('faqs'));
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        $this->authorize('faqs.create');

        return view('Dashboard.Faqs.create');
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(StoreFaqRequest $request)
    {
        $this->authorize('faqs.store');

        try {

            $data = $request->validated();

            $response = $this->faq_service->store($data);

            return redirect()->back()->with(['success' => __('dashboard.your_item_added_successfully')]);

        } catch (\Exception $e) {

            return redirect()->back()->with(['error' => __('dashboard.failed_to_add_item')]);
        }
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(Faq $faq)
    {
        $this->authorize('faqs.edit');

        return view('Dashboard.Faqs.edit', compact('faq'));
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(UpdateFaqRequest $request, Faq $faq)
    {
        $this->authorize('faqs.update');
        try {

            $data = $request->validated();

            $response = $this->faq_service->update($data, $faq);

            return redirect()->back()->with(['success' => __('dashboard.your_item_updated_successfully')]);
        } catch (\Exception $e) {
            return redirect()->back()->with(['error' => __('dashboard.failed_to_update_item')]);
        }
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(DeleteFaqRequest $request)
    {
        $this->authorize('faqs.delete');

        $selectedIds = $request->input('selectedIds');

        $data = $request->validated();

        $deleted = $this->faq_service->delete($selectedIds, $data);

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
