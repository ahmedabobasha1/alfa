<?php

namespace App\Services\Dashboard;

use App\Helper\Media;
use App\Models\Blog;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Str;

class BlogService
{
    public function store($request)
    {
        $data = $request->validated();

        DB::beginTransaction();
        try {
            $data['slug_ar'] = preg_replace('/\s+/u', '-', trim($data['name_ar']));
            $data['slug_en'] = Str::slug($data['name_en']);

            if ($request->hasFile('image')) {
                $data['image'] = Media::uploadAndAttachImage($request->file('image'), 'blogs');
            }
            if ($request->hasFile('icon')) {
                $data['icon'] = Media::uploadAndAttachImage($request->file('icon'), 'blogs');
            }
            $blog = Blog::create($data);

            DB::commit();

            return $blog;
        } catch (\Exception $e) {
            DB::rollBack();
            throw $e;
        }
    }

    public function update($request, $blog)
    {
        $data = $request->validated();

        DB::beginTransaction();

        try {
            $data['status'] = $data['status'] ?? 0;
            $data['show_in_home'] = $data['show_in_home'] ?? 0;
            $data['show_in_header'] = $data['show_in_header'] ?? 0;
            $data['show_in_footer'] = $data['show_in_footer'] ?? 0;
            $data['index'] = $data['index'] ?? 0;
            $data['slug_ar'] = preg_replace('/\s+/u', '-', trim($data['slug_ar']));
            $data['slug_ar'] = preg_replace('/[^\p{L}\p{N}_-]+/u', '', $data['slug_ar']);
            $data['slug_en'] = Str::slug($data['slug_en']);

            if ($request->hasFile('image')) {
                if ($blog->image) {
                    Media::removeFile('blogs', $blog->image);
                }
                $data['image'] = Media::uploadAndAttachImage($request->file('image'), 'blogs');
            }

            if ($request->hasFile('icon')) {
                if ($blog->icon) {
                    Media::removeFile('blogs', $blog->icon);
                }
                $data['icon'] = Media::uploadAndAttachImage($request->file('icon'), 'blogs');
            }

            $blog->update($data);

            DB::commit();

            return $blog;
        } catch (\Exception $e) {
            DB::rollBack();
            throw $e;
        }
    }

    public function delete($selectedIds)
    {
        $blogs = Blog::whereIn('id', $selectedIds)->get();

        DB::beginTransaction();
        try {
            foreach ($blogs as $blog) {
                // Delete associated image if it exists
                if ($blog->image) {
                    Media::removeFile('blogs', $blog->image);
                }

                // Delete associated Icon if it exists
                if ($blog->icon) {
                    Media::removeFile('blogs', $blog->icon);
                }
                // Delete associated product images
                $imagesService = app(ImagesService::class);
                $imagesService->destroyAll($blog, 'blogs/');

                // Delete the blog model (this triggers the observer)
                $blog->delete();
            }

            DB::commit();

            return true;
        } catch (\Exception $e) {
            DB::rollBack();
            throw $e;
        }
    }
}
