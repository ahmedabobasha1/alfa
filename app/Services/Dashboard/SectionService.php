<?php

namespace App\Services\Dashboard;

use App\Helper\Media;
use App\Models\Section;
use Illuminate\Support\Facades\DB;

class SectionService
{
    public function store($request)
    {

        DB::beginTransaction();
        try {
            $data = $request->validated();

            if ($request->hasFile('image')) {
                $data['image'] = Media::uploadAndAttachImage($request->file('image'), 'sections');
            }
            if ($request->hasFile('icon')) {
                $data['icon'] = Media::uploadAndAttachImage($request->file('icon'), 'sections');
            }

            Section::create($data);

            DB::commit();

            return true;
        } catch (\Exception $e) {
            DB::rollBack();
            throw $e;
        }
    }

    public function update($request, $section)
    {
        $data = $request->validated();

        DB::beginTransaction();

        try {
            $data['status'] = $data['status'] ?? 0;

            if ($request->hasFile('image')) {
                if ($section->image) {
                    Media::removeFile('sections', $section->image);
                }
                $data['image'] = Media::uploadAndAttachImage($request->file('image'), 'sections');
            }

            if ($request->hasFile('icon')) {
                if ($section->icon) {
                    Media::removeFile('sections', $section->icon);
                }
                $data['icon'] = Media::uploadAndAttachImage($request->file('icon'), 'sections');
            }

            $section->update($data);

            DB::commit();

            return $section;
        } catch (\Exception $e) {
            DB::rollback();
            throw $e;
        }
    }

    public function delete($selectedIds)
    {
        $sections = Section::whereIn('id', $selectedIds)->get();

        DB::beginTransaction();
        try {
            foreach ($sections as $section) {
                // Delete associated image if it exists
                if ($section->image) {
                    Media::removeFile('sections', $section->image);
                }
                // Delete associated Icon if it exists
                if ($section->icon) {
                    Media::removeFile('sections', $section->icon);
                }
            }
            $deleted = Section::whereIn('id', $selectedIds)->delete();

            DB::commit();

            return $deleted > 0;

        } catch (\Exception $e) {

            DB::rollBack();

            throw $e;
        }

    }
}
