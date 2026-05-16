<x-dashboard.layout :title="__('dashboard.add_team')">

    <!-- Page Header -->
    <x-dashboard.partials.page-header :header="__('dashboard.add_team')" :label_url="route('dashboard.teams.index')" :label="__('dashboard.teams')" />
    <!-- End Page Header -->


    <!-- Row-->
    <div class="row">
        <div class="col-sm-12 col-xl-12 col-lg-12">
            <div class="card custom-card overflow-hidden">
                <div class="card-header">
                    <h4 class="card-title">{{ __('dashboard.add_team') }}</h4>
                </div>

                <div class="card-body">

                    <form action="{{ route('dashboard.teams.store') }}" method="POST" enctype="multipart/form-data">
                        @csrf
                        <div class="row">

                            <div class="form-group col-md-6">
                                <label class="">{{__('dashboard.name_en')}}</label>
                                <input class="form-control" name="name_en" type="text" value="{{old('name_en')}}" placeholder="{{__('dashboard.name_en')}}" >
                            </div>

                            <div class="form-group col-md-6">
                                <label class="">{{__('dashboard.name_ar')}}</label>
                                <input class="form-control" name="name_ar" type="text" value="{{old('name_ar')}}" placeholder="{{__('dashboard.name_ar')}}" >
                            </div>

                            <div class="form-group col-md-6">
                                <label class="">{{__('dashboard.position_en')}}</label>
                                <input class="form-control" name="position_en" type="text" value="{{old('position_en')}}" placeholder="{{__('dashboard.position_en')}}" >
                            </div>

                            <div class="form-group col-md-6">
                                <label class="">{{__('dashboard.position_ar')}}</label>
                                <input class="form-control" name="position_ar" type="text" value="{{old('position_ar')}}" placeholder="{{__('dashboard.position_ar')}}" >
                            </div>

                           
                            <div class="form-group col-md-6">
                                <label class="">{{__('dashboard.bio_en')}}</label>
                                <textarea class="form-control" name="bio_en" rows="3" placeholder="{{__('dashboard.bio_en')}}">{{ old('bio_en') }}</textarea>
                            </div>

                            <div class="form-group col-md-6">
                                <label class="">{{__('dashboard.bio_ar')}}</label>
                                <textarea class="form-control" name="bio_ar" rows="3" placeholder="{{__('dashboard.bio_ar')}}">{{ old('bio_ar') }}</textarea>
                            </div>

                            <div class="form-group col-md-8">
                                <label>{{__('dashboard.image')}} (400px * 400px max 2mb)</label>
                                <input type="file" class="form-control" name="image">
                            </div>

                            <div class="form-group col-md-4">
                                <label class="">{{__('dashboard.alt_image')}}</label>
                                <input class="form-control" name="alt_image" type="text" value="{{old('alt_image')}}" placeholder="{{__('dashboard.alt_image')}}">
                            </div>

                            <div class="form-group col-md-6">
                                <label class="">{{__('dashboard.text_en')}}</label>
                                <textarea class="form-control" id="myeditorinstance" name="text_en" rows="2" placeholder="{{__('dashboard.text_en')}}">{{ old('text_en') }}</textarea>
                            </div>

                            <div class="form-group col-md-6">
                                <label class="">{{__('dashboard.text_ar')}}</label>
                                <textarea class="form-control" id="myeditorinstance" name="text_ar" rows="2" placeholder="{{__('dashboard.text_ar')}}">{{ old('text_ar') }}</textarea>
                            </div>


                            <div class="form-group col-md-6">
                                <label class="">{{__('dashboard.facebook')}}</label>
                                <input class="form-control" name="facebook" type="url" value="{{old('facebook')}}" placeholder="https://facebook.com/username">
                            </div>

                            <div class="form-group col-md-6">
                                <label class="">{{__('dashboard.twitter')}}</label>
                                <input class="form-control" name="twitter" type="url" value="{{old('twitter')}}" placeholder="https://twitter.com/username">
                            </div>

                            <div class="form-group col-md-6">
                                <label class="">{{__('dashboard.linkedin')}}</label>
                                <input class="form-control" name="linkedin" type="url" value="{{old('linkedin')}}" placeholder="https://linkedin.com/in/username">
                            </div>

                            <div class="form-group col-md-6">
                                <label class="">{{__('dashboard.instagram')}}</label>
                                <input class="form-control" name="instagram" type="url" value="{{old('instagram')}}" placeholder="https://instagram.com/username">
                            </div>

                            <div class="form-group col-md-4">
                                <label class="">{{__('dashboard.order')}}</label>
                                <input class="form-control" name="order" type="number" value="{{old('order', 0)}}" placeholder="{{__('dashboard.order')}}">
                            </div>

                            <div class="form-group col-md-4 mt-3 mb-3">
                                <div class="d-flex flex-wrap gap-2">
                                    <h5 class="font-size-14 mb-3">{{__('dashboard.status')}} </h5>
                                    <input type="checkbox" id="switch1" switch="none" value="1" name="status" checked />
                                    <label for="switch1" data-on-label="{{ __('dashboard.yes') }}" data-off-label="{{ __('dashboard.no') }}"></label>
                                </div>
                            </div>

                            <div class="form-group col-md-4 mt-3 mb-3">
                                <div class="d-flex flex-wrap gap-2">
                                    <h5 class="font-size-14 mb-3">{{__('dashboard.show_in_home')}} </h5>
                                    <input type="checkbox" id="switch2" switch="none" value="1" name="show_in_home" />
                                    <label for="switch2" data-on-label="{{ __('dashboard.yes') }}" data-off-label="{{ __('dashboard.no') }}"></label>
                                </div>
                            </div>

                            <div class="form-group col-md-12">
                                <button type="submit" class="btn btn-success"><i class="icon-note"></i>
                                    {{__('dashboard.save')}} </button>
                                <a href="{{route('dashboard.teams.index')}}"><button type="button" class="btn btn-danger mr-1"><i class="icon-trash"></i>
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

