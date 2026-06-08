@extends('layouts.app')

@section('title', 'Our Plumbing Services')

@section('content')

    <!-- Header Section -->
    <section class="bg-gradient-pb text-light py-5">
        <div class="container py-4 text-center">
            <h1 class="display-4 text-white mb-3">Our Professional Plumbing Services</h1>
            <p class="lead text-light text-opacity-80 mx-auto" style="max-width: 600px;">We offer comprehensive services for both residential properties and commercial establishments in the Springfield area.</p>
        </div>
    </section>

    <!-- Services Grid -->
    <section class="py-5">
        <div class="container py-4">
            <div class="row g-4">
                @foreach($services as $service)
                    <div class="col-lg-4 col-md-6">
                        <div class="card card-premium h-100">
                            @if($service->image_path)
                                <img src="{{ asset('storage/' . $service->image_path) }}" class="card-img-top" alt="{{ $service->name }}" style="height: 220px; object-fit: cover;">
                            @endif
                            <div class="card-body p-4">
                                <div class="d-flex align-items-center mb-3">
                                    <div class="bg-primary bg-opacity-10 text-primary p-2.5 rounded-3 fs-3 me-3">
                                        <i class="bi bi-{{ $service->icon }}"></i>
                                    </div>
                                    <h3 class="card-title h4 mb-0">{{ $service->name }}</h3>
                                </div>
                                <p class="card-text text-muted">{{ $service->description }}</p>
                            </div>
                            <div class="card-footer bg-transparent border-0 px-4 pb-4 pt-0 d-flex justify-content-between align-items-center">
                                <div>
                                    <small class="text-muted d-block">Estimated Price</small>
                                    <span class="fs-4 fw-bold text-primary">{{ $service->price_info }}</span>
                                </div>
                                <a href="{{ route('booking', ['service' => $service->slug]) }}" class="btn btn-pb-primary">Book Now</a>
                            </div>
                        </div>
                    </div>
                @endforeach
            </div>
        </div>
    </section>

    <!-- Guarantee Alert Callout -->
    <section class="py-5 bg-light">
        <div class="container">
            <div class="card bg-gradient-blue text-white p-4 p-md-5 rounded-4 shadow-sm border-0">
                <div class="row align-items-center">
                    <div class="col-md-2 text-center text-md-start mb-3 mb-md-0">
                        <i class="bi bi-patch-check-fill" style="font-size: 4.5rem; color: #fbbf24;"></i>
                    </div>
                    <div class="col-md-10">
                        <h3 class="text-white h2 mb-2">All Labor & Materials Under Warranty</h3>
                        <p class="lead mb-0 text-white text-opacity-90">We stand by our craft. Every service comes backed by our 100% Satisfaction Guarantee and limited labor warranties. If anything goes wrong, we will make it right at no extra cost to you.</p>
                    </div>
                </div>
            </div>
        </div>
    </section>

@endsection
