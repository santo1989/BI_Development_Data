<?php

namespace App\Http\Controllers\Api;

use App\Models\Buyer;
use Illuminate\Http\Request;
use Illuminate\Http\Response;
use App\Http\Controllers\Controller;
use App\Http\Resources\BuyerResource;
use App\Http\Resources\BuyerCollection;
use App\Http\Requests\BuyerStoreRequest;
use App\Http\Requests\BuyerUpdateRequest;

class BuyerController extends Controller
{
    public function index(Request $request): BuyerCollection
    {
        $this->authorize('view-any', Buyer::class);

        $search = $request->get('search', '');

        $buyers = Buyer::search($search)
            ->latest()
            ->paginate();

        return new BuyerCollection($buyers);
    }

    public function store(BuyerStoreRequest $request): BuyerResource
    {
        $this->authorize('create', Buyer::class);

        $validated = $request->validated();

        $buyer = Buyer::create($validated);

        return new BuyerResource($buyer);
    }

    public function show(Request $request, Buyer $buyer): BuyerResource
    {
        $this->authorize('view', $buyer);

        return new BuyerResource($buyer);
    }

    public function update(
        BuyerUpdateRequest $request,
        Buyer $buyer
    ): BuyerResource {
        $this->authorize('update', $buyer);

        $validated = $request->validated();

        $buyer->update($validated);

        return new BuyerResource($buyer);
    }

    public function destroy(Request $request, Buyer $buyer): Response
    {
        $this->authorize('delete', $buyer);

        $buyer->delete();

        return response()->noContent();
    }
}
