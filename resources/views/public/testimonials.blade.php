@extends('layouts.app')

@section('title', 'Customer Testimonials & Reviews')

@section('content')

    <!-- Header Section -->
    <section class="bg-gradient-pb text-light py-5">
        <div class="container py-4 text-center">
            <h1 class="display-4 text-white mb-3">Customer Testimonials</h1>
            <p class="lead text-light text-opacity-80 mx-auto" style="max-width: 600px;">Read verified feedback from our clients and submit your own plumbing experience with our team.</p>
        </div>
    </section>

    <!-- Testimonials List & Submission -->
    <section class="py-5">
        <div class="container py-4">
            
            <div class="row g-5">
                <!-- Reviews Section -->
                <div class="col-lg-7">
                    <!-- Rating summary box -->
                    <div class="card card-premium p-4 mb-4 text-center text-sm-start bg-light">
                        <div class="row align-items-center">
                            <div class="col-sm-4 text-center mb-3 mb-sm-0">
                                <h2 class="display-3 fw-bold text-primary mb-0">{{ $averageRating }}</h2>
                                <div class="stars-display mb-1 fs-5">
                                    @for($i = 1; $i <= 5; $i++)
                                        @if($i <= round($averageRating))
                                            <i class="bi bi-star-fill"></i>
                                        @else
                                            <i class="bi bi-star"></i>
                                        @endif
                                    @endfor
                                </div>
                                <p class="text-muted small mb-0">out of 5 stars</p>
                            </div>
                            <div class="col-sm-8 border-start border-secondary border-opacity-10 ps-sm-4">
                                <h4 class="mb-2">Highly Recommended!</h4>
                                <p class="text-muted small mb-0">Based on {{ $totalReviews }} verified plumbing customer reviews. We strive to provide professional and reliable service to all clients.</p>
                            </div>
                        </div>
                    </div>

                    <!-- Testimonial Feed -->
                    @if($testimonials->isEmpty())
                        <div class="card card-premium p-5 text-center text-muted">
                            <i class="bi bi-chat-left-text fs-1 mb-3"></i>
                            <p>No approved testimonials yet. Be the first to submit a review!</p>
                        </div>
                    @else
                        <div class="d-flex flex-column gap-4">
                            @foreach($testimonials as $t)
                                <div class="card card-premium p-4">
                                    <div class="d-flex justify-content-between align-items-start mb-3">
                                        <div class="d-flex align-items-center">
                                            <div class="bg-primary bg-opacity-10 text-primary rounded-circle d-flex align-items-center justify-content-center fw-bold fs-5 me-3" style="width: 45px; height: 45px;">
                                                {{ substr($t->customer_name, 0, 1) }}
                                            </div>
                                            <div>
                                                <h4 class="h6 mb-0">{{ $t->customer_name }}</h4>
                                                <small class="text-muted">{{ $t->customer_role ?: 'Homeowner' }}</small>
                                            </div>
                                        </div>
                                        <div class="stars-display fs-5">
                                            @for($i = 1; $i <= 5; $i++)
                                                @if($i <= $t->rating)
                                                    <i class="bi bi-star-fill"></i>
                                                @else
                                                    <i class="bi bi-star"></i>
                                                @endif
                                            @endfor
                                        </div>
                                    </div>
                                    <p class="text-muted small mb-0">"{{ $t->review }}"</p>
                                    <div class="text-end text-muted mt-2" style="font-size: 0.75rem;">
                                        Reviewed {{ $t->created_at->diffForHumans() }}
                                    </div>
                                </div>
                            @endforeach

                            <!-- Pagination -->
                            <div class="mt-3">
                                {{ $testimonials->links('pagination::bootstrap-5') }}
                            </div>
                        </div>
                    @endif
                </div>

                <!-- Form Section -->
                <div class="col-lg-5">
                    <div class="card card-premium p-4 sticky-top" style="top: 100px; z-index: 10;">
                        <h3 class="h4 mb-3"><i class="bi bi-pencil-square text-primary me-2"></i>Write a Review</h3>
                        <p class="text-muted small mb-4">Your email address will not be published. Required fields are marked with *</p>

                        @if(session('success'))
                            <div class="alert alert-success border-0 shadow-sm small py-2.5 px-3 mb-4" role="alert">
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

                        <form method="POST" action="{{ route('testimonials.store') }}">
                            @csrf
                            <div class="mb-3">
                                <label for="customer_name" class="form-label small fw-bold">Full Name *</label>
                                <input type="text" name="customer_name" id="customer_name" class="form-control" placeholder="e.g. John Doe" value="{{ old('customer_name') }}" required>
                            </div>

                            <div class="mb-3">
                                <label for="customer_role" class="form-label small fw-bold">Role (Optional)</label>
                                <input type="text" name="customer_role" id="customer_role" class="form-control" placeholder="e.g. Homeowner, Business Owner" value="{{ old('customer_role') }}">
                            </div>

                            <div class="mb-3">
                                <label class="form-label small fw-bold d-block">Overall Rating *</label>
                                <div class="star-rating-input">
                                    <input type="radio" id="star5" name="rating" value="5" {{ old('rating') == 5 ? 'checked' : '' }} required /><label for="star5" title="5 stars"><i class="bi bi-star-fill"></i></label>
                                    <input type="radio" id="star4" name="rating" value="4" {{ old('rating') == 4 ? 'checked' : '' }} /><label for="star4" title="4 stars"><i class="bi bi-star-fill"></i></label>
                                    <input type="radio" id="star3" name="rating" value="3" {{ old('rating') == 3 ? 'checked' : '' }} /><label for="star3" title="3 stars"><i class="bi bi-star-fill"></i></label>
                                    <input type="radio" id="star2" name="rating" value="2" {{ old('rating') == 2 ? 'checked' : '' }} /><label for="star2" title="2 stars"><i class="bi bi-star-fill"></i></label>
                                    <input type="radio" id="star1" name="rating" value="1" {{ old('rating') == 1 ? 'checked' : '' }} /><label for="star1" title="1 star"><i class="bi bi-star-fill"></i></label>
                                </div>
                            </div>

                            <div class="mb-3">
                                <label for="review" class="form-label small fw-bold">Review *</label>
                                <textarea name="review" id="review" rows="4" class="form-control" placeholder="Describe your plumbing service experience here..." required>{{ old('review') }}</textarea>
                                <div class="form-text small">Minimum 10 characters. Max 1000 characters.</div>
                            </div>

                            <button type="submit" class="btn btn-pb-primary w-100 py-2.5 mt-2">Submit Review</button>
                        </form>
                    </div>
                </div>
            </div>

        </div>
    </section>

@endsection
