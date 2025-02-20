@extends('layouts.app')

@section('content')
    <div class="container">
        <div class="searchbar mt-0 mb-4">
            <div class="row">
                <div class="col-md-6">
                    <form>
                        <div class="input-group">
                            <input id="indexSearch" type="text" name="search" placeholder="{{ __('crud.common.search') }}"
                                value="{{ $search ?? '' }}" class="form-control" autocomplete="off" />
                            <div class="input-group-append">
                                <button type="submit" class="btn btn-primary">
                                    <i class="icon ion-md-search"></i>
                                </button>
                            </div>
                        </div>
                    </form>
                </div>
                <div class="col-md-6 text-right">
                    <a href="{{ route('import-accessories') }}">
                        <button type="button" class="btn btn-dark">
                            <i class="icon ion-md-cloud-upload"></i> Excel Upload
                        </button>
                    </a>
                    @can('create', App\Models\TilAccessories::class)
                        <a href="{{ route('til-accessories.create') }}" class="btn btn-primary">
                            <i class="icon ion-md-add"></i> @lang('crud.common.create')
                        </a>
                    @endcan
                </div>
            </div>
        </div>

        <div class="card">
            <div class="card-body">
                <div style="display: flex; justify-content: space-between;">
                    <h4 class="card-title">
                        @lang('crud.til_accessories_list.index_title')
                    </h4>
                </div>

                <div class="table-responsive">
                    <table class="table table-borderless table-hover">
                        <thead>
                            <tr>
                                <th class="text-left">
                                    @lang('crud.til_accessories_list.inputs.WO_No')
                                </th>
                                <th class="text-left">
                                    @lang('crud.til_accessories_list.inputs.Approved_Date')
                                </th>
                                <th class="text-left">
                                    @lang('crud.til_accessories_list.inputs.Internal_Ref_No')
                                </th>
                                <th class="text-left">
                                    @lang('crud.til_accessories_list.inputs.WO_Date')
                                </th>
                                <th class="text-left">
                                    @lang('crud.til_accessories_list.inputs.Delivery_Date')
                                </th>
                                <th class="text-left">
                                    @lang('crud.til_accessories_list.inputs.WO_Type')
                                </th>
                                <th class="text-left">
                                    @lang('crud.til_accessories_list.inputs.Supplier')
                                </th>
                                <th class="text-left">
                                    @lang('crud.til_accessories_list.inputs.Buyer')
                                </th>
                                <th class="text-right">
                                    @lang('crud.til_accessories_list.inputs.Job_Year')
                                </th>
                                <th class="text-left">
                                    @lang('crud.til_accessories_list.inputs.Job_No')
                                </th>
                                <th class="text-left">
                                    @lang('crud.til_accessories_list.inputs.Style_Ref')
                                </th>
                                <th class="text-left">
                                    @lang('crud.til_accessories_list.inputs.Order_No')
                                </th>
                                <th class="text-left">
                                    @lang('crud.til_accessories_list.inputs.Order_qty')
                                </th>
                                <th class="text-left">
                                    @lang('crud.til_accessories_list.inputs.Item_Name')
                                </th>
                                <th class="text-left">
                                    @lang('crud.til_accessories_list.inputs.Description')
                                </th>
                                <th class="text-left">
                                    @lang('crud.til_accessories_list.inputs.UOM')
                                </th>
                                <th class="text-right">
                                    @lang('crud.til_accessories_list.inputs.WO_Qty')
                                </th>
                                <th class="text-right">
                                    @lang('crud.til_accessories_list.inputs.WO_Unit_price')
                                </th>
                                <th class="text-right">
                                    @lang('crud.til_accessories_list.inputs.WO_value')
                                </th>
                                <th class="text-right">
                                    @lang('crud.til_accessories_list.inputs.Budget_Unit_price')
                                </th>
                                <th class="text-right">
                                    @lang('crud.til_accessories_list.inputs.Precost_value')
                                </th>
                                <th class="text-right">
                                    @lang('crud.til_accessories_list.inputs.Deference')
                                </th>
                                <th class="text-right">
                                    @lang('crud.til_accessories_list.inputs.Deference_percent')
                                </th>
                                <th class="text-right">
                                    @lang('crud.til_accessories_list.inputs.On_Time_Receive')
                                </th>
                                <th class="text-right">
                                    @lang('crud.til_accessories_list.inputs.OTD_percent')
                                </th>
                                <th class="text-right">
                                    @lang('crud.til_accessories_list.inputs.Total_Receive_Qty')
                                </th>
                                <th class="text-right">
                                    @lang('crud.til_accessories_list.inputs.Receive_Value')
                                </th>
                                <th class="text-right">
                                    @lang('crud.til_accessories_list.inputs.Receive_Balance')
                                </th>
                                <th class="text-left">
                                    @lang('crud.til_accessories_list.inputs.Dealing_Merchant')
                                </th>
                                <th class="text-left">
                                    @lang('crud.til_accessories_list.inputs.Team_Leader')
                                </th>
                                <th class="text-left">
                                    @lang('crud.til_accessories_list.inputs.buyer_id')
                                </th>
                                <th class="text-left">
                                    @lang('crud.til_accessories_list.inputs.User_Name')
                                </th>
                                <th class="text-left">
                                    @lang('crud.til_accessories_list.inputs.item_id')
                                </th>
                                <th class="text-left">
                                    @lang('crud.til_accessories_list.inputs.Remarks')
                                </th>
                                <th class="text-left">
                                    @lang('crud.til_accessories_list.inputs.item_umo_id')
                                </th>
                                <th class="text-center">
                                    @lang('crud.common.actions')
                                </th>
                            </tr>
                        </thead>
                        <tbody>
                            @forelse($tilAccessories as $tilAccessories)
                                <tr>
                                    <td>{{ $tilAccessories->WO_No ?? '-' }}</td>
                                    <td>{{ $tilAccessories->Approved_Date ?? '-' }}</td>
                                    <td>
                                        {{ $tilAccessories->Internal_Ref_No ?? '-' }}
                                    </td>
                                    <td>{{ $tilAccessories->WO_Date ?? '-' }}</td>
                                    <td>{{ $tilAccessories->Delivery_Date ?? '-' }}</td>
                                    <td>{{ $tilAccessories->WO_Type ?? '-' }}</td>
                                    <td>{{ $tilAccessories->Supplier ?? '-' }}</td>
                                    <td>{{ $tilAccessories->Buyer ?? '-' }}</td>
                                    <td>{{ $tilAccessories->Job_Year ?? '-' }}</td>
                                    <td>{{ $tilAccessories->Job_No ?? '-' }}</td>
                                    <td>{{ $tilAccessories->Style_Ref ?? '-' }}</td>
                                    <td>{{ $tilAccessories->Order_No ?? '-' }}</td>
                                    <td>{{ $tilAccessories->Order_qty ?? '-' }}</td>
                                    <td>{{ $tilAccessories->Item_Name ?? '-' }}</td>
                                    <td>{{ $tilAccessories->Description ?? '-' }}</td>
                                    <td>{{ $tilAccessories->UOM ?? '-' }}</td>
                                    <td>{{ $tilAccessories->WO_Qty ?? '-' }}</td>
                                    <td>{{ $tilAccessories->WO_Unit_price ?? '-' }}</td>
                                    <td>{{ $tilAccessories->WO_value ?? '-' }}</td>
                                    <td>
                                        {{ $tilAccessories->Budget_Unit_price ?? '-' }}
                                    </td>
                                    <td>{{ $tilAccessories->Precost_value ?? '-' }}</td>
                                    <td>{{ $tilAccessories->Deference ?? '-' }}</td>
                                    <td>
                                        {{ $tilAccessories->Deference_percent ?? '-' }}
                                    </td>
                                    <td>
                                        {{ $tilAccessories->On_Time_Receive ?? '-' }}
                                    </td>
                                    <td>{{ $tilAccessories->OTD_percent ?? '-' }}</td>
                                    <td>
                                        {{ $tilAccessories->Total_Receive_Qty ?? '-' }}
                                    </td>
                                    <td>{{ $tilAccessories->Receive_Value ?? '-' }}</td>
                                    <td>
                                        {{ $tilAccessories->Receive_Balance ?? '-' }}
                                    </td>
                                    <td>
                                        {{ $tilAccessories->Dealing_Merchant ?? '-' }}
                                    </td>
                                    <td>{{ $tilAccessories->Team_Leader ?? '-' }}</td>
                                    <td>
                                        {{ optional($tilAccessories->buyer)->name ?? '-' }}
                                    </td>
                                    <td>{{ $tilAccessories->User_Name ?? '-' }}</td>
                                    <td>
                                        {{ optional($tilAccessories->item)->name ?? '-' }}
                                    </td>
                                    <td>{{ $tilAccessories->Remarks ?? '-' }}</td>
                                    <td>
                                        {{ optional($tilAccessories->itemUmo)->name ?? '-' }}
                                    </td>
                                    <td class="text-center" style="width: 134px;">
                                        <div role="group" aria-label="Row Actions" class="btn-group">
                                            @can('update', $tilAccessories)
                                                <a href="{{ route('til-accessories.edit', $tilAccessories) }}">
                                                    <button type="button" class="btn btn-light">
                                                        <i class="icon ion-md-create"></i>
                                                    </button>
                                                </a>
                                                @endcan @can('view', $tilAccessories)
                                                <a href="{{ route('til-accessories.show', $tilAccessories) }}">
                                                    <button type="button" class="btn btn-light">
                                                        <i class="icon ion-md-eye"></i>
                                                    </button>
                                                </a>
                                                @endcan @can('delete', $tilAccessories)
                                                <form action="{{ route('til-accessories.destroy', $tilAccessories) }}"
                                                    method="POST"
                                                    onsubmit="return confirm('{{ __('crud.common.are_you_sure') }}')">
                                                    @csrf @method('DELETE')
                                                    <button type="submit" class="btn btn-light text-danger">
                                                        <i class="icon ion-md-trash"></i>
                                                    </button>
                                                </form>
                                            @endcan
                                        </div>
                                    </td>
                                </tr>
                            @empty
                                <tr>
                                    <td colspan="36">
                                        @lang('crud.common.no_items_found')
                                    </td>
                                </tr>
                            @endforelse
                        </tbody>
                        <tfoot>
                            <tr>
                                <td colspan="36">
                                    {{-- {!! $tilAccessories->render() !!} --}}
                                    {{-- {{ $tilAccessories->links() }} --}}
                                </td>
                            </tr>
                        </tfoot>
                    </table>
                </div>
            </div>
        </div>
    </div>
@endsection
