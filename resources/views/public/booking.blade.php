@extends('layouts.app')

@section('title', 'Request Service Booking')

@section('content')

    <!-- Header Section -->
    <section class="bg-gradient-pb text-light py-5">
        <div class="container py-4 text-center">
            <h1 class="display-4 text-white mb-3">Request a Plumbing Service</h1>
            <p class="lead text-light text-opacity-80 mx-auto" style="max-width: 600px;">Fill out the form below to book an appointment. Our dispatcher will review your request and contact you to confirm.</p>
        </div>
    </section>

    <!-- Booking Form Section -->
    <section class="py-5">
        <div class="container py-4">
            <div class="row justify-content-center">
                <div class="col-lg-8">
                    <div class="card card-premium p-4 p-md-5">
                        <h2 class="h3 mb-4"><i class="bi bi-calendar-event text-primary me-2"></i>Service Booking Details</h2>
                        <p class="text-muted small mb-4">Please provide detailed contact and scheduling details to help us assign the right technician for your problem.</p>

                        @if($errors->any())
                            <div class="alert alert-danger border-0 small py-2 px-3 mb-4" role="alert">
                                <ul class="mb-0 ps-3">
                                    @foreach($errors->all() as $error)
                                        <li>{{ $error }}</li>
                                    @endforeach
                                </ul>
                            </div>
                        @endif

                        <form method="POST" action="{{ route('booking.store') }}">
                            @csrf
                            
                            <h5 class="border-bottom pb-2 mb-3 text-secondary small text-uppercase">1. Contact Information</h5>
                            <div class="row">
                                <div class="col-md-6 mb-3">
                                    <label for="customer_name" class="form-label small fw-bold">Full Name *</label>
                                    <input type="text" name="customer_name" id="customer_name" class="form-control" placeholder="e.g. John Doe" value="{{ old('customer_name') }}" required>
                                </div>
                                <div class="col-md-6 mb-3">
                                    <label for="customer_phone" class="form-label small fw-bold">Phone Number *</label>
                                    <input type="text" name="customer_phone" id="customer_phone" class="form-control" placeholder="e.g. +1 (555) 019-9000" value="{{ old('customer_phone') }}" required>
                                </div>
                            </div>
                            <div class="mb-3">
                                <label for="customer_email" class="form-label small fw-bold">Email Address *</label>
                                <input type="email" name="customer_email" id="customer_email" class="form-control" placeholder="john@example.com" value="{{ old('customer_email') }}" required>
                            </div>

                            <h5 class="border-bottom pb-2 mb-3 mt-4 text-secondary small text-uppercase">2. Location & Scheduling</h5>
                            <div class="mb-3">
                                <label for="address" class="form-label small fw-bold">Service Address *</label>
                                <input type="text" name="address" id="address" class="form-control" placeholder="e.g. 123 Main St, Apartment 4B, Springfield" value="{{ old('address') }}" required>
                            </div>
                            
                            <div class="row">
                                <div class="col-md-6 mb-3">
                                    <label for="service_id" class="form-label small fw-bold">Required Service *</label>
                                    <select name="service_id" id="service_id" class="form-select" required>
                                        <option value="" disabled>-- Select a Service --</option>
                                        @foreach($services as $service)
                                            <option value="{{ $service->id }}" {{ (old('service_id') == $service->id || $selectedServiceId == $service->id) ? 'selected' : '' }}>
                                                {{ $service->name }} ({{ $service->price_info }})
                                            </option>
                                        @endforeach
                                    </select>
                                </div>
                                <div class="col-md-6 mb-3">
                                    <label for="preferred_date" class="form-label small fw-bold">Preferred Service Date *</label>
                                    <input type="date" name="preferred_date" id="preferred_date" class="form-control" min="{{ date('Y-m-d') }}" value="{{ old('preferred_date') }}" required>
                                </div>
                            </div>

                            <h5 class="border-bottom pb-2 mb-3 mt-4 text-secondary small text-uppercase">3. Describe the Problem</h5>
                            <div class="mb-4">
                                <label for="problem_description" class="form-label small fw-bold">Description of plumbing issue *</label>
                                <textarea name="problem_description" id="problem_description" rows="5" class="form-control" placeholder="Please describe what is leaking, clogged, or broken. The more details you provide, the better we can prepare our tools." required>{{ old('problem_description') }}</textarea>
                                <div class="form-text small">Minimum 10 characters.</div>
                            </div>

                            <button type="submit" class="btn btn-pb-primary btn-lg w-100 py-3 mt-2"><i class="bi bi-check-circle-fill me-2"></i> Submit Booking Request</button>
                        </form>
                    </div>
                </div>
            </div>
        </div>
    </section>

@endsection
