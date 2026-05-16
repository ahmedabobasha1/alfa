<x-dashboard.layout :title="__('dashboard.edit') . $site_address->title">

    <!-- Page Header -->
    <x-dashboard.partials.page-header :header="__('dashboard.edit').$site_address->title" :label_url="route('dashboard.site-addresses.index')" :label="__('dashboard.site-addresses')" />
    <!-- End Page Header -->


    <!-- Row-->
    <div class="row">
        <div class="col-sm-12 col-xl-12 col-lg-12">
            <div class="card ">
                <div class="card-header d-flex justify-content-between">
                    <h4 class="card-title pt-3">{{ __('dashboard.edit').$site_address->title }}</h4>       
                </div>

                <div class="card-body">

                    <form action="{{ route('dashboard.site-addresses.update',[$site_address->id]) }}" method="POST"  enctype="multipart/form-data">
                        @csrf
                        @method('PATCH')
                        <div class="row">

                              <div class="form-group col-md-2">
                                <label for="type">{{ __('dashboard.type') }}</label>
                                <select class="form-control select2" name="type">
                                    <option value="" {{ !old('type') ? 'selected' : '' }}>
                                        {{ __('dashboard.select_type') }}</option>

                                    @foreach (\App\Models\SiteAddress::TYPES as $type)
                                        <option value="{{ $type }}" @selected(old('type', $site_address->type) == $type) >
                                            {{ $type }}
                                        </option>
                                    @endforeach
                                </select>
                            </div>

                            <div class="form-group col-md-5">
                                <label class="">{{__('dashboard.title_en')}}</label>
                                <input class="form-control" name="title_en" type="text" value="{{ $site_address->title_en }}" placeholder="{{__('dashboard.title_en')}}">
                            </div>

                            <div class="form-group col-md-5">
                                <label class="">{{__('dashboard.title_ar')}}</label>
                                <input class="form-control" name="title_ar" type="text" value="{{ $site_address->title_ar }}" placeholder="{{__('dashboard.title_ar')}}">
                            </div>

                            <div class="form-group col-md-3">
                                <label class="">{{trans('dashboard.email')}}</label>
                                <input class="form-control" name="email" type="text" placeholder="{{trans('dashboard.email')}}" value="{{ $site_address->email  }}">
                            </div>

                            <div class="form-group col-md-3">
                                <fieldset class="form-group">
                                    <label for="phone">{{ __('dashboard.phone') }}</label>
                                    <div class="input-group">
                                        <div class="input-group-prepend">
                                            <select name="code" class="form-control" style="width: auto;">
                                                <option value="+20" {{ ($site_address['code'] ?? '') == '+20' ? 'selected' : '' }}>🇪🇬 +20</option>
                                                <option value="+966" {{ ($site_address['code'] ?? '') == '+966' ? 'selected' : '' }}>🇸🇦 +966</option>
                                                <option value="+971" {{ ($site_address['code'] ?? '') == '+971' ? 'selected' : '' }}>🇦🇪 +971</option>
                                                <option value="+1" {{ ($site_address['code'] ?? '') == '+1' ? 'selected' : '' }}>🇺🇸 +1</option>
                                            </select>
                                        </div>
                                        <input type="number" class="form-control" name="phone" value="{{ $site_address->phone }}" >
                                    </div>
                                </fieldset>
                            </div>
                            

                            <div class="form-group col-md-3">
                                <fieldset class="form-group">
                                    <label for="phone2">{{ __('dashboard.phone2') }}</label>
                                    <div class="input-group">
                                        <div class="input-group-prepend">
                                            <select name="code2" class="form-control" style="width: auto;">
                                                <option value="+20" {{ ($site_address['code2'] ?? '') == '+20' ? 'selected' : '' }}>🇪🇬 +20</option>
                                                <option value="+966" {{ ($site_address['code2'] ?? '') == '+966' ? 'selected' : '' }}>🇸🇦 +966</option>
                                                <option value="+971" {{ ($site_address['code2'] ?? '') == '+971' ? 'selected' : '' }}>🇦🇪 +971</option>
                                                <option value="+1" {{ ($site_address['code2'] ?? '') == '+1' ? 'selected' : '' }}>🇺🇸 +1</option>
                                            </select>
                                        </div>
                                        <input type="number" class="form-control" name="phone2" value="{{ $site_address->phone2 }}" >
                                    </div>
                                </fieldset>
                            </div>

                            <div class="form-group col-md-3">
                                <label class="">{{trans('dashboard.order')}}</label>
                                <input class="form-control" name="order" type="number" min="0" autocomplete="off" placeholder="{{trans('dashboard.order')}}" value="{{ $site_address->order}}">
                            </div>

                            <div class="form-group col-md-6">
                                <label class="">{{trans('dashboard.address_en')}}</label>
                                <textarea class="form-control" name="address_en">{{ $site_address->address_en}}</textarea>

                            </div>
                            <div class="form-group col-md-6">
                                <label class="">{{trans('dashboard.address_ar')}}</label>
                                <textarea class="form-control" name="address_ar">{{ $site_address->address_ar}}</textarea>
                            </div>
                            <div class="form-group col-md-6">
                                <label class="">{{trans('dashboard.working_hours_en')}}</label>
                                <textarea class="form-control" name="working_hours_en" placeholder="{{trans('dashboard.working_hours_en')}}">{{ old('working_hours_en', $site_address->working_hours_en) }}</textarea>
                            </div>
                            <div class="form-group col-md-6">
                                <label class="">{{trans('dashboard.working_hours_ar')}}</label>
                                <textarea class="form-control" name="working_hours_ar" placeholder="{{trans('dashboard.working_hours_ar')}}">{{ old('working_hours_ar', $site_address->working_hours_ar) }}</textarea>
                            </div>
                            <div class="form-group col-md-12">
                                <label class="">{{trans('dashboard.map_url')}}</label>
                                <textarea class="form-control" name="map_url">{{ $site_address->map_url }}</textarea>
                            </div>
                            <div class="form-group col-md-12">
                                <label class="">{{trans('dashboard.map_link')}}</label>
                                <input class="form-control" name="map_link" type="text" value="{{ old('map_link', $site_address->map_link) }}" placeholder="{{trans('dashboard.map_link')}}">
                            </div>

                       

                            <div class="form-group col-md-4 mt-3 mb-3">
                                <div class="d-flex flex-wrap gap-2">
                                    <h5 class="font-size-14 mb-3">{{__('dashboard.publish/unpublish')}} </h5>
                                    <input type="checkbox" id="switch1" switch="none" value="1" name="status"  @checked(old('status', $site_address->status)) />
                                    <label for="switch1" data-on-label="{{ __('dashboard.yes') }}" data-off-label="{{ __('dashboard.no') }}"></label>
                                </div>
                            </div>

                            <div class="form-group col-md-12">
                                <button type="submit" class="btn btn-success"><i class="icon-note"></i>
                                    {{__('dashboard.save')}} </button>
                                <a href="{{route('dashboard.site-addresses.index')}}"><button type="button" class="btn btn-danger mr-1"><i class="icon-trash"></i>
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
