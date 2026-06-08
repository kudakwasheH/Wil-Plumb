@extends('layouts.app')

@section('title', 'Professional Plumbing Services')

@section('content')

    <!-- Hero Section -->
    <section class="bg-gradient-pb text-light py-5 position-relative overflow-hidden">
        <div class="position-absolute top-0 end-0 opacity-10 translate-middle-y" style="transform: rotate(-30deg);">
            <i class="bi bi-wrench-adjustable" style="font-size: 35rem;"></i>
        </div>
        <div class="container py-5 position-relative z-1">
            <div class="row align-items-center">
                <div class="col-lg-7 text-center text-lg-start mb-5 mb-lg-0">
                    <span class="badge bg-primary px-3 py-2 mb-3 rounded-pill text-uppercase tracking-wider small"><i class="bi bi-shield-fill text-warning me-1"></i> Certified & Insured Specialists</span>
                    <h1 class="display-3 text-white mb-3">{{ \App\Models\Setting::get('hero_title', 'Expert Plumbing Services When You Need Them Most') }}</h1>
                    <p class="lead text-light text-opacity-80 mb-4 fs-5">{{ \App\Models\Setting::get('hero_subtitle', 'Fast, reliable, and professional residential & commercial plumbing solutions from certified local experts.') }}</p>
                    <div class="d-flex flex-column flex-sm-row gap-3 justify-content-center justify-content-lg-start">
                        <a href="{{ route('booking') }}" class="btn btn-pb-primary btn-lg"><i class="bi bi-calendar2-check me-2"></i>Book Service Online</a>
                        <a href="{{ route('services') }}" class="btn btn-pb-outline btn-lg text-white border-white-50"><i class="bi bi-list-stars me-2"></i>Explore Services</a>
                    </div>
                    <div class="row mt-5 pt-4 border-top border-secondary border-opacity-30">
                        <div class="col-4 col-sm-4 text-center text-lg-start">
                            <h3 class="fw-extrabold text-info text-gradient mb-0 fs-1">15+</h3>
                            <p class="text-muted small mb-0">Years Experience</p>
                        </div>
                        <div class="col-4 col-sm-4 text-center text-lg-start">
                            <h3 class="fw-extrabold text-info text-gradient mb-0 fs-1">100%</h3>
                            <p class="text-muted small mb-0">Satisfaction Rate</p>
                        </div>
                        <div class="col-4 col-sm-4 text-center text-lg-start">
                            <h3 class="fw-extrabold text-info text-gradient mb-0 fs-1">30M</h3>
                            <p class="text-muted small mb-0">Avg Response</p>
                        </div>
                    </div>
                </div>
                <div class="col-lg-5">
                    <div class="card bg-dark bg-opacity-40 border border-secondary border-opacity-35 p-4 rounded-4 shadow-lg">
                        <h4 class="text-white mb-3"><i class="bi bi-lightning-charge-fill text-warning me-2"></i>Emergency Help?</h4>
                        <p class="text-muted small mb-4">Water leak? Clogged pipe? Contact us right away for urgent plumbing solutions.</p>
                        
                        <div class="d-grid gap-3">
                            <a href="tel:{{ str_replace([' ', '(', ')', '-'], '', \App\Models\Setting::get('site_phone', '+1 (555) 019-9000')) }}" class="btn btn-danger py-3 fw-bold rounded-3 shadow-sm">
                                <i class="bi bi-telephone-outbound me-2"></i> Call Now: {{ \App\Models\Setting::get('site_phone', '+1 (555) 019-9000') }}
                            </a>
                            @if(\App\Models\Setting::get('whatsapp_number'))
                                <a href="https://wa.me/{{ \App\Models\Setting::get('whatsapp_number') }}?text=Emergency%20plumbing%20needed!" target="_blank" class="btn btn-success py-3 fw-bold rounded-3 shadow-sm">
                                    <i class="bi bi-whatsapp me-2"></i> Chat on WhatsApp
                                </a>
                            @endif
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </section>

    <!-- About Section -->
    <section class="py-5 bg-white">
        <div class="container py-4">
            <div class="row align-items-center">
                <div class="col-lg-6 mb-4 mb-lg-0">
                    <div class="pe-lg-5">
                        <span class="text-primary fw-bold text-uppercase small tracking-wider mb-2 d-block">Who We Are</span>
                        <h2 class="display-5 mb-4 text-gradient">Your Local Certified Plumbers</h2>
                        <p class="lead mb-4">{{ \App\Models\Setting::get('about_content') }}</p>
                        <ul class="list-unstyled mb-4">
                            <li class="mb-3 d-flex align-items-center"><i class="bi bi-check-circle-fill text-primary me-3 fs-5"></i> <span>Licensed and Bonded Technicians</span></li>
                            <li class="mb-3 d-flex align-items-center"><i class="bi bi-check-circle-fill text-primary me-3 fs-5"></i> <span>Clear Upfront Pricing - No Hidden Charges</span></li>
                            <li class="mb-3 d-flex align-items-center"><i class="bi bi-check-circle-fill text-primary me-3 fs-5"></i> <span>Clean and Respectful Property Care</span></li>
                        </ul>
                        <a href="{{ route('contact') }}" class="btn btn-pb-outline">Learn More About Us</a>
                    </div>
                </div>
                <div class="col-lg-6">
                    <div class="row g-4">
                        <div class="col-6">
                            <div class="card-premium p-4 text-center">
                                <div class="fs-1 text-primary mb-3"><i class="bi bi-shield-check"></i></div>
                                <h5>Guaranteed Work</h5>
                                <p class="text-muted small mb-0">Warranty on all labor and parts installed.</p>
                            </div>
                        </div>
                        <div class="col-6">
                            <div class="card-premium p-4 text-center">
                                <div class="fs-1 text-primary mb-3"><i class="bi bi-clock-history"></i></div>
                                <h5>24/7 Service</h5>
                                <p class="text-muted small mb-0">Emergency support available any time, day or night.</p>
                            </div>
                        </div>
                        <div class="col-6">
                            <div class="card-premium p-4 text-center">
                                <div class="fs-1 text-primary mb-3"><i class="bi bi-cash-stack"></i></div>
                                <h5>Transparent Pricing</h5>
                                <p class="text-muted small mb-0">Clear diagnostic quotes before any work begins.</p>
                            </div>
                        </div>
                        <div class="col-6">
                            <div class="card-premium p-4 text-center">
                                <div class="fs-1 text-primary mb-3"><i class="bi bi-people-fill"></i></div>
                                <h5>Expert Team</h5>
                                <p class="text-muted small mb-0">Certified, heavily vetted local plumbing technicians.</p>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </section>

    <!-- Services Section -->
    <section class="py-5 bg-light">
        <div class="container py-4">
            <div class="text-center mb-5">
                <span class="text-primary fw-bold text-uppercase small tracking-wider mb-2 d-block">What We Do</span>
                <h2 class="display-5 text-gradient">Our Plumbing Services</h2>
                <p class="text-muted mx-auto" style="max-width: 600px;">We cover everything from routine maintenance and inspection to urgent leak repairs and complete repiping.</p>
            </div>
            
            <div class="row g-4">
                @foreach($services as $service)
                    <div class="col-lg-4 col-md-6">
                        <div class="card card-premium h-100">
                            @if($service->image_path)
                                <img src="{{ asset('storage/' . $service->image_path) }}" class="card-img-top" alt="{{ $service->name }}" style="height: 200px; object-fit: cover;">
                            @endif
                            <div class="card-body p-4">
                                <div class="d-flex align-items-center mb-3">
                                    <div class="bg-primary bg-opacity-10 text-primary p-2.5 rounded-3 fs-3 me-3">
                                        <i class="bi bi-{{ $service->icon }}"></i>
                                    </div>
                                    <h4 class="card-title h5 mb-0">{{ $service->name }}</h4>
                                </div>
                                <p class="card-text text-muted small">{{ Str::limit($service->description, 140) }}</p>
                            </div>
                            <div class="card-footer bg-transparent border-0 px-4 pb-4 pt-0 d-flex justify-content-between align-items-center">
                                <span class="fw-bold text-primary">{{ $service->price_info }}</span>
                                <a href="{{ route('booking', ['service' => $service->slug]) }}" class="btn btn-pb-outline btn-sm">Book Now</a>
                            </div>
                        </div>
                    </div>
                @endforeach
            </div>
            
            <div class="text-center mt-5">
                <a href="{{ route('services') }}" class="btn btn-pb-primary btn-lg">View All Services <i class="bi bi-arrow-right ms-2"></i></a>
            </div>
        </div>
    </section>

    <!-- Featured Projects Section -->
    <section class="py-5 bg-white">
        <div class="container py-4">
            <div class="text-center mb-5">
                <span class="text-primary fw-bold text-uppercase small tracking-wider mb-2 d-block">Our Portfolio</span>
                <h2 class="display-5 text-gradient">Featured Projects</h2>
                <p class="text-muted mx-auto" style="max-width: 600px;">Slide the bars below to see our dramatic before-and-after work transitions in detail.</p>
            </div>

            <div class="row g-4">
                @foreach($projects as $project)
                    <div class="col-lg-4 col-md-6">
                        <div class="card card-premium h-100">
                            <!-- Before/After Slider Container -->
                            <div class="ba-slider" style="--clip-pos: 50%;">
                                <img class="ba-after" src="{{ asset('storage/' . $project->after_image) }}" alt="After" />
                                <div class="ba-before">
                                    <img src="{{ asset('storage/' . $project->before_image) }}" alt="Before" />
                                </div>
                                <div class="ba-divider"></div>
                                <input type="range" class="ba-range" min="0" max="100" value="50" oninput="this.parentElement.style.setProperty('--clip-pos', this.value + '%')" />
                            </div>
                            
                            <div class="card-body p-4">
                                <span class="badge bg-secondary mb-2">{{ $project->category }}</span>
                                <h4 class="card-title h5">{{ $project->title }}</h4>
                                <p class="card-text text-muted small">{{ Str::limit($project->description, 130) }}</p>
                                <div class="row g-2 border-top pt-3 mt-3 small text-muted">
                                    <div class="col-6"><i class="bi bi-geo-alt me-1"></i> {{ $project->location }}</div>
                                    <div class="col-6"><i class="bi bi-calendar-check me-1"></i> {{ $project->completion_date->format('M Y') }}</div>
                                </div>
                            </div>
                        </div>
                    </div>
                @endforeach
            </div>

            <div class="text-center mt-5">
                <a href="{{ route('projects') }}" class="btn btn-pb-outline btn-lg">Explore Full Portfolio</a>
            </div>
        </div>
    </section>

    <!-- Testimonials Section -->
    <section class="py-5 bg-light">
        <div class="container py-4">
            <div class="text-center mb-5">
                <span class="text-primary fw-bold text-uppercase small tracking-wider mb-2 d-block">Testimonials</span>
                <h2 class="display-5 text-gradient">What Our Clients Say</h2>
                <p class="text-muted mx-auto" style="max-width: 600px;">We take pride in our service. Read verified reviews from homeowners and business managers.</p>
            </div>

            <div class="row g-4 justify-content-center">
                @foreach($testimonials as $testimonial)
                    <div class="col-lg-4 col-md-6">
                        <div class="card-premium p-4 h-100 d-flex flex-column justify-content-between">
                            <div>
                                <div class="stars-display mb-3">
                                    @for($i = 1; $i <= 5; $i++)
                                        @if($i <= $testimonial->rating)
                                            <i class="bi bi-star-fill"></i>
                                        @else
                                            <i class="bi bi-star"></i>
                                        @endif
                                    @endfor
                                </div>
                                <p class="text-muted small fst-italic mb-4">"{{ $testimonial->review }}"</p>
                            </div>
                            <div class="d-flex align-items-center">
                                <div class="bg-primary bg-opacity-10 text-primary rounded-circle d-flex align-items-center justify-content-center fw-bold fs-5 me-3" style="width: 45px; height: 45px;">
                                    {{ substr($testimonial->customer_name, 0, 1) }}
                                </div>
                                <div>
                                    <h5 class="mb-0 h6">{{ $testimonial->customer_name }}</h5>
                                    <small class="text-muted">{{ $testimonial->customer_role ?: 'Homeowner' }}</small>
                                </div>
                            </div>
                        </div>
                    </div>
                @endforeach
            </div>
            
            <div class="text-center mt-5">
                <a href="{{ route('testimonials') }}" class="btn btn-pb-primary">Read More Reviews & Write Yours</a>
            </div>
        </div>
    </section>

    <!-- Call to Action Section -->
    <section class="py-5 bg-gradient-pb text-light">
        <div class="container py-4">
            <div class="row align-items-center justify-content-between">
                <div class="col-lg-7 text-center text-lg-start mb-4 mb-lg-0">
                    <h2 class="text-white display-6 mb-3">Ready to Solve Your Plumbing Troubles?</h2>
                    <p class="lead text-light text-opacity-80 mb-0">Get in touch with us for a free estimate or standard scheduled inspections.</p>
                </div>
                <div class="col-lg-5 text-center text-lg-end">
                    <div class="d-flex flex-column flex-sm-row gap-3 justify-content-center justify-content-lg-end">
                        <a href="{{ route('booking') }}" class="btn btn-pb-primary btn-lg"><i class="bi bi-calendar2-check me-2"></i>Schedule Appointment</a>
                        <a href="{{ route('contact') }}" class="btn btn-outline-light btn-lg"><i class="bi bi-envelope me-2"></i>Send Message</a>
                    </div>
                </div>
            </div>
        </div>
    </section>

@endsection
