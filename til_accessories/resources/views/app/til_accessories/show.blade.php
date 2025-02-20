@extends('layouts.app')

@section('content')
<div class="container">
    <div class="card">
        <div class="card-body">
            <h4 class="card-title">
                <a href="{{ route('til-accessories.index') }}" class="mr-4"
                    ><i class="icon ion-md-arrow-back"></i
                ></a>
                @lang('crud.til_accessories_list.show_title')
            </h4>

            <div class="mt-4">
                <div class="mb-4">
                    <h5>@lang('crud.til_accessories_list.inputs.WO_No')</h5>
                    <span>{{ $tilAccessories->WO_No ?? '-' }}</span>
                </div>
                <div class="mb-4">
                    <h5>
                        @lang('crud.til_accessories_list.inputs.Approved_Date')
                    </h5>
                    <span>{{ $tilAccessories->Approved_Date ?? '-' }}</span>
                </div>
                <div class="mb-4">
                    <h5>
                        @lang('crud.til_accessories_list.inputs.Internal_Ref_No')
                    </h5>
                    <span>{{ $tilAccessories->Internal_Ref_No ?? '-' }}</span>
                </div>
                <div class="mb-4">
                    <h5>@lang('crud.til_accessories_list.inputs.WO_Date')</h5>
                    <span>{{ $tilAccessories->WO_Date ?? '-' }}</span>
                </div>
                <div class="mb-4">
                    <h5>
                        @lang('crud.til_accessories_list.inputs.Delivery_Date')
                    </h5>
                    <span>{{ $tilAccessories->Delivery_Date ?? '-' }}</span>
                </div>
                <div class="mb-4">
                    <h5>@lang('crud.til_accessories_list.inputs.WO_Type')</h5>
                    <span>{{ $tilAccessories->WO_Type ?? '-' }}</span>
                </div>
                <div class="mb-4">
                    <h5>@lang('crud.til_accessories_list.inputs.Supplier')</h5>
                    <span>{{ $tilAccessories->Supplier ?? '-' }}</span>
                </div>
                <div class="mb-4">
                    <h5>@lang('crud.til_accessories_list.inputs.Buyer')</h5>
                    <span>{{ $tilAccessories->Buyer ?? '-' }}</span>
                </div>
                <div class="mb-4">
                    <h5>@lang('crud.til_accessories_list.inputs.Job_Year')</h5>
                    <span>{{ $tilAccessories->Job_Year ?? '-' }}</span>
                </div>
                <div class="mb-4">
                    <h5>@lang('crud.til_accessories_list.inputs.Job_No')</h5>
                    <span>{{ $tilAccessories->Job_No ?? '-' }}</span>
                </div>
                <div class="mb-4">
                    <h5>@lang('crud.til_accessories_list.inputs.Style_Ref')</h5>
                    <span>{{ $tilAccessories->Style_Ref ?? '-' }}</span>
                </div>
                <div class="mb-4">
                    <h5>@lang('crud.til_accessories_list.inputs.Order_No')</h5>
                    <span>{{ $tilAccessories->Order_No ?? '-' }}</span>
                </div>
                <div class="mb-4">
                    <h5>@lang('crud.til_accessories_list.inputs.Order_qty')</h5>
                    <span>{{ $tilAccessories->Order_qty ?? '-' }}</span>
                </div>
                <div class="mb-4">
                    <h5>@lang('crud.til_accessories_list.inputs.Item_Name')</h5>
                    <span>{{ $tilAccessories->Item_Name ?? '-' }}</span>
                </div>
                <div class="mb-4">
                    <h5>
                        @lang('crud.til_accessories_list.inputs.Description')
                    </h5>
                    <span>{{ $tilAccessories->Description ?? '-' }}</span>
                </div>
                <div class="mb-4">
                    <h5>@lang('crud.til_accessories_list.inputs.UOM')</h5>
                    <span>{{ $tilAccessories->UOM ?? '-' }}</span>
                </div>
                <div class="mb-4">
                    <h5>@lang('crud.til_accessories_list.inputs.WO_Qty')</h5>
                    <span>{{ $tilAccessories->WO_Qty ?? '-' }}</span>
                </div>
                <div class="mb-4">
                    <h5>
                        @lang('crud.til_accessories_list.inputs.WO_Unit_price')
                    </h5>
                    <span>{{ $tilAccessories->WO_Unit_price ?? '-' }}</span>
                </div>
                <div class="mb-4">
                    <h5>@lang('crud.til_accessories_list.inputs.WO_value')</h5>
                    <span>{{ $tilAccessories->WO_value ?? '-' }}</span>
                </div>
                <div class="mb-4">
                    <h5>
                        @lang('crud.til_accessories_list.inputs.Budget_Unit_price')
                    </h5>
                    <span>{{ $tilAccessories->Budget_Unit_price ?? '-' }}</span>
                </div>
                <div class="mb-4">
                    <h5>
                        @lang('crud.til_accessories_list.inputs.Precost_value')
                    </h5>
                    <span>{{ $tilAccessories->Precost_value ?? '-' }}</span>
                </div>
                <div class="mb-4">
                    <h5>@lang('crud.til_accessories_list.inputs.Deference')</h5>
                    <span>{{ $tilAccessories->Deference ?? '-' }}</span>
                </div>
                <div class="mb-4">
                    <h5>
                        @lang('crud.til_accessories_list.inputs.Deference_percent')
                    </h5>
                    <span>{{ $tilAccessories->Deference_percent ?? '-' }}</span>
                </div>
                <div class="mb-4">
                    <h5>
                        @lang('crud.til_accessories_list.inputs.On_Time_Receive')
                    </h5>
                    <span>{{ $tilAccessories->On_Time_Receive ?? '-' }}</span>
                </div>
                <div class="mb-4">
                    <h5>
                        @lang('crud.til_accessories_list.inputs.OTD_percent')
                    </h5>
                    <span>{{ $tilAccessories->OTD_percent ?? '-' }}</span>
                </div>
                <div class="mb-4">
                    <h5>
                        @lang('crud.til_accessories_list.inputs.Total_Receive_Qty')
                    </h5>
                    <span>{{ $tilAccessories->Total_Receive_Qty ?? '-' }}</span>
                </div>
                <div class="mb-4">
                    <h5>
                        @lang('crud.til_accessories_list.inputs.Receive_Value')
                    </h5>
                    <span>{{ $tilAccessories->Receive_Value ?? '-' }}</span>
                </div>
                <div class="mb-4">
                    <h5>
                        @lang('crud.til_accessories_list.inputs.Receive_Balance')
                    </h5>
                    <span>{{ $tilAccessories->Receive_Balance ?? '-' }}</span>
                </div>
                <div class="mb-4">
                    <h5>
                        @lang('crud.til_accessories_list.inputs.Dealing_Merchant')
                    </h5>
                    <span>{{ $tilAccessories->Dealing_Merchant ?? '-' }}</span>
                </div>
                <div class="mb-4">
                    <h5>
                        @lang('crud.til_accessories_list.inputs.Team_Leader')
                    </h5>
                    <span>{{ $tilAccessories->Team_Leader ?? '-' }}</span>
                </div>
                <div class="mb-4">
                    <h5>@lang('crud.til_accessories_list.inputs.buyer_id')</h5>
                    <span
                        >{{ optional($tilAccessories->buyer)->name ?? '-'
                        }}</span
                    >
                </div>
                <div class="mb-4">
                    <h5>@lang('crud.til_accessories_list.inputs.User_Name')</h5>
                    <span>{{ $tilAccessories->User_Name ?? '-' }}</span>
                </div>
                <div class="mb-4">
                    <h5>@lang('crud.til_accessories_list.inputs.item_id')</h5>
                    <span
                        >{{ optional($tilAccessories->item)->name ?? '-'
                        }}</span
                    >
                </div>
                <div class="mb-4">
                    <h5>@lang('crud.til_accessories_list.inputs.Remarks')</h5>
                    <span>{{ $tilAccessories->Remarks ?? '-' }}</span>
                </div>
                <div class="mb-4">
                    <h5>
                        @lang('crud.til_accessories_list.inputs.item_umo_id')
                    </h5>
                    <span
                        >{{ optional($tilAccessories->itemUmo)->name ?? '-'
                        }}</span
                    >
                </div>
            </div>

            <div class="mt-4">
                <a
                    href="{{ route('til-accessories.index') }}"
                    class="btn btn-light"
                >
                    <i class="icon ion-md-return-left"></i>
                    @lang('crud.common.back')
                </a>

                @can('create', App\Models\TilAccessories::class)
                <a
                    href="{{ route('til-accessories.create') }}"
                    class="btn btn-light"
                >
                    <i class="icon ion-md-add"></i> @lang('crud.common.create')
                </a>
                @endcan
            </div>
        </div>
    </div>
</div>
@endsection
