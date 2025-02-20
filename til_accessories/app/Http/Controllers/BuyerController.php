<?php

namespace App\Http\Controllers;

use App\Models\Buyer;
use Illuminate\View\View;
use Illuminate\Http\Request;
use Illuminate\Http\RedirectResponse;
use App\Http\Requests\BuyerStoreRequest;
use App\Http\Requests\BuyerUpdateRequest;

class BuyerController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index(Request $request): View
    {
        $this->authorize('view-any', Buyer::class);

        $search = $request->get('search', '');

        $buyers = Buyer::search($search)
            ->latest()
            ->paginate(5)
            ->withQueryString();

        return view('app.buyers.index', compact('buyers', 'search'));
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create(Request $request): View
    {
        $this->authorize('create', Buyer::class);

        return view('app.buyers.create');
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(BuyerStoreRequest $request): RedirectResponse
    {
        $this->authorize('create', Buyer::class);

        $validated = $request->validated();

        $buyer = Buyer::create($validated);

        return redirect()
            ->route('buyers.edit', $buyer)
            ->withSuccess(__('crud.common.created'));
    }

    /**
     * Display the specified resource.
     */
    public function show(Request $request, Buyer $buyer): View
    {
        $this->authorize('view', $buyer);

        return view('app.buyers.show', compact('buyer'));
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(Request $request, Buyer $buyer): View
    {
        $this->authorize('update', $buyer);

        return view('app.buyers.edit', compact('buyer'));
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(
        BuyerUpdateRequest $request,
        Buyer $buyer
    ): RedirectResponse {
        $this->authorize('update', $buyer);

        $validated = $request->validated();

        $buyer->update($validated);

        return redirect()
            ->route('buyers.edit', $buyer)
            ->withSuccess(__('crud.common.saved'));
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Request $request, Buyer $buyer): RedirectResponse
    {
        $this->authorize('delete', $buyer);

        $buyer->delete();

        return redirect()
            ->route('buyers.index')
            ->withSuccess(__('crud.common.removed'));
    }
}
