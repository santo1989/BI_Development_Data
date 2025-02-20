<?php

namespace App\Http\Controllers\Api;

use Illuminate\Http\Request;
use Illuminate\Http\Response;
use App\Models\TilAccessories;
use App\Http\Controllers\Controller;
use App\Http\Resources\TilAccessoriesResource;
use App\Http\Resources\TilAccessoriesCollection;
use App\Http\Requests\TilAccessoriesStoreRequest;
use App\Http\Requests\TilAccessoriesUpdateRequest;

class TilAccessoriesController extends Controller
{
    public function index(Request $request): TilAccessoriesCollection
    {
        $this->authorize('view-any', TilAccessories::class);

        $search = $request->get('search', '');

        $tilAccessories = TilAccessories::search($search)
            ->latest()
            ->paginate();

        return new TilAccessoriesCollection($tilAccessories);
    }

    public function store(
        TilAccessoriesStoreRequest $request
    ): TilAccessoriesResource {
        $this->authorize('create', TilAccessories::class);

        $validated = $request->validated();

        $tilAccessories = TilAccessories::create($validated);

        return new TilAccessoriesResource($tilAccessories);
    }

    public function show(
        Request $request,
        TilAccessories $tilAccessories
    ): TilAccessoriesResource {
        $this->authorize('view', $tilAccessories);

        return new TilAccessoriesResource($tilAccessories);
    }

    public function update(
        TilAccessoriesUpdateRequest $request,
        TilAccessories $tilAccessories
    ): TilAccessoriesResource {
        $this->authorize('update', $tilAccessories);

        $validated = $request->validated();

        $tilAccessories->update($validated);

        return new TilAccessoriesResource($tilAccessories);
    }

    public function destroy(
        Request $request,
        TilAccessories $tilAccessories
    ): Response {
        $this->authorize('delete', $tilAccessories);

        $tilAccessories->delete();

        return response()->noContent();
    }
}
