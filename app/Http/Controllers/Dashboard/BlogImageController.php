<?php

namespace App\Http\Controllers\Dashboard;

use App\Http\Controllers\Controller;
use App\Http\Requests\Dashboard\ImageRequest;
use App\Models\Blog;
use App\Services\Dashboard\ImagesService;
use Illuminate\Http\Request;

class BlogImageController extends Controller
{
    public function __construct(private ImagesService $imagesService) {}

    /**
     * Display a listing of the resource.
     */
    public function index($blog)
    {
        $data['blog'] = Blog::findOrFail($blog);

        return view('Dashboard.Blogs.images', $data);
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(ImageRequest $request, $blog)
    {
        try {
            $blog = Blog::findOrFail($request->blog);

            $this->imagesService->upload($request->file('images'), $blog, 'blogs/');

            return redirect()->back()->with('success', __('dashboard.images_uploaded_successfully'));
        } catch (\Exception $e) {
            return redirect()->back()->with('error', $e->getMessage());
        }
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy($blog, $image)
    {
        $blog = Blog::findOrFail($blog);

        $image = $blog->images()->where('id', $image)->firstOrFail();

        // Delete the image file from storage
        $this->imagesService->delete($blog, $image, 'blogs/');

        return redirect()->back()->with('success', __('dashboard.image_deleted_successfully'));
    }

    public function destroyAllImages(Request $request, $blog)
    {
        $blog = Blog::findOrFail($blog);

        $this->imagesService->destroyAll($blog, 'blogs/');

        return redirect()->back()->with('success', __('dashboard.all_images_deleted_successfully'));
    }
}
