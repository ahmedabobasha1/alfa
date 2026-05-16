<?php

namespace App\Services\Dashboard;

use App\Models\Category;
use App\Models\Media;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Str;

class CategoryService
{
    public function store($request, $data)
    {

        DB::beginTransaction();
        try {

            $data['slug_ar'] = preg_replace('/\s+/u', '-', trim($data['name_ar']));
            $data['slug_en'] = Str::slug($data['name_en']);

            if ($request->hasFile('image')) {
                $data['image'] = Media::uploadAndAttachImage($request->file('image'), 'categories');
            }
            if ($request->hasFile('icon')) {
                $data['icon'] = Media::uploadAndAttachImage($request->file('icon'), 'categories');
            }
            $category = Category::create($data);

            DB::commit();

            return $category;
        } catch (\Exception $e) {
            DB::rollback();
            throw $e;
        }
    }

    public function update($request, $data, $category)
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
                if ($category->image) {
                    Media::removeFile('categories', $category->image);
                }
                $data['image'] = Media::uploadAndAttachImage($request->file('image'), 'categories');
            }

            if ($request->hasFile('icon')) {
                if ($category->icon) {
                    Media::removeFile('categories', $category->icon);
                }
                $data['icon'] = Media::uploadAndAttachImage($request->file('icon'), 'categories');
            }

            $category->update($data);

            DB::commit();

            return $category;
        } catch (\Exception $e) {
            DB::rollback();
            throw $e;
        }
    }

    public function delete($selectedIds)
    {
        $categories = Category::with('images')->whereIn('id', $selectedIds)->get();

        DB::beginTransaction();
        try {
            foreach ($categories as $category) {
                // Delete associated image if it exists
                if ($category->image) {
                    Media::removeFile('categories', $category->image);
                }

                // Delete associated Icon if it exists
                if ($category->icon) {
                    Media::removeFile('categories', $category->icon);
                }

                // Delete associated category images
                $imagesService = app(ImagesService::class);
                $imagesService->destroyAll($category, 'categories/');

                // Finally, delete the category
                $category->delete();
            }

            DB::commit();

            return true;
        } catch (\Exception $e) {
            DB::rollBack();

            throw $e;
        }
    }
}
