<?php

namespace App\View\Composers;

use App\Models\Dashboard\Menu;
use Illuminate\Support\Facades\Cache;
use Illuminate\View\View;

class FooterMenuComposer
{
    public function compose(View $view): void
    {
        try {
            $footerMenus = Cache::remember('footer_menus', 3600, function () {
                return $this->buildFooterMenus();
            });

            $view->with('footerMenus', $footerMenus);
        } catch (\Exception $e) {
            $simpleMenus = Menu::active()->whereNull('parent_id')->orderBy('order', 'asc')->get()->map(function ($menu) {
                return [
                    'id' => $menu->id,
                    'name' => $menu->name,
                    'link' => $menu->link,
                    'segment' => $menu->segment,
                ];
            })->toArray();

            $view->with('footerMenus', $simpleMenus);
        }
    }

    private function buildFooterMenus(): array
    {
        // جلب جميع القوائم النشطة
        $allMenus = Menu::active()->orderBy('order', 'asc')->get();

        if ($allMenus->isEmpty()) {
            return [];
        }

        $menuTree = [];

        // جلب القوائم الرئيسية فقط
        $parentMenus = $allMenus->filter(function ($menu) {
            return is_null($menu->parent_id);
        });

        foreach ($parentMenus as $parentMenu) {
            // التحقق من عدم وجود أطفال لهذه القائمة
            $hasChildren = $allMenus->where('parent_id', $parentMenu->id)->count() > 0;

            // إضافة القائمة فقط إذا لم يكن لها أطفال
            if (! $hasChildren) {
                $menuTree[] = [
                    'id' => $parentMenu->id,
                    'name' => $parentMenu->name,
                    'link' => $parentMenu->link,
                    'segment' => $parentMenu->segment,
                ];
            }
        }

        return $menuTree;
    }
}
