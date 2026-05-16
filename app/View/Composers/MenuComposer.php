<?php

namespace App\View\Composers;

use App\Models\Dashboard\Menu;
use Illuminate\Support\Facades\Cache;
use Illuminate\View\View;

class MenuComposer
{
    public function compose(View $view): void
    {
        try {
            $hierarchicalMenus = Cache::remember('hierarchical_menus', 3600, function () {
                return $this->buildMenuHierarchy();
            });

            $view->with('menus', $hierarchicalMenus);
        } catch (\Exception $e) {
            $simpleMenus = Menu::active()->orderBy('order', 'asc')->get()->map(function ($menu) {
                return [
                    'id' => $menu->id,
                    'name' => $menu->name,
                    'link' => $menu->link,
                    'segment' => $menu->segment,
                    'children' => [],
                ];
            })->toArray();

            $view->with('menus', $simpleMenus);
        }
    }

    private function buildMenuHierarchy(): array
    {
        $allMenus = Menu::active()->orderBy('order', 'asc')->get();

        if ($allMenus->isEmpty()) {
            return [];
        }

        $menuTree = [];

        $parentMenus = $allMenus->filter(function ($menu) {
            return is_null($menu->parent_id);
        });

        foreach ($parentMenus as $parentMenu) {
            $menuData = [
                'id' => $parentMenu->id,
                'name' => $parentMenu->name,
                'link' => $parentMenu->link,
                'segment' => $parentMenu->segment,
                'children' => [],
                'has_dropdown' => false,
                'is_services' => false,
            ];

            $children = $allMenus->filter(function ($menu) use ($parentMenu) {
                return $menu->parent_id == $parentMenu->id;
            });

            foreach ($children as $child) {
                $menuData['children'][] = [
                    'id' => $child->id,
                    'name' => $child->name,
                    'link' => $child->link,
                    'segment' => $child->segment,
                ];
            }

            // تحديد إذا كان له أطفال
            $hasChildren = count($menuData['children']) > 0;
            $menuData['has_dropdown'] = $hasChildren;

            // تحديد إذا كان قائمة خدمات (فقط إذا لم يكن له أطفال)
            if (! $hasChildren) {
                $isServices = str_contains(strtolower($menuData['name']), 'خدم') ||
                             str_contains(strtolower($menuData['name']), 'service') ||
                             str_contains($menuData['link'], 'services');

                $menuData['is_services'] = $isServices;
                $menuData['has_dropdown'] = $isServices;
            }

            $menuTree[] = $menuData;
        }

        return $menuTree;
    }
}
