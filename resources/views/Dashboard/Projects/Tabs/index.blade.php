<x-dashboard.layout :title="$project->name . ' '.__('dashboard.tabs')">
    <div class="container-fluid">

        <!-- Page Header -->

        <x-dashboard.partials.page-header :header="$project->name . ' '.__('dashboard.tabs')" />

        <!-- End Page Header -->

        <!-- Table -->
        <div class="row">
            <div class="col-12">
                <div class="card">
                    <div class="card-header d-flex justify-content-between">
                        <h4 class="card-title pt-3">{{ __('dashboard.tabs') }}</h4>

                        <div class="page-title-right d-flex justify-content-end">
                                <div class="btn btn-list">
                                    <a href="{{ route('dashboard.projects.tabs.create',$project->id) }}"><button class="btn ripple btn-primary"><i class="fas fa-plus-circle"></i> {{__('dashboard.add')}}</button></a>
                                </div>
                                
                        </div>
                    </div>
                    <div class="card-body">
                        <table id="datatable-buttons" class="table table-bordered dt-responsive nowrap w-100">
                            <thead>
                                <tr>
                                  
                                    <th>{{ __('dashboard.id') }}</th>
                                    <th>{{ __('dashboard.name_en') }}</th>
                                    <th>{{ __('dashboard.name_ar') }}</th>
                                    <th>{{__('dashboard.icon')}}</th>
                                    <th>{{ __('dashboard.status') }}</th>
                                    <th>{{ __('dashboard.delete') }}</th>
                                </tr>
                            </thead>


                            <tbody>
                                @foreach($project->tabs as $tab)
                              
                                <tr id="{{ $tab->id }}">
                                   
                                    <td><a href="{{ route('dashboard.projects.tabs.edit', [$project->id,$tab->id]) }}">{{ $tab->id}}</a></td>
                                    <td><a href="{{ route('dashboard.projects.tabs.edit', [$project->id,$tab->id]) }}">{{$tab->name_en }}</a></td>
                                    <td><a href="{{ route('dashboard.projects.tabs.edit', [$project->id,$tab->id]) }}">{{$tab->name_ar }}</a></td>
                                    <td>
                                        <a href="{{ route('dashboard.projects.tabs.edit', [$project->id,$tab->id]) }}">
                                            <img src="{{ $tab->icon_path }}" width="70">
                                        </a>
                                    </td>
                                   
                                    <td>
                                        <a href="{{ route('dashboard.projects.tabs.edit', [$project->id,$tab->id]) }}" class="status">
                                            @if($tab->status == 1) {{ __('dashboard.yes') }} @else {{
                                            __('dashboard.no') }} @endif
                                        </a>
                                    </td>
                                    <td>
                                        <form action="{{ route('dashboard.projects.tabs.destroy',[$project->id,$tab->id]) }}" method="POST">
                                            @csrf
                                            @method('DELETE')
                                            <button type="submit" class="btn btn-danger btn-sm delete" data-toggle="modal" data-target="#deleteModal"><i class="fas fa-trash"></i></button>
                                        </form>
                                    </td>
                                </tr>
                                @endforeach
                            </tbody>
                        </table>
                    </div>
                </div>
                <!-- end cardaa -->
            </div> <!-- end col -->
        </div>
        <!-- end row -->
    </div>
</x-dashboard.layout>

