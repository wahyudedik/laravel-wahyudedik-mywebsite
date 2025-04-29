<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>{{ config('app.name', 'Wahyu Dedik') }}</title>
    <link rel="icon" href="{{ asset('img/logo.png') }}" type="image/x-icon">
    <!-- Tabler CSS -->
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/@tabler/core@1.0.0-beta17/dist/css/tabler.min.css">
    <!-- Tabler Icons -->
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/@tabler/icons-webfont@2.22.0/tabler-icons.min.css">
    <style>
        .hero-section {
            background: linear-gradient(135deg, #4158D0 0%, #C850C0 46%, #FFCC70 100%);
            color: white;
            padding: 6rem 0;
        }

        .feature-card {
            transition: transform 0.3s ease;
            height: 100%;
        }

        .feature-card:hover {
            transform: translateY(-5px);
        }

        .icon-box {
            width: 64px;
            height: 64px;
            border-radius: 50%;
            display: flex;
            align-items: center;
            justify-content: center;
            margin-bottom: 1rem;
        }
    </style>
</head>

<body>
    <div class="page">
        <!-- Header -->
        <header class="navbar navbar-expand-md navbar-light d-print-none">
            <div class="container-xl">
                <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#navbar-menu">
                    <span class="navbar-toggler-icon"></span>
                </button>
                <h1 class="navbar-brand navbar-brand-autodark d-none-navbar-horizontal pe-0 pe-md-3">
                    <a href="{{ url('/') }}">
                        Wahyu Dedik
                    </a>
                </h1>
                <div class="navbar-nav flex-row order-md-last">
                    <div class="nav-item d-none d-md-flex me-3">
                        <div class="btn-list">
                            <a href="https://github.com/wahyudedik" class="btn btn-outline-white" target="_blank"
                                rel="noreferrer">
                                <i class="ti ti-brand-github"></i>
                                GitHub
                            </a>
                        </div>
                    </div>
                    @if (Route::has('login'))
                        <div class="nav-item">
                            @auth
                                <a href="{{ url('/admin/dashboard') }}" class="btn btn-primary">Dashboard</a>
                            @else
                                <a href="{{ route('login') }}" class="btn">Log in</a>
                            @endauth
                        </div>
                    @endif
                </div>
                <div class="collapse navbar-collapse" id="navbar-menu">
                    <div class="d-flex flex-column flex-md-row flex-fill align-items-stretch align-items-md-center">
                        <ul class="navbar-nav">
                            <li class="nav-item">
                                <a class="nav-link" href="{{ url('/products') }}">
                                    <span class="nav-link-icon d-md-none d-lg-inline-block">
                                        <i class="ti ti-shopping-cart"></i>
                                    </span>
                                    <span class="nav-link-title">Products</span>
                                </a>
                            </li>
                            <li class="nav-item">
                                <a class="nav-link" href="{{ url('/collaboration') }}">
                                    <span class="nav-link-icon d-md-none d-lg-inline-block">
                                        <i class="ti ti-users"></i>
                                    </span>
                                    <span class="nav-link-title">Collaboration</span>
                                </a>
                            </li>
                            <li class="nav-item">
                                <a class="nav-link" href="{{ url('/resume') }}">
                                    <span class="nav-link-icon d-md-none d-lg-inline-block">
                                        <i class="ti ti-file-cv"></i>
                                    </span>
                                    <span class="nav-link-title">Resume</span>
                                </a>
                            </li>
                            <li class="nav-item">
                                <a class="nav-link" href="{{ url('/contact') }}">
                                    <span class="nav-link-icon d-md-none d-lg-inline-block">
                                        <i class="ti ti-mail"></i>
                                    </span>
                                    <span class="nav-link-title">Contact</span>
                                </a>
                            </li>
                        </ul>
                    </div>
                </div>
            </div>
        </header>

        <!-- Hero Section -->
        <div class="hero-section">
            <div class="container">
                <div class="row align-items-center">
                    <div class="col-lg-6">
                        <h1 class="display-3 fw-bold mb-3">Digital Solutions for Modern Needs</h1>
                        <p class="fs-2 mb-4">Premium digital products, professional collaboration, and expert services.
                        </p>
                        <div class="d-flex gap-3">
                            <a href="{{ url('/products') }}" class="btn btn-light btn-lg">Explore Products</a>
                            <a href="{{ url('/contact') }}" class="btn btn-outline-light btn-lg">Get in Touch</a>
                        </div>
                    </div>
                    <div class="col-lg-6 d-none d-lg-block">
                        <img src="{{ asset('img/hero.png') }}" alt="Digital Solutions"
                            class="img-fluid rounded-3 shadow">
                    </div>
                </div>
            </div>
        </div>

        <!-- Features Section -->
        <div class="container py-5">
            <div class="text-center mb-5">
                <h2 class="display-6 fw-bold">What I Offer</h2>
                <p class="text-muted">Discover my range of services and digital products</p>
            </div>

            <div class="row g-4">
                <!-- Digital Product Store -->
                <div class="col-md-6 col-lg-3">
                    <div class="card feature-card">
                        <div class="card-body text-center">
                            <div class="icon-box bg-primary-lt mx-auto">
                                <i class="ti ti-shopping-cart fs-1 text-primary"></i>
                            </div>
                            <h3 class="card-title">Digital Products</h3>
                            <p class="text-muted">E-books, templates, applications with flexible licensing options.</p>
                            <a href="{{ url('/products') }}" class="btn btn-outline-primary mt-3">Browse Store</a>
                        </div>
                    </div>
                </div>

                <!-- Project Collaboration -->
                <div class="col-md-6 col-lg-3">
                    <div class="card feature-card">
                        <div class="card-body text-center">
                            <div class="icon-box bg-green-lt mx-auto">
                                <i class="ti ti-users fs-1 text-green"></i>
                            </div>
                            <h3 class="card-title">Collaboration</h3>
                            <p class="text-muted">Partner with me on projects via direct WhatsApp communication.</p>
                            <a href="{{ url('/collaboration') }}" class="btn btn-outline-green mt-3">Start Project</a>
                        </div>
                    </div>
                </div>

                <!-- Online CV/Resume -->
                <div class="col-md-6 col-lg-3">
                    <div class="card feature-card">
                        <div class="card-body text-center">
                            <div class="icon-box bg-purple-lt mx-auto">
                                <i class="ti ti-file-cv fs-1 text-purple"></i>
                            </div>
                            <h3 class="card-title">Resume</h3>
                            <p class="text-muted">View my professional experience, skills, and qualifications.</p>
                            <a href="{{ url('/resume') }}" class="btn btn-outline-purple mt-3">View Resume</a>
                        </div>
                    </div>
                </div>

                <!-- Contact -->
                <div class="col-md-6 col-lg-3">
                    <div class="card feature-card">
                        <div class="card-body text-center">
                            <div class="icon-box bg-orange-lt mx-auto">
                                <i class="ti ti-mail fs-1 text-orange"></i>
                            </div>
                            <h3 class="card-title">Contact</h3>
                            <p class="text-muted">Reach out for inquiries, custom orders, or general questions.</p>
                            <a href="{{ url('/contact') }}" class="btn btn-outline-orange mt-3">Get in Touch</a>
                        </div>
                    </div>
                </div>
            </div>
        </div>

        <!-- Testimonials Section -->
        <div class="bg-light py-5">
            <div class="container">
                <div class="text-center mb-5">
                    <h2 class="display-6 fw-bold">What Clients Say</h2>
                    <p class="text-muted">Feedback from satisfied customers</p>
                </div>

                <div class="row g-4">
                    @php
                        $publishedFeedbacks = \App\Models\Feedback::where('is_published', true)
                            ->where('content', '!=', '')
                            ->latest()
                            ->take(3)
                            ->get();
                    @endphp

                    @forelse($publishedFeedbacks as $feedback)
                        <div class="col-md-4">
                            <div class="card h-100">
                                <div class="card-body">
                                    <div class="d-flex mb-3">
                                        @for ($i = 1; $i <= 5; $i++)
                                            <span class="text-warning me-1">
                                                <i
                                                    class="ti ti-star{{ $i <= $feedback->rating ? '-filled' : '' }}"></i>
                                            </span>
                                        @endfor
                                    </div>
                                    <p class="card-text">"{{ $feedback->content }}"</p>
                                </div>
                                <div class="card-footer bg-transparent border-0">
                                    <div class="d-flex align-items-center">
                                        @php
                                            $initials = \App\Models\Feedback::getInitials($feedback->name);
                                            $colors = ['blue', 'red', 'green', 'purple', 'orange', 'teal'];
                                            $colorIndex = crc32($feedback->name) % count($colors);
                                            $color = $colors[$colorIndex];
                                        @endphp
                                        <span
                                            class="avatar avatar-sm rounded bg-{{ $color }}-lt me-3">{{ $initials }}</span>
                                        <div>
                                            <div class="font-weight-medium">{{ $feedback->name }}</div>
                                            <div class="text-muted">{{ $feedback->position }}</div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                    @empty
                        <!-- Fallback testimonials if no published feedback -->
                        <div class="col-md-4">
                            <div class="card h-100">
                                <div class="card-body">
                                    <div class="d-flex mb-3">
                                        <span class="text-warning me-1"><i class="ti ti-star-filled"></i></span>
                                        <span class="text-warning me-1"><i class="ti ti-star-filled"></i></span>
                                        <span class="text-warning me-1"><i class="ti ti-star-filled"></i></span>
                                        <span class="text-warning me-1"><i class="ti ti-star-filled"></i></span>
                                        <span class="text-warning"><i class="ti ti-star-filled"></i></span>
                                    </div>
                                    <p class="card-text">"The e-book templates were exactly what I needed for my
                                        business.
                                        Professional design and easy to customize."</p>
                                </div>
                                <div class="card-footer bg-transparent border-0">
                                    <div class="d-flex align-items-center">
                                        <span class="avatar avatar-sm rounded bg-blue-lt me-3">JD</span>
                                        <div>
                                            <div class="font-weight-medium">John Doe</div>
                                            <div class="text-muted">Marketing Specialist</div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>

                        <div class="col-md-4">
                            <div class="card h-100">
                                <div class="card-body">
                                    <div class="d-flex mb-3">
                                        <span class="text-warning me-1"><i class="ti ti-star-filled"></i></span>
                                        <span class="text-warning me-1"><i class="ti ti-star-filled"></i></span>
                                        <span class="text-warning me-1"><i class="ti ti-star-filled"></i></span>
                                        <span class="text-warning me-1"><i class="ti ti-star-filled"></i></span>
                                        <span class="text-warning"><i class="ti ti-star-filled"></i></span>
                                    </div>
                                    <p class="card-text">"Working on a collaboration project was seamless. Great
                                        communication and delivered beyond expectations."</p>
                                </div>
                                <div class="card-footer bg-transparent border-0">
                                    <div class="d-flex align-items-center">
                                        <span class="avatar avatar-sm rounded bg-red-lt me-3">JS</span>
                                        <div>
                                            <div class="font-weight-medium">Jane Smith</div>
                                            <div class="text-muted">Startup Founder</div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>

                        <div class="col-md-4">
                            <div class="card h-100">
                                <div class="card-body">
                                    <div class="d-flex mb-3">
                                        <span class="text-warning me-1"><i class="ti ti-star-filled"></i></span>
                                        <span class="text-warning me-1"><i class="ti ti-star-filled"></i></span>
                                        <span class="text-warning me-1"><i class="ti ti-star-filled"></i></span>
                                        <span class="text-warning me-1"><i class="ti ti-star-filled"></i></span>
                                        <span class="text-warning me-1"><i class="ti ti-star-filled"></i></span>
                                    </div>
                                    <p class="card-text">"The application I purchased works flawlessly. Customer
                                        support
                                        was responsive and helpful with my questions."</p>
                                </div>
                                <div class="card-footer bg-transparent border-0">
                                    <div class="d-flex align-items-center">
                                        <span class="avatar avatar-sm rounded bg-green-lt me-3">RJ</span>
                                        <div>
                                            <div class="font-weight-medium">Robert Johnson</div>
                                            <div class="text-muted">Software Developer</div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                    @endforelse
                </div>
            </div>
        </div>

        <!-- Footer -->
        <footer class="footer footer-transparent d-print-none">
            <div class="container-xl">
                <div class="row text-center align-items-center flex-row-reverse">
                    <div class="col-lg-auto ms-lg-auto">
                        <ul class="list-inline list-inline-dots mb-0">
                            <li class="list-inline-item">
                                <a href="{{ url('/products') }}" class="link-secondary">Products</a>
                            </li>
                            <li class="list-inline-item">
                                <a href="{{ url('/collaboration') }}" class="link-secondary">Collaboration</a>
                            </li>
                            <li class="list-inline-item">
                                <a href="{{ url('/resume') }}" class="link-secondary">Resume</a>
                            </li>
                            <li class="list-inline-item">
                                <a href="{{ url('/contact') }}" class="link-secondary">Contact</a>
                            </li>
                        </ul>
                    </div>
                    <div class="col-12 col-lg-auto mt-3 mt-lg-0">
                        <ul class="list-inline list-inline-dots mb-0">
                            <li class="list-inline-item">
                                Copyright &copy; {{ date('Y') }}
                                <a href="." class="link-secondary">Wahyu Dedik</a>.
                                All rights reserved.
                            </li>
                        </ul>
                    </div>
                </div>
            </div>
        </footer>
    </div>

    <!-- Tabler Core -->
    <script src="https://cdn.jsdelivr.net/npm/@tabler/core@1.0.0-beta17/dist/js/tabler.min.js"></script>
</body>

</html>
