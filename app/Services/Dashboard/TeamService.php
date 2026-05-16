<?php

namespace App\Services\Dashboard;

use App\Helper\Media;
use App\Models\Team;
use Illuminate\Support\Facades\DB;

class TeamService
{
    /**
     * Create a new class instance.
     */
    public function store($request, $data)
    {
        DB::beginTransaction();

        try {
            if ($request->hasFile('image')) {
                $data['image'] = Media::uploadAndAttachImage($request->file('image'), 'teams');
            }

            // Create the Team
            Team::create($data);

            DB::commit();

            return true;
        } catch (\Exception $e) {
            DB::rollBack();

            throw $e;
        }
    }

    public function update($request, $data, $team)
    {
        DB::beginTransaction();
        try {
            $data['status'] = $data['status'] ?? 0;
            $data['show_in_home'] = $data['show_in_home'] ?? 0;

            // Update team image only if new image is uploaded
            if ($request->hasFile('image')) {
                if ($team->image) {
                    Media::removeFile('teams', $team->image);
                }
                $data['image'] = Media::uploadAndAttachImage($request->file('image'), 'teams');
            }

            $team->update($data);

            DB::commit();

            return true;
        } catch (\Exception $e) {
            DB::rollBack();

            throw $e;
        }
    }

    public function delete($selectedIds)
    {
        $teams = Team::whereIn('id', $selectedIds)->get();

        DB::beginTransaction();
        try {
            foreach ($teams as $team) {
                // Delete associated image if it exists
                if ($team->image) {
                    Media::removeFile('teams', $team->image);
                }

                // Finally, delete the team
                $team->delete();
            }

            DB::commit();

            return true;
        } catch (\Exception $e) {
            DB::rollBack();

            throw $e;
        }
    }
}
