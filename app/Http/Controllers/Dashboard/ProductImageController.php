<?php

namespace App\Http\Controllers\Dashboard;

use App\Http\Controllers\Controller;
use App\Http\Requests\Dashboard\ImageRequest;
use App\Models\Product;
use App\Services\Dashboard\ImagesService;
use Illuminate\Http\Request;

class ProductImageController extends Controller
{
    public function __construct(private ImagesService $imagesService) {}

    /**
     * Display a listing of the resource.
     */
    public function index($product)
    {
        $data['product'] = Product::findOrFail($product);

        return view('Dashboard.Products.images', $data);
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(ImageRequest $request, $product)
    {
        try {
            $product = Product::findOrFail($request->product);

            $this->imagesService->upload($request->file('images'), $product, 'products/');

            return redirect()->back()->with('success', __('dashboard.images_uploaded_successfully'));
        } catch (\Exception $e) {
            return redirect()->back()->with('error', $e->getMessage());
        }
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy($product, $image)
    {
        $product = Product::findOrFail($product);

        $image = $product->images()->where('id', $image)->firstOrFail();

        // Delete the image file from storage
        $this->imagesService->delete($product, $image, 'products/');

        return redirect()->back()->with('success', __('dashboard.image_deleted_successfully'));
    }

    public function destroyAllImages(Request $request, $product)
    {
        $product = Product::findOrFail($product);

        $this->imagesService->destroyAll($product, 'products/');

        return redirect()->back()->with('success', __('dashboard.all_images_deleted_successfully'));
    }
}
