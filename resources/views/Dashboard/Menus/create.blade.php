<x-dashboard.layout :title="__('dashboard.add_menu')">

    <!-- Page Header -->
    <x-dashboard.partials.page-header :header="__('dashboard.add_menu')" :label_url="route('dashboard.menus.index')" :label="__('dashboard.menus')" />
    <!-- End Page Header -->


    <!-- Row-->
    <div class="row">
        <div class="col-sm-12 col-xl-12 col-lg-12">
            <div class="card custom-card overflow-hidden">
                <div class="card-header">
                    <h4 class="card-title">{{ __('dashboard.add_menu') }}</h4>
                </div>

                <div class="card-body">

                    <form action="{{ route('dashboard.menus.store') }}" method="POST" enctype="multipart/form-data">
                        @csrf
                        <div class="row">
                            <input type="hidden" name="type" value="main">
                            <div class="form-group col-md-6">
                                <label class="">{{ __('dashboard.name_en') }}</label>
                                <input class="form-control" name="name_en" type="text" value="{{ old('name_en') }}"
                                    placeholder="{{ __('dashboard.name_en') }}">
                            </div>

                            <div class="form-group col-md-6">
                                <label class="">{{ __('dashboard.name_ar') }}</label>
                                <input class="form-control" name="name_ar" type="text" value="{{ old('name_ar') }}"
                                    placeholder="{{ __('dashboard.name_ar') }}">
                            </div>

                            <div class="form-group col-md-4 mb-3">
                                <label for="parent">{{ __('dashboard.parent') }}</label>
                                <select class="form-control" name="parent_id">
                                    <option value="" {{ !old('parent_id') ? 'selected' : '' }}>
                                        {{ __('dashboard.no_parent') }}</option>

                                    @foreach ($menus as $menuItem)
                                        <option @selected(old('parent_id') == $menuItem->id) value="{{ $menuItem->id }}">
                                            {{ $menuItem->name }}</option>
                                    @endforeach
                                </select>
                            </div>



                            <div class="form-group col-md-4 mb-3">
                                <label for="route_name">{{ __('dashboard.route_name') }}</label>
                                <select name="route_name" class="form-control">
                                    <option value="">{{ __('dashboard.choose_route_name') }}</option>
                                    @foreach (App\Enums\MenuRouteName::cases() as $name)
                                        <option value="{{ $name->value }}" @selected(old('route_name') === $name->value)>
                                            {{ $name->value }}</option>
                                    @endforeach
                                </select>
                            </div>



                            <div class="form-group col-md-4">
                                <label class="">{{ __('dashboard.order') }}</label>
                                <input class="form-control" name="order" type="number" value="{{ old('order') }}"
                                    placeholder="{{ __('dashboard.order') }}">
                            </div>

                            <div class="form-group col-md-4 ">
                                <div class="d-flex flex-wrap gap-2">
                                    <h5 class="font-size-14 mb-3">{{ __('dashboard.publish/unpublish') }} </h5>
                                    <input type="checkbox" id="switch1" switch="none" value="1" name="status"
                                        checked />
                                    <label for="switch1" data-on-label="{{ __('dashboard.yes') }}"
                                        data-off-label="{{ __('dashboard.no') }}"></label>
                                </div>
                            </div>


                            <div class="form-group col-md-12">
                                <button type="submit" class="btn btn-success"><i class="icon-note"></i>
                                    {{ __('dashboard.save') }} </button>
                                <a href="{{ route('dashboard.menus.index') }}"><button type="button"
                                        class="btn btn-danger mr-1"><i class="icon-trash"></i>
                                        {{ __('dashboard.cancel') }}</button></a>
                            </div>

                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>
    <!-- End Row -->

    @section('script')
        <script>
            $(document).ready(function() {
                $('#segment_select').on('change', function() {
                    var selectedValue = $(this).val();

                    if (selectedValue === 'custom') {
                        $('#custom_segment_div').show();
                        $('#custom_segment').prop('required', true);
                    } else {
                        $('#custom_segment_div').hide();
                        $('#custom_segment').prop('required', false);
                        $('#custom_segment').val('');
                    }
                });

                // Handle form submission
                $('form').on('submit', function(e) {
                    var segmentSelect = $('#segment_select').val();
                    var customSegment = $('#custom_segment').val();

                    if (segmentSelect === 'custom' && customSegment) {
                        // Use custom segment value
                        $('<input>').attr({
                            type: 'hidden',
                            name: 'segment',
                            value: customSegment
                        }).appendTo(this);

                        // Remove the select name to avoid conflict
                        $('#segment_select').removeAttr('name');
                    }
                });
            });
        </script>
    @endsection

</x-dashboard.layout>
