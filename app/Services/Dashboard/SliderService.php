<?php

namespace App\Services\Dashboard;

use App\Helper\Media;
use App\Models\Slider;
use Illuminate\Support\Facades\DB;

class SliderService
{
    public function store($data, $request)
    {

        DB::beginTransaction();
        try {
            if ($request->hasFile('image_en')) {
                $data['image_en'] = Media::uploadAndAttachImage($request->file('image_en'), 'sliders');
            }
            if ($request->hasFile('image_ar')) {
                $data['image_ar'] = Media::uploadAndAttachImage($request->file('image_ar'), 'sliders');
            }
            if ($request->hasFile('mobile_image_en')) {
                $data['mobile_image_en'] = Media::uploadAndAttachImage($request->file('mobile_image_en'), 'sliders');
            }
            if ($request->hasFile('mobile_image_ar')) {
                $data['mobile_image_ar'] = Media::uploadAndAttachImage($request->file('mobile_image_ar'), 'sliders');
            }

            Slider::create($data);

            DB::commit();

            return true;
        } catch (\Exception $e) {

            DB::rollBack();

            throw $e;
        }

    }

    public function update($request, $data, $slider)
    {

        DB::beginTransaction();
        try {
            $data['status'] = $data['status'] ?? 0;

            if ($request->hasFile('image_en')) {
                if ($slider->image_en) {
                    Media::removeFile('sliders', $slider->image_en);
                }
                $data['image_en'] = Media::uploadAndAttachImage($request->file('image_en'), 'sliders');
            }
            if ($request->hasFile('image_ar')) {
                if ($slider->image_ar) {
                    Media::removeFile('sliders', $slider->image_ar);
                }
                $data['image_ar'] = Media::uploadAndAttachImage($request->file('image_ar'), 'sliders');
            }
            if ($request->hasFile('mobile_image_en')) {
                if ($slider->mobile_image_en) {
                    Media::removeFile('sliders', $slider->mobile_image_en);
                }
                $data['mobile_image_en'] = Media::uploadAndAttachImage($request->file('mobile_image_en'), 'sliders');
            }
            if ($request->hasFile('mobile_image_ar')) {
                if ($slider->mobile_image_ar) {
                    Media::removeFile('sliders', $slider->mobile_image_ar);
                }
                $data['mobile_image_ar'] = Media::uploadAndAttachImage($request->file('mobile_image_ar'), 'sliders');
            }

            $slider->update($data);
            DB::commit();

            return true;
        } catch (\Exception $e) {
            DB::rollBack();

            return false;
        }
    }

    public function delete($selectedIds)
    {
        $sliders = Slider::whereIn('id', $selectedIds)->get();

        DB::beginTransaction();

        try {
            foreach ($sliders as $slider) {
                // Delete associated images if they exist
                if ($slider->image_en) {
                    Media::removeFile('sliders', $slider->image_en);
                }
                if ($slider->image_ar) {
                    Media::removeFile('sliders', $slider->image_ar);
                }
                if ($slider->mobile_image_en) {
                    Media::removeFile('sliders', $slider->mobile_image_en);
                }
                if ($slider->mobile_image_ar) {
                    Media::removeFile('sliders', $slider->mobile_image_ar);
                }
            }
            $deleted = Slider::whereIn('id', $selectedIds)->delete();

            DB::commit();

            return $deleted > 0;

        } catch (\Exception $e) {
            DB::rollBack();

            return false;
        }
    }
}
