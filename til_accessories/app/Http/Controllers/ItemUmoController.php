<?php

namespace App\Http\Controllers;

use App\Models\ItemUmo;
use Illuminate\View\View;
use Illuminate\Http\Request;
use Illuminate\Http\RedirectResponse;
use App\Http\Requests\ItemUmoStoreRequest;
use App\Http\Requests\ItemUmoUpdateRequest;

class ItemUmoController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index(Request $request): View
    {
        $this->authorize('view-any', ItemUmo::class);

        $search = $request->get('search', '');

        $itemUmos = ItemUmo::search($search)
            ->latest()
            ->paginate(5)
            ->withQueryString();

        return view('app.item_umos.index', compact('itemUmos', 'search'));
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create(Request $request): View
    {
        $this->authorize('create', ItemUmo::class);

        return view('app.item_umos.create');
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(ItemUmoStoreRequest $request): RedirectResponse
    {
        $this->authorize('create', ItemUmo::class);

        $validated = $request->validated();

        $itemUmo = ItemUmo::create($validated);

        return redirect()
            ->route('item-umos.edit', $itemUmo)
            ->withSuccess(__('crud.common.created'));
    }

    /**
     * Display the specified resource.
     */
    public function show(Request $request, ItemUmo $itemUmo): View
    {
        $this->authorize('view', $itemUmo);

        return view('app.item_umos.show', compact('itemUmo'));
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(Request $request, ItemUmo $itemUmo): View
    {
        $this->authorize('update', $itemUmo);

        return view('app.item_umos.edit', compact('itemUmo'));
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(
        ItemUmoUpdateRequest $request,
        ItemUmo $itemUmo
    ): RedirectResponse {
        $this->authorize('update', $itemUmo);

        $validated = $request->validated();

        $itemUmo->update($validated);

        return redirect()
            ->route('item-umos.edit', $itemUmo)
            ->withSuccess(__('crud.common.saved'));
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(
        Request $request,
        ItemUmo $itemUmo
    ): RedirectResponse {
        $this->authorize('delete', $itemUmo);

        $itemUmo->delete();

        return redirect()
            ->route('item-umos.index')
            ->withSuccess(__('crud.common.removed'));
    }
}
