@extends('adminlte::page')

@section('title', 'Dashboard')

@section('content_header')
    <h1>Dashboard</h1>
@stop

@section('content')
    <div class="row">
        <div class="col-lg-3 col-6">
            <div class="small-box bg-info">
                <div class="inner">
                    <h3>{{ $stats['users'] }}</h3>
                    <p>Users</p>
                </div>
                <div class="icon"><i class="fas fa-users"></i></div>
            </div>
        </div>
        <div class="col-lg-3 col-6">
            <div class="small-box bg-success">
                <div class="inner">
                    <h3>{{ $stats['posts'] }}</h3>
                    <p>Posts</p>
                </div>
                <div class="icon"><i class="fas fa-newspaper"></i></div>
            </div>
        </div>
        <div class="col-lg-3 col-6">
            <div class="small-box bg-warning">
                <div class="inner">
                    <h3>{{ $stats['services'] }}</h3>
                    <p>Services</p>
                </div>
                <div class="icon"><i class="fas fa-concierge-bell"></i></div>
            </div>
        </div>
        <div class="col-lg-3 col-6">
            <div class="small-box bg-danger">
                <div class="inner">
                    <h3>{{ number_format($stats['payments_total'], 2) }}</h3>
                    <p>Payments (Paid)</p>
                </div>
                <div class="icon"><i class="fas fa-rupee-sign"></i></div>
            </div>
        </div>
    </div>

    <div class="row">
        <div class="col-md-8">
            <div class="card">
                <div class="card-header">
                    <h3 class="card-title">Analytics (Last 30 Days)</h3>
                </div>
                <div class="card-body">
                    <canvas id="activityChart" height="110"></canvas>
                </div>
            </div>
        </div>
        <div class="col-md-4">
            <div class="card">
                <div class="card-header">
                    <h3 class="card-title">Quick Draft</h3>
                </div>
                <div class="card-body">
                    <form method="POST" action="#">
                        @csrf
                        <div class="form-group">
                            <label>Title</label>
                            <input class="form-control" placeholder="Draft title" disabled>
                        </div>
                        <div class="form-group">
                            <label>Content</label>
                            <textarea class="form-control" rows="4" placeholder="Write something..." disabled></textarea>
                        </div>
                        <button class="btn btn-primary" type="button" disabled>Save Draft</button>
                        <small class="text-muted d-block mt-2">Draft CRUD will be wired when Posts CRUD is added.</small>
                    </form>
                </div>
            </div>

            <div class="card card-outline card-info">
                <div class="card-header">
                    <h3 class="card-title">Notifications</h3>
                </div>
                <div class="card-body">
                    @forelse($notifications as $n)
                        <div class="callout callout-info py-2 mb-2">
                            <p class="mb-0 small">{{ $n->data['message'] ?? 'System notification' }}</p>
                        </div>
                    @empty
                        <div class="callout callout-info mb-0">
                            <p class="mb-0">No unread notifications.</p>
                        </div>
                    @endforelse
                </div>
            </div>

            <div class="card card-outline card-warning">
                <div class="card-header">
                    <h3 class="card-title">Alerts</h3>
                </div>
                <div class="card-body">
                    @forelse($recentActivity as $a)
                        <div class="callout callout-warning py-2 mb-2">
                            <p class="mb-0 small">
                                <strong>{{ ucfirst($a->module) }}:</strong>
                                {{ $a->message }}
                            </p>
                        </div>
                    @empty
                        <div class="callout callout-warning mb-0">
                            <p class="mb-0">No recent admin activity.</p>
                        </div>
                    @endforelse
                </div>
            </div>
        </div>
    </div>
@stop

@section('js')
    <script src="https://cdn.jsdelivr.net/npm/chart.js@4.4.2/dist/chart.umd.min.js"></script>
    <script>
        const series = @json($series);

        const labels = (() => {
            const set = new Set();
            for (const k of ['users', 'posts', 'services', 'payments']) {
                for (const row of series[k]) set.add(row.d);
            }
            return Array.from(set).sort();
        })();

        const toMap = (rows) => {
            const m = new Map();
            for (const r of rows) m.set(r.d, Number(r.c));
            return m;
        };

        const users = toMap(series.users);
        const posts = toMap(series.posts);
        const services = toMap(series.services);
        const payments = toMap(series.payments);

        const ctx = document.getElementById('activityChart');
        new Chart(ctx, {
            type: 'line',
            data: {
                labels,
                datasets: [
                    { label: 'New Users', data: labels.map(l => users.get(l) || 0) },
                    { label: 'Posts Created', data: labels.map(l => posts.get(l) || 0) },
                    { label: 'Services Added', data: labels.map(l => services.get(l) || 0) },
                    { label: 'Payments (Paid)', data: labels.map(l => payments.get(l) || 0) },
                ]
            },
            options: {
                responsive: true,
                plugins: { legend: { position: 'bottom' } },
                interaction: { mode: 'index', intersect: false },
                scales: { y: { beginAtZero: true } }
            }
        });
    </script>
@stop