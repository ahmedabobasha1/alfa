<?php

namespace App\Http\Controllers\Dashboard;

use App\Http\Controllers\Controller;
use App\Http\Requests\Dashboard\ImageRequest;
use App\Models\Project;
use App\Services\Dashboard\ImagesService;
use Illuminate\Http\Request;

class ProjectImageController extends Controller
{
    public function __construct(private ImagesService $imagesService) {}

    /**
     * Display a listing of the resource.
     */
    public function index($project)
    {
        $data['project'] = Project::findOrFail($project);

        return view('Dashboard.Projects.images', $data);
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(ImageRequest $request, $project)
    {
        try {
            $project = Project::findOrFail($request->project);

            $this->imagesService->upload($request->file('images'), $project, 'projects/');

            return redirect()->back()->with('success', __('dashboard.images_uploaded_successfully'));
        } catch (\Exception $e) {
            return redirect()->back()->with('error', $e->getMessage());
        }
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy($project, $image)
    {
        $project = Project::findOrFail($project);

        $image = $project->images()->where('id', $image)->firstOrFail();

        // Delete the image file from storage
        $this->imagesService->delete($project, $image, 'projects/');

        return redirect()->back()->with('success', __('dashboard.image_deleted_successfully'));
    }

    public function destroyAllImages(Request $request, $project)
    {
        $project = Project::findOrFail($project);

        $this->imagesService->destroyAll($project, 'projects/');

        return redirect()->back()->with('success', __('dashboard.all_images_deleted_successfully'));
    }
}
