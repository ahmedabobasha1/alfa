<?php

namespace App\Http\Controllers\Dashboard;

use App\Http\Controllers\Controller;
use App\Http\Requests\Dashboard\Phones\DeletePhoneRequest;
use App\Http\Requests\Dashboard\Phones\StorePhoneRequest;
use App\Http\Requests\Dashboard\Phones\UpdatePhoneRequest;
use App\Models\Phone;

// Cache-related imports removed since cache is disabled

class PhoneController extends Controller
{
    // No need for constructor - global NoCacheMiddleware handles all caching

    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $phones = Phone::latest()->get();

        return view('Dashboard.Phones.index', compact('phones'));
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        return view('Dashboard.Phones.create');
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(StorePhoneRequest $request)
    {
        Phone::create($request->validated());

        // No cache clearing needed - cache is disabled

        return redirect()->route('dashboard.phones.index')->with('success', 'تم إضافة الهاتف بنجاح');
    }

    /**
     * Display the specified resource.
     */
    public function show(string $id)
    {
        $phone = Phone::findOrFail($id);

        return view('Dashboard.Phones.show', compact('phone'));
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(string $id)
    {
        $phone = Phone::findOrFail($id);

        return view('Dashboard.Phones.edit', compact('phone'));
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(UpdatePhoneRequest $request, string $id)
    {
        $phone = Phone::findOrFail($id);
        $phone->update($request->validated());

        // No cache clearing needed - cache is disabled

        return redirect()->route('dashboard.phones.index')->with('success', 'تم تحديث الهاتف بنجاح');
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(DeletePhoneRequest $request, Phone $phone)
    {
        $selectedIds = $request->input('selectedIds', [$phone->id]);

        try {
            Phone::whereIn('id', $selectedIds)->delete();

            if (request()->ajax()) {
                return response()->json([
                    'success' => true,
                    'message' => __('dashboard.your_items_deleted_successfully'),
                ]);
            }

            return redirect()->route('dashboard.phones.index')
                ->with('success', __('dashboard.your_items_deleted_successfully'));
        } catch (\Exception $e) {
            if (request()->ajax()) {
                return response()->json([
                    'success' => false,
                    'message' => __('dashboard.an_error_occurred'),
                ], 500);
            }

            return redirect()->back()
                ->withErrors(__('dashboard.an_error_occurred'));
        }
    }

    // clearAllCaches method removed - cache is completely disabled
}
