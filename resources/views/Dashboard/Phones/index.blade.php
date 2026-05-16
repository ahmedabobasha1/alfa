<x-dashboard.layout title="{{ __('dashboard.phones') }}">
<div class="container-fluid">
    <div class="row">
        <div class="col-12">
            <div class="page-title-box d-flex align-items-center justify-content-between">
                <h4 class="mb-0">{{ __('dashboard.phones') }}</h4>
                <div class="page-title-right d-flex justify-content-end">
                    <x-dashboard.partials.action-buttons createUrl="{{ route('dashboard.phones.create') }}" />
                </div>
            </div>
        </div>
    </div>

    <div class="row">
        <div class="col-12">
            <div class="card">
                <div class="card-body">
                    <div class="table-responsive">
                    <table id="datatable-buttons" class="table table-bordered dt-responsive nowrap w-100">
                            <thead>
                                <tr>
                                    <th><input type="checkbox" id="checkAll" /></th>
                                   
                                    <th>{{ __('dashboard.name_ar') }}</th>
                                    <th>{{ __('dashboard.name_en') }}</th>
                                    <th>{{ __('dashboard.code') }}</th>
                                    <th>{{ __('dashboard.phone_number') }}</th>
                                    <th>{{ __('dashboard.email') }}</th>
                                    <th>{{ __('dashboard.order') }}</th>
                                    <th>{{ __('dashboard.status') }}</th>
                                    <th>{{ __('dashboard.actions') }}</th>
                                </tr>
                            </thead>
                            <tbody>
                                @forelse($phones as $phone)
                                <tr id="{{ $phone->id }}">
                                    <td><input type="checkbox" name="checkbox" class="form-check-input check-inputs" value="{{ $phone->id }}" /></td>
                                  
                                    <td>{{ $phone->name_ar ?? '-' }}</td>
                                    <td>{{ $phone->name_en ?? '-' }}</td>
                                    <td>{{ $phone->code ?? '-' }}</td>
                                    <td>{{ $phone->phone }}</td>
                                    <td>{{ $phone->email ?? '-' }}</td>
                                    <td>{{ $phone->order ?? '-' }}</td>
                                    <td>
                                        @if($phone->status)
                                            <span class="badge bg-success">{{ __('dashboard.active') }}</span>
                                        @else
                                            <span class="badge bg-danger">{{ __('dashboard.inactive') }}</span>
                                        @endif
                                    </td>
                                    <td>
                                        <div class="btn-group" role="group">
                                            <a href="{{ route('dashboard.phones.edit', $phone->id) }}" class="btn btn-sm btn-primary">
                                                <i class="fas fa-edit"></i>
                                            </a>
                                            <form action="{{ route('dashboard.phones.destroy', $phone->id) }}" method="POST" class="d-inline">
                                                @csrf
                                                @method('DELETE')
                                                <button type="submit" class="btn btn-sm btn-danger" onclick="return confirm('هل أنت متأكد من الحذف؟')">
                                                    <i class="fas fa-trash"></i>
                                                </button>
                                            </form>
                                        </div>
                                    </td>
                                </tr>
                                @empty
                                <tr>
                                    <td colspan="10" class="text-center">{{ __('dashboard.no_phones') }}</td>
                                </tr>
                                @endforelse
                            </tbody>
                        </table>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>

@section('script')
    <script>
        var url = '{{ route('dashboard.phones.index') }}';
    </script>
    <x-dashboard.partials.delete-btn />
    <script>
        $(function() {
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