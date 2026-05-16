<?php

namespace App\Services\Dashboard;

use App\Helper\Media;
use App\Models\Service as ModelsService;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Str;

class Service
{
    /**
     * Create a new class instance.
     */
    public function store($request, $data)
    {
        DB::beginTransaction();

        try {
            // Generate slugs
            $data['slug_ar'] = preg_replace('/\s+/u', '-', trim($data['name_ar']));
            $data['slug_en'] = Str::slug($data['name_en']);

            if ($request->hasFile('image')) {
                $data['image'] = Media::uploadAndAttachImage($request->file('image'), 'services');
            }

            if ($request->hasFile('icon')) {
                $data['icon'] = Media::uploadAndAttachImage($request->file('icon'), 'services');
            }

            // Create the Service
            ModelsService::create($data);

            DB::commit();

            return true;
        } catch (\Exception $e) {
            DB::rollBack();

            throw $e;
        }
    }

    public function update($request, $data, $service)
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

            if ($request->hasFile('icon')) {
                if ($service->icon) {
                    Media::removeFile('services', $service->icon);
                }
                $data['icon'] = Media::uploadAndAttachImage($request->file('icon'), 'services');
            }

            // تحديث صورة الخدمة فقط إذا تم رفع صورة جديدة
            if ($request->hasFile('image')) {
                if ($service->image) {
                    Media::removeFile('services', $service->image);
                }
                $data['image'] = Media::uploadAndAttachImage($request->file('image'), 'services');
            }

            $service->Update($data);

            DB::commit();

            return true;
        } catch (\Exception $e) {
            DB::rollBack();

            throw $e;
        }
    }

    public function delete($selectedIds)
    {
        $services = ModelsService::with('images')->whereIn('id', $selectedIds)->get();

        DB::beginTransaction();
        try {
            foreach ($services as $service) {
                // Delete associated image if it exists
                if ($service->image) {
                    Media::removeFile('services', $service->image);
                }

                // Delete associated Icon if it exists
                if ($service->icon) {
                    Media::removeFile('services', $service->icon);
                }

                // Delete associated service images
                $imagesService = app(ImagesService::class);
                $imagesService->destroyAll($service, 'services/');

                // Finally, delete the service
                $service->delete();
            }

            DB::commit();

            return true;
        } catch (\Exception $e) {
            DB::rollBack();

            throw $e;
        }
    }
}
