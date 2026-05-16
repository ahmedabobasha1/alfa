<?php

namespace App\Services\Dashboard;

use App\Models\Admin;
use Illuminate\Support\Facades\DB;

class AdminService
{
    public function store($data)
    {
        DB::beginTransaction();
        try {
            $admin = Admin::create($data);

            $permissions = $data['permissions'];

            $admin->givePermissionTo($permissions);

            DB::commit();

            return true;
        } catch (\Exception $e) {
            DB::rollBack();

            return false;
        }
    }

    public function update($data, $admin)
    {

        DB::beginTransaction();

        try {

            if (empty($data['password'])) {
                unset($data['password']);
            }

            $permissions = $data['permissions'] ?? [];

            $admin->syncPermissions($permissions);

            $admin->update($data);

            DB::commit();

            return true;

        } catch (\Exception $e) {

            DB::rollBack();

            return false;
        }

    }

    public function delete($selectedIds)
    {

        try {
            return Admin::whereIn('id', $selectedIds)->delete();
        } catch (\Exception $e) {
            throw $e;
        }
    }
}
