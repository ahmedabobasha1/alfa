<x-dashboard.layout :title="__('dashboard.menus')">
    <div class="container-fluid">

        <!-- Page Header -->

        <x-dashboard.partials.page-header :header="__('dashboard.menus')" />

        <!-- End Page Header -->

        <!-- Table -->
        <div class="row">
            <div class="col-12">
                <div class="card">
                    <div class="card-header d-flex justify-content-between">
                        <h4 class="card-title pt-3">{{ __('dashboard.menus') }}</h4>

                        <div class="page-title-right d-flex justify-content-end">
                            <x-dashboard.partials.action-buttons createUrl="{{ route('dashboard.menus.create') }}" />
                        </div>
                    </div>
                    <div class="card-body">
                        <table id="datatable-buttons" class="table table-bordered dt-responsive nowrap w-100">
                            <thead>
                                <tr>
                                    <th><input type="checkbox" id="checkAll" /></th>
                                    <th>{{ __('dashboard.id') }}</th>
                                    <th>{{ __('dashboard.name_en') }}</th>
                                    <th>{{ __('dashboard.name_ar') }}</th>
                                    <th>{{ __('dashboard.route_name') }}</th>
                                    <th>{{ __('dashboard.parent') }}</th>
                                    <th>{{ __('dashboard.status') }}</th>
                                </tr>
                            </thead>


                            <tbody>
                                @foreach ($menus as $menu)
                                    <tr id="{{ $menu->id }}">
                                        <td><input type="checkbox" name="checkbox" class="form-check-input check-inputs"
                                                value="{{ $menu->id }}" /></td>
                                        <td><a
                                                href="{{ route('dashboard.menus.edit', $menu->id) }}">{{ $menu->id }}</a>
                                        </td>
                                        <td><a
                                                href="{{ route('dashboard.menus.edit', $menu->id) }}">{{ $menu->name_en }}</a>
                                        </td>
                                        <td><a
                                                href="{{ route('dashboard.menus.edit', $menu->id) }}">{{ $menu->name_ar }}</a>
                                        </td>
                                        <td><a
                                                href="{{ route('dashboard.menus.edit', $menu->id) }}">{{ $menu->route_name }}</a>
                                        </td>

                                        <td>
                                            <a href="{{ route('dashboard.menus.edit', $menu->id) }}">
                                                {{ $menu->parent_name }}
                                            </a>
                                        </td>
                                        <td>
                                            <a href="{{ route('dashboard.menus.edit', $menu->id) }}" class="status">
                                                @if ($menu->status == 1)
                                                    {{ __('dashboard.yes') }}
                                                @else
                                                    {{ __('dashboard.no') }}
                                                @endif
                                            </a>
                                        </td>
                                    </tr>
                                @endforeach
                            </tbody>
                        </table>
                    </div>
                </div>
                <!-- end cardaa -->
            </div> <!-- end col -->
        </div>
        <!-- end row -->
    </div>

    @section('script')
        <x-dashboard.partials.delete-btn />
        <script>
            $(document).ready(function() {
                // Handle "Select All" checkbox
                $('#checkAll').on('change', function() {
                    $('.check-inputs').prop('checked', this.checked);
                });

                // Update "Select All" checkbox when individual checkboxes change
                $('.check-inputs').on('change', function() {
                    var totalCheckboxes = $('.check-inputs').length;
                    var checkedCheckboxes = $('.check-inputs:checked').length;
                    $('#checkAll').prop('checked', totalCheckboxes === checkedCheckboxes);
                });
            });
        </script>
    @endsection
</x-dashboard.layout>
