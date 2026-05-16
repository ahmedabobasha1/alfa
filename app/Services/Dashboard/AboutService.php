<?php

namespace App\Services\Dashboard;

use App\Helper\Media;
use Illuminate\Support\Facades\DB;

class AboutService
{
    public function update($request, $data, $about)
    {

        DB::beginTransaction();

        try {

            if ($request->hasFile('image')) {
                if ($about->image) {
                    Media::removeFile('about', $about->image);
                }
                $data['image'] = Media::uploadAndAttachImage($request->file('image'), 'about');
            }

            if ($request->hasFile('icon')) {
                if ($about->icon) {
                    Media::removeFile('about', $about->icon);
                }
                $data['icon'] = Media::uploadAndAttachImage($request->file('icon'), 'about');
            }

            if ($request->hasFile('icon2')) {
                if ($about->icon2) {
                    Media::removeFile('about', $about->icon2);
                }
                $data['icon2'] = Media::uploadAndAttachImage($request->file('icon2'), 'about');
            }

            if ($request->hasFile('banner')) {
                if ($about->banner) {
                    Media::removeFile('about', $about->banner);
                }
                $data['banner'] = Media::uploadAndAttachImage($request->file('banner'), 'about');
            }

            if ($request->hasFile('banner2')) {
                if ($about->banner2) {
                    Media::removeFile('about', $about->banner2);
                }
                $data['banner2'] = Media::uploadAndAttachImage($request->file('banner2'), 'about');
            }

            if ($request->hasFile('video')) {
                if ($about->video) {
                    Media::removeFile('about', $about->video);
                }
                $data['video'] = Media::uploadAndAttachImage($request->file('video'), 'about');
            }

            $about->update($data);

            DB::commit();

            return true;
        } catch (\Exception $e) {
            DB::rollBack();

            return false;
        }
    }
}
