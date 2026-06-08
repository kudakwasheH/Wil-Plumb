@extends('layouts.admin')

@section('content')
    <div class="mb-4 pb-2 border-bottom">
        <a href="{{ route('admin.messages.index') }}" class="text-decoration-none text-muted small"><i class="bi bi-arrow-left"></i> Back to messages</a>
        <h1 class="h2 text-dark mt-2 mb-0">Read Message</h1>
        <p class="text-muted small mb-0">View complete details of contact form submission.</p>
    </div>

    <div class="row justify-content-center">
        <div class="col-lg-8">
            <div class="admin-card p-4 p-md-5">
                <div class="d-flex justify-content-between align-items-start border-bottom pb-3 mb-4">
                    <div>
                        <h2 class="h4 mb-1 text-dark">{{ $message->subject }}</h2>
                        <small class="text-muted">Received on {{ $message->created_at->format('l, F d, Y \a\t H:i') }}</small>
                    </div>
                    <div>
                        <span class="badge bg-light text-dark border p-2"><i class="bi bi-envelope-open-fill text-muted me-1"></i> Read</span>
                    </div>
                </div>

                <div class="row mb-4 p-3 bg-light rounded border g-3">
                    <div class="col-sm-6">
                        <small class="text-muted d-block text-uppercase" style="font-size: 0.75rem;">From Name</small>
                        <span class="fw-bold text-dark">{{ $message->name }}</span>
                    </div>
                    <div class="col-sm-6">
                        <small class="text-muted d-block text-uppercase" style="font-size: 0.75rem;">Email Address</small>
                        <a href="mailto:{{ $message->email }}" class="fw-semibold text-primary text-decoration-none">{{ $message->email }}</a>
                    </div>
                    <div class="col-sm-6">
                        <small class="text-muted d-block text-uppercase" style="font-size: 0.75rem;">Phone Number</small>
                        @if($message->phone)
                            <a href="tel:{{ $message->phone }}" class="fw-semibold text-primary text-decoration-none">{{ $message->phone }}</a>
                        @else
                            <span class="text-muted">Not Provided</span>
                        @endif
                    </div>
                </div>

                <div class="mb-4">
                    <small class="text-muted d-block text-uppercase mb-2" style="font-size: 0.75rem;">Message Content</small>
                    <div class="p-3 bg-white border rounded text-dark fs-5" style="white-space: pre-line; min-height: 150px; line-height: 1.6;">
                        {{ $message->message }}
                    </div>
                </div>

                <div class="d-flex justify-content-between align-items-center mt-5 border-top pt-4">
                    <a href="mailto:{{ $message->email }}?subject=RE:%20{{ rawurlencode($message->subject) }}" class="btn btn-pb-primary"><i class="bi bi-reply-fill me-1"></i> Reply via Email</a>
                    
                    <form action="{{ route('admin.messages.destroy', $message->id) }}" method="POST" onsubmit="return confirm('Are you sure you want to permanently delete this message?');">
                        @csrf
                        @method('DELETE')
                        <button type="submit" class="btn btn-outline-danger"><i class="bi bi-trash-fill me-1"></i> Delete Message</button>
                    </form>
                </div>
            </div>
        </div>
    </div>
@endsection
