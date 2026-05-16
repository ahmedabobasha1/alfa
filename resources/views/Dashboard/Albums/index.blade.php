<x-dashboard.layout :title="__('dashboard.albums')">
    <div class="container-fluid">

        <!-- Page Header -->

        <x-dashboard.partials.page-header :header="__('dashboard.albums')" />

        <!-- End Page Header -->

        <!-- Table -->
        <div class="row">
            <div class="col-12">
                <div class="card">
                    <div class="card-header d-flex justify-content-between">
                        <h4 class="card-title pt-3">{{ __('dashboard.albums') }}</h4>

                        <div class="page-title-right d-flex justify-content-end">
                            <x-dashboard.partials.action-buttons createUrl="{{ route('dashboard.albums.create') }}" />
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
                                    <th>{{ __('dashboard.image') }}</th>
                                    <th>{{ __('dashboard.type') }}</th>
                                    <th>{{ __('dashboard.status') }}</th>
                                </tr>
                            </thead>


                            <tbody>
                                @foreach($albums as $album)
                                <tr id="{{ $album->id }}">
                                    <td><input type="checkbox" name="checkbox" class="form-check-input check-inputs" value="{{ $album->id }}" /></td>
                                    <td><a href="{{ route('dashboard.albums.edit', $album->id) }}">{{ $album->id}}</a></td>
                                    <td><a href="{{ route('dashboard.albums.edit', $album->id) }}">{{$album->name_en }}</a></td>
                                    <td><a href="{{ route('dashboard.albums.edit', $album->id) }}">{{
                                            $album->name_ar }}</a></td>
                                    <td>
                                        <a href="{{ route('dashboard.albums.edit', $album->id) }}">
                                            <img src="{{ $album->image_path }}" width="70">
                                        </a>
                                    </td>
    
                                    <td>{{ $album->type }}</td>
                                    <td>
                                        <a href="{{ route('dashboard.albums.edit', $album->id) }}" class="status">
                                            @if($album->status == 1) {{ __('dashboard.yes') }} @else {{
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
