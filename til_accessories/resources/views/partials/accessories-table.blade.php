<div class="table-responsive">
    <table class="table table-borderless table-hover">
        <thead>
            <tr>
                @foreach($selectedFields as $field)
                    <th class="text-left">
                        {{ $field['label'] }}
                    </th>
                @endforeach
                <th class="text-center">@lang('crud.common.actions')</th>
            </tr>
        </thead>
        <tbody>
            @forelse($tilAccessories as $accessory)
                <tr>
                    @foreach($selectedFields as $field)
                        <td>{{ $accessory->{$field['key']} ?? '-' }}</td>
                    @endforeach
                    <td class="text-center" style="width: 134px;">
                        <!-- Action buttons -->
                    </td>
                </tr>
            @empty
                <tr>
                    <td colspan="{{ count($selectedFields) + 1 }}">
                        @lang('crud.common.no_items_found')
                    </td>
                </tr>
            @endforelse
        </tbody>
        <tfoot>
            <tr>
                <td colspan="{{ count($selectedFields) + 1 }}">
                    {{ $tilAccessories->links() }}
                </td>
            </tr>
        </tfoot>
    </table>
</div>