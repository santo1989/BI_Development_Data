<?php

namespace App\Http\Controllers\Api;

use App\Models\ItemUmo;
use Illuminate\Http\Request;
use Illuminate\Http\Response;
use App\Http\Controllers\Controller;
use App\Http\Resources\ItemUmoResource;
use App\Http\Resources\ItemUmoCollection;
use App\Http\Requests\ItemUmoStoreRequest;
use App\Http\Requests\ItemUmoUpdateRequest;

class ItemUmoController extends Controller
{
    public function index(Request $request): ItemUmoCollection
    {
        $this->authorize('view-any', ItemUmo::class);

        $search = $request->get('search', '');

        $itemUmos = ItemUmo::search($search)
            ->latest()
            ->paginate();

        return new ItemUmoCollection($itemUmos);
    }

    public function store(ItemUmoStoreRequest $request): ItemUmoResource
    {
        $this->authorize('create', ItemUmo::class);

        $validated = $request->validated();

        $itemUmo = ItemUmo::create($validated);

        return new ItemUmoResource($itemUmo);
    }

    public function show(Request $request, ItemUmo $itemUmo): ItemUmoResource
    {
        $this->authorize('view', $itemUmo);

        return new ItemUmoResource($itemUmo);
    }

    public function update(
        ItemUmoUpdateRequest $request,
        ItemUmo $itemUmo
    ): ItemUmoResource {
        $this->authorize('update', $itemUmo);

        $validated = $request->validated();

        $itemUmo->update($validated);

        return new ItemUmoResource($itemUmo);
    }

    public function destroy(Request $request, ItemUmo $itemUmo): Response
    {
        $this->authorize('delete', $itemUmo);

        $itemUmo->delete();

        return response()->noContent();
    }
}
