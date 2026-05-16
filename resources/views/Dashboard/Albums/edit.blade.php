<x-dashboard.layout :title="__('dashboard.edit') . $album->name">

    <!-- Page Header -->
    <x-dashboard.partials.page-header :header="__('dashboard.edit') . $album->name" :label_url="route('dashboard.albums.index')" :label="__('dashboard.albums')" />
    <!-- End Page Header -->


    <!-- Row-->
    <div class="row">
        <div class="col-sm-12 col-xl-12 col-lg-12">
            <div class="card ">
                <div class="card-header d-flex justify-content-between">
                    <h4 class="card-title pt-3">{{ __('dashboard.edit') . $album->name }}</h4>
                    <a href="{{ route('dashboard.albums.images.index',$album->id) }}"><button class="btn ripple btn-primary"><i class="fas fa-plus-circle"></i>
                        {{__('dashboard.upload_images')}}</button></a>
                </div>

                <div class="card-body">

                    <form action="{{ route('dashboard.albums.update', [$album->id]) }}" method="POST"
                        enctype="multipart/form-data">
                        @csrf
                        @method('PATCH')
                        <div class="row">

                            <div class="form-group col-md-4">
                                <label class="">{{ __('dashboard.name_en') }}</label>
                                <input class="form-control" name="name_en" type="text"
                                    value="{{ $album->name_en }}" placeholder="{{ __('dashboard.name_en') }}">
                            </div>

                            <div class="form-group col-md-4">
                                <label class="">{{ __('dashboard.name_ar') }}</label>
                                <input class="form-control" name="name_ar" type="text"
                                    value="{{ $album->name_ar }}" placeholder="{{ __('dashboard.name_ar') }}">
                            </div>


                            <div class="form-group col-md-2">
                                <label class="">{{ __('dashboard.order') }}</label>
                                <input class="form-control" name="order" type="number" value="{{ $album->order }}"
                                    placeholder="{{ __('dashboard.order') }}">
                            </div>


                            <div class=" form-group  col-md-6">
                                <label>{{ __('dashboard.image') }} (225px * 225px max 1mb)</label>
                                <input type="file" class="form-control" name="image">
                            </div>

                            <div class=" form-group  col-md-2">
                                <label for="">{{ __('dashboard.image') }}</label>
                                <img src="{{ $album->image_path }}" width="250">
                            </div>

                            <div class="form-group col-md-4">
                                <label class="">{{ __('dashboard.alt_image') }}</label>
                                <input class="form-control" name="alt_image" type="text"
                                    placeholder="{{ __('dashboard.alt_image') }}" value="{{ $album->alt_image }}">
                            </div>

            
                            <div class="form-group col-md-6">
                                <label class="">{{ __('dashboard.long_desc_en') }}</label>
                                <textarea class="form-control" id="myeditorinstance" name="long_desc_en" type="text"
                                    placeholder="{{ __('dashboard.long_desc_en') }}">{!! $album->long_desc_en !!}</textarea>
                            </div>

                            <div class="form-group col-md-6">
                                <label class="">{{ __('dashboard.long_desc_ar') }}</label>
                                <textarea class="form-control" id="myeditorinstance" name="long_desc_ar" type="text"
                                    placeholder="{{ __('dashboard.long_desc_ar') }}">{!! $album->long_desc_ar !!}</textarea>
                            </div>

                         
                          
                          
                            <div class="row mt-3">
                                <div class="form-group col-md-3">
                                    <div class="d-flex flex-wrap gap-2">
                                        <h5 class="font-size-14 mb-3">{{ __('dashboard.publish/unpublish') }} </h5>
                                        <input type="checkbox" id="switch1" switch="none" value="1"
                                            name="status" @checked(old('status', $album->status)) />
                                        <label for="switch1" data-on-label="{{ __('dashboard.yes') }}"
                                            data-off-label="{{ __('dashboard.no') }}"></label>
                                    </div>
                                </div>
                                <div class="form-group col-md-3">
                                    <div class="d-flex flex-wrap gap-2">
                                        <h5 class="font-size-14 mb-3">{{ __('dashboard.show_in_home') }}</h5>
                                        <input type="checkbox" id="switch2" switch="none" value="1"
                                            name="show_in_home" @checked(old('show_in_home', $album->show_in_home)) />
                                        <label for="switch2" data-on-label="{{ __('dashboard.yes') }}"
                                            data-off-label="{{ __('dashboard.no') }}"></label>
                                    </div>
                                </div>
                                <div class="form-group col-md-3">
                                    <div class="d-flex flex-wrap gap-2">
                                        <h5 class="font-size-14 mb-3">{{ __('dashboard.show_in_header') }} </h5>
                                        <input type="checkbox" id="switch3" switch="none" value="1"
                                            name="show_in_header" @checked(old('show_in_header', $album->show_in_header)) />
                                        <label for="switch3" data-on-label="{{ __('dashboard.yes') }}"
                                            data-off-label="{{ __('dashboard.no') }}"></label>
                                    </div>
                                </div>
                                <div class="form-group col-md-3">
                                    <div class="d-flex flex-wrap gap-2">
                                        <h5 class="font-size-14 mb-3">{{ __('dashboard.show_in_footer') }} </h5>
                                        <input type="checkbox" id="switch4" switch="none" value="1"
                                            name="show_in_footer" @checked(old('show_in_footer', $album->show_in_footer)) />
                                        <label for="switch4" data-on-label="{{ __('dashboard.yes') }}"
                                            data-off-label="{{ __('dashboard.no') }}"></label>
                                    </div>
                                </div>

                            </div>


                            <div class="col-12">
                                <div class="row">
                                    <div class="form-group col-md-12">
                                        <hr>
                                        <h4 class="card-title">{{ __('dashboard.seo') }}</h4>
                                    </div>
                                    <div class="form-group col-md-2">
                                        <label for="name_ar">{{ __('dashboard.slug_en') }}</label>
                                        <input type="text" autocomplete="off" class="form-control"
                                            placeholder="{{ __('dashboard.slug_en') }}" name="slug_en"
                                            value="{{ $album->slug_en }}">
                                    </div>

                                    <div class="form-group col-md-5">
                                        <label> {{ __('dashboard.meta_title_en') }}</label>
                                        <textarea class="form-control" name="meta_title_en" placeholder="{{ __('dashboard.meta_title_en') }}"> {!! $album->meta_title_en !!}</textarea>
                                    </div>

                                    <div class="form-group col-md-5">
                                        <label for="meta_desc"> {{ __('dashboard.meta_desc_en') }}</label>
                                        <textarea class="form-control" name="meta_desc_en" placeholder="{{ __('dashboard.meta_desc_en') }}"> {!! $album->meta_desc_en !!}</textarea>
                                    </div>

                                    <div class="form-group col-md-12">
                                        <hr>

                                    </div>

                                    <div class="form-group col-md-2">
                                        <label>{{ __('dashboard.slug_ar') }}</label>
                                        <input type="text" autocomplete="off" class="form-control"
                                            placeholder="{{ __('dashboard.slug_ar') }}" name="slug_ar"
                                                value="{{ $album->slug_ar }}">
                                    </div>

                                    <div class="form-group col-md-5">
                                        <label> {{ __('dashboard.meta_title_ar') }}</label>
                                        <textarea class="form-control" name="meta_title_ar" placeholder="{!! __('dashboard.meta_title_ar') !!}">{{ $album->meta_title_ar }}</textarea>
                                    </div>

                                    <div class="form-group col-md-5">
                                        <label> {{ __('dashboard.meta_desc_ar') }}</label>
                                        <textarea class="form-control" name="meta_desc_ar" placeholder="{!! __('dashboard.meta_desc') !!}">{!! $album->meta_desc_ar !!}</textarea>
                                    </div>


                                    <div class="d-flex flex-wrap gap-2">
                                        <h5 class="font-size-14 mb-3">{{ __('dashboard.meta_robots') }} (index)</h5>
                                        <input type="checkbox" id="switch5" switch="none" value="1"
                                            name="index" @checked(old('index', $album->index)) />
                                        <label for="switch5" data-on-label="{{ __('dashboard.yes') }}"
                                            data-off-label="{{ __('dashboard.no') }}"></label>

                                    </div>
                                </div>
                            </div>
                            <div class="form-group col-md-12">
                                <button type="submit" class="btn btn-success"><i class="icon-note"></i>
                                    {{ __('dashboard.update') }} </button>
                                <a href="{{ route('dashboard.albums.index') }}"><button type="button"
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

   

</x-dashboard.layout>
