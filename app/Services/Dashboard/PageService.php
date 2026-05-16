<?php

namespace App\Services\Dashboard;

use App\Models\Page;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Str;

class PageService
{
    public function store($data)
    {
        DB::beginTransaction();
        try {
            $data['slug_en'] = Str::slug($data['title_en']);
            $data['slug_ar'] = Str::slug($data['title_ar']);

            Page::create($data);

            DB::commit();

            return true;
        } catch (\Exception $e) {

            DB::rollBack();

            throw $e;
        }
    }

    public function update($data, $page)
    {

        DB::beginTransaction();
        try {
            $data['status'] = $data['status'] ?? 0;
            $data['slug_en'] = Str::slug($data['slug_en']);
            $data['slug_ar'] = Str::slug($data['slug_ar']);

            $page->update($data);

            DB::commit();

            return true;
        } catch (\Exception $e) {
            DB::rollBack();
            throw $e;
        }
    }

    public function delete($selectedIds)
    {

        DB::beginTransaction();

        try {

            $deleted = Page::whereIn('id', $selectedIds)->delete();

            DB::commit();

            return $deleted > 0;

        } catch (\Exception $e) {
            DB::rollBack();

            throw $e;
        }
    }
}
