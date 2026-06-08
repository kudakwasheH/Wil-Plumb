@extends('layouts.admin')

@section('content')
    <div class="mb-4 pb-2 border-bottom">
        <a href="{{ route('admin.requests.index') }}" class="text-decoration-none text-muted small"><i class="bi bi-arrow-left"></i> Back to bookings</a>
        <h1 class="h2 text-dark mt-2 mb-0">Booking Details</h1>
        <p class="text-muted small mb-0">Review client booking request and update progress status.</p>
    </div>

    <div class="row g-4">
        <!-- Customer & Service Specs -->
        <div class="col-lg-7">
            <div class="admin-card p-4 h-100">
                <div class="d-flex justify-content-between align-items-center border-bottom pb-3 mb-4">
                    <h3 class="h5 text-dark mb-0"><i class="bi bi-person-badge text-primary me-2"></i>Customer Information</h3>
                    <span class="badge bg-secondary">Ref #REQ-{{ str_pad($booking->id, 5, '0', STR_PAD_LEFT) }}</span>
                </div>
                
                <div class="row mb-4">
                    <div class="col-sm-6 mb-3">
                        <label class="text-muted small text-uppercase d-block">Client Name</label>
                        <span class="fw-bold text-dark fs-5">{{ $booking->customer_name }}</span>
                    </div>
                    <div class="col-sm-6 mb-3">
                        <label class="text-muted small text-uppercase d-block">Phone Number</label>
                        <a href="tel:{{ $booking->customer_phone }}" class="fw-semibold fs-5 text-decoration-none text-primary">{{ $booking->customer_phone }}</a>
                    </div>
                    <div class="col-sm-6 mb-3">
                        <label class="text-muted small text-uppercase d-block">Email Address</label>
                        <a href="mailto:{{ $booking->customer_email }}" class="fw-semibold text-decoration-none text-primary">{{ $booking->customer_email }}</a>
                    </div>
                    <div class="col-sm-6 mb-3">
                        <label class="text-muted small text-uppercase d-block">Request Logged</label>
                        <span class="text-muted">{{ $booking->created_at->format('M d, Y H:i') }}</span>
                    </div>
                </div>

                <div class="d-flex justify-content-between align-items-center border-bottom pb-3 mb-4 mt-2">
                    <h3 class="h5 text-dark mb-0"><i class="bi bi-geo-fill text-primary me-2"></i>Job Specifications</h3>
                </div>

                <div class="mb-3">
                    <label class="text-muted small text-uppercase d-block">Service Address</label>
                    <p class="fw-bold text-dark">{{ $booking->address }}</p>
                </div>
                
                <div class="row mb-3">
                    <div class="col-sm-6 mb-3">
                        <label class="text-muted small text-uppercase d-block">Required Service</label>
                        <span class="badge bg-light text-dark border p-2"><i class="bi bi-{{ $booking->service->icon ?? 'wrench' }} text-primary me-1"></i> {{ $booking->service->name ?? 'N/A' }}</span>
                    </div>
                    <div class="col-sm-6 mb-3">
                        <label class="text-muted small text-uppercase d-block">Preferred Date</label>
                        <span class="fw-bold text-dark">{{ $booking->preferred_date->format('l, F d, Y') }}</span>
                    </div>
                </div>

                <div class="mb-0">
                    <label class="text-muted small text-uppercase d-block">Problem Description</label>
                    <div class="bg-light p-3 rounded text-dark border small fst-italic">
                        "{{ $booking->problem_description }}"
                    </div>
                </div>
            </div>
        </div>

        <!-- Dispatch Status & Admin Notes -->
        <div class="col-lg-5">
            <div class="admin-card p-4 h-100">
                <h3 class="h5 text-dark border-bottom pb-3 mb-4"><i class="bi bi-sliders text-primary me-2"></i>Management Control</h3>
                
                <form method="POST" action="{{ route('admin.requests.update', $booking->id) }}">
                    @csrf
                    @method('PUT')

                    <div class="mb-4">
                        <label for="status" class="form-label small fw-bold">Dispatch Status *</label>
                        <select name="status" id="status" class="form-select form-select-lg" required>
                            <option value="pending" {{ $booking->status == 'pending' ? 'selected' : '' }}>Pending (Awaiting dispatch)</option>
                            <option value="in_progress" {{ $booking->status == 'in_progress' ? 'selected' : '' }}>In Progress (Technician on-site)</option>
                            <option value="completed" {{ $booking->status == 'completed' ? 'selected' : '' }}>Completed (Job done / invoiced)</option>
                            <option value="cancelled" {{ $booking->status == 'cancelled' ? 'selected' : '' }}>Cancelled (Client cancelled / rejected)</option>
                        </select>
                    </div>

                    <div class="mb-4">
                        <label for="admin_notes" class="form-label small fw-bold">Internal Admin Notes</label>
                        <textarea name="admin_notes" id="admin_notes" rows="6" class="form-control" placeholder="Write internal notes about diagnosis, assigned technician name, parts used, invoicing details, etc. (Not visible to customer)">{{ old('admin_notes', $booking->admin_notes) }}</textarea>
                    </div>

                    <div class="d-grid gap-2">
                        <button type="submit" class="btn btn-pb-primary py-2.5"><i class="bi bi-save2-fill me-2"></i> Save Changes</button>
                    </div>
                </form>
                
                <hr class="my-4">
                
                <div class="text-center">
                    <form action="{{ route('admin.requests.destroy', $booking->id) }}" method="POST" onsubmit="return confirm('Are you sure you want to permanently delete this service request? This cannot be undone.');">
                        @csrf
                        @method('DELETE')
                        <button type="submit" class="btn btn-sm btn-outline-danger w-100 py-2"><i class="bi bi-trash-fill me-1"></i> Delete Service Request</button>
                    </form>
                </div>
            </div>
        </div>
    </div>
@endsection
