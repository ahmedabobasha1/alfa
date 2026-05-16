<x-dashboard.layout :title="$project->name . ' ' . __('dashboard.add_tab')">

    <!-- Page Header -->
    <x-dashboard.partials.page-header :header="$project->name . ' ' . __('dashboard.add_tab')" :label_url="route('dashboard.projects.edit', $project->id)" :label="$project->name . ' ' . __('dashboard.tabs')" />
    <!-- End Page Header -->


    <!-- Row-->
    <div class="row">
        <div class="col-sm-12 col-xl-12 col-lg-12">
            <div class="card custom-card overflow-hidden">
                <div class="card-header">
                    <h4 class="card-title">{{ __('dashboard.add_tab') }}</h4>
                </div>

                <div class="card-body">

                    <form action="{{ route('dashboard.projects.tabs.store', $project->id) }}" method="POST"
                        enctype="multipart/form-data">
                        @csrf
                        <div class="row">

                            <div class="form-group col-md-4">
                                <label class="">{{ __('dashboard.name_en') }}</label>
                                <input class="form-control" name="name_en" type="text" value="{{ old('name_en') }}"
                                    placeholder="{{ __('dashboard.name_en') }}">
                                @error('name_en')
                                    <span class="text-danger">{{ $message }}</span>
                                @enderror
                            </div>

                            <div class="form-group col-md-4">
                                <label class="">{{ __('dashboard.name_ar') }}</label>
                                <input class="form-control" name="name_ar" type="text" value="{{ old('name_ar') }}"
                                    placeholder="{{ __('dashboard.name_ar') }}">
                                @error('name_ar')
                                    <span class="text-danger">{{ $message }}</span>
                                @enderror
                            </div>

                            <div class="form-group col-md-4">
                                <label class="">{{ __('dashboard.order') }}</label>
                                <input class="form-control" name="order" type="number" value="{{ old('order') }}"
                                    placeholder="{{ __('dashboard.order') }}">
                                @error('order')
                                    <span class="text-danger">{{ $message }}</span>
                                @enderror
                            </div>


                            <div class="form-group col-md-8">
                                <label class="">{{ __('dashboard.icon') }}</label>
                                <input type="file" class="form-control" name="icon">
                                @error('icon')
                                    <span class="text-danger">{{ $message }}</span>
                                @enderror
                            </div>
                            <div class="form-group col-md-4">
                                <label class="">{{ __('dashboard.alt_icon') }}</label>
                                <input class="form-control" name="alt_icon" type="text"
                                    value="{{ old('alt_icon') }}" placeholder="{{ __('dashboard.alt_icon') }}">
                                @error('alt_icon')
                                    <span class="text-danger">{{ $message }}</span>
                                @enderror
                            </div>

                            <div class="form-group col-md-6">
                                <label class="">{{ __('dashboard.short_desc_en') }}</label>
                                <textarea class="form-control" name="short_desc_en" rows="3" placeholder="{{ __('dashboard.short_desc_en') }}">{{ old('short_desc_en') }}</textarea>
                                @error('short_desc_en')
                                    <span class="text-danger">{{ $message }}</span>
                                @enderror
                            </div>
                            <div class="form-group col-md-6">
                                <label class="">{{ __('dashboard.short_desc_ar') }}</label>
                                <textarea class="form-control" name="short_desc_ar" rows="3" placeholder="{{ __('dashboard.short_desc_ar') }}">{{ old('short_desc_ar') }}</textarea>
                                @error('short_desc_ar')
                                    <span class="text-danger">{{ $message }}</span>
                                @enderror
                            </div>


                            <div class="form-group col-md-6">
                                <label class="">{{ __('dashboard.long_desc_en') }}</label>
                                <textarea class="form-control" id="myeditorinstance" name="long_desc_en" rows="3"
                                    placeholder="{{ __('dashboard.long_desc_en') }}">{{ old('long_desc_en') }}</textarea>
                                @error('long_desc_en')
                                    <span class="text-danger">{{ $message }}</span>
                                @enderror
                            </div>
                            <div class="form-group col-md-6">
                                <label class="">{{ __('dashboard.long_desc_ar') }}</label>
                                <textarea class="form-control" id="myeditorinstance" name="long_desc_ar" rows="3"
                                    placeholder="{{ __('dashboard.long_desc_ar') }}">{{ old('long_desc_ar') }}</textarea>
                                @error('long_desc_ar')
                                    <span class="text-danger">{{ $message }}</span>
                                @enderror
                            </div>


                            <div class="form-group col-md-4 mt-3 mb-3">

                                <div class="d-flex flex-wrap gap-2 mt-3">
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
                                <a href="{{ route('dashboard.projects.tabs.index', $project->id) }}"><button
                                        type="button" class="btn btn-danger mr-1"><i class="icon-trash"></i>
                                        {{ __('dashboard.cancel') }}</button></a>
                            </div>

                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>
    <!-- End Row -->




</x-dashboard.layout>

