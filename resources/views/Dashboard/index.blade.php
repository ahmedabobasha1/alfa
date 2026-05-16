<x-dashboard.layout title="{{ __('dashboard.dashboard') }}">
    <div class="row">
        @foreach ($countModels as $key => $count)
            @can("{$key}.view")
            <div class="col-xl-3 col-md-6">
                <div class="card card-h-100">
                    <div class="card-body">
                        <div class="row align-items-center">
                            <div class="col-6">
                                <span class="text-muted mb-3 lh-1 d-block text-truncate">{{ __('dashboard.total_' . $key) }}</span>
                                <h4 class="mb-3">
                                    <span class="counter-value" data-target="{{ $count }}">0</span>
                                </h4>
                            </div>
                            <div class="col-6">
                                <div id="mini-chart{{ $loop->index }}" class="apex-charts mb-2" data-colors='["#5156be"]'></div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
            @endcan
        @endforeach
    </div>

    <!-- Google Analytics Summary -->
    @if(isset($analyticsSummary) && $analyticsSummary['available'])
    <div class="row mt-4">
        <div class="col-12">
            <div class="card">
                <div class="card-header d-flex justify-content-between align-items-center">
                    <h5 class="card-title mb-0">
                        <i class="fas fa-chart-line me-2"></i>
                        Analytics Overview (Last 7 Days)
                    </h5>
                    <a href="{{ route('dashboard.analytics.index') }}" class="btn btn-sm btn-outline-primary">
                        <i class="fas fa-external-link-alt me-1"></i>
                        View Full Analytics
                    </a>
                </div>
                <div class="card-body">
                    <div class="row">
                        <div class="col-xl-3 col-md-6">
                            <div class="d-flex gap-3 align-items-center">
                                <div class="flex-shrink-0">
                                    <div class="avatar-sm">
                                        <span class="avatar-title bg-soft-primary rounded fs-3">
                                            <i class="fas fa-users text-primary"></i>
                                        </span>
                                    </div>
                                </div>
                                <div class="flex-grow-1 ms-3">
                                    <h6 class="mb-1">Total Users</h6>
                                    <h4 class="mb-0">{{ number_format($analyticsSummary['overview']['total_users'] ?? 0) }}</h4>
                                </div>
                            </div>
                        </div>
                        <div class="col-xl-3 col-md-6">
                            <div class="d-flex gap-3 align-items-center">
                                <div class="flex-shrink-0">
                                    <div class="avatar-sm">
                                        <span class="avatar-title bg-soft-success rounded fs-3">
                                            <i class="fas fa-chart-line text-success"></i>
                                        </span>
                                    </div>
                                </div>
                                <div class="flex-grow-1 ms-3">
                                    <h6 class="mb-1">Sessions</h6>
                                    <h4 class="mb-0">{{ number_format($analyticsSummary['overview']['sessions'] ?? 0) }}</h4>
                                </div>
                            </div>
                        </div>
                        <div class="col-xl-3 col-md-6">
                            <div class="d-flex gap-3 align-items-center">
                                <div class="flex-shrink-0">
                                    <div class="avatar-sm">
                                        <span class="avatar-title bg-soft-info rounded fs-3">
                                            <i class="fas fa-eye text-info"></i>
                                        </span>
                                    </div>
                                </div>
                                <div class="flex-grow-1 ms-3">
                                    <h6 class="mb-1">Page Views</h6>
                                    <h4 class="mb-0">{{ number_format($analyticsSummary['overview']['page_views'] ?? 0) }}</h4>
                                </div>
                            </div>
                        </div>
                        <div class="col-xl-3 col-md-6">
                            <div class="d-flex gap-3 align-items-center">
                                <div class="flex-shrink-0">
                                    <div class="avatar-sm">
                                        <span class="avatar-title bg-soft-danger rounded fs-3">
                                            <i class="fas fa-user-clock text-danger"></i>
                                        </span>
                                    </div>
                                </div>
                                <div class="flex-grow-1 ms-3">
                                    <h6 class="mb-1">Active Users (Now)</h6>
                                    <h4 class="mb-0">{{ number_format($analyticsSummary['realtime']['active_users'] ?? 0) }}</h4>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
    @endif
</x-dashboard.layout>