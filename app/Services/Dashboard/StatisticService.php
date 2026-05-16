<?php

namespace App\Services\Dashboard;

use App\Helper\Media;
use App\Models\Statistic;
use Illuminate\Support\Facades\DB;

class StatisticService
{
    public function store($request)
    {
        $data = $request->validated();

        DB::beginTransaction();
        try {
            // Handle icon upload if present
            if ($request->hasFile('icon')) {
                $data['icon'] = Media::uploadAndAttachImage($request->file('icon'), 'statistics');
            }

            $statistic = Statistic::create($data);

            DB::commit();

            return $statistic;

        } catch (\Exception $e) {

            DB::rollback();

            throw $e;
        }
    }

    public function update($request, $statistic)
    {
        $data = $request->validated();

        DB::beginTransaction();

        try {
            $data['status'] = $data['status'] ?? 0;

            // Handle icon upload replacement
            if ($request->hasFile('icon')) {
                if ($statistic->icon) {
                    Media::removeFile('statistics', $statistic->icon);
                }
                $data['icon'] = Media::uploadAndAttachImage($request->file('icon'), 'statistics');
            }

            $statistic->update($data);

            DB::commit();

            return $statistic;

        } catch (\Exception $e) {

            DB::rollback();

            throw $e;
        }
    }

    public function delete($selectedIds)
    {
        $statistics = statistic::whereIn('id', $selectedIds)->get();

        DB::beginTransaction();
        try {
            // Remove icon files before deletion
            foreach ($statistics as $statistic) {
                if ($statistic->icon) {
                    Media::removeFile('statistics', $statistic->icon);
                }
            }

            $deleted = statistic::whereIn('id', $selectedIds)->delete();

            DB::commit();

            return $deleted > 0;

        } catch (\Exception $e) {

            DB::rollBack();

            throw $e;
        }

    }
}
