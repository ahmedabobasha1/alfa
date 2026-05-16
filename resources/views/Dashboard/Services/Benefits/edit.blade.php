<x-dashboard.layout :title="$service->name . ' ' . __('dashboard.edit_benefit')">

    <!-- Page Header -->
    <x-dashboard.partials.page-header :header="$service->name . ' ' . __('dashboard.edit_benefit')" :label_url="route('dashboard.services.benefits.index', $service->id)" :label="$service->name . ' ' . __('dashboard.benefits')" />
    <!-- End Page Header -->


    <!-- Row-->
    <div class="row">
        <div class="col-sm-12 col-xl-12 col-lg-12">
            <div class="card custom-card overflow-hidden">
                <div class="card-header">
                    <h4 class="card-title">{{ __('dashboard.edit_benefit') }}</h4>
                </div>

                <div class="card-body">

                    <form action="{{ route('dashboard.services.benefits.update', [$service->id, $benefit->id]) }}" method="POST"
                        enctype="multipart/form-data">
                        @csrf
                        @method('PATCH')
                        <div class="row">

                            <div class="form-group col-md-4">
                                <label class="">{{ __('dashboard.title_en') }}</label>
                                <input class="form-control" name="title_en" type="text" value="{{ old('title_en', $benefit->title_en) }}"
                                    placeholder="{{ __('dashboard.title_en') }}">
                                @error('title_en')
                                    <span class="text-danger">{{ $message }}</span>
                                @enderror
                            </div>

                            <div class="form-group col-md-4">
                                <label class="">{{ __('dashboard.title_ar') }}</label>
                                <input class="form-control" name="title_ar" type="text" value="{{ old('title_ar', $benefit->title_ar) }}"
                                    placeholder="{{ __('dashboard.title_ar') }}">
                                @error('title_ar')
                                    <span class="text-danger">{{ $message }}</span>
                                @enderror
                            </div>

                            <div class="form-group col-md-4">
                                <label class="">{{ __('dashboard.order') }}</label>
                                <input class="form-control" name="order" type="number" value="{{ old('order', $benefit->order) }}"
                                    placeholder="{{ __('dashboard.order') }}">
                                @error('order')
                                    <span class="text-danger">{{ $message }}</span>
                                @enderror
                            </div>


                            <div class="form-group col-md-8">
                                <label class="">{{ __('dashboard.image') }}</label>
                                <input type="file" class="form-control" name="image">
                                @error('image')
                                    <span class="text-danger">{{ $message }}</span>
                                @enderror
                                @if($benefit->image)
                                    <div class="mt-2">
                                        <img src="{{ $benefit->image_path }}" alt="{{ $benefit->alt_image }}" style="max-width: 100px; max-height: 100px;">
                                        <p class="text-muted">{{ __('dashboard.current_image') }}</p>
                                    </div>
                                @endif
                            </div>
                            <div class="form-group col-md-4">
                                <label class="">{{ __('dashboard.alt_image') }}</label>
                                <input class="form-control" name="alt_image" type="text"
                                    value="{{ old('alt_image', $benefit->alt_image) }}" placeholder="{{ __('dashboard.alt_image') }}">
                                @error('alt_image')
                                    <span class="text-danger">{{ $message }}</span>
                                @enderror
                            </div>

                            <div class="form-group col-md-8">
                                <label class="">{{ __('dashboard.icon') }}</label>
                                <input type="file" class="form-control" name="icon">
                                @error('icon')
                                    <span class="text-danger">{{ $message }}</span>
                                @enderror
                                @if($benefit->icon)
                                    <div class="mt-2">
                                        <img src="{{ $benefit->icon_path }}" alt="{{ $benefit->alt_icon }}" style="max-width: 100px; max-height: 100px;">
                                        <p class="text-muted">{{ __('dashboard.current_icon') }}</p>
                                    </div>
                                @endif
                            </div>
                            <div class="form-group col-md-4">
                                <label class="">{{ __('dashboard.alt_icon') }}</label>
                                <input class="form-control" name="alt_icon" type="text"
                                    value="{{ old('alt_icon', $benefit->alt_icon) }}" placeholder="{{ __('dashboard.alt_icon') }}">
                                @error('alt_icon')
                                    <span class="text-danger">{{ $message }}</span>
                                @enderror
                            </div>

                            <div class="form-group col-md-6">
                                <label class="">{{ __('dashboard.short_desc_en') }}</label>
                                <textarea class="form-control" name="short_description_en" rows="3" placeholder="{{ __('dashboard.short_desc_en') }}">{{ old('short_description_en', $benefit->short_description_en) }}</textarea>
                                @error('short_description_en')
                                    <span class="text-danger">{{ $message }}</span>
                                @enderror
                            </div>
                            <div class="form-group col-md-6">
                                <label class="">{{ __('dashboard.short_desc_ar') }}</label>
                                <textarea class="form-control" name="short_description_ar" rows="3" placeholder="{{ __('dashboard.short_desc_ar') }}">{{ old('short_description_ar', $benefit->short_description_ar) }}</textarea>
                                @error('short_description_ar')
                                    <span class="text-danger">{{ $message }}</span>
                                @enderror
                            </div>


                            <div class="form-group col-md-6">
                                <label class="">{{ __('dashboard.long_desc_en') }}</label>
                                <textarea class="form-control" id="myeditorinstance" name="long_description_en" rows="3"
                                    placeholder="{{ __('dashboard.long_desc_en') }}">{{ old('long_description_en', $benefit->long_description_en) }}</textarea>
                                @error('long_description_en')
                                    <span class="text-danger">{{ $message }}</span>
                                @enderror
                            </div>
                            <div class="form-group col-md-6">
                                <label class="">{{ __('dashboard.long_desc_ar') }}</label>
                                <textarea class="form-control" id="myeditorinstance" name="long_description_ar" rows="3"
                                    placeholder="{{ __('dashboard.long_desc_ar') }}">{{ old('long_description_ar', $benefit->long_description_ar) }}</textarea>
                                @error('long_description_ar')
                                    <span class="text-danger">{{ $message }}</span>
                                @enderror
                            </div>


                            <div class="form-group col-md-4 mt-3 mb-3">

                                <div class="d-flex flex-wrap gap-2 mt-3">
                                    <h5 class="font-size-14 mb-3">{{ __('dashboard.publish/unpublish') }} </h5>
                                    <input type="checkbox" id="switch1" switch="none" value="1" name="status"
                                        {{ old('status', $benefit->status) ? 'checked' : '' }} />
                                    <label for="switch1" data-on-label="{{ __('dashboard.yes') }}"
                                        data-off-label="{{ __('dashboard.no') }}"></label>
                                </div>
                            </div>

                            <div class="form-group col-md-12">
                                <button type="submit" class="btn btn-success"><i class="icon-note"></i>
                                    {{ __('dashboard.update') }} </button>
                                <a href="{{ route('dashboard.services.benefits.index', $service->id) }}"><button
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

