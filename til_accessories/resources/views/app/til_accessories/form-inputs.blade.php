@php $editing = isset($tilAccessories) @endphp

<div class="row">
    <x-inputs.group class="col-sm-12">
        <x-inputs.text
            name="WO_No"
            label="Wo No"
            :value="old('WO_No', ($editing ? $tilAccessories->WO_No : ''))"
            maxlength="255"
            placeholder="Wo No"
            required
        ></x-inputs.text>
    </x-inputs.group>

    <x-inputs.group class="col-sm-12">
        <x-inputs.text
            name="Approved_Date"
            label="Approved Date"
            :value="old('Approved_Date', ($editing ? $tilAccessories->Approved_Date : ''))"
            maxlength="255"
            placeholder="Approved Date"
        ></x-inputs.text>
    </x-inputs.group>

    <x-inputs.group class="col-sm-12">
        <x-inputs.text
            name="Internal_Ref_No"
            label="Internal Ref No"
            :value="old('Internal_Ref_No', ($editing ? $tilAccessories->Internal_Ref_No : ''))"
            maxlength="255"
            placeholder="Internal Ref No"
        ></x-inputs.text>
    </x-inputs.group>

    <x-inputs.group class="col-sm-12">
        <x-inputs.date
            name="WO_Date"
            label="Wo Date"
            value="{{ old('WO_Date', ($editing ? optional($tilAccessories->WO_Date)->format('Y-m-d') : '')) }}"
            max="255"
            required
        ></x-inputs.date>
    </x-inputs.group>

    <x-inputs.group class="col-sm-12">
        <x-inputs.date
            name="Delivery_Date"
            label="Delivery Date"
            value="{{ old('Delivery_Date', ($editing ? optional($tilAccessories->Delivery_Date)->format('Y-m-d') : '')) }}"
            max="255"
        ></x-inputs.date>
    </x-inputs.group>

    <x-inputs.group class="col-sm-12">
        <x-inputs.text
            name="WO_Type"
            label="Wo Type"
            :value="old('WO_Type', ($editing ? $tilAccessories->WO_Type : ''))"
            maxlength="255"
            placeholder="Wo Type"
        ></x-inputs.text>
    </x-inputs.group>

    <x-inputs.group class="col-sm-12">
        <x-inputs.text
            name="Supplier"
            label="Supplier"
            :value="old('Supplier', ($editing ? $tilAccessories->Supplier : ''))"
            maxlength="255"
            placeholder="Supplier"
        ></x-inputs.text>
    </x-inputs.group>

    <x-inputs.group class="col-sm-12">
        <x-inputs.text
            name="Buyer"
            label="Buyer"
            :value="old('Buyer', ($editing ? $tilAccessories->Buyer : ''))"
            maxlength="255"
            placeholder="Buyer"
        ></x-inputs.text>
    </x-inputs.group>

    <x-inputs.group class="col-sm-12">
        <x-inputs.number
            name="Job_Year"
            label="Job Year"
            :value="old('Job_Year', ($editing ? $tilAccessories->Job_Year : ''))"
            max="255"
            placeholder="Job Year"
        ></x-inputs.number>
    </x-inputs.group>

    <x-inputs.group class="col-sm-12">
        <x-inputs.text
            name="Job_No"
            label="Job No"
            :value="old('Job_No', ($editing ? $tilAccessories->Job_No : ''))"
            maxlength="255"
            placeholder="Job No"
        ></x-inputs.text>
    </x-inputs.group>

    <x-inputs.group class="col-sm-12">
        <x-inputs.text
            name="Style_Ref"
            label="Style Ref"
            :value="old('Style_Ref', ($editing ? $tilAccessories->Style_Ref : ''))"
            maxlength="255"
            placeholder="Style Ref"
        ></x-inputs.text>
    </x-inputs.group>

    <x-inputs.group class="col-sm-12">
        <x-inputs.text
            name="Order_No"
            label="Order No"
            :value="old('Order_No', ($editing ? $tilAccessories->Order_No : ''))"
            maxlength="255"
            placeholder="Order No"
        ></x-inputs.text>
    </x-inputs.group>

    <x-inputs.group class="col-sm-12">
        <x-inputs.text
            name="Order_qty"
            label="Order Qty"
            :value="old('Order_qty', ($editing ? $tilAccessories->Order_qty : ''))"
            maxlength="255"
            placeholder="Order Qty"
        ></x-inputs.text>
    </x-inputs.group>

    <x-inputs.group class="col-sm-12">
        <x-inputs.text
            name="Item_Name"
            label="Item Name"
            :value="old('Item_Name', ($editing ? $tilAccessories->Item_Name : ''))"
            maxlength="255"
            placeholder="Item Name"
        ></x-inputs.text>
    </x-inputs.group>

    <x-inputs.group class="col-sm-12">
        <x-inputs.textarea
            name="Description"
            label="Description"
            maxlength="255"
            >{{ old('Description', ($editing ? $tilAccessories->Description :
            '')) }}</x-inputs.textarea
        >
    </x-inputs.group>

    <x-inputs.group class="col-sm-12">
        <x-inputs.text
            name="UOM"
            label="Uom"
            :value="old('UOM', ($editing ? $tilAccessories->UOM : ''))"
            maxlength="255"
            placeholder="Uom"
        ></x-inputs.text>
    </x-inputs.group>

    <x-inputs.group class="col-sm-12">
        <x-inputs.number
            name="WO_Qty"
            label="Wo Qty"
            :value="old('WO_Qty', ($editing ? $tilAccessories->WO_Qty : ''))"
            max="255"
            placeholder="Wo Qty"
        ></x-inputs.number>
    </x-inputs.group>

    <x-inputs.group class="col-sm-12">
        <x-inputs.number
            name="WO_Unit_price"
            label="Wo Unit Price"
            :value="old('WO_Unit_price', ($editing ? $tilAccessories->WO_Unit_price : ''))"
            max="255"
            step="0.01"
            placeholder="Wo Unit Price"
        ></x-inputs.number>
    </x-inputs.group>

    <x-inputs.group class="col-sm-12">
        <x-inputs.number
            name="WO_value"
            label="Wo Value"
            :value="old('WO_value', ($editing ? $tilAccessories->WO_value : ''))"
            max="255"
            step="0.01"
            placeholder="Wo Value"
        ></x-inputs.number>
    </x-inputs.group>

    <x-inputs.group class="col-sm-12">
        <x-inputs.number
            name="Budget_Unit_price"
            label="Budget Unit Price"
            :value="old('Budget_Unit_price', ($editing ? $tilAccessories->Budget_Unit_price : ''))"
            max="255"
            step="0.01"
            placeholder="Budget Unit Price"
        ></x-inputs.number>
    </x-inputs.group>

    <x-inputs.group class="col-sm-12">
        <x-inputs.number
            name="Precost_value"
            label="Precost Value"
            :value="old('Precost_value', ($editing ? $tilAccessories->Precost_value : ''))"
            max="255"
            step="0.01"
            placeholder="Precost Value"
        ></x-inputs.number>
    </x-inputs.group>

    <x-inputs.group class="col-sm-12">
        <x-inputs.number
            name="Deference"
            label="Deference"
            :value="old('Deference', ($editing ? $tilAccessories->Deference : ''))"
            max="255"
            step="0.01"
            placeholder="Deference"
        ></x-inputs.number>
    </x-inputs.group>

    <x-inputs.group class="col-sm-12">
        <x-inputs.number
            name="Deference_percent"
            label="Deference Percent"
            :value="old('Deference_percent', ($editing ? $tilAccessories->Deference_percent : ''))"
            max="255"
            step="0.01"
            placeholder="Deference Percent"
        ></x-inputs.number>
    </x-inputs.group>

    <x-inputs.group class="col-sm-12">
        <x-inputs.number
            name="On_Time_Receive"
            label="On Time Receive"
            :value="old('On_Time_Receive', ($editing ? $tilAccessories->On_Time_Receive : ''))"
            max="255"
            placeholder="On Time Receive"
        ></x-inputs.number>
    </x-inputs.group>

    <x-inputs.group class="col-sm-12">
        <x-inputs.number
            name="OTD_percent"
            label="Otd Percent"
            :value="old('OTD_percent', ($editing ? $tilAccessories->OTD_percent : ''))"
            max="255"
            placeholder="Otd Percent"
        ></x-inputs.number>
    </x-inputs.group>

    <x-inputs.group class="col-sm-12">
        <x-inputs.number
            name="Total_Receive_Qty"
            label="Total Receive Qty"
            :value="old('Total_Receive_Qty', ($editing ? $tilAccessories->Total_Receive_Qty : ''))"
            max="255"
            placeholder="Total Receive Qty"
        ></x-inputs.number>
    </x-inputs.group>

    <x-inputs.group class="col-sm-12">
        <x-inputs.number
            name="Receive_Value"
            label="Receive Value"
            :value="old('Receive_Value', ($editing ? $tilAccessories->Receive_Value : ''))"
            max="255"
            step="0.01"
            placeholder="Receive Value"
        ></x-inputs.number>
    </x-inputs.group>

    <x-inputs.group class="col-sm-12">
        <x-inputs.number
            name="Receive_Balance"
            label="Receive Balance"
            :value="old('Receive_Balance', ($editing ? $tilAccessories->Receive_Balance : ''))"
            max="255"
            step="0.01"
            placeholder="Receive Balance"
        ></x-inputs.number>
    </x-inputs.group>

    <x-inputs.group class="col-sm-12">
        <x-inputs.text
            name="Dealing_Merchant"
            label="Dealing Merchant"
            :value="old('Dealing_Merchant', ($editing ? $tilAccessories->Dealing_Merchant : ''))"
            maxlength="255"
            placeholder="Dealing Merchant"
        ></x-inputs.text>
    </x-inputs.group>

    <x-inputs.group class="col-sm-12">
        <x-inputs.text
            name="Team_Leader"
            label="Team Leader"
            :value="old('Team_Leader', ($editing ? $tilAccessories->Team_Leader : ''))"
            maxlength="255"
            placeholder="Team Leader"
        ></x-inputs.text>
    </x-inputs.group>

    <x-inputs.group class="col-sm-12">
        <x-inputs.select name="buyer_id" label="Buyer" required>
            @php $selected = old('buyer_id', ($editing ? $tilAccessories->buyer_id : '')) @endphp
            <option disabled {{ empty($selected) ? 'selected' : '' }}>Please select the Buyer</option>
            @foreach($buyers as $value => $label)
            <option value="{{ $value }}" {{ $selected == $value ? 'selected' : '' }} >{{ $label }}</option>
            @endforeach
        </x-inputs.select>
    </x-inputs.group>

    <x-inputs.group class="col-sm-12">
        <x-inputs.text
            name="User_Name"
            label="User Name"
            :value="old('User_Name', ($editing ? $tilAccessories->User_Name : ''))"
            maxlength="255"
            placeholder="User Name"
        ></x-inputs.text>
    </x-inputs.group>

    <x-inputs.group class="col-sm-12">
        <x-inputs.select name="item_id" label="Item" required>
            @php $selected = old('item_id', ($editing ? $tilAccessories->item_id : '')) @endphp
            <option disabled {{ empty($selected) ? 'selected' : '' }}>Please select the Item</option>
            @foreach($items as $value => $label)
            <option value="{{ $value }}" {{ $selected == $value ? 'selected' : '' }} >{{ $label }}</option>
            @endforeach
        </x-inputs.select>
    </x-inputs.group>

    <x-inputs.group class="col-sm-12">
        <x-inputs.textarea name="Remarks" label="Remarks" maxlength="255"
            >{{ old('Remarks', ($editing ? $tilAccessories->Remarks : ''))
            }}</x-inputs.textarea
        >
    </x-inputs.group>

    <x-inputs.group class="col-sm-12">
        <x-inputs.select name="item_umo_id" label="Item Umo" required>
            @php $selected = old('item_umo_id', ($editing ? $tilAccessories->item_umo_id : '')) @endphp
            <option disabled {{ empty($selected) ? 'selected' : '' }}>Please select the Item Umo</option>
            @foreach($itemUmos as $value => $label)
            <option value="{{ $value }}" {{ $selected == $value ? 'selected' : '' }} >{{ $label }}</option>
            @endforeach
        </x-inputs.select>
    </x-inputs.group>
</div>
