<?php

namespace App\Services\Dashboard;

use App\Models\Menu;

class MenuService
{
    public function store($data)
    {
        $menu = Menu::create($data);

        return $menu;
    }

    public function update($data, $menu)
    {
        try {
            $data['status'] = $data['status'] ?? 0;
            $menu->update($data);

            return true;
        } catch (\Exception $e) {
            throw $e;
        }
    }

    public function delete($selectedIds)
    {
        try {
            $result = Menu::whereIn('id', $selectedIds)->delete();

            return $result;
        } catch (\Exception $e) {
            throw $e;
        }
    }
}
