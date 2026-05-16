<?php

namespace App\Services\Dashboard;

use App\Helper\Media;
use App\Models\AboutStruct;
use Illuminate\Support\Facades\DB;

class AboutStructService
{
    /**
     * Create a new class instance.
     */
    public function store($request, $data)
    {
        DB::beginTransaction();

        try {
            // Handle icon upload if present
            if ($request->hasFile('icon')) {
                $data['icon'] = Media::uploadAndAttachImage($request->file('icon'), 'about_structs');
            }

            $about_struct = AboutStruct::create($data);

            DB::commit();

            return $about_struct;
        } catch (\Exception $e) {
            DB::rollBack();
            throw $e;
        }
    }

    public function update($request, $about_struct, $data)
    {
        DB::beginTransaction();

        try {
            $data['status'] = $data['status'] ?? 0;

            // Handle icon upload replacement
            if ($request->hasFile('icon')) {
                if ($about_struct->icon) {
                    Media::removeFile('about_structs', $about_struct->icon);
                }
                $data['icon'] = Media::uploadAndAttachImage($request->file('icon'), 'about_structs');
            }
            // Update basic fields
            $about_struct->update($data);

            DB::commit();

            return true;

        } catch (\Exception $e) {
            DB::rollBack();
            throw $e;
        }
    }

    public function delete($selectedIds)
    {
        $about_struct = AboutStruct::whereIn('id', $selectedIds)->get();

        DB::beginTransaction();

        try {
            foreach ($about_struct as $about_struct) {
                // Delete associated image if it exists
                if ($about_struct->icon) {
                    Media::removeFile('about_structs', $about_struct->icon);
                }
            }
            $deleted = AboutStruct::whereIn('id', $selectedIds)->delete();

            DB::commit();

            return $deleted > 0;
        } catch (\Exception $e) {
            DB::rollBack();

            return false;
        }
    }
}
