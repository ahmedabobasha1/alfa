<?php

namespace App\Services\Dashboard;

use App\Helper\Media;
use App\Models\Product;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Str;

class ProductService
{
    public function store($request)
    {
        $data = $request->validated();

        DB::beginTransaction();
        try {

            $data['slug_ar'] = preg_replace('/\s+/u', '-', trim($data['name_ar']));
            $data['slug_en'] = Str::slug($data['name_en']);

            if ($request->hasFile('image')) {
                $data['image'] = Media::uploadAndAttachImage($request->file('image'), 'products');
            }
            if ($request->hasFile('icon')) {
                $data['icon'] = Media::uploadAndAttachImage($request->file('icon'), 'products');
            }
            $product = Product::create($data);

            DB::commit();

            return $product;
        } catch (\Exception $e) {
            DB::rollback();
            throw $e;
        }
    }

    public function update($request, $data, $product)
    {
        DB::beginTransaction();
        try {
            $data['status'] = $data['status'] ?? 0;
            $data['show_in_home'] = $data['show_in_home'] ?? 0;
            $data['show_in_header'] = $data['show_in_header'] ?? 0;
            $data['show_in_footer'] = $data['show_in_footer'] ?? 0;
            $data['index'] = $data['index'] ?? 0;
            $data['slug_ar'] = preg_replace('/\s+/u', '-', trim($data['slug_ar']));
            $data['slug_en'] = Str::slug($data['slug_en']);

            if ($request->hasFile('image')) {
                if ($product->image) {
                    Media::removeFile('products', $product->image);
                }
                $data['image'] = Media::uploadAndAttachImage($request->file('image'), 'products');
            }

            if ($request->hasFile('icon')) {
                if ($product->icon) {
                    Media::removeFile('products', $product->icon);
                }
                $data['icon'] = Media::uploadAndAttachImage($request->file('icon'), 'products');
            }

            $product->update($data);

            DB::commit();

            return $product;
        } catch (\Exception $e) {
            DB::rollback();
            throw $e;
        }
    }

    public function delete($selectedIds)
    {
        $products = Product::with('images')->whereIn('id', $selectedIds)->get();

        DB::beginTransaction();
        try {
            foreach ($products as $product) {
                // Delete associated image if it exists
                if ($product->image) {
                    Media::removeFile('products', $product->image);
                }

                // Delete associated Icon if it exists
                if ($product->icon) {
                    Media::removeFile('products', $product->icon);
                }

                // Delete associated product images
                $imagesService = app(ImagesService::class);
                $imagesService->destroyAll($product, 'products/');

                // Finally, delete the product
                $product->delete();
            }

            DB::commit();

            return true;
        } catch (\Exception $e) {
            DB::rollBack();

            throw $e;
        }
    }
}
