@extends('layouts.admin')

@section('content')
    <div class="d-flex justify-content-between align-items-center mb-4 pb-2 border-bottom">
        <div>
            <h1 class="h2 text-dark mb-0">Projects Management</h1>
            <p class="text-muted small mb-0">Manage case studies and before-and-after photo galleries shown on the portfolio page.</p>
        </div>
        <div>
            <a href="{{ route('admin.projects.create') }}" class="btn btn-pb-primary"><i class="bi bi-plus-lg me-1"></i> Add Project</a>
        </div>
    </div>

    <div class="admin-card p-4">
        <div class="table-responsive">
            <table class="table table-hover align-middle">
                <thead class="table-light">
                    <tr>
                        <th style="width: 150px;">Before / After Preview</th>
                        <th>Project Title</th>
                        <th>Location & Category</th>
                        <th>Completion Date</th>
                        <th>Featured</th>
                        <th style="width: 150px;" class="text-end">Actions</th>
                    </tr>
                </thead>
                <tbody>
                    @forelse($projects as $project)
                        <tr>
                            <td>
                                <div class="d-flex gap-1" style="height: 60px;">
                                    @if($project->before_image)
                                        <img src="{{ asset('storage/' . $project->before_image) }}" alt="Before" class="rounded object-fit-cover" style="width: 60px; height: 60px;">
                                    @endif
                                    @if($project->after_image)
                                        <img src="{{ asset('storage/' . $project->after_image) }}" alt="After" class="rounded object-fit-cover" style="width: 60px; height: 60px;">
                                    @endif
                                </div>
                            </td>
                            <td>
                                <div class="fw-bold text-dark">{{ $project->title }}</div>
                                <small class="text-muted">{{ Str::limit($project->description, 80) }}</small>
                            </td>
                            <td>
                                <div><span class="badge bg-secondary">{{ $project->category }}</span></div>
                                <small class="text-muted"><i class="bi bi-geo-alt me-1"></i> {{ $project->location }}</small>
                            </td>
                            <td>
                                {{ $project->completion_date->format('M d, Y') }}
                            </td>
                            <td>
                                @if($project->is_featured)
                                    <span class="badge bg-primary"><i class="bi bi-star-fill text-warning me-1"></i> Yes</span>
                                @else
                                    <span class="badge bg-light text-dark border">No</span>
                                @endif
                            </td>
                            <td class="text-end">
                                <div class="btn-group">
                                    <a href="{{ route('admin.projects.edit', $project->id) }}" class="btn btn-sm btn-light border"><i class="bi bi-pencil"></i></a>
                                    <form action="{{ route('admin.projects.destroy', $project->id) }}" method="POST" onsubmit="return confirm('Are you sure you want to delete this project?');" class="d-inline">
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
                                <i class="bi bi-images fs-1 mb-2"></i>
                                <p class="mb-0">No projects created yet. Click "Add Project" to get started.</p>
                            </td>
                        </tr>
                    @endforelse
                </tbody>
            </table>
        </div>
    </div>
@endsection
