<?php

namespace App\Services\Dashboard;

use App\Models\SiteAddress;
use Illuminate\Support\Facades\DB;

class SiteAddressService
{
    /**
     * Create a new class instance.
     */
    public function store($data)
    {
        DB::beginTransaction();

        try {
            $data['phone'] = $data['code'].$data['phone'];
            $data['phone2'] = $data['code2'].$data['phone2'];

            // Create the SiteAddress
            SiteAddress::create($data);

            DB::commit();

            return true;
        } catch (\Exception $e) {

            DB::rollBack();

            throw $e;
        }
    }

    public function update($data, $site_address)
    {
        DB::beginTransaction();

        try {
            $data['status'] = $data['status'] ?? 0;
            $data['phone'] = $data['code'].$data['phone'];
            $data['phone2'] = $data['code2'].$data['phone2'];

            $site_address->update($data);
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

            $deleted = SiteAddress::whereIn('id', $selectedIds)->delete();

            DB::commit();

            return $deleted > 0;

        } catch (\Exception $e) {

            DB::rollBack();

            return false;
        }
    }
}
