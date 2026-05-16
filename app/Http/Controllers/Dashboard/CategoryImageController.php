<?php

namespace App\Http\Controllers\Dashboard;

use App\Http\Controllers\Controller;
use App\Http\Requests\Dashboard\ImageRequest;
use App\Models\Category;
use App\Services\Dashboard\ImagesService;
use Illuminate\Http\Request;

class CategoryImageController extends Controller
{
    public function __construct(private ImagesService $imagesService) {}

    /**
     * Display a listing of the resource.
     */
    public function index($category)
    {
        $data['category'] = Category::findOrFail($category);

        return view('Dashboard.Categories.images', $data);
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(ImageRequest $request, $category)
    {
        try {
            $category = Category::findOrFail($request->category);

            $this->imagesService->upload($request->file('images'), $category, 'categories/');

            return redirect()->back()->with('success', __('dashboard.images_uploaded_successfully'));
        } catch (\Exception $e) {
            return redirect()->back()->with('error', $e->getMessage());
        }
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy($category, $image)
    {
        $category = category::findOrFail($category);

        $image = $category->images()->where('id', $image)->firstOrFail();

        // Delete the image file from storage
        $this->imagesService->delete($category, $image, 'categories/');

        return redirect()->back()->with('success', __('dashboard.image_deleted_successfully'));
    }

    public function destroyAllImages(Request $request, $category)
    {
        $category = category::findOrFail($category);

        $this->imagesService->destroyAll($category, 'categories/');

        return redirect()->back()->with('success', __('dashboard.all_images_deleted_successfully'));
    }
}
