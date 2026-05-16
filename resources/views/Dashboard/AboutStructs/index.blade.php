<x-dashboard.layout :title="__('dashboard.about_structs')">
    <div class="container-fluid">

        <!-- Page Header -->

        <x-dashboard.partials.page-header :header="__('dashboard.about_structs')" />

        <!-- End Page Header -->

        <!-- Table -->
        <div class="row">
            <div class="col-12">
                <div class="card">
                    <div class="card-header d-flex justify-content-between">
                        <h4 class="card-title pt-3">{{ __('dashboard.about_structs') }}</h4>

                        <div class="page-title-right d-flex justify-content-end">
                            <x-dashboard.partials.action-buttons
                                createUrl="{{ route('dashboard.about-structs.create') }}" />
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
                                    <th>{{ __('dashboard.status') }}</th>
                                </tr>
                            </thead>


                            <tbody>
                                @foreach ($about_structs as $about_struct)
                                    <tr id="{{ $about_struct->id }}">
                                        <td><input type="checkbox" name="checkbox" class="form-check-input check-inputs"
                                                value="{{ $about_struct->id }}" /></td>
                                        <td><a
                                                href="{{ route('dashboard.about-structs.edit', $about_struct->id) }}">{{ $about_struct->id }}</a>
                                        </td>
                                        <td><a
                                                href="{{ route('dashboard.about-structs.edit', $about_struct->id) }}">{{ $about_struct->title_en }}</a>
                                        </td>
                                        <td><a
                                                href="{{ route('dashboard.about-structs.edit', $about_struct->id) }}">{{ $about_struct->title_ar }}</a>
                                        </td>
                                        <td>
                                            <a href="{{ route('dashboard.about-structs.edit', $about_struct->id) }}"
                                                class="status">
                                                @if ($about_struct->status == 1)
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
            $(function() {
                $('#checkAll').on('change', function() {
                    $('.check-inputs').prop('checked', this.checked);
                });
            });
        </script>
    @endsection
</x-dashboard.layout>
