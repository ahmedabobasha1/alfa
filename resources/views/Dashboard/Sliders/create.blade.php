<x-dashboard.layout :title="__('dashboard.add_slider')">

    <!-- Page Header -->
    <x-dashboard.partials.page-header :header="__('dashboard.add_slider')" :label_url="route('dashboard.sliders.index')" :label="__('dashboard.sliders')" />
    <!-- End Page Header -->


    <!-- Row-->
    <div class="row">
        <div class="col-sm-12 col-xl-12 col-lg-12">
            <div class="card custom-card overflow-hidden">
                <div class="card-header">
                    <h4 class="card-title">{{ __('dashboard.add_slider') }}</h4>
                </div>

                <div class="card-body">

                    <form action="{{ route('dashboard.sliders.store') }}" method="POST" enctype="multipart/form-data">
                        @csrf
                        <div class="row">

                            <div class="form-group col-md-4">
                                <label class="">{{__('dashboard.title_en')}}</label>
                                <input class="form-control" name="title_en" type="text" value="{{old('title_en')}}" placeholder="{{__('dashboard.title_en')}}" >
                            </div>

                            <div class="form-group col-md-4">
                                <label class="">{{__('dashboard.title_ar')}}</label>
                                <input class="form-control" name="title_ar" type="text" value="{{old('title_ar')}}" placeholder="{{__('dashboard.title_ar')}}" >
                            </div>

                            <div class="form-group col-md-2 mb-2">
                                <label for="type">{{ __('dashboard.type') }}</label>
                                <select name="type" class="form-control">
                                    <option value="">{{ __('dashboard.choose_type') }}</option>
                                    @foreach (App\Enums\SliderType::cases() as $type)
                                    <option value="{{ $type->value }}" @selected(old('type') === $type->value)>{{ $type->name }}</option>
                                    @endforeach
                                </select>
                            </div>

                            <div class="form-group col-md-2">
                                <label class="">{{__('dashboard.order')}}</label>
                                <input class="form-control" name="order" type="number" value="{{old('order')}}" placeholder="{{__('dashboard.order')}}" >
                            </div>
                            

                            <div class="form-group col-md-6">
                                <label class="">{{__('dashboard.second_title_en')}}</label>
                                <input class="form-control" name="title2_en" type="text" value="{{old('second_title_en')}}" placeholder="{{__('dashboard.second_title_en')}}" >
                            </div>

                            <div class="form-group col-md-6">
                                <label class="">{{__('dashboard.second_title_ar')}}</label>
                                <input class="form-control" name="title2_ar" type="text" value="{{old('second_title_ar')}}" placeholder="{{__('dashboard.second_title_ar')}}" >
                            </div>

                        

                            <div class=" form-group  col-md-3">
                                <label>{{__('dashboard.image_en')}} (225px * 225px max 1mb)</label>
                                <input type="file" class="form-control" name="image_en">
                            </div>

                            <div class="form-group col-md-3">
                                <label class="">{{__('dashboard.alt_image_en')}}</label>
                                <input class="form-control" name="alt_image_en" type="text" value="{{old('alt_image_en')}}" placeholder="{{__('dashboard.alt_image_en')}}">
                            </div>

                            <div class=" form-group  col-md-3">
                                <label>{{__('dashboard.image_ar')}} (225px * 225px max 1mb)</label>
                                <input type="file" class="form-control" name="image_ar">
                            </div>

                            <div class="form-group col-md-3">
                                <label class="">{{__('dashboard.alt_image_ar')}}</label>
                                <input class="form-control" name="alt_image_ar" type="text" value="{{old('alt_image_ar')}}" placeholder="{{__('dashboard.alt_image_ar')}}">
                            </div>

                            <div class=" form-group  col-md-3">
                                <label>{{__('dashboard.mobile_image_en')}} (225px * 225px max 1mb)</label>
                                <input type="file" class="form-control" name="mobile_image_en">
                            </div>

                            <div class="form-group col-md-3">
                                <label class="">{{__('dashboard.mobile_alt_image_en')}}</label>
                                <input class="form-control" name="mobile_alt_image_en" type="text" value="{{old('mobile_alt_image_en')}}" placeholder="{{__('dashboard.mobile_alt_image_en')}}">
                            </div>

                            <div class=" form-group  col-md-3">
                                <label>{{__('dashboard.mobile_image_ar')}} (225px * 225px max 1mb)</label>
                                <input type="file" class="form-control" name="mobile_image_ar">
                            </div>

                            <div class="form-group col-md-3">
                                <label class="">{{__('dashboard.mobile_alt_image_ar')}}</label>
                                <input class="form-control" name="mobile_alt_image_ar" type="text" value="{{old('mobile_alt_image_ar')}}" placeholder="{{__('dashboard.mobile_alt_image_ar')}}">
                            </div>

                            <div class="form-group col-md-6">
                                <label class="">{{__('dashboard.text_en')}}</label>
                                <textarea class="form-control" id="myeditorinstance" name="text_en" type="text" placeholder="{{__('dashboard.text_en')}}">{!! old('text_en') !!}</textarea>
                            </div>

                            <div class="form-group col-md-6">
                                <label class="">{{__('dashboard.text_ar')}}</label>
                                <textarea class="form-control" id="myeditorinstance" name="text_ar" type="text" placeholder="{{__('dashboard.text_ar')}}">{!! old('text_ar') !!}</textarea>
                            </div>

                             <div class="form-group col-md-6 mt-3">
                                <label class="">{{__('dashboard.second_text_en')}}</label>
                                <textarea class="form-control"  name="second_text_en" type="text" placeholder="{{__('dashboard.second_text_en')}}">{!! old('second_text_en') !!}</textarea>
                            </div>

                            <div class="form-group col-md-6 mt-3">
                                <label class="">{{__('dashboard.second_text_ar')}}</label>
                                <textarea class="form-control"  name="second_text_ar" type="text" placeholder="{{__('dashboard.second_text_ar')}}">{!! old('second_text_ar') !!}</textarea>
                            </div>

                            <div class="form-group col-md-4 mt-3 mb-3">
                                <div class="d-flex flex-wrap gap-2">
                                    <h5 class="font-size-14 mb-3">{{__('dashboard.publish/unpublish')}} </h5>
                                    <input type="checkbox" id="switch1" switch="none" value="1" name="status" checked />
                                    <label for="switch1" data-on-label="{{ __('dashboard.yes') }}" data-off-label="{{ __('dashboard.no') }}"></label>
                                </div>
                            </div>

                            <div class="form-group col-md-12">
                                <button type="submit" class="btn btn-success"><i class="icon-note"></i>
                                    {{__('dashboard.save')}} </button>
                                <a href="{{route('dashboard.sliders.index')}}"><button type="button" class="btn btn-danger mr-1"><i class="icon-trash"></i>
                                        {{__('dashboard.cancel')}}</button></a>
                            </div>

                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>
    <!-- End Row -->
</x-dashboard.layout>
