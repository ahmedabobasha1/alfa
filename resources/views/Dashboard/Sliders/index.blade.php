<x-dashboard.layout :title="__('dashboard.sliders')">
    <div class="container-fluid">

        <!-- Page Header -->

        <x-dashboard.partials.page-header :header="__('dashboard.sliders')" />

        <!-- End Page Header -->

        <!-- Table -->
        <div class="row">
            <div class="col-12">
                <div class="card">
                    <div class="card-header d-flex justify-content-between">
                        <h4 class="card-title pt-3">{{ __('dashboard.sliders') }}</h4>

                        <div class="page-title-right d-flex justify-content-end">

                            <x-dashboard.partials.action-buttons createUrl="{{ route('dashboard.sliders.create') }}" />
                        </div>
                    </div>
                    <div class="card-body">
                        <table id="datatable-buttons" class="table table-bordered dt-responsive nowrap w-100">
                            <thead>
                                <tr>
                                    <th><input type="checkbox" id="checkAll" /></th>
                                    <th>{{ __('dashboard.id') }}</th>
                                    <th>{{ __('dashboard.title_en') }}</th>
                                    <th>{{ __('dashboard.title_ar') }}</th>
                                    <th>{{ __('dashboard.image') }}</th>
                                    <th>{{ __('dashboard.type') }}</th>
                                    <th>{{ __('dashboard.status') }}</th>
                                </tr>
                            </thead>


                            <tbody>
                                @foreach($sliders as $slider)
                                <tr id="{{ $slider->id }}">
                                    <td><input type="checkbox" name="checkbox" class="form-check-input check-inputs" value="{{ $slider->id }}" /></td>
                                    <td><a href="{{ route('dashboard.sliders.edit', $slider->id) }}">{{ $slider->id}}</a></td>
                                    <td><a href="{{ route('dashboard.sliders.edit', $slider->id) }}">{{$slider->title_en }}</a></td>
                                    <td><a href="{{ route('dashboard.sliders.edit', $slider->id) }}">{{
                                            $slider->title_ar }}</a></td>
                                    <td>
                                        <a href="{{ route('dashboard.sliders.edit', $slider->id) }}">
                                            <img src="{{ $slider->image_path }}" width="70">
                                        </a>
                                    </td>

                                    <td><a href="{{ route('dashboard.sliders.edit', $slider->id) }}">{{
                                            $slider->type }}</a></td>

                                    <td>
                                        <a href="{{ route('dashboard.sliders.edit', $slider->id) }}" class="status">
                                            @if($slider->status == 1) {{ __('dashboard.yes') }} @else {{
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
