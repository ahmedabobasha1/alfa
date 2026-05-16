<x-dashboard.layout title="Search Console">
    <div class="row mb-3">
        <div class="col-12 d-flex gap-2 align-items-center">
            <form method="GET" class="d-inline">
                <select name="period" class="form-select d-inline w-auto" onchange="this.form.submit()">
                    <option value="7d" {{ $period === '7d' ? 'selected' : '' }}>Last 7 days</option>
                    <option value="14d" {{ $period === '14d' ? 'selected' : '' }}>Last 14 days</option>
                    <option value="28d" {{ $period === '28d' ? 'selected' : '' }}>Last 28 days</option>
                    <option value="90d" {{ $period === '90d' ? 'selected' : '' }}>Last 90 days</option>
                </select>
            </form>
            <span class="text-muted">from {{ $start }} to {{ $end }}</span>
        </div>
    </div>

    @if(!empty($error))
        <div class="alert alert-warning">Failed to fetch data from Search Console: {{ $error }}</div>
    @endif

    <div class="row">
        <div class="col-md-3">
            <div class="card">
                <div class="card-body">
                    <div class="text-muted">Clicks</div>
                    <div class="h3">{{ number_format($summary['clicks'] ?? 0) }}</div>
                </div>
            </div>
        </div>
        <div class="col-md-3">
            <div class="card">
                <div class="card-body">
                    <div class="text-muted">Impressions</div>
                    <div class="h3">{{ number_format($summary['impressions'] ?? 0) }}</div>
                </div>
            </div>
        </div>
        <div class="col-md-3">
            <div class="card">
                <div class="card-body">
                    <div class="text-muted">CTR</div>
                    <div class="h3">{{ number_format(($summary['ctr'] ?? 0) * 100, 2) }}%</div>
                </div>
            </div>
        </div>
        <div class="col-md-3">
            <div class="card">
                <div class="card-body">
                    <div class="text-muted">Average Position</div>
                    <div class="h3">{{ number_format($summary['position'] ?? 0, 2) }}</div>
                </div>
            </div>
        </div>
    </div>

    <div class="row mt-4">
        <div class="col-lg-6">
            <div class="card h-100">
                <div class="card-header">Top Queries</div>
                <div class="card-body p-0">
                    <div class="table-responsive">
                        <table class="table table-striped mb-0">
                            <thead>
                            <tr>
                                <th>Query</th>
                                <th>Clicks</th>
                                <th>Impressions</th>
                                <th>CTR</th>
                                <th>Position</th>
                            </tr>
                            </thead>
                            <tbody>
                            @forelse($topQueries as $row)
                                <tr>
                                    <td>{{ $row['keys'][0] ?? '-' }}</td>
                                    <td>{{ (int) $row['clicks'] }}</td>
                                    <td>{{ (int) $row['impressions'] }}</td>
                                    <td>{{ number_format($row['ctr'] * 100, 2) }}%</td>
                                    <td>{{ number_format($row['position'], 2) }}</td>
                                </tr>
                            @empty
                                <tr><td colspan="5" class="text-center text-muted">No data</td></tr>
                            @endforelse
                            </tbody>
                        </table>
                    </div>
                </div>
            </div>
        </div>
        <div class="col-lg-6">
            <div class="card h-100">
                <div class="card-header">Top Pages</div>
                <div class="card-body p-0">
                    <div class="table-responsive">
                        <table class="table table-striped mb-0">
                            <thead>
                            <tr>
                                <th>Page</th>
                                <th>Clicks</th>
                                <th>Impressions</th>
                                <th>CTR</th>
                                <th>Position</th>
                            </tr>
                            </thead>
                            <tbody>
                            @forelse($topPages as $row)
                                <tr>
                                    <td class="text-truncate" style="max-width: 280px;" title="{{ $row['keys'][0] ?? '-' }}">{{ $row['keys'][0] ?? '-' }}</td>
                                    <td>{{ (int) $row['clicks'] }}</td>
                                    <td>{{ (int) $row['impressions'] }}</td>
                                    <td>{{ number_format($row['ctr'] * 100, 2) }}%</td>
                                    <td>{{ number_format($row['position'], 2) }}</td>
                                </tr>
                            @empty
                                <tr><td colspan="5" class="text-center text-muted">No data</td></tr>
                            @endforelse
                            </tbody>
                        </table>
                    </div>
                </div>
            </div>
        </div>
    </div>
</x-dashboard.layout>


