<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>@yield('title', 'Expert Plumbing Services') - {{ \App\Models\Setting::get('site_name', 'WIL Plumbing') }}</title>
    <meta name="description" content="@yield('meta_description', 'Professional residential and commercial plumbing services. Leak detection, repiping, drain cleaning, and 24/7 emergency response.')">
    
    <!-- Fonts -->
    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    
    @vite(['resources/css/app.css', 'resources/js/app.js'])
    @yield('styles')
</head>
<body>

    <!-- Header / Navbar -->
    <nav class="navbar navbar-expand-lg navbar-glass sticky-top py-3">
        <div class="container">
            <a class="navbar-brand d-flex align-items-center" href="{{ route('home') }}">
                <img src="{{ asset('logo.png') }}" alt="{{ \App\Models\Setting::get('site_name', 'WIL Plumbing') }}" height="55" class="d-inline-block align-top">
            </a>
            <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#navbarNav" aria-controls="navbarNav" aria-expanded="false" aria-label="Toggle navigation">
                <span class="navbar-toggler-icon"></span>
            </button>
            <div class="collapse navbar-collapse" id="navbarNav">
                <ul class="navbar-nav mx-auto mb-2 mb-lg-0">
                    <li class="nav-item">
                        <a class="nav-link px-3 {{ Route::currentRouteName() == 'home' ? 'active text-primary fw-semibold' : 'text-dark' }}" href="{{ route('home') }}">Home</a>
                    </li>
                    <li class="nav-item">
                        <a class="nav-link px-3 {{ Route::currentRouteName() == 'services' ? 'active text-primary fw-semibold' : 'text-dark' }}" href="{{ route('services') }}">Services</a>
                    </li>
                    <li class="nav-item">
                        <a class="nav-link px-3 {{ Route::currentRouteName() == 'projects' ? 'active text-primary fw-semibold' : 'text-dark' }}" href="{{ route('projects') }}">Portfolio</a>
                    </li>
                    <li class="nav-item">
                        <a class="nav-link px-3 {{ Route::currentRouteName() == 'testimonials' ? 'active text-primary fw-semibold' : 'text-dark' }}" href="{{ route('testimonials') }}">Testimonials</a>
                    </li>
                    <li class="nav-item">
                        <a class="nav-link px-3 {{ Route::currentRouteName() == 'contact' ? 'active text-primary fw-semibold' : 'text-dark' }}" href="{{ route('contact') }}">Contact</a>
                    </li>
                </ul>
                <div class="d-flex align-items-center gap-3">
                    <a href="tel:{{ str_replace([' ', '(', ')', '-'], '', \App\Models\Setting::get('site_phone', '+1 (555) 019-9000')) }}" class="text-decoration-none text-dark fw-bold d-none d-xl-block">
                        <i class="bi bi-telephone text-primary me-1"></i> {{ \App\Models\Setting::get('site_phone', '+1 (555) 019-9000') }}
                    </a>
                    <a href="{{ route('booking') }}" class="btn btn-pb-primary">Request Service</a>
                </div>
            </div>
        </div>
    </nav>

    <!-- Main Content -->
    <main>
        @yield('content')
    </main>

    <!-- WhatsApp Floating Bubble -->
    @if(\App\Models\Setting::get('whatsapp_number'))
        <a href="https://wa.me/{{ \App\Models\Setting::get('whatsapp_number') }}?text=Hello%20WIL%20Plumbing%2C%20I%20need%20plumbing%20assistance." class="whatsapp-bubble" target="_blank" aria-label="Chat with us on WhatsApp">
            <i class="bi bi-whatsapp"></i>
        </a>
    @endif

    <!-- Footer -->
    <footer class="bg-gradient-pb text-light pt-5 pb-4 mt-5">
        <div class="container">
            <div class="row">
                <div class="col-md-4 mb-4">
                    <h5 class="text-white mb-3">
                        <img src="{{ asset('logo.png') }}" alt="{{ \App\Models\Setting::get('site_name', 'WIL Plumbing') }}" height="45" class="d-inline-block align-top bg-white p-1 rounded">
                    </h5>
                    <p class="text-muted small">
                        {{ \App\Models\Setting::get('about_content', 'Certified, licensed plumbing services provider with a focus on quick dispatch, quality plumbing repair, and 24/7 service availability.') }}
                    </p>
                    <div class="d-flex gap-3 mt-3">
                        <a href="#" class="text-muted fs-5"><i class="bi bi-facebook"></i></a>
                        <a href="#" class="text-muted fs-5"><i class="bi bi-instagram"></i></a>
                        <a href="#" class="text-muted fs-5"><i class="bi bi-twitter"></i></a>
                    </div>
                </div>
                <div class="col-md-4 mb-4">
                    <h5 class="text-white mb-3">Quick Links</h5>
                    <ul class="list-unstyled">
                        <li class="mb-2"><a href="{{ route('services') }}" class="text-muted text-decoration-none small">Our Services</a></li>
                        <li class="mb-2"><a href="{{ route('projects') }}" class="text-muted text-decoration-none small">Completed Projects</a></li>
                        <li class="mb-2"><a href="{{ route('testimonials') }}" class="text-muted text-decoration-none small">Client Reviews</a></li>
                        <li class="mb-2"><a href="{{ route('booking') }}" class="text-muted text-decoration-none small">Book Online</a></li>
                        <li class="mb-2"><a href="{{ route('login') }}" class="text-muted text-decoration-none small">Admin Portal</a></li>
                    </ul>
                </div>
                <div class="col-md-4 mb-4">
                    <h5 class="text-white mb-3">Contact Info</h5>
                    <ul class="list-unstyled text-muted small">
                        <li class="mb-2"><i class="bi bi-geo-alt text-info me-2"></i> {{ \App\Models\Setting::get('business_address', '123 Plumbing Way, Springfield') }}</li>
                        <li class="mb-2"><i class="bi bi-telephone text-info me-2"></i> {{ \App\Models\Setting::get('site_phone', '+1 (555) 019-9000') }}</li>
                        <li class="mb-2"><i class="bi bi-envelope text-info me-2"></i> {{ \App\Models\Setting::get('site_email', 'info@wilplumbing.com') }}</li>
                        <li class="mb-2"><i class="bi bi-clock text-info me-2"></i> {{ \App\Models\Setting::get('business_hours', 'Mon - Sat: 8 AM - 6 PM') }}</li>
                    </ul>
                </div>
            </div>
            <hr class="border-secondary">
            <div class="row mt-4">
                <div class="col-md-6 text-center text-md-start">
                    <p class="text-muted small mb-0">&copy; {{ date('Y') }} {{ \App\Models\Setting::get('site_name', 'WIL Plumbing') }}. All rights reserved.</p>
                </div>
                <div class="col-md-6 text-center text-md-end">
                    <p class="text-muted small mb-0">Designed by certified plumbing specialists.</p>
                </div>
            </div>
        </div>
    </footer>

    @yield('scripts')
</body>
</html>
