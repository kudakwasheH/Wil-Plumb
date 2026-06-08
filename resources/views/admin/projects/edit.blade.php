@extends('layouts.admin')

@section('content')
    <div class="mb-4 pb-2 border-bottom">
        <a href="{{ route('admin.projects.index') }}" class="text-decoration-none text-muted small"><i class="bi bi-arrow-left"></i> Back to list</a>
        <h1 class="h2 text-dark mt-2 mb-0">Edit Project: {{ $project->title }}</h1>
        <p class="text-muted small mb-0">Modify completed case study text, categories, location, and photos.</p>
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
        <form method="POST" action="{{ route('admin.projects.update', $project->id) }}" enctype="multipart/form-data">
            @csrf
            @method('PUT')

            <div class="row">
                <div class="col-md-6 mb-3">
                    <label for="title" class="form-label small fw-bold">Project Title *</label>
                    <input type="text" name="title" id="title" class="form-control" placeholder="e.g. Copper Pipe Overhaul" value="{{ old('title', $project->title) }}" required>
                </div>
                <div class="col-md-6 mb-3">
                    <label for="location" class="form-label small fw-bold">Location *</label>
                    <input type="text" name="location" id="location" class="form-control" placeholder="e.g. Springfield East" value="{{ old('location', $project->location) }}" required>
                </div>
            </div>

            <div class="row">
                <div class="col-md-6 mb-3">
                    <label for="category" class="form-label small fw-bold">Category *</label>
                    <select name="category" id="category" class="form-select" required>
                        <option value="" disabled>-- Select a Category --</option>
                        <option value="Residential" {{ old('category', $project->category) == 'Residential' ? 'selected' : '' }}>Residential</option>
                        <option value="Commercial" {{ old('category', $project->category) == 'Commercial' ? 'selected' : '' }}>Commercial</option>
                        <option value="Emergency" {{ old('category', $project->category) == 'Emergency' ? 'selected' : '' }}>Emergency</option>
                    </select>
                </div>
                <div class="col-md-6 mb-3">
                    <label for="completion_date" class="form-label small fw-bold">Completion Date *</label>
                    <input type="date" name="completion_date" id="completion_date" class="form-control" value="{{ old('completion_date', $project->completion_date->format('Y-m-d')) }}" required>
                </div>
            </div>

            <div class="row mb-3">
                <div class="col-md-6">
                    <label for="before_image" class="form-label small fw-bold">Replace Before Image (Optional)</label>
                    <input type="file" name="before_image" id="before_image" class="form-control" accept="image/*">
                    <div class="form-text small">Leave blank to keep current photo.</div>
                    
                    @if($project->before_image)
                        <div class="mt-2 text-center border p-2 bg-light rounded">
                            <small class="text-muted d-block mb-1">Current Before Photo</small>
                            <img src="{{ asset('storage/' . $project->before_image) }}" alt="Before" class="img-thumbnail" style="max-height: 120px;">
                        </div>
                    @endif
                </div>
                <div class="col-md-6">
                    <label for="after_image" class="form-label small fw-bold">Replace After Image (Optional)</label>
                    <input type="file" name="after_image" id="after_image" class="form-control" accept="image/*">
                    <div class="form-text small">Leave blank to keep current photo.</div>
                    
                    @if($project->after_image)
                        <div class="mt-2 text-center border p-2 bg-light rounded">
                            <small class="text-muted d-block mb-1">Current After Photo</small>
                            <img src="{{ asset('storage/' . $project->after_image) }}" alt="After" class="img-thumbnail" style="max-height: 120px;">
                        </div>
                    @endif
                </div>
            </div>

            <div class="mb-3">
                <label for="description" class="form-label small fw-bold">Detailed Project Description *</label>
                <textarea name="description" id="description" rows="5" class="form-control" placeholder="Describe the diagnostic process, pipe work, materials replaced, and outcome..." required>{{ old('description', $project->description) }}</textarea>
            </div>

            <div class="mb-4 form-check">
                <input type="checkbox" name="is_featured" id="is_featured" class="form-check-input" value="1" {{ old('is_featured', $project->is_featured) ? 'checked' : '' }}>
                <label class="form-check-label small" for="is_featured">Featured project (displays on homepage case studies)</label>
            </div>

            <button type="submit" class="btn btn-pb-primary py-2.5 px-4"><i class="bi bi-check-circle-fill me-2"></i> Update Case Study</button>
        </form>
    </div>
@endsection
