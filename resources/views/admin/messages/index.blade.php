@extends('layouts.admin')

@section('content')
    <div class="d-flex justify-content-between align-items-center mb-4 pb-2 border-bottom">
        <div>
            <h1 class="h2 text-dark mb-0">Contact Messages</h1>
            <p class="text-muted small mb-0">Browse and respond to general online contact form submissions.</p>
        </div>
    </div>

    <div class="admin-card p-4">
        <div class="table-responsive">
            <table class="table table-hover align-middle">
                <thead class="table-light">
                    <tr>
                        <th style="width: 100px;">Status</th>
                        <th>Sender Details</th>
                        <th>Subject</th>
                        <th>Received Date</th>
                        <th style="width: 150px;" class="text-end">Actions</th>
                    </tr>
                </thead>
                <tbody>
                    @forelse($messages as $msg)
                        <tr class="{{ !$msg->is_read ? 'table-warning fw-semibold' : '' }}">
                            <td>
                                @if(!$msg->is_read)
                                    <span class="badge bg-warning text-dark"><i class="bi bi-envelope-fill"></i> Unread</span>
                                @else
                                    <span class="badge bg-light text-muted border"><i class="bi bi-envelope-open"></i> Read</span>
                                @endif
                            </td>
                            <td>
                                <div class="text-dark">{{ $msg->name }}</div>
                                <small class="text-muted">{{ $msg->email }} | {{ $msg->phone ?: 'No phone' }}</small>
                            </td>
                            <td>
                                <div class="text-dark">{{ $msg->subject }}</div>
                                <small class="text-muted text-opacity-80">{{ Str::limit($msg->message, 80) }}</small>
                            </td>
                            <td>
                                {{ $msg->created_at->format('M d, Y H:i') }}
                            </td>
                            <td class="text-end">
                                <div class="btn-group">
                                    <a href="{{ route('admin.messages.show', $msg->id) }}" class="btn btn-sm btn-light border"><i class="bi bi-eye"></i> View</a>
                                    <form action="{{ route('admin.messages.destroy', $msg->id) }}" method="POST" onsubmit="return confirm('Are you sure you want to delete this message?');" class="d-inline">
                                        @csrf
                                        @method('DELETE')
                                        <button type="submit" class="btn btn-sm btn-light text-danger border"><i class="bi bi-trash"></i></button>
                                    </form>
                                </div>
                            </td>
                        </tr>
                    @empty
                        <tr>
                            <td colspan="5" class="text-center py-5 text-muted">
                                <i class="bi bi-envelope-x fs-1 mb-2"></i>
                                <p class="mb-0">No contact messages received yet.</p>
                            </td>
                        </tr>
                    @endforelse
                </tbody>
            </table>
        </div>
    </div>
@endsection
