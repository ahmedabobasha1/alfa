<x-dashboard.layout :title="__('dashboard._site_addresses')">
    <div class="container-fluid">

        <!-- Page Header -->

        <x-dashboard.partials.page-header :header="__('dashboard.site_addresses')" />

        <!-- End Page Header -->

        <!-- Table -->
        <div class="row">
            <div class="col-12">
                <div class="card">
                    <div class="card-header d-flex justify-content-between">
                        <h4 class="card-title pt-3">{{ __('dashboard.site_addresses') }}</h4>

                        <div class="page-title-right d-flex justify-content-end">
                            <x-dashboard.partials.action-buttons createUrl="{{ route('dashboard.site-addresses.create') }}" />
                        </div>
                    </div>
                    <div class="card-body">
                        <table id="datatable-buttons" class="table table-bordered dt-responsive nowrap w-100">
                            <thead>
                                <tr>
                                    <th><input type="checkbox" id="checkAll" /></th>
                                    <th>{{ __('dashboard.id') }}</th>
                                    <th>{{ __('dashboard.title') }}</th>
                                    <th>{{ __('dashboard.address') }}</th>
                                    <th>{{ __('dashboard.type') }}</th>
                                    <th>{{ __('dashboard.status') }}</th>
                                </tr>
                            </thead>


                            <tbody>
                                @foreach($site_addresses as $site_address)
                                <tr id="{{ $site_address->id }}">
                                    <td><input type="checkbox" name="checkbox" class="form-check-input check-inputs" value="{{ $site_address->id }}" /></td>
                                    <td><a href="{{ route('dashboard.site-addresses.edit', $site_address->id) }}">{{ $site_address->id}}</a></td>
                                    <td><a href="{{ route('dashboard.site-addresses.edit', $site_address->id) }}">{{$site_address->title }}</a></td>
                                    <td><a href="{{ route('dashboard.site-addresses.edit', $site_address->id) }}">{{
                                            $site_address->address }}</a></td>
                                   
                                    <td><a href="{{ route('dashboard.site-addresses.edit', $site_address->id) }}">{{
                                            $site_address->type }}</a>
                                    </td>
                                   
                                    <td>
                                        <a href="{{ route('dashboard.site-addresses.edit', $site_address->id) }}" class="status">
                                            @if($site_address->status == 1) {{ __('dashboard.yes') }} @else {{
                                            __('dashboard.no') }} @endif
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
</x-dashboard.layout>
