<?php

namespace App\Http\Controllers\Dashboard;

use App\Http\Controllers\Controller;
use App\Http\Requests\Dashboard\Album\DeleteAlbumRequest;
use App\Http\Requests\Dashboard\Album\StoreAlbumRequest;
use App\Http\Requests\Dashboard\Album\UpdateAlbumRequest;
use App\Models\Album;
use App\Services\Dashboard\AlbumService;

class AlbumController extends Controller
{
    public function __construct(private AlbumService $albumService) {}

    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $this->authorize('albums.view');

        $albums = Album::orderBy('id', 'desc')->get();

        return view('Dashboard.Albums.index', compact('albums'));
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {

        $this->authorize('albums.create');
        $data['album'] = new Album;
        $data['albums'] = Album::get();

        return view('Dashboard.Albums.create', $data);
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(StoreAlbumRequest $request)
    {
        $this->authorize('albums.store');
        try {
            $data = $request->validated();
            $response = $this->albumService->store($request, $data);

            if (! $response) {
                return redirect()->back()->with(['error' => __('dashboard.failed_to_create_item')]);
            }

            return redirect()->route('dashboard.albums.index')->with(['success' => __('dashboard.your_item_created_successfully')]);
        } catch (\Exception $e) {
            return redirect()->back()->with('error', $e->getMessage());
        }
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(Album $album)
    {
        $this->authorize('albums.edit');
        $data['album'] = $album;
        $data['albums'] = Album::get();

        return view('Dashboard.Albums.edit', $data);
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(UpdateAlbumRequest $request, Album $album)
    {
        $this->authorize('albums.update');
        try {
            $response = $this->albumService->update($request, $album);

            if (! $response) {
                return redirect()->back()->with(['error' => __('dashboard.failed_to_update_item')]);
            }

            return redirect()->route('dashboard.albums.index')->with(['success' => __('dashboard.your_item_updated_successfully')]);
        } catch (\Exception $e) {
            return redirect()->back()->with('error', $e->getMessage());
        }
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(DeleteAlbumRequest $request, string $id)
    {
        $this->authorize('albums.delete');

        $selectedIds = $request->input('selectedIds');

        $data = $request->validated();

        $deleted = $this->albumService->delete($selectedIds, $data);

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
