@extends('layouts.admin')

@section('content')
    <div class="mb-4 pb-2 border-bottom">
        <a href="{{ route('admin.projects.index') }}" class="text-decoration-none text-muted small"><i class="bi bi-arrow-left"></i> Back to list</a>
        <h1 class="h2 text-dark mt-2 mb-0">Add New Project</h1>
        <p class="text-muted small mb-0">Publish a new plumbing case study with detailed text and before/after slider photos.</p>
    </div>

    @if($errors->any())
        <div class="alert alert-danger border-0 small py-2 px-3 mb-4" role="alert">
            <ul class="mb-0 ps-3">
                @foreach($errors->all() as $error)
                    <li>{{ $error }}</li>
                @endforeach
            </ul>
        </div>
    @endif

    <div class="admin-card p-4">
        <form method="POST" action="{{ route('admin.projects.store') }}" enctype="multipart/form-data">
            @csrf

            <div class="row">
                <div class="col-md-6 mb-3">
                    <label for="title" class="form-label small fw-bold">Project Title *</label>
                    <input type="text" name="title" id="title" class="form-control" placeholder="e.g. Copper Pipe Overhaul" value="{{ old('title') }}" required>
                </div>
                <div class="col-md-6 mb-3">
                    <label for="location" class="form-label small fw-bold">Location *</label>
                    <input type="text" name="location" id="location" class="form-control" placeholder="e.g. Springfield East" value="{{ old('location') }}" required>
                </div>
            </div>

            <div class="row">
                <div class="col-md-6 mb-3">
                    <label for="category" class="form-label small fw-bold">Category *</label>
                    <select name="category" id="category" class="form-select" required>
                        <option value="" disabled selected>-- Select a Category --</option>
                        <option value="Residential" {{ old('category') == 'Residential' ? 'selected' : '' }}>Residential</option>
                        <option value="Commercial" {{ old('category') == 'Commercial' ? 'selected' : '' }}>Commercial</option>
                        <option value="Emergency" {{ old('category') == 'Emergency' ? 'selected' : '' }}>Emergency</option>
                    </select>
                </div>
                <div class="col-md-6 mb-3">
                    <label for="completion_date" class="form-label small fw-bold">Completion Date *</label>
                    <input type="date" name="completion_date" id="completion_date" class="form-control" value="{{ old('completion_date', date('Y-m-d')) }}" required>
                </div>
            </div>

            <div class="row">
                <div class="col-md-6 mb-3">
                    <label for="before_image" class="form-label small fw-bold">Before Image *</label>
                    <input type="file" name="before_image" id="before_image" class="form-control" accept="image/*" required>
                    <div class="form-text small">Recommended: JPG/PNG, 600x400 ratio. Max 2MB.</div>
                </div>
                <div class="col-md-6 mb-3">
                    <label for="after_image" class="form-label small fw-bold">After Image *</label>
                    <input type="file" name="after_image" id="after_image" class="form-control" accept="image/*" required>
                    <div class="form-text small">Recommended: JPG/PNG, 600x400 ratio. Max 2MB.</div>
                </div>
            </div>

            <div class="mb-3">
                <label for="description" class="form-label small fw-bold">Detailed Project Description *</label>
                <textarea name="description" id="description" rows="5" class="form-control" placeholder="Describe the diagnostic process, pipe work, materials replaced, and outcome..." required>{{ old('description') }}</textarea>
            </div>

            <div class="mb-4 form-check">
                <input type="checkbox" name="is_featured" id="is_featured" class="form-check-input" value="1">
                <label class="form-check-label small" for="is_featured">Featured project (displays on homepage case studies)</label>
            </div>

            <button type="submit" class="btn btn-pb-primary py-2.5 px-4"><i class="bi bi-check-circle-fill me-2"></i> Publish Case Study</button>
        </form>
    </div>
@endsection
