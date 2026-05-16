<?php

namespace App\Http\Controllers\Dashboard;

use App\Http\Controllers\Controller;
use App\Http\Requests\Dashboard\ImageRequest;
use App\Models\Album;
use App\Services\Dashboard\ImagesService;
use Illuminate\Http\Request;

class AlbumImageController extends Controller
{
    public function __construct(private ImagesService $imagesService) {}

    /**
     * Display a listing of the resource.
     */
    public function index($album)
    {
        $data['album'] = Album::findOrFail($album);

        return view('Dashboard.Albums.images', $data);
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(ImageRequest $request, $album)
    {
        try {
            $album = Album::findOrFail($request->album);

            $this->imagesService->upload($request->file('images'), $album, 'albums/');

            return redirect()->back()->with('success', __('dashboard.images_uploaded_successfully'));
        } catch (\Exception $e) {
            return redirect()->back()->with('error', $e->getMessage());
        }
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy($album, $image)
    {
        $album = Album::findOrFail($album);

        $image = $album->images()->where('id', $image)->firstOrFail();

        // Delete the image file from storage
        $this->imagesService->delete($album, $image, 'albums/');

        return redirect()->back()->with('success', __('dashboard.image_deleted_successfully'));
    }

    public function destroyAllImages(Request $request, $album)
    {
        $album = Album::findOrFail($album);

        $this->imagesService->destroyAll($album, 'albums/');

        return redirect()->back()->with('success', __('dashboard.all_images_deleted_successfully'));
    }
}
