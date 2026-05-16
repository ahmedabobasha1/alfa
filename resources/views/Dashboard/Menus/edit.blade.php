<x-dashboard.layout :title="__('dashboard.edit') . $menu->name">

    <!-- Page Header -->
    <x-dashboard.partials.page-header :header="__('dashboard.edit') . $menu->name" :label_url="route('dashboard.menus.index')" :label="__('dashboard.menus')" />
    <!-- End Page Header -->


    <!-- Row-->
    <div class="row">
        <div class="col-sm-12 col-xl-12 col-lg-12">
            <div class="card custom-card overflow-hidden">
                <div class="card-header">
                    <h4 class="card-title">{{ __('dashboard.edit') . $menu->name }}</h4>
                </div>

                <div class="card-body">

                    <form action="{{ route('dashboard.menus.update', [$menu->id]) }}" method="POST" enctype="multipart/form-data">
                        @csrf
                        @method('PATCH')
                        <div class="row">

                            <div class="form-group col-md-6">
                                <label class="">{{ __('dashboard.name_en') }}</label>
                                <input class="form-control" name="name_en" type="text" value="{{ $menu->name_en }}" placeholder="{{ __('dashboard.name_en') }}">
                            </div>

                            <div class="form-group col-md-6">
                                <label class="">{{ __('dashboard.name_ar') }}</label>
                                <input class="form-control" name="name_ar" type="text" value="{{ $menu->name_ar }}" placeholder="{{ __('dashboard.name_ar') }}">
                            </div>

                            <div class="form-group col-md-4">
                                <label for="parent">{{ __('dashboard.parent') }}</label>
                                <select class="form-control select2" name="parent_id">
                                    <option value="{{ $menu->parent_id ?? '' }}">{{ $menu->parent_name }}</option>

                                    @foreach ($menus as $menuItem)
                                    <option @selected($menu->parent_id == $menuItem->id) value="{{ $menuItem->id }}">
                                        {{ $menuItem->name }}</option>
                                    @endforeach
                                </select>
                            </div>



                            <div class="form-group col-md-4 mb-3">
                                <label for="route_name">{{ __('dashboard.route_name') }}</label>
                                <select name="route_name" class="form-control">
                                    <option value="">{{ __('dashboard.choose_route_name') }}</option>
                                    @foreach (App\Enums\MenuRouteName::cases() as $name)
                                    <option value="{{ $name->value }}" @selected((old('route_name', $menu->route_name ?? '') == $name->value))>
                                        {{ $name->value }}</option>
                                    @endforeach
                                </select>

                            </div>


                            <div class="form-group col-md-4">
                                <label class="">{{ __('dashboard.order') }}</label>
                                <input class="form-control" name="order" type="number" value="{{ $menu->order }}">
                            </div>

                            <div class="form-group col-md-4">
                                <div class="d-flex flex-wrap gap-2">
                                    <h5 class="font-size-14 mb-3">{{ __('dashboard.publish/unpublish') }} </h5>
                                    <input type="checkbox" id="switch1" switch="none" value="1" name="status" @checked(old('status', $menu->status)) />
                                    <label for="switch1" data-on-label="{{ __('dashboard.yes') }}" data-off-label="{{ __('dashboard.no') }}"></label>
                                </div>
                            </div>

                            <div class="form-group col-md-12">

                                <button type="submit" class="btn btn-success"><i class="icon-note"></i>
                                    {{ __('dashboard.update') }} </button>

                                <button type="reset" class="btn btn-danger"><i class="icon-note"></i>
                                    {{ __('dashboard.cancel') }} </button>

                            </div>

                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>
    <!-- End Row -->




</x-dashboard.layout>
