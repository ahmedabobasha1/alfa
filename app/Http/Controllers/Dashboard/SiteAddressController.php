<?php

namespace App\Http\Controllers\Dashboard;

use App\Http\Controllers\Controller;
use App\Http\Requests\Dashboard\SiteAddresses\DeleteSiteAddressRequest;
use App\Http\Requests\Dashboard\SiteAddresses\StoreSiteAddressRequest;
use App\Http\Requests\Dashboard\SiteAddresses\UpdateSiteAddressRequest;
use App\Models\SiteAddress;
use App\Services\Dashboard\SiteAddressService;
use Illuminate\Support\Str;

class SiteAddressController extends Controller
{
    public function __construct(private SiteAddressService $service) {}

    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $this->authorize('site_addresses.view');

        $site_addresses = SiteAddress::all();

        return view('Dashboard.SiteAddress.index', compact('site_addresses'));
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        $this->authorize('site_addresses.create');

        return view('Dashboard.SiteAddress.create');
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(StoreSiteAddressRequest $request)
    {
        $this->authorize('site_addresses.store');
        try {
            $data = $request->validated();
            $response = $this->service->store($data);

            if (! $response) {
                return redirect()->back()->with(['error' => __('dashboard.failed_to_add_item')]);
            }

            return redirect()->back()->with(['success' => __('dashboard.your_item_added_successfully')]);
        } catch (\Exception $e) {

            return redirect()->back()->with(['error' => __('dashboard.failed_to_add_item')]);
        }
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(SiteAddress $site_address)
    {
        $this->authorize('site_addresses.edit');

        $codes = ['+20'];

        // Helper function to split phone
        $splitPhone = function ($phone) use ($codes) {
            foreach ($codes as $code) {
                if (Str::startsWith($phone, $code)) {
                    return ['code' => $code, 'number' => Str::replaceFirst($code, '', $phone)];
                }
            }

            return ['code' => null, 'number' => $phone];
        };

        $phoneData = $splitPhone($site_address->phone);
        $phone2Data = $splitPhone($site_address->phone2);

        // Add values to $site_address
        $site_address['code'] = $phoneData['code'];
        $site_address['phone'] = $phoneData['number'];
        $site_address['code2'] = $phone2Data['code'];
        $site_address['phone2'] = $phone2Data['number'];

        return view('Dashboard.SiteAddress.edit', compact('site_address'));
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(UpdateSiteAddressRequest $request, SiteAddress $site_address)
    {
        $this->authorize('site_addresses.update');

        try {
            $data = $request->validated();

            $response = $this->service->update($data, $site_address);
            if (! $response) {
                return redirect()->back()->with(['error' => __('dashboard.failed_to_update_item')]);
            }

            return redirect()->back()->with(['success' => __('dashboard.your_item_updated_successfully')]);
        } catch (\Exception $e) {

            return redirect()->back()->with(['error' => $e->getMessage() ?? __('dashboard.failed_to_update_item')]);
        }
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(DeleteSiteAddressRequest $request, string $id)
    {
        $this->authorize('site_addresses.delete');

        $selectedIds = $request->input('selectedIds');

        $data = $request->validated();

        $deleted = $this->service->delete($selectedIds, $data);

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
