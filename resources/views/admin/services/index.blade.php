@extends('layouts.admin')

@section('content')
    <div class="d-flex justify-content-between align-items-center mb-4 pb-2 border-bottom">
        <div>
            <h1 class="h2 text-dark mb-0">Services Management</h1>
            <p class="text-muted small mb-0">Add, edit, or remove services displayed on the public website.</p>
        </div>
        <div>
            <a href="{{ route('admin.services.create') }}" class="btn btn-pb-primary"><i class="bi bi-plus-lg me-1"></i> Add Service</a>
        </div>
    </div>

    <div class="admin-card p-4">
        <div class="table-responsive">
            <table class="table table-hover align-middle">
                <thead class="table-light">
                    <tr>
                        <th style="width: 80px;">Icon</th>
                        <th>Service Name</th>
                        <th>Price Info</th>
                        <th>Status</th>
                        <th style="width: 150px;" class="text-end">Actions</th>
                    </tr>
                </thead>
                <tbody>
                    @forelse($services as $service)
                        <tr>
                            <td>
                                <div class="bg-primary bg-opacity-10 text-primary p-2.5 rounded-3 text-center fs-4">
                                    <i class="bi bi-{{ $service->icon }}"></i>
                                </div>
                            </td>
                            <td>
                                <div class="fw-bold text-dark">{{ $service->name }}</div>
                                <small class="text-muted">{{ Str::limit($service->description, 80) }}</small>
                            </td>
                            <td>
                                <span class="fw-semibold text-primary">{{ $service->price_info }}</span>
                            </td>
                            <td>
                                @if($service->is_active)
                                    <span class="badge bg-success"><i class="bi bi-check-circle me-1"></i> Active</span>
                                @else
                                    <span class="badge bg-secondary"><i class="bi bi-dash-circle me-1"></i> Inactive</span>
                                @endif
                            </td>
                            <td class="text-end">
                                <div class="btn-group">
                                    <a href="{{ route('admin.services.edit', $service->id) }}" class="btn btn-sm btn-light border"><i class="bi bi-pencil"></i></a>
                                    <form action="{{ route('admin.services.destroy', $service->id) }}" method="POST" onsubmit="return confirm('Are you sure you want to delete this service?');" class="d-inline">
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
                                <i class="bi bi-journal-x fs-1 mb-2"></i>
                                <p class="mb-0">No services created yet. Click "Add Service" to get started.</p>
                            </td>
                        </tr>
                    @endforelse
                </tbody>
            </table>
        </div>
    </div>
@endsection
