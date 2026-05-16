<x-dashboard.layout :title="__('dashboard.blogs')">
    <div class="container-fluid">

        <!-- Page Header -->

        <x-dashboard.partials.page-header :header="__('dashboard.blogs')" />

        <!-- End Page Header -->

        <!-- Table -->
        <div class="row">
            <div class="col-12">
                <div class="card">
                    <div class="card-header d-flex justify-content-between">
                        <h4 class="card-title pt-3">{{ __('dashboard.blogs') }}</h4>

                        <div class="page-title-right d-flex justify-content-end">
                            <x-dashboard.partials.action-buttons createUrl="{{ route('dashboard.blogs.create') }}" />
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
                                    <th>{{ __('dashboard.category') }}</th>
                                    <th>{{ __('dashboard.status') }}</th>
                                </tr>
                            </thead>


                            <tbody>
                                @foreach ($blogs as $product)
                                    <tr id="{{ $product->id }}">
                                        <td><input type="checkbox" name="checkbox" class="form-check-input check-inputs"
                                                value="{{ $product->id }}" /></td>
                                        <td><a
                                                href="{{ route('dashboard.blogs.edit', $product->id) }}">{{ $product->id }}</a>
                                        </td>
                                        <td><a
                                                href="{{ route('dashboard.blogs.edit', $product->id) }}">{{ $product->name_en }}</a>
                                        </td>
                                        <td><a
                                                href="{{ route('dashboard.blogs.edit', $product->id) }}">{{ $product->name_ar }}</a>
                                        </td>
                                        <td>
                                            <a href="{{ route('dashboard.blogs.edit', $product->id) }}">
                                                <img src="{{ $product->image_path }}" width="70">
                                            </a>
                                        </td>
                                        <td>
                                            <a href="{{ route('dashboard.blogs.edit', $product->id) }}">
                                                {{ $product->category?->name }}
                                            </a>
                                        </td>
                                        <td>
                                            <a href="{{ route('dashboard.blogs.edit', $product->id) }}" class="status">
                                                @if ($product->status == 1)
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
