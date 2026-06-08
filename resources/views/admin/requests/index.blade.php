@extends('layouts.admin')

@section('content')
    <div class="d-flex justify-content-between align-items-center mb-4 pb-2 border-bottom">
        <div>
            <h1 class="h2 text-dark mb-0">Bookings & Service Requests</h1>
            <p class="text-muted small mb-0">Track and dispatch customer service bookings and status updates.</p>
        </div>
    </div>

    <!-- Status Filters -->
    <div class="d-flex flex-wrap gap-2 mb-4">
        <a href="{{ route('admin.requests.index') }}" class="btn btn-sm {{ $activeStatus == 'all' ? 'btn-primary' : 'btn-outline-secondary' }}">All Bookings</a>
        <a href="{{ route('admin.requests.index', ['status' => 'pending']) }}" class="btn btn-sm {{ $activeStatus == 'pending' ? 'btn-warning text-dark' : 'btn-outline-warning text-dark' }}"><i class="bi bi-clock"></i> Pending</a>
        <a href="{{ route('admin.requests.index', ['status' => 'in_progress']) }}" class="btn btn-sm {{ $activeStatus == 'in_progress' ? 'btn-primary' : 'btn-outline-primary' }}"><i class="bi bi-gear-fill"></i> In Progress</a>
        <a href="{{ route('admin.requests.index', ['status' => 'completed']) }}" class="btn btn-sm {{ $activeStatus == 'completed' ? 'btn-success' : 'btn-outline-success' }}"><i class="bi bi-check-circle-fill"></i> Completed</a>
        <a href="{{ route('admin.requests.index', ['status' => 'cancelled']) }}" class="btn btn-sm {{ $activeStatus == 'cancelled' ? 'btn-secondary' : 'btn-outline-secondary' }}"><i class="bi bi-x-circle'></i> Cancelled</a>
    </div>

    <div class="admin-card p-4">
        <div class="table-responsive">
            <table class="table table-hover align-middle">
                <thead class="table-light">
                    <tr>
                        <th>Customer Details</th>
                        <th>Address</th>
                        <th>Required Service</th>
                        <th>Preferred Date</th>
                        <th>Status</th>
                        <th class="text-end">Actions</th>
                    </tr>
                </thead>
                <tbody>
                    @forelse($requests as $req)
                        <tr>
                            <td>
                                <div class="fw-bold text-dark">{{ $req->customer_name }}</div>
                                <small class="text-muted">{{ $req->customer_phone }} | {{ $req->customer_email }}</small>
                            </td>
                            <td>
                                <div class="small text-muted">{{ Str::limit($req->address, 50) }}</div>
                            </td>
                            <td>
                                <span class="badge bg-light text-dark border"><i class="bi bi-{{ $req->service->icon ?? 'wrench' }} text-primary me-1"></i> {{ $req->service->name ?? 'N/A' }}</span>
                            </td>
                            <td>{{ $req->preferred_date->format('M d, Y') }}</td>
                            <td>
                                @if($req->status == 'pending')
                                    <span class="badge bg-warning text-dark">Pending</span>
                                @elseif($req->status == 'in_progress')
                                    <span class="badge bg-primary">In Progress</span>
                                @elseif($req->status == 'completed')
                                    <span class="badge bg-success">Completed</span>
                                @else
                                    <span class="badge bg-secondary">Cancelled</span>
                                @endif
                            </td>
                            <td class="text-end">
                                <div class="btn-group">
                                    <a href="{{ route('admin.requests.show', $req->id) }}" class="btn btn-sm btn-light border"><i class="bi bi-eye-fill text-primary"></i> View details</a>
                                    <form action="{{ route('admin.requests.destroy', $req->id) }}" method="POST" onsubmit="return confirm('Are you sure you want to delete this booking?');" class="d-inline">
                                        @csrf
                                        @method('DELETE')
                                        <button type="submit" class="btn btn-sm btn-light text-danger border"><i class="bi bi-trash"></i></button>
                                    </form>
                                </div>
                            </td>
                        </tr>
                    @empty
                        <tr>
                            <td colspan="6" class="text-center py-5 text-muted">
                                <i class="bi bi-calendar-x fs-1 mb-2"></i>
                                <p class="mb-0">No booking requests found under this status.</p>
                            </td>
                        </tr>
                    @endforelse
                </tbody>
            </table>
        </div>
    </div>
@endsection
