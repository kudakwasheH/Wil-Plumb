@extends('layouts.app')

@section('title', 'Our Portfolio & Case Studies')

@section('content')

    <!-- Header Section -->
    <section class="bg-gradient-pb text-light py-5">
        <div class="container py-4 text-center">
            <h1 class="display-4 text-white mb-3">Completed Projects Gallery</h1>
            <p class="lead text-light text-opacity-80 mx-auto" style="max-width: 600px;">Review our premium plumbing work. Move the sliders in the images below to compare before and after conditions side by side.</p>
        </div>
    </section>

    <!-- Filters & Gallery Section -->
    <section class="py-5">
        <div class="container py-4">
            
            <!-- Category Filtering -->
            <div class="d-flex flex-wrap justify-content-center gap-2 mb-5">
                @foreach($categories as $cat)
                    <a href="{{ route('projects', $cat == 'All' ? [] : ['category' => $cat]) }}" 
                       class="btn px-4 py-2 rounded-pill fw-semibold {{ $activeCategory == $cat ? 'btn-primary' : 'btn-outline-secondary' }}">
                        {{ $cat }}
                    </a>
                @endforeach
            </div>

            <!-- Projects Grid -->
            @if($projects->isEmpty())
                <div class="text-center py-5">
                    <i class="bi bi-folder-x fs-1 text-muted mb-3"></i>
                    <h4>No Projects Found</h4>
                    <p class="text-muted">We haven't uploaded any projects in this category yet. Check back soon!</p>
                </div>
            @else
                <div class="row g-4">
                    @foreach($projects as $project)
                        <div class="col-lg-4 col-md-6">
                            <div class="card card-premium h-100">
                                <!-- Interactive Before-After Slider -->
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
                                    <h3 class="card-title h5">{{ $project->title }}</h3>
                                    <p class="card-text text-muted small mb-3">{{ $project->description }}</p>
                                    
                                    <div class="row g-2 border-top pt-3 mt-3 small text-muted">
                                        <div class="col-6"><i class="bi bi-geo-alt me-1 text-primary"></i> {{ $project->location }}</div>
                                        <div class="col-6 text-end"><i class="bi bi-calendar-check me-1 text-primary"></i> {{ $project->completion_date->format('F d, Y') }}</div>
                                    </div>
                                </div>
                            </div>
                        </div>
                    @endforeach
                </div>
            @endif

        </div>
    </section>

@endsection
