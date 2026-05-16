<?php

namespace App\Http\Controllers\Dashboard;

use App\Http\Controllers\Controller;
use App\Http\Requests\Dashboard\Menus\DeleteMenuRequest;
use App\Http\Requests\Dashboard\Menus\StoreMenuRequest;
use App\Http\Requests\Dashboard\Menus\UpdateMenuRequest;
use App\Models\Menu;
use App\Services\Dashboard\MenuService;

class MenuController extends Controller
{
    public function __construct(private MenuService $menuService) {}

    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $this->authorize('menus.view');

        $menus = Menu::with('parent')->get();

        return view('Dashboard.Menus.index', compact('menus'));
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        $this->authorize('menus.create');

        $menus = Menu::with('parent')->get();

        return view('Dashboard.Menus.create', compact('menus'));
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(StoreMenuRequest $request)
    {
        $this->authorize('menus.store');

        try {
            $data = $request->validated();

            $this->menuService->store($data);

            return redirect()->back()->with(['success' => __('dashboard.your_item_added_successfully')]);
        } catch (\Exception $e) {

            return redirect()->back()->with(['error' => __('dashboard.failed_to_add_item')]);
        }
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(Menu $menu)
    {
        $this->authorize('menus.edit');

        $menu->load('parent');
        $menus = Menu::with('parent')->get();

        return view('Dashboard.Menus.edit', compact('menu', 'menus'));
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(UpdateMenuRequest $request, Menu $menu)
    {

        $this->authorize('menus.update');

        try {
            $data = $request->validated();

            $this->menuService->update($data, $menu);

            return redirect()->route('dashboard.menus.index')->with(['success' => __('dashboard.your_item_updated_successfully')]);
        } catch (\Exception $e) {

            return response()->json(['success' => false, 'message' => __('status update failed')]);
        }
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(DeleteMenuRequest $request, Menu $menu)
    {
        $this->authorize('menus.delete');

        $selectedIds = $request->input('selectedIds');

        $deleted = $this->menuService->delete($selectedIds);

        if (request()->ajax()) {
            if (! $deleted) {
                return response()->json(['message' => $deleted ?? __('dashboard.an messages.error entering data')], 422);
            }

            return response()->json(['success' => true, 'message' => __('dashboard.your_items_deleted_successfully')]);
        }
        if (! $deleted) {
            return redirect()->back()->withErrors($delete ?? __('dashboard.an error has occurred. Please contact the developer to resolve the issue'));
        }
    }
}
