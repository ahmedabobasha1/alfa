<?php

namespace App\Http\Controllers\Dashboard;

use App\Http\Controllers\Controller;
use App\Http\Requests\Dashboard\About\AboutRequest;
use App\Models\AboutUs;
use App\Services\Dashboard\AboutService;

class AboutUsController extends Controller
{
    public function __construct(private AboutService $about_service) {}

    public function edit()
    {
        $this->authorize('about.edit');
        $about = AboutUs::first();

        return view('Dashboard.AboutUs.edit', compact('about'));
    }

    public function update(AboutRequest $request, AboutUs $about)
    {
        $this->authorize('about.update');
        try {
            $data = $request->validated();

            $response = $this->about_service->update($request, $data, $about);
            if (! $response) {
                return redirect()->back()->with(['error' => __('dashboard.failed_to_update_item')]);
            }

            return redirect()->back()->with(['success' => __('dashboard.your_item_updated_successfully')]);
        } catch (\Exception $e) {

            return redirect()->back()->with(['error' => $e->getMessage()]);
        }
    }
}
