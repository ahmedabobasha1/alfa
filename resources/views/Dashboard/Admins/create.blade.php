<x-dashboard.layout :title="__('dashboard.add_admin')">

    <!-- Page Header -->
    <x-dashboard.partials.page-header :header="__('dashboard.add_admin')" :label_url="route('dashboard.admins.index')" :label="__('dashboard.admins')" />
    <!-- End Page Header -->


    <!-- Row-->
    <div class="row">
        <div class="col-sm-12 col-xl-12 col-lg-12">
            <div class="card custom-card overflow-hidden">
                <div class="card-header">
                    <h4 class="card-title">{{ __('dashboard.add_admin') }}</h4>
                </div>

                <div class="card-body">

                    <form action="{{ route('dashboard.admins.store') }}" method="POST" enctype="multipart/form-data">
                        @csrf

                        <div class="row">

                            <div class="form-group col-md-6">
                                <label class="">{{ __('dashboard.name') }}</label>
                                <input class="form-control" name="name" type="text" value="{{ old('name') }}"
                                    placeholder="{{ __('dashboard.name') }}" required>
                            </div>


                            <div class="form-group col-md-6">
                                <label class="">{{ __('dashboard.email') }}</label>
                                <input class="form-control" name="email" type="email" value="{{ old('email') }}"
                                    placeholder="{{ __('dashboard.email') }}" required>
                            </div>


                            <div class="form-group col-md-6">
                                <label class="">{{ __('dashboard.password') }}</label>
                                <input class="form-control" name="password" type="password"
                                    placeholder="{{ __('dashboard.password') }}" required>
                            </div>

                            <div class="form-group col-md-6">
                                <label class="">{{ __('dashboard.confirm_password') }}</label>
                                <input class="form-control" name="password_confirmation" type="password"
                                    placeholder="{{ __('dashboard.password') }}" required>
                            </div>
                        </div>
                        <div class="row">
                            <div class="row mt-4">
                                <div class="col-12">
                                    <div class="card card-permission">
                                        <div class="card-header">
                                            <h4 class="card-title mb-0">{{ __('dashboard.permissions') }}</h4>
                                        </div>
                                        <div class="card-body">
                                            <div class="row">
                                                @foreach ($permissionGroups as $group => $permissions)
                                                    <div class="col-md-12 mb-6 head-border">
                                                        <h5>{{ $group }}</h5>
                                                        <div class="row">
                                                            @foreach ($permissions as $key => $permission)
                                                                <div class="form-check col-2">
                                                                    <input type="checkbox" name="permissions[]"
                                                                        value="{{ $permission->name }}"
                                                                        class="form-check-input"
                                                                        id="permission-{{ $permission->id }}">
                                                                    <label class="form-check-label"
                                                                        for="permission-{{ $permission->id }}">
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
                            </div>

                        </div>

                        <div class="form-group col-md-12">
                            <button type="submit" class="btn btn-success"><i class="icon-note"></i>
                                {{ __('dashboard.save') }} </button>
                            <a href="{{ route('dashboard.admins.index') }}"><button type="button"
                                    class="btn btn-danger mr-1"><i class="icon-trash"></i>
                                    {{ __('dashboard.cancel') }}</button></a>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>
    <!-- End Row -->




</x-dashboard.layout>
