<?php

namespace App\Services\Dashboard;

use App\Helper\Media;
use App\Models\Project;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Str;

class ProjectService
{
    public function store($request)
    {
        $data = $request->validated();

        DB::beginTransaction();
        try {

            $data['slug_ar'] = preg_replace('/\s+/u', '-', trim($data['name_ar']));
            $data['slug_en'] = Str::slug($data['name_en']);

            if ($request->hasFile('image')) {
                $data['image'] = Media::uploadAndAttachImage($request->file('image'), 'projects');
            }
            if ($request->hasFile('icon')) {
                $data['icon'] = Media::uploadAndAttachImage($request->file('icon'), 'projects');
            }
            $project = Project::create($data);

            DB::commit();

            return $project;
        } catch (\Exception $e) {
            DB::rollback();
            throw $e;
        }
    }

    public function update($request, $data, $project)
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

            if ($request->hasFile('image')) {
                if ($project->image) {
                    Media::removeFile('projects', $project->image);
                }
                $data['image'] = Media::uploadAndAttachImage($request->file('image'), 'projects');
            }

            if ($request->hasFile('icon')) {
                if ($project->icon) {
                    Media::removeFile('projects', $project->icon);
                }
                $data['icon'] = Media::uploadAndAttachImage($request->file('icon'), 'projects');
            }

            $project->update($data);

            DB::commit();

            return $project;
        } catch (\Exception $e) {
            DB::rollback();
            throw $e;
        }
    }

    public function delete($selectedIds)
    {
        $projects = Project::with('images')->whereIn('id', $selectedIds)->get();

        DB::beginTransaction();
        try {
            foreach ($projects as $project) {
                // Delete associated image if it exists
                if ($project->image) {
                    Media::removeFile('projects', $project->image);
                }

                // Delete associated Icon if it exists
                if ($project->icon) {
                    Media::removeFile('projects', $project->icon);
                }

                // Delete associated project images
                $imagesService = app(ImagesService::class);
                $imagesService->destroyAll($project, 'projects/');

                // Finally, delete the project
                $project->delete();
            }

            DB::commit();

            return true;
        } catch (\Exception $e) {
            DB::rollBack();

            throw $e;
        }
    }
}
