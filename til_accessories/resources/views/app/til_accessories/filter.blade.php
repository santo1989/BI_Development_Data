@extends('layouts.app')

@section('content')
    <div class="container">
        <div class="searchbar mt-0 mb-4">
            <div class="row">
                <!-- Existing Search Form -->
                <div class="col-md-6">
                    <form id="searchForm">
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
                    <!-- Existing Buttons -->
                </div>
            </div>
            
            <!-- Drag & Drop Cards -->
            <div class="row mt-3">
                <div class="col-md-4">
                    <div class="card">
                        <div class="card-header">Display Fields</div>
                        <div class="card-body fields-list" id="displayFields">
                            @foreach($fieldNames as $field)
                                <div class="field-item" data-field="{{ $field['key'] }}">
                                    {{ $field['label'] }}
                                </div>
                            @endforeach
                        </div>
                    </div>
                </div>
                <div class="col-md-4">
                    <div class="card">
                        <div class="card-header">Order By</div>
                        <div class="card-body fields-list" id="orderByFields"></div>
                    </div>
                </div>
                <div class="col-md-4">
                    <div class="card">
                        <div class="card-header">Group By</div>
                        <div class="card-body fields-list" id="groupByFields"></div>
                    </div>
                </div>
            </div>
        </div>

        <div class="card">
            <div class="card-body">
                <div id="dynamicTable">
                    <!-- Table will be loaded here via AJAX -->
                </div>
            </div>
        </div>
    </div>
@endsection

@push('styles')
    <style>
        .fields-list {
            min-height: 150px;
        }
        .field-item {
            padding: 5px;
            margin: 2px;
            background: #f8f9fa;
            border: 1px solid #ddd;
            cursor: move;
        }
    </style>
@endpush

@push('scripts')
    <script src="https://cdn.jsdelivr.net/npm/sortablejs@1.15.0/Sortable.min.js"></script>
    <script>
        document.addEventListener('DOMContentLoaded', function() {
            // Initialize Sortable
            const updateHiddenFields = () => {
                const displayFields = Array.from(document.querySelectorAll('#displayFields .field-item'))
                    .map(item => item.dataset.field);
                const orderByFields = Array.from(document.querySelectorAll('#orderByFields .field-item'))
                    .map(item => ({field: item.dataset.field, dir: item.dataset.dir}));
                const groupByFields = Array.from(document.querySelectorAll('#groupByFields .field-item'))
                    .map(item => item.dataset.field);

                document.getElementById('displayFieldsInput').value = JSON.stringify(displayFields);
                document.getElementById('orderByFieldsInput').value = JSON.stringify(orderByFields);
                document.getElementById('groupByFieldsInput').value = JSON.stringify(groupByFields);
            };

            new Sortable(document.getElementById('displayFields'), {
                group: 'shared',
                animation: 150,
                onSort: updateHiddenFields
            });

            new Sortable(document.getElementById('orderByFields'), {
                group: 'shared',
                animation: 150,
                onSort: updateHiddenFields,
                onAdd: function(evt) {
                    const item = evt.item;
                    const dirSelect = document.createElement('select');
                    dirSelect.className = 'form-control form-control-sm';
                    dirSelect.innerHTML = `
                        <option value="asc">ASC</option>
                        <option value="desc">DESC</option>
                    `;
                    item.appendChild(dirSelect);
                    item.dataset.dir = 'asc';
                    dirSelect.addEventListener('change', function() {
                        item.dataset.dir = this.value;
                        updateHiddenFields();
                    });
                }
            });

            new Sortable(document.getElementById('groupByFields'), {
                group: 'shared',
                animation: 150,
                onSort: updateHiddenFields
            });

            // AJAX Form Submission
            const form = document.getElementById('searchForm');
            form.addEventListener('submit', function(e) {
                e.preventDefault();
                loadTableData();
            });

            // Initial load
            loadTableData();
        });

        function loadTableData() {
            const formData = new FormData(document.getElementById('searchForm'));
            const params = new URLSearchParams(formData);

            fetch(`{{ route('til-accessories.index') }}?${params}`, {
                headers: {'X-Requested-With': 'XMLHttpRequest'}
            })
            .then(response => response.text())
            .then(html => {
                document.getElementById('dynamicTable').innerHTML = html;
            });
        }
    </script>
@endpush