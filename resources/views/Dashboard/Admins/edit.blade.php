<x-dashboard.layout :title="__('dashboard.edit') . $admin->name">

    <!-- Page Header -->
    <x-dashboard.partials.page-header :header="__('dashboard.edit').$admin->name" :label_url="route('dashboard.admins.index')" :label="__('dashboard.admins')" />
    <!-- End Page Header -->


    <!-- Row-->
    <div class="row">
        <div class="col-sm-12 col-xl-12 col-lg-12">
            <div class="card custom-card overflow-hidden">
                <div class="card-header">
                    <h4 class="card-title">{{ __('dashboard.edit').$admin->name }}</h4>
                </div>

                <div class="card-body">

                    <form action="{{ route('dashboard.admins.update',[$admin->id]) }}" method="POST" enctype="multipart/form-data">
                        @csrf
                        @method('PATCH')
                        <div class="row">

                            <div class="form-group col-md-6">
                                <label class="">{{__('dashboard.name')}}</label>
                                <input class="form-control" name="name" type="text" value="{{$admin->name}}">
                            </div>

                            <div class="form-group col-md-6">
                                <label class="">{{__('dashboard.email')}}</label>
                                <input class="form-control" name="email" type="email" value="{{$admin->email}}" placeholder="{{__('dashboard.email')}}">
                            </div>


                            <div class="form-group col-md-6">
                                <label class="">{{__('dashboard.new_password')}}</label>
                                <input class="form-control" name="password" type="password" value="{{old('password') }}">
                            </div>

                            <div class="form-group col-md-6">
                                <label class="">{{ __('dashboard.confirm_password') }}</label>
                                <input class="form-control" name="password_confirmation" type="password" value="{{old('password_confirmation') }}">
                            </div>

                            <div class="col-12">
                                <div class="card card-permission">
                                    <div class="card-header">
                                        <h4 class="card-title mb-0">{{ __('dashboard.permissions') }}</h4>


                                    </div>

                                    <div class="card-body">
                                        <div class="row">
                                            <!-- Global Check All -->
                                            <div class="d-flex justify-content-between mb-3">
                                                <div class="form-check form-check-inline">
                                                    <input type="checkbox" class="form-check-input" id="checkAll">
                                                    <label class="form-check-label" for="checkAll">
                                                        {{ __('dashboard.check_all') }} (All Permissions)
                                                    </label>
                                                </div>
                                            </div>

                                            @foreach($permissionGroups as $group => $permissions)
                                            <div class="col-md-12 mb-6 head-border">
                                                <div class="d-flex justify-content-between align-items-center">
                                                    <h5>{{ $group }}</h5>
                                                    <div class="form-check">
                                                        <input type="checkbox" class="form-check-input check-all" data-group="{{ $group }}">
                                                        <label class="form-check-label">Check All</label>
                                                    </div>
                                                </div>
                                        
                                                <div class="row">
                                                    @foreach($permissions as $key => $permission)
                                                    <div class="form-check col-2">
                                                        <input type="checkbox" name="permissions[]" value="{{ $permission->name }}" 
                                                               class="form-check-input permission-checkbox-{{ $group }} permission-checkbox" 
                                                               id="permission-{{ $permission->id }}" 
                                                               {{ in_array($permission->name, $adminPermissions) ? 'checked' : '' }}>
                                                        <label class="form-check-label" for="permission-{{ $permission->id }}">
                                                            {{ ucfirst(Illuminate\Support\Str::afterLast($permission->name, '.')) }}
                                                        </label>
                                                    </div>
                                                    @endforeach
                                                </div>
                                            </div>
                                        @endforeach
                                        </div>
                                    </div>
                                </div>
                            </div>


                            <div class="form-group col-md-12 mt-3">
                                <button type="submit" class="btn btn-success"><i class="icon-note"></i>
                                    {{__('dashboard.save')}} </button>
                                <a href="{{route('dashboard.admins.index')}}"><button type="button" class="btn btn-danger mr-1"><i class="icon-trash"></i>
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
