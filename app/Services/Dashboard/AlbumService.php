<?php

namespace App\Services\Dashboard;

use App\Helper\Media;
use App\Models\Album;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Str;

class AlbumService
{
    public function store($request, $data)
    {
        DB::beginTransaction();
        try {
            $data['slug_ar'] = preg_replace('/\s+/u', '-', trim($data['name_ar']));
            $data['slug_en'] = Str::slug($data['name_en']);

            if ($request->hasFile('image')) {
                $data['image'] = Media::uploadAndAttachImage($request->file('image'), 'albums');
            }

            $album = Album::create($data);
            DB::commit();

            return $album;
        } catch (\Exception $e) {
            DB::rollBack();
            throw $e;
        }
    }

    public function update($request, $album)
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
            $data['slug_en'] = Str::slug($data['slug_en']);

            if ($request->hasFile('image')) {
                if ($album->image) {
                    Media::removeFile('albums', $album->image);
                }
                $data['image'] = Media::uploadAndAttachImage($request->file('image'), 'albums');
            }

            $album->update($data);

            DB::commit();

            return $album;
        } catch (\Exception $e) {
            DB::rollBack();
            throw $e;
        }
    }

    public function delete($selectedIds)
    {
        $albums = Album::with('images')->whereIn('id', $selectedIds)->get();

        DB::beginTransaction();
        try {
            foreach ($albums as $album) {
                // Delete associated image if it exists
                if ($album->image) {
                    Media::removeFile('albums', $album->image);
                }
                // Delete associated album images
                $imagesService = app(ImagesService::class);
                $imagesService->destroyAll($album, 'albums/');

                // Finally, delete the album
                $album->delete();
            }

            DB::commit();

            return true;
        } catch (\Exception $e) {
            DB::rollBack();

            throw $e;
        }
    }
}
