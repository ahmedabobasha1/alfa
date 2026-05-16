<x-dashboard.layout title="Google Analytics Dashboard">
    <div class="row">
        <div class="col-12">
            <div class="card">
                <div class="card-header d-flex justify-content-between align-items-center">
                    <h4 class="card-title mb-0">
                        <i class="fas fa-chart-line me-2"></i>
                        Google Analytics Dashboard
                    </h4>
                    <div class="d-flex gap-2">
                        <select id="period-selector" class="form-select form-select-sm" style="width: auto;">
                            <option value="7d" {{ $period === '7d' ? 'selected' : '' }}>Last 7 Days</option>
                            <option value="14d" {{ $period === '14d' ? 'selected' : '' }}>Last 14 Days</option>
                            <option value="30d" {{ $period === '30d' ? 'selected' : '' }}>Last 30 Days</option>
                            <option value="90d" {{ $period === '90d' ? 'selected' : '' }}>Last 90 Days</option>
                            <option value="1y" {{ $period === '1y' ? 'selected' : '' }}>Last Year</option>
                        </select>
                        <button id="refresh-btn" class="btn btn-sm btn-outline-primary">
                            <i class="fas fa-sync-alt"></i> Refresh
                        </button>
                    </div>
                </div>
                <div class="card-body">
                    @if (isset($error))
                        <div class="alert alert-danger">
                            <i class="fas fa-exclamation-triangle me-2"></i>
                            <strong>Error:</strong> {{ $error }}
                        </div>
                    @endif

                    <!-- Connection Status -->
                    <div id="connection-status" class="mb-4" style="display: none;">
                        <div class="alert" id="status-alert">
                            <i class="fas fa-info-circle me-2"></i>
                            <span id="status-message"></span>
                        </div>
                    </div>

                    <!-- Overview Cards -->
                    <div class="row mb-4">
                        <div class="col-xl-3 col-md-6">
                            <div class="card card-h-100">
                                <div class="card-body">
                                    <div class="d-flex align-items-center">
                                        <div class="flex-grow-1">
                                            <span class="text-muted mb-3 lh-1 d-block text-truncate">Total Users</span>
                                            <h4 class="mb-3">
                                                <span class="counter-value"
                                                    data-target="{{ $overview['total_users'] ?? 0 }}">0</span>
                                            </h4>
                                        </div>
                                        <div class="flex-shrink-0">
                                            <div class="avatar-sm">
                                                <span class="avatar-title bg-soft-primary rounded fs-2">
                                                    <i class="fas fa-users text-primary"></i>
                                                </span>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>

                        <div class="col-xl-3 col-md-6">
                            <div class="card card-h-100">
                                <div class="card-body">
                                    <div class="d-flex align-items-center">
                                        <div class="flex-grow-1">
                                            <span class="text-muted mb-3 lh-1 d-block text-truncate">Sessions</span>
                                            <h4 class="mb-3">
                                                <span class="counter-value"
                                                    data-target="{{ $overview['sessions'] ?? 0 }}">0</span>
                                            </h4>
                                        </div>
                                        <div class="flex-shrink-0">
                                            <div class="avatar-sm">
                                                <span class="avatar-title bg-soft-success rounded fs-2">
                                                    <i class="fas fa-chart-line text-success"></i>
                                                </span>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>

                        <div class="col-xl-3 col-md-6">
                            <div class="card card-h-100">
                                <div class="card-body">
                                    <div class="d-flex align-items-center">
                                        <div class="flex-grow-1">
                                            <span class="text-muted mb-3 lh-1 d-block text-truncate">Page Views</span>
                                            <h4 class="mb-3">
                                                <span class="counter-value"
                                                    data-target="{{ $overview['page_views'] ?? 0 }}">0</span>
                                            </h4>
                                        </div>
                                        <div class="flex-shrink-0">
                                            <div class="avatar-sm">
                                                <span class="avatar-title bg-soft-info rounded fs-2">
                                                    <i class="fas fa-eye text-info"></i>
                                                </span>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>

                        <div class="col-xl-3 col-md-6">
                            <div class="card card-h-100">
                                <div class="card-body">
                                    <div class="d-flex align-items-center">
                                        <div class="flex-grow-1">
                                            <span class="text-muted mb-3 lh-1 d-block text-truncate">Bounce Rate</span>
                                            <h4 class="mb-3">
                                                <span class="counter-value"
                                                    data-target="{{ $overview['bounce_rate'] ?? 0 }}">0</span>%
                                            </h4>
                                        </div>
                                        <div class="flex-shrink-0">
                                            <div class="avatar-sm">
                                                <span class="avatar-title bg-soft-warning rounded fs-2">
                                                    <i class="fas fa-percentage text-warning"></i>
                                                </span>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>

                    <!-- Real-time Data -->
                    <div class="row mb-4">
                        <div class="col-12">
                            <div class="card">
                                <div class="card-header">
                                    <h5 class="card-title mb-0">
                                        <i class="fas fa-clock me-2"></i>
                                        Real-time Activity
                                        <small class="text-muted ms-2" id="realtime-timestamp">Last updated:
                                            {{ $realTimeData['last_updated'] ?? 'N/A' }}</small>
                                    </h5>
                                </div>
                                <div class="card-body">
                                    <div class="row">
                                        <div class="col-md-6">
                                            <div class="d-flex align-items-center">
                                                <div class="flex-shrink-0">
                                                    <div class="avatar-sm">
                                                        <span class="avatar-title bg-soft-danger rounded fs-2">
                                                            <i class="fas fa-user-clock text-danger"></i>
                                                        </span>
                                                    </div>
                                                </div>
                                                <div class="flex-grow-1 ms-3">
                                                    <h6 class="mb-1">Active Users</h6>
                                                    <h4 class="mb-0" id="realtime-active-users">
                                                        {{ $realTimeData['active_users'] ?? 0 }}</h4>
                                                </div>
                                            </div>
                                        </div>
                                        <div class="col-md-6">
                                            <div class="d-flex align-items-center">
                                                <div class="flex-shrink-0">
                                                    <div class="avatar-sm">
                                                        <span class="avatar-title bg-soft-primary rounded fs-2">
                                                            <i class="fas fa-eye text-primary"></i>
                                                        </span>
                                                    </div>
                                                </div>
                                                <div class="flex-grow-1 ms-3">
                                                    <h6 class="mb-1">Page Views (30min)</h6>
                                                    <h4 class="mb-0" id="realtime-page-views">
                                                        {{ $realTimeData['page_views'] ?? 0 }}</h4>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>

                    <!-- Charts Row -->
                    <div class="row mb-4">
                        <!-- Traffic Sources -->
                        <div class="col-xl-6">
                            <div class="card">
                                <div class="card-header">
                                    <h5 class="card-title mb-0">
                                        <i class="fas fa-share-alt me-2"></i>
                                        Traffic Sources
                                    </h5>
                                </div>
                                <div class="card-body">
                                    <div id="traffic-sources-chart" style="height: 300px;"></div>
                                </div>
                            </div>
                        </div>

                        <!-- Device Breakdown -->
                        <div class="col-xl-6">
                            <div class="card">
                                <div class="card-header">
                                    <h5 class="card-title mb-0">
                                        <i class="fas fa-mobile-alt me-2"></i>
                                        Device Breakdown
                                    </h5>
                                </div>
                                <div class="card-body">
                                    <div id="device-breakdown-chart" style="height: 300px;"></div>
                                </div>
                            </div>
                        </div>
                    </div>

                    <!-- User Behavior Chart -->
                    <div class="row mb-4">
                        <div class="col-12">
                            <div class="card">
                                <div class="card-header">
                                    <h5 class="card-title mb-0">
                                        <i class="fas fa-chart-area me-2"></i>
                                        User Behavior Over Time
                                    </h5>
                                </div>
                                <div class="card-body">
                                    <div id="user-behavior-chart" style="height: 400px;"></div>
                                </div>
                            </div>
                        </div>
                    </div>

                    <!-- Top Pages Table -->
                    <div class="row">
                        <div class="col-12">
                            <div class="card">
                                <div class="card-header">
                                    <h5 class="card-title mb-0">
                                        <i class="fas fa-list me-2"></i>
                                        Top Pages
                                    </h5>
                                </div>
                                <div class="card-body">
                                    <div class="table-responsive">
                                        <table class="table table-centered table-nowrap mb-0">
                                            <thead>
                                                <tr>
                                                    <th>Page</th>
                                                    <th>Page Views</th>
                                                    <th>Users</th>
                                                    <th>Avg. Duration</th>
                                                    <th>Bounce Rate</th>
                                                </tr>
                                            </thead>
                                            <tbody id="top-pages-table">
                                                @foreach ($topPages as $page)
                                                    <tr>
                                                        <td>
                                                            <div>
                                                                <h6 class="mb-1">
                                                                    {{ Str::limit($page['title'], 50) }}</h6>
                                                                <small class="text-muted">{{ $page['path'] }}</small>
                                                            </div>
                                                        </td>
                                                        <td>{{ number_format($page['page_views']) }}</td>
                                                        <td>{{ number_format($page['users']) }}</td>
                                                        <td>{{ $page['avg_duration'] }}</td>
                                                        <td>{{ $page['bounce_rate'] }}%</td>
                                                    </tr>
                                                @endforeach
                                            </tbody>
                                        </table>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>

    @push('scripts')
        <script src="https://cdn.jsdelivr.net/npm/apexcharts"></script>
        <script>
            $(document).ready(function() {
                // Initialize counter animations
                $('.counter-value').each(function() {
                    var $this = $(this);
                    var countTo = $this.attr('data-target');

                    $({
                        countNum: 0
                    }).animate({
                        countNum: countTo
                    }, {
                        duration: 2000,
                        easing: 'swing',
                        step: function() {
                            $this.text(Math.floor(this.countNum));
                        },
                        complete: function() {
                            $this.text(this.countNum);
                        }
                    });
                });

                // Period selector change
                $('#period-selector').on('change', function() {
                    var period = $(this).val();
                    loadAnalyticsData(period);
                });

                // Refresh button
                $('#refresh-btn').on('click', function() {
                    var period = $('#period-selector').val();
                    loadAnalyticsData(period, true);
                });

                // Test connection button
                $('#test-connection-btn').on('click', function() {
                    testConnection();
                });

                // Clear cache button
                $('#clear-cache-btn').on('click', function() {
                    clearCache();
                });

                // Initialize charts
                initializeCharts();

                // Auto-refresh real-time data every 30 seconds
                setInterval(function() {
                    loadRealTimeData();
                }, 30000);
            });

            function loadAnalyticsData(period, refresh = false) {
                var url = '{{ route('dashboard.analytics.getData') }}';
                var params = {
                    period: period,
                    type: 'overview'
                };

                if (refresh) {
                    params.refresh = true;
                }

                $.get(url, params)
                    .done(function(response) {
                        if (response.success) {
                            updateOverviewData(response.data);
                            loadTrafficSources(period);
                            loadTopPages(period);
                            loadUserBehavior(period);
                            loadDeviceBreakdown(period);
                        }
                    })
                    .fail(function(xhr) {
                        showStatus('Error loading analytics data', 'danger');
                    });
            }

            function loadTrafficSources(period) {
                $.get('{{ route('dashboard.analytics.getData') }}', {
                        period: period,
                        type: 'traffic_sources'
                    })
                    .done(function(response) {
                        if (response.success) {
                            updateTrafficSourcesChart(response.data);
                        }
                    });
            }

            function loadTopPages(period) {
                $.get('{{ route('dashboard.analytics.getData') }}', {
                        period: period,
                        type: 'top_pages'
                    })
                    .done(function(response) {
                        if (response.success) {
                            updateTopPagesTable(response.data);
                        }
                    });
            }

            function loadUserBehavior(period) {
                $.get('{{ route('dashboard.analytics.getData') }}', {
                        period: period,
                        type: 'user_behavior'
                    })
                    .done(function(response) {
                        if (response.success) {
                            updateUserBehaviorChart(response.data);
                        }
                    });
            }

            function loadDeviceBreakdown(period) {
                $.get('{{ route('dashboard.analytics.getData') }}', {
                        period: period,
                        type: 'device_breakdown'
                    })
                    .done(function(response) {
                        if (response.success) {
                            updateDeviceBreakdownChart(response.data);
                        }
                    });
            }

            function loadRealTimeData() {
                $.get('{{ route('dashboard.analytics.getData') }}', {
                        type: 'realtime'
                    })
                    .done(function(response) {
                        if (response.success) {
                            updateRealTimeData(response.data);
                        }
                    });
            }

            function updateOverviewData(data) {
                $('.counter-value[data-target]').each(function() {
                    var $this = $(this);
                    var metric = $this.closest('.card-body').find('.text-muted').text().toLowerCase().replace(/\s+/g,
                        '_');

                    if (data[metric] !== undefined) {
                        $this.attr('data-target', data[metric]);
                        $this.text(data[metric]);
                    }
                });
            }

            function updateRealTimeData(data) {
                $('#realtime-active-users').text(data.active_users);
                $('#realtime-page-views').text(data.page_views);
                $('#realtime-timestamp').text('Last updated: ' + data.last_updated);
            }

            function updateTopPagesTable(pages) {
                var tbody = $('#top-pages-table');
                tbody.empty();

                pages.forEach(function(page) {
                    var row = `
                    <tr>
                        <td>
                            <div>
                                <h6 class="mb-1">${page.title.length > 50 ? page.title.substring(0, 50) + '...' : page.title}</h6>
                                <small class="text-muted">${page.path}</small>
                            </div>
                        </td>
                        <td>${page.page_views.toLocaleString()}</td>
                        <td>${page.users.toLocaleString()}</td>
                        <td>${page.avg_duration}</td>
                        <td>${page.bounce_rate}%</td>
                    </tr>
                `;
                    tbody.append(row);
                });
            }

            function testConnection() {
                $.get('{{ route('dashboard.analytics.testConnection') }}')
                    .done(function(response) {
                        if (response.success) {
                            showStatus('Connection successful! Analytics data is available.', 'success');
                        } else {
                            showStatus('Connection failed: ' + response.message, 'danger');
                        }
                    })
                    .fail(function(xhr) {
                        showStatus('Connection test failed: ' + xhr.responseJSON?.error || 'Unknown error', 'danger');
                    });
            }

            function clearCache() {
                $.get('{{ route('dashboard.analytics.clearCache') }}')
                    .done(function(response) {
                        if (response.success) {
                            showStatus('Cache cleared successfully!', 'success');
                            // Reload data
                            var period = $('#period-selector').val();
                            loadAnalyticsData(period);
                        } else {
                            showStatus('Failed to clear cache: ' + response.message, 'danger');
                        }
                    })
                    .fail(function(xhr) {
                        showStatus('Cache clear failed: ' + xhr.responseJSON?.error || 'Unknown error', 'danger');
                    });
            }

            function showStatus(message, type) {
                var alertClass = 'alert-' + type;
                var iconClass = type === 'success' ? 'fa-check-circle' : 'fa-exclamation-triangle';

                $('#status-alert')
                    .removeClass()
                    .addClass('alert ' + alertClass);

                $('#status-message').html('<i class="fas ' + iconClass + ' me-2"></i>' + message);
                $('#connection-status').show();

                setTimeout(function() {
                    $('#connection-status').fadeOut();
                }, 5000);
            }

            function initializeCharts() {
                // Traffic Sources Chart
                var trafficSourcesData = @json($trafficSources);
                if (trafficSourcesData.length > 0) {
                    var trafficOptions = {
                        series: trafficSourcesData.map(item => item.sessions),
                        chart: {
                            type: 'donut',
                            height: 300
                        },
                        labels: trafficSourcesData.map(item => item.source),
                        responsive: [{
                            breakpoint: 480,
                            options: {
                                chart: {
                                    width: 200
                                },
                                legend: {
                                    position: 'bottom'
                                }
                            }
                        }]
                    };
                    new ApexCharts(document.querySelector("#traffic-sources-chart"), trafficOptions).render();
                }

                // Device Breakdown Chart
                var deviceData = @json($deviceBreakdown);
                if (deviceData.length > 0) {
                    var deviceOptions = {
                        series: deviceData.map(item => item.sessions),
                        chart: {
                            type: 'pie',
                            height: 300
                        },
                        labels: deviceData.map(item => item.device),
                        responsive: [{
                            breakpoint: 480,
                            options: {
                                chart: {
                                    width: 200
                                },
                                legend: {
                                    position: 'bottom'
                                }
                            }
                        }]
                    };
                    new ApexCharts(document.querySelector("#device-breakdown-chart"), deviceOptions).render();
                }

                // User Behavior Chart
                var behaviorData = @json($userBehavior);
                if (behaviorData.length > 0) {
                    var behaviorOptions = {
                        series: [{
                            name: 'Users',
                            data: behaviorData.map(item => item.users)
                        }, {
                            name: 'Sessions',
                            data: behaviorData.map(item => item.sessions)
                        }, {
                            name: 'Page Views',
                            data: behaviorData.map(item => item.page_views)
                        }],
                        chart: {
                            type: 'area',
                            height: 400,
                            toolbar: {
                                show: false
                            }
                        },
                        dataLabels: {
                            enabled: false
                        },
                        stroke: {
                            curve: 'smooth'
                        },
                        xaxis: {
                            categories: behaviorData.map(item => item.date)
                        },
                        tooltip: {
                            x: {
                                format: 'dd/MM/yy'
                            }
                        }
                    };
                    new ApexCharts(document.querySelector("#user-behavior-chart"), behaviorOptions).render();
                }
            }

            function updateTrafficSourcesChart(data) {
                // Update chart logic here
            }

            function updateDeviceBreakdownChart(data) {
                // Update chart logic here
            }

            function updateUserBehaviorChart(data) {
                // Update chart logic here
            }
        </script>
    @endpush
</x-dashboard.layout>
