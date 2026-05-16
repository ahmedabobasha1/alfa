<?php

namespace App\Http\Controllers\Dashboard;

use App\Http\Controllers\Controller;
use App\Http\Requests\Dashboard\Blogs\DeleteBlogRequest;
use App\Http\Requests\Dashboard\Blogs\StoreBlogRequest;
use App\Http\Requests\Dashboard\Blogs\UpdateBlogRequest;
use App\Models\Author;
use App\Models\Blog;
use App\Models\BlogCategory;
use App\Services\Dashboard\BlogService;

class BlogController extends Controller
{
    protected $service;

    public function __construct(BlogService $service)
    {
        $this->service = $service;
    }

    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $this->authorize('blogs.view');
        $data['authors'] = Author::all();
        $data['categories'] = BlogCategory::all();
        $data['blogs'] = Blog::with('author', 'category')->orderBy('created_at', 'desc')->get();

        $data['section'] = 'blogs';

        return view('Dashboard.Blogs.index', $data);
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        $this->authorize('blogs.create');
        $data['authors'] = Author::all();
        $data['categories'] = BlogCategory::all();
        $data['section'] = 'blogs';

        return view('Dashboard.Blogs.create', $data);
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(StoreBlogRequest $request)
    {
        try {
            $this->authorize('blogs.create');
            $this->service->store($request);

            return redirect()->route('dashboard.blogs.index')->with('success', __('dashboard.your_items_added_successfully'));
        } catch (\Exception $e) {
            return redirect()->back()->with('error', $e->getMessage());
        }
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(Blog $blog)
    {
        $this->authorize('blogs.edit');
        $data['blog'] = $blog;
        $data['authors'] = Author::all();
        $data['categories'] = BlogCategory::all();
        $data['section'] = 'blogs';

        return view('Dashboard.Blogs.edit', $data);
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(UpdateBlogRequest $request, Blog $blog)
    {
        try {
            $this->authorize('blogs.edit');
            $this->service->update($request, $blog);

            return redirect()->route('dashboard.blogs.index')->with('success', __('dashboard.your_items_updated_successfully'));
        } catch (\Exception $e) {
            return redirect()->back()->with('error', $e->getMessage());
        }
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(DeleteBlogRequest $request, string $id)
    {
        $this->authorize('blogs.delete');

        $selectedIds = $request->input('selectedIds');

        $deleted = $this->service->delete($selectedIds);

        if (request()->ajax()) {
            if (! $deleted) {
                return response()->json(['message' => __('dashboard.an messages.error entering data')], 422);
            }

            return response()->json(['success' => true, 'message' => __('dashboard.your_items_deleted_successfully')]);
        }
        if (! $deleted) {
            return redirect()->back()->withErrors(__('dashboard.an error has occurred. Please contact the developer to resolve the issue'));
        }
    }
}
