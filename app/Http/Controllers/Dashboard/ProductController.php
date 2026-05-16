<?php

namespace App\Http\Controllers\Dashboard;

use App\Http\Controllers\Controller;
use App\Http\Requests\Dashboard\Products\DeleteProductRequest;
use App\Http\Requests\Dashboard\Products\StoreProductRequest;
use App\Http\Requests\Dashboard\Products\UpdateProductRequest;
use App\Models\Category;
use App\Models\Product;
use App\Services\Dashboard\ProductService;
use Illuminate\Support\Facades\Log;

class ProductController extends Controller
{
    public function __construct(private ProductService $productService) {}

    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $this->authorize('products.view');

        try {
            $products = Product::with(['parent', 'category'])
                ->descOrder()
                ->get();

            return view('Dashboard.Products.index', compact('products'));
        } catch (\Exception $e) {

            return redirect()->back()->with('error', __('dashboard.an_error_occurred').' '.$e->getMessage());
        }
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        $this->authorize('products.create');

        try {
            $data['products'] = Product::with('parent')->get();
            $data['categories'] = Category::with('parent')->get();

            return view('Dashboard.Products.create', $data);
        } catch (\Exception $e) {

            return redirect()->back()->with('error', __('dashboard.an_error_occurred').' '.$e->getMessage());
        }
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(StoreProductRequest $request)
    {
        $this->authorize('products.store');

        try {

            $data = $request->validated();

            $response = $this->productService->store($request, $data);

            if (! $response) {
                return redirect()->back()->with(['error' => __('dashboard.failed_to_create_item')]);
            }

            return redirect()->route('dashboard.products.index')->with(['success' => __('dashboard.your_item_created_successfully')]);
        } catch (\Exception $e) {
            return redirect()->back()->with('error', __('dashboard.an_error_occurred').' '.$e->getMessage());
        }
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(Product $product)
    {
        $this->authorize('products.edit');

        try {
            $data['product'] = $product->load(['category', 'images']);
            $data['products'] = Product::with('parent')->get();
            $data['categories'] = Category::with('parent')->get();

            return view('Dashboard.Products.edit', $data);
        } catch (\Exception $e) {
            Log::error('Error loading product edit form: '.$e->getMessage());

            return redirect()->back()->with('error', __('dashboard.an_error_occurred').$e->getMessage());
        }
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(UpdateProductRequest $request, Product $product)
    {
        $this->authorize('products.update');
        try {
            $data = $request->validated();
            $response = $this->productService->update($request, $data, $product);

            if (! $response) {
                return redirect()->back()->with(['error' => __('dashboard.failed_to_update_item')]);
            }

            return redirect()->route('dashboard.products.index')->with(['success' => __('dashboard.your_item_updated_successfully')]);
        } catch (\Exception $e) {
            return redirect()->back()->with('error', $e->getMessage());
        }
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(DeleteProductRequest $request, string $id)
    {
        $this->authorize('products.delete');

        $selectedIds = $request->input('selectedIds', [$id]);

        try {
            $deleted = $this->productService->delete($selectedIds);

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
