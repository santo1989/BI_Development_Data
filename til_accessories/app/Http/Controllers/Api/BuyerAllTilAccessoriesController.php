<?php

namespace App\Http\Controllers\Api;

use App\Models\Buyer;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Http\Resources\TilAccessoriesResource;
use App\Http\Resources\TilAccessoriesCollection;

class BuyerAllTilAccessoriesController extends Controller
{
    public function index(
        Request $request,
        Buyer $buyer
    ): TilAccessoriesCollection {
        $this->authorize('view', $buyer);

        $search = $request->get('search', '');

        $allTilAccessories = $buyer
            ->allTilAccessories()
            ->search($search)
            ->latest()
            ->paginate();

        return new TilAccessoriesCollection($allTilAccessories);
    }

    public function store(
        Request $request,
        Buyer $buyer
    ): TilAccessoriesResource {
        $this->authorize('create', TilAccessories::class);

        $validated = $request->validate([
            'WO_No' => 'required|max:255|string',
            'Approved_Date' => 'nullable|max:255|string',
            'Internal_Ref_No' => 'nullable|max:255|string',
            'WO_Date' => 'required|date',
            'Delivery_Date' => 'nullable|date',
            'WO_Type' => 'nullable|max:255|string',
            'Supplier' => 'nullable|max:255|string',
            'Buyer' => 'nullable|max:255|string',
            'Job_Year' => 'nullable|numeric',
            'Job_No' => 'nullable|max:255|string',
            'Style_Ref' => 'nullable|max:255|string',
            'Order_No' => 'nullable|max:255|string',
            'Order_qty' => 'nullable|max:255|string',
            'Item_Name' => 'nullable|max:255|string',
            'item_id' => 'nullable|exists:items,id',
            'Description' => 'nullable|max:255|string',
            'UOM' => 'nullable|max:255|string',
            'itemUmo_id' => 'required|exists:item_umos,id',
            'WO_Qty' => 'nullable|numeric',
            'WO_Unit_price' => 'nullable|numeric',
            'WO_value' => 'nullable|numeric',
            'Budget_Unit_price' => 'nullable|numeric',
            'Precost_value' => 'nullable|numeric',
            'Deference' => 'nullable|numeric',
            'Deference_percent' => 'nullable|numeric',
            'On_Time_Receive' => 'nullable|numeric',
            'OTD_percent' => 'nullable|numeric',
            'Total_Receive_Qty' => 'nullable|numeric',
            'Receive_Value' => 'nullable|numeric',
            'Receive_Balance' => 'nullable|numeric',
            'Dealing_Merchant' => 'nullable|max:255|string',
            'Team_Leader' => 'nullable|max:255|string',
            'User_Name' => 'nullable|max:255|string',
            'Remarks' => 'nullable|max:255|string',
        ]);

        $tilAccessories = $buyer->allTilAccessories()->create($validated);

        return new TilAccessoriesResource($tilAccessories);
    }
}
