<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Admin Dashboard - {{ \App\Models\Setting::get('site_name', 'WIL Plumbing') }}</title>
    <!-- Fonts -->
    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    
    @vite(['resources/css/app.css', 'resources/js/app.js'])
    @yield('styles')
</head>
<body class="bg-light">

<div class="container-fluid">
    <div class="row">
        <!-- Sidebar -->
        <div class="col-md-3 col-lg-2 px-0 admin-sidebar d-flex flex-column justify-content-between position-fixed start-0 top-0 bottom-0 overflow-y-auto">
            <div class="w-100">
                <div class="p-4 border-bottom border-secondary border-opacity-20 mb-3 text-center">
                    <img src="{{ asset('logo.png') }}" alt="WIL Plumbing" height="40" class="d-inline-block align-top bg-white p-1 rounded mb-2">
                    <h3 class="text-white h5 mb-0">WIL <span class="text-info">Plumbing</span></h3>
                    <small class="text-muted text-uppercase tracking-widest style" style="font-size: 0.65rem;">Admin Panel</small>
                </div>
                
                <ul class="nav flex-column mb-auto">
                    <li class="nav-item">
                        <a href="{{ route('admin.dashboard') }}" class="nav-link {{ Route::currentRouteName() == 'admin.dashboard' ? 'active' : '' }}">
                            <i class="bi bi-speedometer2 me-2"></i> Dashboard
                        </a>
                    </li>
                    <li class="nav-item">
                        <a href="{{ route('admin.requests.index') }}" class="nav-link {{ Str::startsWith(Route::currentRouteName(), 'admin.requests') ? 'active' : '' }}">
                            <i class="bi bi-calendar2-week me-2"></i> Bookings
                            @php
                                $pendCount = \App\Models\ServiceRequest::where('status', 'pending')->count();
                            @endphp
                            @if($pendCount > 0)
                                <span class="badge bg-danger rounded-pill float-end small">{{ $pendCount }}</span>
                            @endif
                        </a>
                    </li>
                    <li class="nav-item">
                        <a href="{{ route('admin.services.index') }}" class="nav-link {{ Str::startsWith(Route::currentRouteName(), 'admin.services') ? 'active' : '' }}">
                            <i class="bi bi-list-check me-2"></i> Services
                        </a>
                    </li>
                    <li class="nav-item">
                        <a href="{{ route('admin.projects.index') }}" class="nav-link {{ Str::startsWith(Route::currentRouteName(), 'admin.projects') ? 'active' : '' }}">
                            <i class="bi bi-images me-2"></i> Projects
                        </a>
                    </li>
                    <li class="nav-item">
                        <a href="{{ route('admin.testimonials.index') }}" class="nav-link {{ Str::startsWith(Route::currentRouteName(), 'admin.testimonials') ? 'active' : '' }}">
                            <i class="bi bi-chat-square-text me-2"></i> Testimonials
                            @php
                                $pendingTest = \App\Models\Testimonial::where('is_approved', false)->count();
                            @endphp
                            @if($pendingTest > 0)
                                <span class="badge bg-warning text-dark rounded-pill float-end small">{{ $pendingTest }}</span>
                            @endif
                        </a>
                    </li>
                    <li class="nav-item">
                        <a href="{{ route('admin.messages.index') }}" class="nav-link {{ Str::startsWith(Route::currentRouteName(), 'admin.messages') ? 'active' : '' }}">
                            <i class="bi bi-envelope me-2"></i> Messages
                            @php
                                $unreadMsgs = \App\Models\ContactMessage::where('is_read', false)->count();
                            @endphp
                            @if($unreadMsgs > 0)
                                <span class="badge bg-info text-dark rounded-pill float-end small">{{ $unreadMsgs }}</span>
                            @endif
                        </a>
                    </li>
                    <li class="nav-item">
                        <a href="{{ route('admin.settings.index') }}" class="nav-link {{ Route::currentRouteName() == 'admin.settings.index' ? 'active' : '' }}">
                            <i class="bi bi-gear me-2"></i> Settings
                        </a>
                    </li>
                </ul>
            </div>
            
            <div class="p-3 border-top border-secondary border-opacity-20 text-center">
                <div class="small text-muted mb-2">Logged in as:</div>
                <div class="fw-bold text-white small mb-3">{{ Auth::user()->name }}</div>
                <form action="{{ route('logout') }}" method="POST">
                    @csrf
                    <button type="submit" class="btn btn-danger btn-sm w-100 py-2"><i class="bi bi-box-arrow-right me-1"></i> Sign Out</button>
                </form>
            </div>
        </div>

        <!-- Content Area -->
        <div class="col-md-9 col-lg-10 offset-md-3 offset-lg-2 py-4 px-md-4">
            
            <!-- Top Navbar for mobile -->
            <div class="d-md-none bg-dark p-3 rounded-3 mb-4 d-flex justify-content-between align-items-center">
                <h3 class="text-white h5 mb-0">
                    <img src="{{ asset('logo.png') }}" alt="WIL Plumbing" height="30" class="d-inline-block align-top bg-white p-0.5 rounded me-2">
                    WIL Plumbing
                </h3>
                <div class="dropdown">
                    <button class="btn btn-secondary btn-sm dropdown-toggle" type="button" data-bs-toggle="dropdown">
                        Menu
                    </button>
                    <ul class="dropdown-menu dropdown-menu-end dropdown-menu-dark">
                        <li><a class="dropdown-item" href="{{ route('admin.dashboard') }}">Dashboard</a></li>
                        <li><a class="dropdown-item" href="{{ route('admin.requests.index') }}">Bookings</a></li>
                        <li><a class="dropdown-item" href="{{ route('admin.services.index') }}">Services</a></li>
                        <li><a class="dropdown-item" href="{{ route('admin.projects.index') }}">Projects</a></li>
                        <li><a class="dropdown-item" href="{{ route('admin.testimonials.index') }}">Testimonials</a></li>
                        <li><a class="dropdown-item" href="{{ route('admin.messages.index') }}">Messages</a></li>
                        <li><a class="dropdown-item" href="{{ route('admin.settings.index') }}">Settings</a></li>
                        <li><hr class="dropdown-divider"></li>
                        <li>
                            <form action="{{ route('logout') }}" method="POST" class="px-3">
                                @csrf
                                <button type="submit" class="btn btn-danger btn-sm w-100">Sign Out</button>
                            </form>
                        </li>
                    </ul>
                </div>
            </div>

            <!-- Flash messages -->
            @if(session('success'))
                <div class="alert alert-success border-0 shadow-sm py-2.5 px-3 mb-4" role="alert">
                    <i class="bi bi-check-circle-fill me-2"></i> {{ session('success') }}
                </div>
            @endif
            
            @if(session('error'))
                <div class="alert alert-danger border-0 shadow-sm py-2.5 px-3 mb-4" role="alert">
                    <i class="bi bi-exclamation-triangle-fill me-2"></i> {{ session('error') }}
                </div>
            @endif

            <!-- Main Content -->
            @yield('content')
            
        </div>
    </div>
</div>

@yield('scripts')
</body>
</html>
