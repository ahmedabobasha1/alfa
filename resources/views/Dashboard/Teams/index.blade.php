<x-dashboard.layout :title="__('dashboard.teams')">
    <div class="container-fluid">

        <!-- Page Header -->

        <x-dashboard.partials.page-header :header="__('dashboard.teams')" />

        <!-- End Page Header -->

        <!-- Table -->
        <div class="row">
            <div class="col-12">
                <div class="card">
                    <div class="card-header d-flex justify-content-between">
                        <h4 class="card-title pt-3">{{ __('dashboard.teams') }}</h4>

                        <div class="page-title-right d-flex justify-content-end">
                            <x-dashboard.partials.action-buttons createUrl="{{ route('dashboard.teams.create') }}" />
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
                                    <th>{{ __('dashboard.position_en') }}</th>
                                    <th>{{ __('dashboard.position_ar') }}</th>
                                    <th>{{ __('dashboard.image') }}</th>
                                    <th>{{ __('dashboard.status') }}</th>
                                    <th>{{ __('dashboard.show_in_home') }}</th>
                                </tr>
                            </thead>


                            <tbody>
                                @foreach($teams as $team)
                                <tr id="{{ $team->id }}">
                                    <td><input type="checkbox" name="checkbox" class="form-check-input check-inputs" value="{{ $team->id }}" /></td>
                                    <td><a href="{{ route('dashboard.teams.edit', $team->id) }}">{{ $team->id}}</a></td>
                                    <td><a href="{{ route('dashboard.teams.edit', $team->id) }}">{{ $team->name_en }}</a></td>
                                    <td><a href="{{ route('dashboard.teams.edit', $team->id) }}">{{ $team->name_ar }}</a></td>
                                    <td><a href="{{ route('dashboard.teams.edit', $team->id) }}">{{ $team->position_en }}</a></td>
                                    <td><a href="{{ route('dashboard.teams.edit', $team->id) }}">{{ $team->position_ar }}</a></td>
                                    <td>
                                        <a href="{{ route('dashboard.teams.edit', $team->id) }}">
                                            <img src="{{ $team->image_path }}" width="70">
                                        </a>
                                    </td>

                                    <td>
                                        <a href="{{ route('dashboard.teams.edit', $team->id) }}" class="status">
                                            @if($team->status == 1) {{ __('dashboard.yes') }} @else {{ __('dashboard.no') }} @endif
                                        </a>
                                    </td>
                                    <td>
                                        <a href="{{ route('dashboard.teams.edit', $team->id) }}" class="status">
                                            @if($team->show_in_home == 1) {{ __('dashboard.yes') }} @else {{ __('dashboard.no') }} @endif
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

