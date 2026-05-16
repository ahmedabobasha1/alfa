<?php

namespace App\Services\Dashboard;

use App\Models\Faq;
use Illuminate\Support\Facades\DB;

class FaqService
{
    /**
     * Create a new class instance.
     */
    public function store($data)
    {
        DB::beginTransaction();
        try {

            Faq::create($data);

            DB::commit();

            return true;
        } catch (\Exception $e) {
            DB::rollback();

            throw $e;
        }
    }

    public function update($data, $faq)
    {
        $data['status'] = $data['status'] ?? 0;

        return $faq->update($data);
    }

    public function delete($selectedIds)
    {
        try {
            return Faq::whereIn('id', $selectedIds)->delete();
        } catch (\Exception $e) {
            throw $e;
        }
    }
}
