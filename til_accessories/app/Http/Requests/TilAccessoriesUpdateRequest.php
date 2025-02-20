<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class TilAccessoriesUpdateRequest extends FormRequest
{
    /**
     * Determine if the user is authorized to make this request.
     */
    public function authorize(): bool
    {
        return true;
    }

    /**
     * Get the validation rules that apply to the request.
     */
    public function rules(): array
    {
        return [
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
            'Description' => 'nullable|max:255|string',
            'UOM' => 'nullable|max:255|string',
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
            'buyer_id' => 'required|exists:buyers,id',
            'User_Name' => 'nullable|max:255|string',
            'item_id' => 'required|exists:items,id',
            'Remarks' => 'nullable|max:255|string',
            'item_umo_id' => 'required|exists:item_umos,id',
        ];
    }
}
