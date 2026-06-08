@extends('layouts.admin')

@section('content')
    <div class="d-flex justify-content-between align-items-center mb-4 pb-2 border-bottom">
        <div>
            <h1 class="h2 text-dark mb-0">Business Dashboard</h1>
            <p class="text-muted small mb-0">Overview of WIL Plumbing business performance, inquiries, and scheduled bookings.</p>
        </div>
        <div>
            <span class="badge bg-primary px-3 py-2 fs-6">
                <i class="bi bi-clock me-1"></i> Today is {{ date('F d, Y') }}
            </span>
        </div>
    </div>

    <!-- Statistics Cards -->
    <div class="row g-3 mb-4">
        <div class="col-6 col-lg-3">
            <div class="admin-card p-3 d-flex align-items-center">
                <div class="bg-primary bg-opacity-10 text-primary p-3 rounded-3 fs-3 me-3">
                    <i class="bi bi-calendar2-week"></i>
                </div>
                <div>
                    <h5 class="text-muted small text-uppercase mb-1">Total Bookings</h5>
                    <span class="fs-4 fw-bold text-dark">{{ $totalRequests }}</span>
                </div>
            </div>
        </div>
        <div class="col-6 col-lg-3">
            <div class="admin-card p-3 d-flex align-items-center">
                <div class="bg-danger bg-opacity-10 text-danger p-3 rounded-3 fs-3 me-3">
                    <i class="bi bi-clock-history"></i>
                </div>
                <div>
                    <h5 class="text-muted small text-uppercase mb-1">Pending</h5>
                    <span class="fs-4 fw-bold text-dark">{{ $pendingRequests }}</span>
                </div>
            </div>
        </div>
        <div class="col-6 col-lg-3">
            <div class="admin-card p-3 d-flex align-items-center">
                <div class="bg-success bg-opacity-10 text-success p-3 rounded-3 fs-3 me-3">
                    <i class="bi bi-check-circle"></i>
                </div>
                <div>
                    <h5 class="text-muted small text-uppercase mb-1">Completed Jobs</h5>
                    <span class="fs-4 fw-bold text-dark">{{ $completedJobs }}</span>
                </div>
            </div>
        </div>
        <div class="col-6 col-lg-3">
            <div class="admin-card p-3 d-flex align-items-center">
                <div class="bg-info bg-opacity-10 text-info p-3 rounded-3 fs-3 me-3">
                    <i class="bi bi-envelope"></i>
                </div>
                <div>
                    <h5 class="text-muted small text-uppercase mb-1">Unread Msg</h5>
                    <span class="fs-4 fw-bold text-dark">{{ $unreadMessages }}</span>
                </div>
            </div>
        </div>
    </div>

    <div class="row g-3 mb-4">
        <div class="col-6 col-lg-4">
            <div class="admin-card p-3 d-flex align-items-center">
                <div class="bg-secondary bg-opacity-10 text-secondary p-3 rounded-3 fs-3 me-3">
                    <i class="bi bi-wrench"></i>
                </div>
                <div>
                    <h5 class="text-muted small text-uppercase mb-1">Active Services</h5>
                    <span class="fs-4 fw-bold text-dark">{{ $totalServices }}</span>
                </div>
            </div>
        </div>
        <div class="col-6 col-lg-4">
            <div class="admin-card p-3 d-flex align-items-center">
                <div class="bg-warning bg-opacity-10 text-warning p-3 rounded-3 fs-3 me-3">
                    <i class="bi bi-journal-check"></i>
                </div>
                <div>
                    <h5 class="text-muted small text-uppercase mb-1">Total Projects</h5>
                    <span class="fs-4 fw-bold text-dark">{{ $totalProjects }}</span>
                </div>
            </div>
        </div>
        <div class="col-12 col-lg-4">
            <div class="admin-card p-3 d-flex align-items-center">
                <div class="bg-indigo bg-opacity-10 text-primary p-3 rounded-3 fs-3 me-3">
                    <i class="bi bi-chat-square-quote"></i>
                </div>
                <div>
                    <h5 class="text-muted small text-uppercase mb-1">Reviews Received</h5>
                    <span class="fs-4 fw-bold text-dark">{{ $totalTestimonials }}</span>
                </div>
            </div>
        </div>
    </div>

    <!-- Analytics Charts Section -->
    <div class="row g-4 mb-4">
        <!-- Monthly line chart -->
        <div class="col-xl-8">
            <div class="admin-card p-4 h-100">
                <h3 class="h5 text-dark mb-3"><i class="bi bi-graph-up text-primary me-2"></i>Monthly Booking Requests ({{ date('Y') }})</h3>
                <div style="position: relative; height: 320px;">
                    <canvas id="monthlyRequestsChart"></canvas>
                </div>
            </div>
        </div>
        <!-- Status Donut Chart -->
        <div class="col-xl-4">
            <div class="admin-card p-4 h-100">
                <h3 class="h5 text-dark mb-3"><i class="bi bi-pie-chart text-primary me-2"></i>Job Status Breakdown</h3>
                <div style="position: relative; height: 320px;" class="d-flex align-items-center justify-content-center">
                    <canvas id="statusDonutChart"></canvas>
                </div>
            </div>
        </div>
    </div>

    <!-- Recent Service Requests -->
    <div class="admin-card p-4">
        <div class="d-flex justify-content-between align-items-center mb-3">
            <h3 class="h5 text-dark mb-0"><i class="bi bi-card-list text-primary me-2"></i>Recent Bookings</h3>
            <a href="{{ route('admin.requests.index') }}" class="btn btn-outline-primary btn-sm">View All Bookings</a>
        </div>
        <div class="table-responsive">
            <table class="table table-hover align-middle">
                <thead class="table-light">
                    <tr>
                        <th>Customer</th>
                        <th>Required Service</th>
                        <th>Preferred Date</th>
                        <th>Status</th>
                        <th class="text-end">Actions</th>
                    </tr>
                </thead>
                <tbody>
                    @forelse($recentRequests as $request)
                        <tr>
                            <td>
                                <div class="fw-bold text-dark">{{ $request->customer_name }}</div>
                                <small class="text-muted">{{ $request->customer_phone }}</small>
                            </td>
                            <td>
                                <span class="badge bg-light text-dark border"><i class="bi bi-{{ $request->service->icon ?? 'wrench' }} text-primary me-1"></i> {{ $request->service->name ?? 'N/A' }}</span>
                            </td>
                            <td>{{ $request->preferred_date->format('M d, Y') }}</td>
                            <td>
                                @if($request->status == 'pending')
                                    <span class="badge bg-warning text-dark"><i class="bi bi-clock me-1"></i> Pending</span>
                                @elseif($request->status == 'in_progress')
                                    <span class="badge bg-primary"><i class="bi bi-gear-fill spin me-1"></i> In Progress</span>
                                @elseif($request->status == 'completed')
                                    <span class="badge bg-success"><i class="bi bi-check-circle-fill me-1"></i> Completed</span>
                                @else
                                    <span class="badge bg-secondary"><i class="bi bi-x-circle me-1"></i> Cancelled</span>
                                @endif
                            </td>
                            <td class="text-end">
                                <a href="{{ route('admin.requests.show', $request->id) }}" class="btn btn-sm btn-light border"><i class="bi bi-eye"></i> View details</a>
                            </td>
                        </tr>
                    @empty
                        <tr>
                            <td colspan="5" class="text-center py-4 text-muted">
                                <i class="bi bi-inbox fs-2 mb-2"></i>
                                <p class="mb-0">No booking requests submitted yet.</p>
                            </td>
                        </tr>
                    @endforelse
                </tbody>
            </table>
        </div>
    </div>
@endsection

@section('scripts')
    <!-- Include Chart.js -->
    <script src="https://cdn.jsdelivr.net/npm/chart.js"></script>
    <script>
        document.addEventListener('DOMContentLoaded', function () {
            // 1. Monthly Line Chart
            const monthlyCtx = document.getElementById('monthlyRequestsChart').getContext('2d');
            new Chart(monthlyCtx, {
                type: 'line',
                data: {
                    labels: {!! json_encode($monthlyChartLabels) !!},
                    datasets: [{
                        label: 'Requests',
                        data: {!! json_encode($monthlyChartData) !!},
                        borderColor: '#0284c7',
                        backgroundColor: 'rgba(2, 132, 199, 0.1)',
                        fill: true,
                        tension: 0.4,
                        borderWidth: 3,
                        pointBackgroundColor: '#0284c7',
                        pointBorderColor: '#fff',
                        pointHoverRadius: 8
                    }]
                },
                options: {
                    responsive: true,
                    maintainAspectRatio: false,
                    plugins: {
                        legend: { display: false }
                    },
                    scales: {
                        y: {
                            beginAtZero: true,
                            ticks: { stepSize: 1 }
                        }
                    }
                }
            });

            // 2. Status Donut Chart
            const statusCtx = document.getElementById('statusDonutChart').getContext('2d');
            new Chart(statusCtx, {
                type: 'doughnut',
                data: {
                    labels: {!! json_encode($statusLabels) !!},
                    datasets: [{
                        data: {!! json_encode($statusData) !!},
                        backgroundColor: ['#eab308', '#3b82f6', '#22c55e', '#64748b'],
                        borderWidth: 2,
                        borderColor: '#fff'
                    }]
                },
                options: {
                    responsive: true,
                    maintainAspectRatio: false,
                    plugins: {
                        legend: {
                            position: 'bottom',
                            labels: { boxWidth: 12, padding: 15 }
                        }
                    },
                    cutout: '65%'
                }
            });
        });
    </script>
@endsection
