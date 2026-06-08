@extends('layouts.admin')

@section('content')
    <div class="mb-4 pb-2 border-bottom">
        <h1 class="h2 text-dark mb-0">Website & Business Settings</h1>
        <p class="text-muted small mb-0">Configure company coordinates, phone numbers, WhatsApp dispatch, and public hero copywriting.</p>
    </div>

    <div class="admin-card p-4 p-md-5">
        <form method="POST" action="{{ route('admin.settings.update') }}">
            @csrf
            @method('PUT')

            <!-- Business Details -->
            <h3 class="h5 mb-3 text-primary border-bottom pb-2"><i class="bi bi-building me-2"></i>Company Coordinates</h3>
            <div class="row">
                <div class="col-md-6 mb-3">
                    <label for="site_name" class="form-label small fw-bold">Company Name *</label>
                    <input type="text" name="site_name" id="site_name" class="form-control" value="{{ old('site_name', $settings['site_name']) }}" required>
                </div>
                <div class="col-md-6 mb-3">
                    <label for="site_email" class="form-label small fw-bold">Primary Business Email *</label>
                    <input type="email" name="site_email" id="site_email" class="form-control" value="{{ old('site_email', $settings['site_email']) }}" required>
                </div>
            </div>

            <div class="row">
                <div class="col-md-6 mb-3">
                    <label for="site_phone" class="form-label small fw-bold">Office Phone Number *</label>
                    <input type="text" name="site_phone" id="site_phone" class="form-control" value="{{ old('site_phone', $settings['site_phone']) }}" required>
                </div>
                <div class="col-md-6 mb-3">
                    <label for="whatsapp_number" class="form-label small fw-bold">WhatsApp Dispatch Number</label>
                    <input type="text" name="whatsapp_number" id="whatsapp_number" class="form-control" value="{{ old('whatsapp_number', $settings['whatsapp_number']) }}" placeholder="e.g. 15550199000 (No spaces, pluses or dashes)">
                    <div class="form-text small">Enter clean digits with country code for floating chat link (e.g. 15551234567). Leave blank to disable WhatsApp button.</div>
                </div>
            </div>

            <div class="mb-3">
                <label for="business_address" class="form-label small fw-bold">Physical Business Address *</label>
                <input type="text" name="business_address" id="business_address" class="form-control" value="{{ old('business_address', $settings['business_address']) }}" required>
            </div>

            <div class="mb-4">
                <label for="business_hours" class="form-label small fw-bold">Operating Hours Statement *</label>
                <input type="text" name="business_hours" id="business_hours" class="form-control" value="{{ old('business_hours', $settings['business_hours']) }}" required>
            </div>

            <!-- Copywriting Meta details -->
            <h3 class="h5 mb-3 mt-5 text-primary border-bottom pb-2"><i class="bi bi-megaphone me-2"></i>Homepage Copywriting</h3>
            
            <div class="mb-3">
                <label for="hero_title" class="form-label small fw-bold">Hero Section Main Title *</label>
                <input type="text" name="hero_title" id="hero_title" class="form-control" value="{{ old('hero_title', $settings['hero_title']) }}" required>
            </div>

            <div class="mb-3">
                <label for="hero_subtitle" class="form-label small fw-bold">Hero Section Subtitle *</label>
                <textarea name="hero_subtitle" id="hero_subtitle" rows="3" class="form-control" required>{{ old('hero_subtitle', $settings['hero_subtitle']) }}</textarea>
            </div>

            <div class="mb-4">
                <label for="about_content" class="form-label small fw-bold">About Us Description *</label>
                <textarea name="about_content" id="about_content" rows="5" class="form-control" required>{{ old('about_content', $settings['about_content']) }}</textarea>
            </div>

            <div class="d-grid mt-4">
                <button type="submit" class="btn btn-pb-primary py-3 fw-bold"><i class="bi bi-save2-fill me-2"></i> Update Settings</button>
            </div>
        </form>
    </div>
@endsection
