@extends('layouts.app')

@section('title', 'Contact Us')

@section('content')

    <!-- Header Section -->
    <section class="bg-gradient-pb text-light py-5">
        <div class="container py-4 text-center">
            <h1 class="display-4 text-white mb-3">Contact WIL Plumbing</h1>
            <p class="lead text-light text-opacity-80 mx-auto" style="max-width: 600px;">Get in touch with our office support team or reach out directly to emergency plumbing responders.</p>
        </div>
    </section>

    <!-- Contact Details & Form -->
    <section class="py-5">
        <div class="container py-4">
            
            <div class="row g-5">
                <!-- Contact Info Column -->
                <div class="col-lg-5">
                    <div class="d-flex flex-column gap-4">
                        <div>
                            <span class="text-primary fw-bold text-uppercase small tracking-wider mb-2 d-block">Contact Details</span>
                            <h2 class="h3 mb-4">How to Reach Us</h2>
                            <p class="text-muted">Feel free to contact us via phone, email, or WhatsApp. You can also drop by our office location during business hours.</p>
                        </div>

                        <!-- Info Cards -->
                        <div class="card card-premium p-3 border-0 bg-light shadow-none d-flex flex-row align-items-center">
                            <div class="bg-primary bg-opacity-10 text-primary p-3 rounded-circle fs-4 me-3 d-flex align-items-center justify-content-center" style="width: 55px; height: 55px;">
                                <i class="bi bi-telephone-inbound"></i>
                            </div>
                            <div>
                                <h5 class="mb-0 h6 text-muted small uppercase">Call Center</h5>
                                <a href="tel:{{ str_replace([' ', '(', ')', '-'], '', \App\Models\Setting::get('site_phone', '+1 (555) 019-9000')) }}" class="fs-5 fw-bold text-dark text-decoration-none">
                                    {{ \App\Models\Setting::get('site_phone', '+1 (555) 019-9000') }}
                                </a>
                            </div>
                        </div>

                        <div class="card card-premium p-3 border-0 bg-light shadow-none d-flex flex-row align-items-center">
                            <div class="bg-primary bg-opacity-10 text-primary p-3 rounded-circle fs-4 me-3 d-flex align-items-center justify-content-center" style="width: 55px; height: 55px;">
                                <i class="bi bi-whatsapp"></i>
                            </div>
                            <div>
                                <h5 class="mb-0 h6 text-muted small uppercase">WhatsApp Chat</h5>
                                <a href="https://wa.me/{{ \App\Models\Setting::get('whatsapp_number', '15550199000') }}?text=Hello" target="_blank" class="fs-5 fw-bold text-dark text-decoration-none">
                                    Chat with Support
                                </a>
                            </div>
                        </div>

                        <div class="card card-premium p-3 border-0 bg-light shadow-none d-flex flex-row align-items-center">
                            <div class="bg-primary bg-opacity-10 text-primary p-3 rounded-circle fs-4 me-3 d-flex align-items-center justify-content-center" style="width: 55px; height: 55px;">
                                <i class="bi bi-envelope"></i>
                            </div>
                            <div>
                                <h5 class="mb-0 h6 text-muted small uppercase">Email Address</h5>
                                <a href="mailto:{{ \App\Models\Setting::get('site_email', 'info@wilplumbing.com') }}" class="fs-5 fw-bold text-dark text-decoration-none">
                                    {{ \App\Models\Setting::get('site_email', 'info@wilplumbing.com') }}
                                </a>
                            </div>
                        </div>

                        <div class="card card-premium p-3 border-0 bg-light shadow-none d-flex flex-row align-items-start">
                            <div class="bg-primary bg-opacity-10 text-primary p-3 rounded-circle fs-4 me-3 d-flex align-items-center justify-content-center" style="width: 55px; height: 55px;">
                                <i class="bi bi-geo-alt"></i>
                            </div>
                            <div>
                                <h5 class="mb-0 h6 text-muted small uppercase">Office Address</h5>
                                <p class="mb-0 fw-bold text-dark mt-1">
                                    {{ \App\Models\Setting::get('business_address', '123 Plumbing Way, Springfield') }}
                                </p>
                            </div>
                        </div>

                        <!-- Map Placeholder -->
                        <div class="card card-premium overflow-hidden border-0 shadow-none bg-light p-1" style="height: 200px;">
                            <!-- Google Maps Mockup Frame -->
                            <div class="w-100 h-100 bg-secondary bg-opacity-25 rounded-3 d-flex flex-column align-items-center justify-content-center text-muted">
                                <i class="bi bi-map fs-1 mb-2"></i>
                                <span class="fw-bold">Interactive Location Map</span>
                                <span class="small">{{ \App\Models\Setting::get('business_address', '123 Plumbing Way, Springfield') }}</span>
                            </div>
                        </div>
                    </div>
                </div>

                <!-- Contact Form Column -->
                <div class="col-lg-7">
                    <div class="card card-premium p-4 p-md-5">
                        <span class="text-primary fw-bold text-uppercase small tracking-wider mb-2 d-block">Online Enquiry</span>
                        <h2 class="h3 mb-4">Send us a Message</h2>

                        @if(session('success'))
                            <div class="alert alert-success border-0 shadow-sm py-2.5 px-3 mb-4" role="alert">
                                <i class="bi bi-check-circle-fill me-2"></i> {{ session('success') }}
                            </div>
                        @endif

                        @if($errors->any())
                            <div class="alert alert-danger border-0 small py-2 px-3 mb-4" role="alert">
                                <ul class="mb-0 ps-3">
                                    @foreach($errors->all() as $error)
                                        <li>{{ $error }}</li>
                                    @endforeach
                                </ul>
                            </div>
                        @endif

                        <form method="POST" action="{{ route('contact.store') }}">
                            @csrf
                            <div class="row">
                                <div class="col-md-6 mb-3">
                                    <label for="name" class="form-label small fw-bold">Your Name *</label>
                                    <input type="text" name="name" id="name" class="form-control" placeholder="e.g. John Doe" value="{{ old('name') }}" required>
                                </div>
                                <div class="col-md-6 mb-3">
                                    <label for="email" class="form-label small fw-bold">Email Address *</label>
                                    <input type="email" name="email" id="email" class="form-control" placeholder="john@example.com" value="{{ old('email') }}" required>
                                </div>
                            </div>

                            <div class="row">
                                <div class="col-md-6 mb-3">
                                    <label for="phone" class="form-label small fw-bold">Phone Number</label>
                                    <input type="text" name="phone" id="phone" class="form-control" placeholder="e.g. 555-0199" value="{{ old('phone') }}">
                                </div>
                                <div class="col-md-6 mb-3">
                                    <label for="subject" class="form-label small fw-bold">Subject *</label>
                                    <input type="text" name="subject" id="subject" class="form-control" placeholder="What can we help you with?" value="{{ old('subject') }}" required>
                                </div>
                            </div>

                            <div class="mb-4">
                                <label for="message" class="form-label small fw-bold">Message *</label>
                                <textarea name="message" id="message" rows="5" class="form-control" placeholder="Type your message here..." required>{{ old('message') }}</textarea>
                            </div>

                            <button type="submit" class="btn btn-pb-primary py-2.5 px-4"><i class="bi bi-send-fill me-2"></i> Submit Inquiry</button>
                        </form>
                    </div>
                </div>
            </div>

        </div>
    </section>

@endsection
