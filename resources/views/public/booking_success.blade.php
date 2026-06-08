@extends('layouts.app')

@section('title', 'Booking Request Received')

@section('content')

    <section class="py-5">
        <div class="container py-5">
            <div class="row justify-content-center text-center">
                <div class="col-lg-6">
                    <div class="card card-premium p-5 shadow-lg border-0 bg-white">
                        <div class="text-center mb-4">
                            <div class="d-inline-flex align-items-center justify-content-center bg-success bg-opacity-10 text-success rounded-circle mb-3" style="width: 100px; height: 100px;">
                                <i class="bi bi-calendar2-check-fill" style="font-size: 3.5rem;"></i>
                            </div>
                            <h1 class="display-5 fw-bold text-dark mb-2">Request Received!</h1>
                            <p class="text-success fw-bold text-uppercase tracking-wider small">Booking Reference Created</p>
                        </div>
                        
                        <p class="text-muted mb-4 fs-5">Thank you! Your plumbing service booking request has been successfully saved. A dispatcher from our office will call or email you shortly to confirm the appointment date and details.</p>
                        
                        <div class="border-top border-bottom py-3 mb-4 text-start">
                            <h6 class="text-uppercase small text-muted mb-2">Next Steps:</h6>
                            <ul class="small text-muted mb-0 ps-3">
                                <li class="mb-1">Our team reviews scheduling availability for your selected date.</li>
                                <li class="mb-1">We contact you via phone or email within 2-3 business hours.</li>
                                <li class="mb-1">A certified local plumber is dispatched to your address.</li>
                            </ul>
                        </div>

                        <div class="d-grid gap-2">
                            <a href="{{ route('home') }}" class="btn btn-pb-primary py-3">Return to Homepage</a>
                            <a href="{{ route('contact') }}" class="btn btn-pb-outline py-2.5">Contact Support Office</a>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </section>

@endsection
