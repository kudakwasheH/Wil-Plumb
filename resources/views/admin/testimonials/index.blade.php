@extends('layouts.admin')

@section('content')
    <div class="d-flex justify-content-between align-items-center mb-4 pb-2 border-bottom">
        <div>
            <h1 class="h2 text-dark mb-0">Testimonials Management</h1>
            <p class="text-muted small mb-0">Approve or delete user reviews and ratings displayed on the website.</p>
        </div>
    </div>

    <div class="admin-card p-4">
        <div class="table-responsive">
            <table class="table table-hover align-middle">
                <thead class="table-light">
                    <tr>
                        <th>Customer</th>
                        <th>Rating</th>
                        <th>Review</th>
                        <th>Submission Date</th>
                        <th>Status</th>
                        <th style="width: 180px;" class="text-end">Actions</th>
                    </tr>
                </thead>
                <tbody>
                    @forelse($testimonials as $t)
                        <tr>
                            <td>
                                <div class="fw-bold text-dark">{{ $t->customer_name }}</div>
                                <small class="text-muted">{{ $t->customer_role ?: 'Homeowner' }}</small>
                            </td>
                            <td>
                                <div class="stars-display text-warning small">
                                    @for($i = 1; $i <= 5; $i++)
                                        @if($i <= $t->rating)
                                            <i class="bi bi-star-fill text-warning"></i>
                                        @else
                                            <i class="bi bi-star text-warning"></i>
                                        @endif
                                    @endfor
                                </div>
                            </td>
                            <td>
                                <small class="text-muted fst-italic">"{{ Str::limit($t->review, 100) }}"</small>
                            </td>
                            <td>
                                {{ $t->created_at->format('M d, Y H:i') }}
                            </td>
                            <td>
                                @if($t->is_approved)
                                    <span class="badge bg-success"><i class="bi bi-check-circle-fill"></i> Approved</span>
                                @else
                                    <span class="badge bg-warning text-dark"><i class="bi bi-clock"></i> Pending Approval</span>
                                @endif
                            </td>
                            <td class="text-end">
                                <div class="btn-group">
                                    <form action="{{ route('admin.testimonials.approve', $t->id) }}" method="POST" class="d-inline">
                                        @csrf
                                        @method('PATCH')
                                        <button type="submit" class="btn btn-sm {{ $t->is_approved ? 'btn-outline-secondary' : 'btn-success' }}">
                                            @if($t->is_approved)
                                                Reject
                                            @else
                                                Approve
                                            @endif
                                        </button>
                                    </form>
                                    <form action="{{ route('admin.testimonials.destroy', $t->id) }}" method="POST" onsubmit="return confirm('Are you sure you want to delete this testimonial?');" class="d-inline">
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
                                <i class="bi bi-chat-left-quote fs-1 mb-2"></i>
                                <p class="mb-0">No reviews submitted yet.</p>
                            </td>
                        </tr>
                    @endforelse
                </tbody>
            </table>
        </div>
    </div>
@endsection
