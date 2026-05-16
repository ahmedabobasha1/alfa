<x-dashboard.layout :title="__('dashboard.services')">
    <div class="container-fluid">

        <!-- Page Header -->

        <x-dashboard.partials.page-header :header="__('dashboard.services')" />

        <!-- End Page Header -->

        <!-- Table -->
        <div class="row">
            <div class="col-12">
                <div class="card">
                    <div class="card-header d-flex justify-content-between">
                        <h4 class="card-title pt-3">{{ __('dashboard.services') }}</h4>

                        <div class="page-title-right d-flex justify-content-end">
                            <x-dashboard.partials.action-buttons createUrl="{{ route('dashboard.services.create') }}" />
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
                                    <th>{{ __('dashboard.order') }}</th>
                                    <th>{{ __('dashboard.image') }}</th>
                                    <th>{{ __('dashboard.parent') }}</th>
                                    <th>{{ __('dashboard.status') }}</th>
                                </tr>
                            </thead>


                            <tbody>
                                @foreach ($services as $service)
                                    <tr id="{{ $service->id }}">
                                        <td><input type="checkbox" name="checkbox" class="form-check-input check-inputs"
                                                value="{{ $service->id }}" /></td>
                                        <td><a
                                                href="{{ route('dashboard.services.edit', $service->id) }}">{{ $service->id }}</a>
                                        </td>
                                        <td><a
                                                href="{{ route('dashboard.services.edit', $service->id) }}">{{ $service->name_en }}</a>
                                        </td>
                                        <td><a
                                                href="{{ route('dashboard.services.edit', $service->id) }}">{{ $service->name_ar }}</a>
                                        </td>
                                        <td><a
                                                href="{{ route('dashboard.services.edit', $service->id) }}">{{ $service->order }}</a>
                                        </td>
                                        <td>
                                            <a href="{{ route('dashboard.services.edit', $service->id) }}">
                                                <img src="{{ $service->image_path }}" width="70">
                                            </a>
                                        </td>
                                        <td>
                                            <a href="{{ route('dashboard.services.edit', $service->id) }}">
                                                {{ $service->parent->name ?? __('dashboard.no_parent') }}
                                            </a>
                                        </td>
                                        <td>
                                            <a href="{{ route('dashboard.services.edit', $service->id) }}"
                                                class="status">
                                                @if ($service->status == 1)
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


  
</x-dashboard.layout>
