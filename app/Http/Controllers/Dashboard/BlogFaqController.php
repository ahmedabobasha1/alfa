<?php

namespace App\Http\Controllers\Dashboard;

use App\Http\Controllers\Controller;
use App\Http\Requests\Dashboard\Faqs\StoreFaqRequest;
use App\Http\Requests\Dashboard\Faqs\UpdateFaqRequest;
use App\Models\Blog;
use App\Models\Faq;
use App\Services\Dashboard\FaqService;
use Illuminate\Http\Request;

class BlogFaqController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index(Blog $blog)
    {
        return view('Dashboard.Blogs.Faqs.index', compact('blog'));

    }

    /**
     * Show the form for creating a new resource.
     */
    public function create(Blog $blog)
    {
        return view('Dashboard.Blogs.Faqs.create', compact('blog'));
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(StoreFaqRequest $request, Blog $blog)
    {
        try {
            $data = $request->validated();

            $blog->faqs()->create($data);

            return redirect()->route('dashboard.blogs.faqs.index', $blog->id)
                ->with('success', __('dashboard.Faq created successfully.'));
        } catch (\Exception $e) {

            return redirect()->back()->with('error', 'Error occurred while creating Faq: '.$e->getMessage());
        }
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(Blog $blog, Faq $faq)
    {
        return view('Dashboard.Blogs.Faqs.edit', compact(['blog', 'faq']));
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(UpdateFaqRequest $request, Blog $blog, Faq $faq)
    {

        try {
            $data = $request->validated();
            $response = (new FaqService)->update($data, $faq);
            if ($response) {
                return redirect()->route('dashboard.blogs.faqs.index', $blog->id)->with('success', __('dashboard.Faq updated successfully.'));
            } else {
                return redirect()->back()->with('error', 'Error occurred while updating Faq.');
            }
        } catch (\Exception $e) {
            return redirect()->back()->with('error', 'Error occurred while updating Faq: '.$e->getMessage());
        }
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Request $request, Blog $blog, Faq $faq)
    {

        try {

            $deleted = $faq->delete();

            if ($deleted) {
                return redirect()->back()->with('success', __('dashboard.Faq deleted successfully.'));
            }
        } catch (\Exception $e) {

            return redirect()->back()->with('error', 'Error occurred while deleting Faq: '.$e->getMessage());
        }
    }
}
