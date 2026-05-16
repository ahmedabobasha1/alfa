<x-dashboard.layout :title="__('dashboard.products')">
    <div class="container-fluid">

        <!-- Page Header -->

        <x-dashboard.partials.page-header :header="__('dashboard.products')" />

        <!-- End Page Header -->

        <!-- Table -->
        <div class="row">
            <div class="col-12">
                <div class="card">
                    <div class="card-header d-flex justify-content-between">
                        <h4 class="card-title pt-3">{{ __('dashboard.products') }}</h4>

                        <div class="page-title-right d-flex justify-content-end">
                            <x-dashboard.partials.action-buttons createUrl="{{ route('dashboard.products.create') }}" />
                        </div>
                    </div>
                    <div class="card-body">
                        <table id="datatable-buttons" class="table table-bordered dt-responsive nowrap w-100">
                            <thead>
                                <tr>
                                    <th class="text-center" style="width: 50px;">
                                        <div class="form-check">
                                            <input type="checkbox" class="form-check-input" id="checkAll">
                                        </div>
                                    </th>
                                    <th>{{ __('dashboard.id') }}</th>
                                    <th>{{ __('dashboard.name_en') }}</th>
                                    <th>{{ __('dashboard.name_ar') }}</th>
                                    <th>{{ __('dashboard.image') }}</th>
                                    <th>{{ __('dashboard.parent') }}</th>
                                    <th>{{ __('dashboard.status') }}</th>
                                </tr>
                            </thead>


                            <tbody>
                                @foreach ($products as $product)
                                    <tr>
                                        <td class="text-center">
                                            <div class="form-check">
                                                <input type="checkbox" class="form-check-input check-inputs"
                                                    value="{{ $product->id }}">
                                            </div>
                                        </td>
                                        <td>{{ $product->id }}</td>
                                        <td>
                                            <a href="{{ route('dashboard.products.edit', $product->id) }}">
                                                {{ $product->name_en }}
                                            </a>
                                        </td>
                                        <td>
                                            <a href="{{ route('dashboard.products.edit', $product->id) }}">
                                                {{ $product->name_ar }}
                                            </a>
                                        </td>
                                        <td>
                                            <a href="{{ route('dashboard.products.edit', $product->id) }}">
                                                <img src="{{ $product->image_path }}" width="70">
                                            </a>
                                        </td>
                                        <td>{{ $product->parent?->name }}</td>
                                        <td>
                                            @if ($product->status == 1)
                                                <span class="badge bg-success">{{ __('dashboard.yes') }}</span>
                                            @else
                                                <span class="badge bg-danger">{{ __('dashboard.no') }}</span>
                                            @endif
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
