<?php

namespace App\Http\Controllers\Dashboard;

use App\Http\Controllers\Controller;
use App\Http\Requests\Dashboard\ImageRequest;
use App\Models\Service;
use App\Services\Dashboard\ImagesService;
use Illuminate\Http\Request;

class ServiceImageController extends Controller
{
    public function __construct(private ImagesService $imagesService) {}

    /**
     * Display a listing of the resource.
     */
    public function index($service)
    {
        $data['service'] = Service::findOrFail($service);

        return view('Dashboard.Services.images', $data);
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(ImageRequest $request, $service)
    {
        try {
            $service = Service::findOrFail($request->service);

            $this->imagesService->upload($request->file('images'), $service, 'services/');

            return redirect()->back()->with('success', __('dashboard.images_uploaded_successfully'));
        } catch (\Exception $e) {
            return redirect()->back()->with('error', $e->getMessage());
        }
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy($service, $image)
    {
        $service = Service::findOrFail($service);

        $image = $service->images()->where('id', $image)->firstOrFail();

        // Delete the image file from storage
        $this->imagesService->delete($service, $image, 'services/');

        return redirect()->back()->with('success', __('dashboard.image_deleted_successfully'));
    }

    public function destroyAllImages(Request $request, $service)
    {
        $service = Service::findOrFail($service);

        $this->imagesService->destroyAll($service, 'services/');

        return redirect()->back()->with('success', __('dashboard.all_images_deleted_successfully'));
    }
}
