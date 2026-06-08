@extends('layouts.admin')

@section('content')
    <div class="mb-4 pb-2 border-bottom">
        <a href="{{ route('admin.services.index') }}" class="text-decoration-none text-muted small"><i class="bi bi-arrow-left"></i> Back to list</a>
        <h1 class="h2 text-dark mt-2 mb-0">Edit Service: {{ $service->name }}</h1>
        <p class="text-muted small mb-0">Modify service parameters, icon display, pricing info, and featured cover.</p>
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
        <form method="POST" action="{{ route('admin.services.update', $service->id) }}" enctype="multipart/form-data">
            @csrf
            @method('PUT')

            <div class="row">
                <div class="col-md-6 mb-3">
                    <label for="name" class="form-label small fw-bold">Service Name *</label>
                    <input type="text" name="name" id="name" class="form-control" placeholder="e.g. Drain Cleaning" value="{{ old('name', $service->name) }}" required>
                </div>
                <div class="col-md-6 mb-3">
                    <label for="price_info" class="form-label small fw-bold">Price Information *</label>
                    <input type="text" name="price_info" id="price_info" class="form-control" placeholder="e.g. From $99 or Hourly rate" value="{{ old('price_info', $service->price_info) }}" required>
                </div>
            </div>

            <div class="row">
                <div class="col-md-6 mb-3">
                    <label for="icon" class="form-label small fw-bold">Bootstrap Icon Name *</label>
                    <div class="input-group">
                        <span class="input-group-text"><i class="bi bi-{{ $service->icon }}"></i></span>
                        <input type="text" name="icon" id="icon" class="form-control" placeholder="e.g. water, droplet-half, wrench" value="{{ old('icon', $service->icon) }}" required>
                    </div>
                    <div class="form-text small">Use any valid class name from <a href="https://icons.getbootstrap.com/" target="_blank">Bootstrap Icons</a>.</div>
                </div>
                <div class="col-md-6 mb-3">
                    <label for="image" class="form-label small fw-bold">Update Cover Image (Optional)</label>
                    <input type="file" name="image" id="image" class="form-control" accept="image/*">
                    <div class="form-text small">Leave empty to keep current image. Recommended: JPG/PNG, 600x400 ratio. Max 2MB.</div>
                </div>
            </div>

            @if($service->image_path)
                <div class="mb-3">
                    <label class="form-label small fw-bold d-block">Current Cover Image</label>
                    <img src="{{ asset('storage/' . $service->image_path) }}" alt="{{ $service->name }}" class="img-thumbnail" style="max-width: 200px; max-height: 150px; object-fit: cover;">
                </div>
            @endif

            <div class="mb-3">
                <label for="description" class="form-label small fw-bold">Detailed Description *</label>
                <textarea name="description" id="description" rows="5" class="form-control" placeholder="Explain the service scope, tools used, and problem solved..." required>{{ old('description', $service->description) }}</textarea>
            </div>

            <div class="mb-4 form-check">
                <input type="checkbox" name="is_active" id="is_active" class="form-check-input" value="1" {{ old('is_active', $service->is_active) ? 'checked' : '' }}>
                <label class="form-check-label small" for="is_active">Service is active and visible on the website</label>
            </div>

            <button type="submit" class="btn btn-pb-primary py-2.5 px-4"><i class="bi bi-check-circle-fill me-2"></i> Update Service</button>
        </form>
    </div>
@endsection
