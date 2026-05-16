<?php

namespace App\Services\Dashboard;

use App\Helper\Media;
use App\Models\JobPosition;
use Illuminate\Support\Facades\DB;

class JobPositionService
{
    public function store($request)
    {
        $data = $request->validated();

        DB::beginTransaction();
        try {

            if ($request->hasFile('image')) {
                $data['image'] = Media::uploadAndAttachImage($request->file('image'), 'job-positions');
            }
            if ($request->hasFile('icon')) {
                $data['icon'] = Media::uploadAndAttachImage($request->file('icon'), 'job-positions');
            }
            $jobPosition = JobPosition::create($data);

            DB::commit();

            return $jobPosition;
        } catch (\Exception $e) {

            DB::rollback();

            throw $e;
        }
    }

    public function update($request, $jobPosition)
    {
        $data = $request->validated();

        DB::beginTransaction();

        try {
            $data['status'] = $data['status'] ?? 0;

            if ($request->hasFile('image')) {
                if ($jobPosition->image) {
                    Media::removeFile('job-positions', $jobPosition->image);
                }
                $data['image'] = Media::uploadAndAttachImage($request->file('image'), 'job-positions');
            }

            if ($request->hasFile('icon')) {
                if ($jobPosition->icon) {
                    Media::removeFile('job-positions', $jobPosition->icon);
                }
                $data['icon'] = Media::uploadAndAttachImage($request->file('icon'), 'job-positions');
            }

            $jobPosition->update($data);

            DB::commit();

            return $jobPosition;
        } catch (\Exception $e) {
            DB::rollback();
            throw $e;
        }
    }

    public function delete($selectedIds)
    {
        $jobPositions = JobPosition::whereIn('id', $selectedIds)->get();

        DB::beginTransaction();
        try {
            foreach ($jobPositions as $jobPosition) {
                // Delete associated image if it exists
                if ($jobPosition->image) {
                    Media::removeFile('job-positions', $jobPosition->image);
                }
                // Delete associated Icon if it exists
                if ($jobPosition->icon) {
                    Media::removeFile('job-positions', $jobPosition->icon);
                }
            }
            $deleted = JobPosition::whereIn('id', $selectedIds)->delete();

            DB::commit();

            return $deleted > 0;
        } catch (\Exception $e) {

            DB::rollBack();

            throw $e;
        }
    }
}
