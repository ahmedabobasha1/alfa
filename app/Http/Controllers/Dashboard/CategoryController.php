<?php

namespace App\Http\Controllers\Dashboard;

use App\Http\Controllers\Controller;
use App\Http\Requests\Dashboard\Categories\DeleteCategoryRequest;
use App\Http\Requests\Dashboard\Categories\StoreCategoryRequest;
use App\Http\Requests\Dashboard\Categories\UpdateCategoryRequest;
use App\Models\Category;
use App\Services\Dashboard\CategoryService;

class CategoryController extends Controller
{
    public function __construct(private CategoryService $categoryService) {}

    public function index()
    {
        $this->authorize('categories.view');

        $categories = Category::with('parent')->orderBy('id', 'desc')->get();

        return view('Dashboard.Categories.index', compact('categories'));
    }

    public function create()
    {
        $this->authorize('categories.create');

        $categories = Category::with('parent')->get();

        return view('Dashboard.Categories.create', compact('categories'));
    }

    public function store(StoreCategoryRequest $request)
    {
        $this->authorize('categories.store');

        try {

            $data = $request->validated();

            $response = $this->categoryService->store($request, $data);

            if (! $response) {
                return redirect()->back()->with(['error' => __('dashboard.failed_to_create_item')]);
            }

            return redirect()->route('dashboard.categories.index')->with(['success' => __('dashboard.your_item_created_successfully')]);
        } catch (\Exception $e) {
            return redirect()->back()->with('error', __('dashboard.an_error_occurred').' '.$e->getMessage());
        }
    }

    public function edit(Category $category)
    {
        $this->authorize('categories.edit');

        $categories = Category::with('parent')->get();

        return view('Dashboard.Categories.edit', compact('category', 'categories'));
    }

    public function update(UpdateCategoryRequest $request, Category $category)
    {
        $this->authorize('categories.update');

        try {
            $data = $request->validated();

            $response = $this->categoryService->update($request, $data, $category);

            if (! $response) {
                return redirect()->back()->with(['error' => __('dashboard.failed_to_update_item')]);
            }

            return redirect()->route('dashboard.categories.index')->with(['success' => __('dashboard.your_item_updated_successfully')]);
        } catch (\Exception $e) {
            return redirect()->back()->with('error', $e->getMessage());
        }
    }

    public function destroy(DeleteCategoryRequest $request, string $id)
    {
        $this->authorize('categories.delete');

        $selectedIds = $request->input('selectedIds', [$id]);

        try {
            $deleted = $this->categoryService->delete($selectedIds);

            if (request()->ajax()) {
                return response()->json([
                    'success' => true,
                    'message' => __('dashboard.your_items_deleted_successfully'),
                ]);
            }

            return redirect()->back()
                ->with('success', __('dashboard.your_items_deleted_successfully'));
        } catch (\Exception $e) {

            if (request()->ajax()) {
                return response()->json([
                    'success' => false,
                    'message' => __('dashboard.an_error_occurred'.' '.$e->getMessage()),
                ], 500);
            }

            return redirect()->back()
                ->withErrors(__('dashboard.an_error_occurred'));
        }
    }
}
