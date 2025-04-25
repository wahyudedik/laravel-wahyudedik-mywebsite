<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Online Resume | {{ config('app.name', 'Wahyu Dedik') }}</title>
    <link rel="icon" href="{{ asset('img/logo.png') }}" type="image/x-icon">
    <!-- Tabler CSS -->
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/@tabler/core@1.0.0-beta17/dist/css/tabler.min.css">
    <!-- Tabler Icons -->
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/@tabler/icons-webfont@2.22.0/tabler-icons.min.css">
    <style>
        .timeline-event {
            position: relative;
            padding-left: 45px;
            padding-bottom: 20px;
        }

        .timeline-event:before {
            content: "";
            position: absolute;
            left: 10px;
            top: 0;
            bottom: 0;
            width: 2px;
            background-color: #e6e7e9;
        }

        .timeline-event:last-child:before {
            bottom: 50%;
        }

        .timeline-event:after {
            content: "";
            position: absolute;
            left: 4px;
            top: 8px;
            width: 14px;
            height: 14px;
            border-radius: 50%;
            background-color: #206bc4;
        }

        .skill-badge {
            font-size: 0.9rem;
            padding: 0.5rem 0.75rem;
            margin-right: 0.5rem;
            margin-bottom: 0.5rem;
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
                    @if (Route::has('login'))
                        <div class="nav-item">
                            @auth
                                <a href="{{ url('/dashboard') }}" class="btn btn-primary">Dashboard</a>
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
                            <li class="nav-item active">
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

        <!-- Page header -->
        <div class="page-header d-print-none mt-3">
            <div class="container-xl">
                <div class="row g-2 align-items-center">
                    <div class="col">
                        <h2 class="page-title">
                            Online Resume
                        </h2>
                        <div class="text-muted mt-1">Professional experience and qualifications</div>
                    </div>
                    <div class="col-auto ms-auto d-print-none">
                        <div class="btn-list">
                            <a href="#" class="btn btn-primary" onclick="window.print();">
                                <i class="ti ti-printer me-2"></i>
                                Print Resume
                            </a>
                            <a href="#" class="btn btn-outline-primary">
                                <i class="ti ti-download me-2"></i>
                                Download PDF
                            </a>
                        </div>
                    </div>
                </div>
            </div>
        </div>

        <!-- Page body -->
        <div class="page-body">
            <div class="container-xl">
                @if ($resume)
                    <div class="row">
                        <!-- Left column - Personal Info -->
                        <div class="col-lg-4">
                            <div class="card mb-4">
                                <div class="card-body">
                                    <div class="text-center mb-4">
                                        @if ($resume->photo_path)
                                            <span class="avatar avatar-xl mb-3"
                                                style="background-image: url({{ Storage::url($resume->photo_path) }})"></span>
                                        @else
                                            <span class="avatar avatar-xl mb-3"
                                                style="background-image: url(https://via.placeholder.com/200x200)"></span>
                                        @endif
                                        <h2 class="mb-1">{{ $resume->full_name }}</h2>
                                        <div class="text-muted">{{ $resume->title }}</div>
                                    </div>

                                    <div class="mb-3">
                                        <div class="d-flex align-items-center mb-2">
                                            <i class="ti ti-mail me-2 text-muted"></i>
                                            <div>
                                                <a href="mailto:{{ $resume->email }}">{{ $resume->email }}</a>
                                            </div>
                                        </div>
                                        <div class="d-flex align-items-center mb-2">
                                            <i class="ti ti-phone me-2 text-muted"></i>
                                            <div>
                                                <a href="tel:{{ $resume->phone }}">{{ $resume->phone }}</a>
                                            </div>
                                        </div>
                                        <div class="d-flex align-items-center mb-2">
                                            <i class="ti ti-map-pin me-2 text-muted"></i>
                                            <div>
                                                {{ $resume->location }}
                                            </div>
                                        </div>
                                        @if ($resume->website)
                                            <div class="d-flex align-items-center">
                                                <i class="ti ti-world me-2 text-muted"></i>
                                                <div>
                                                    <a href="{{ $resume->website }}"
                                                        target="_blank">{{ $resume->website }}</a>
                                                </div>
                                            </div>
                                        @endif
                                    </div>

                                    <hr class="my-3">

                                    <!-- Social Links -->
                                    @if (is_array($resume->social_links) && count(array_filter($resume->social_links)) > 0)
                                        <div class="mb-3">
                                            <h3 class="card-title mb-3">Social Profiles</h3>
                                            @if (isset($resume->social_links['github']) && $resume->social_links['github'])
                                                <div class="d-flex align-items-center mb-2">
                                                    <i class="ti ti-brand-github me-2 text-muted"></i>
                                                    <div>
                                                        <a href="{{ $resume->social_links['github'] }}"
                                                            target="_blank">{{ $resume->social_links['github'] }}</a>
                                                    </div>
                                                </div>
                                            @endif
                                            @if (isset($resume->social_links['linkedin']) && $resume->social_links['linkedin'])
                                                <div class="d-flex align-items-center mb-2">
                                                    <i class="ti ti-brand-linkedin me-2 text-muted"></i>
                                                    <div>
                                                        <a href="{{ $resume->social_links['linkedin'] }}"
                                                            target="_blank">{{ $resume->social_links['linkedin'] }}</a>
                                                    </div>
                                                </div>
                                            @endif
                                            @if (isset($resume->social_links['twitter']) && $resume->social_links['twitter'])
                                                <div class="d-flex align-items-center">
                                                    <i class="ti ti-brand-twitter me-2 text-muted"></i>
                                                    <div>
                                                        <a href="{{ $resume->social_links['twitter'] }}"
                                                            target="_blank">{{ $resume->social_links['twitter'] }}</a>
                                                    </div>
                                                </div>
                                            @endif
                                        </div>
                                        <hr class="my-3">
                                    @endif

                                    <!-- Skills -->
                                    @if (is_array($resume->skills) && count($resume->skills) > 0)
                                        <div>
                                            <h3 class="card-title mb-3">Skills</h3>
                                            <div class="d-flex flex-wrap">
                                                @foreach ($resume->skills as $skill)
                                                    <span
                                                        class="badge bg-blue-lt skill-badge">{{ $skill }}</span>
                                                @endforeach
                                            </div>
                                        </div>
                                        <hr class="my-3">
                                    @endif

                                    <!-- Languages -->
                                    @if (is_array($resume->languages) && count($resume->languages) > 0)
                                        <div>
                                            <h3 class="card-title mb-3">Languages</h3>
                                            @foreach ($resume->languages as $language)
                                                <div class="mb-2">
                                                    <div class="d-flex align-items-center mb-1">
                                                        <div class="me-auto">{{ $language['name'] ?? 'Language' }}
                                                        </div>
                                                        <div>{{ $language['level'] ?? 'Proficient' }}</div>
                                                    </div>
                                                    <div class="progress progress-sm">
                                                        <div class="progress-bar bg-primary"
                                                            style="width: {{ $language['percentage'] ?? 100 }}%"
                                                            role="progressbar"
                                                            aria-valuenow="{{ $language['percentage'] ?? 100 }}"
                                                            aria-valuemin="0" aria-valuemax="100"
                                                            aria-label="{{ $language['percentage'] ?? 100 }}% Complete">
                                                            <span
                                                                class="visually-hidden">{{ $language['percentage'] ?? 100 }}%
                                                                Complete</span>
                                                        </div>
                                                    </div>
                                                </div>
                                            @endforeach
                                        </div>
                                    @endif
                                </div>
                            </div>
                        </div>

                        <!-- Right column - Experience, Education, etc. -->
                        <div class="col-lg-8">
                            <!-- About Me -->
                            <div class="card mb-4">
                                <div class="card-header">
                                    <h3 class="card-title">About Me</h3>
                                </div>
                                <div class="card-body">
                                    <p>{{ $resume->about_me }}</p>
                                </div>
                            </div>

                            <!-- Work Experience -->
                            @if ($resume->workExperiences->count() > 0)
                                <div class="card mb-4">
                                    <div class="card-header">
                                        <h3 class="card-title">Work Experience</h3>
                                    </div>
                                    <div class="card-body">
                                        @foreach ($resume->workExperiences as $experience)
                                            <div class="timeline-event">
                                                <div class="d-flex align-items-center mb-2">
                                                    <div class="me-auto">
                                                        <h4 class="m-0">{{ $experience->position }}</h4>
                                                        <div class="text-muted">{{ $experience->company }}</div>
                                                    </div>
                                                    <div class="text-muted">{{ $experience->start_date }} -
                                                        {{ $experience->current_job ? 'Present' : $experience->end_date }}
                                                    </div>
                                                </div>
                                                <p>{{ $experience->description }}</p>
                                                @if (is_array($experience->responsibilities) && count($experience->responsibilities) > 0)
                                                    <ul>
                                                        @foreach ($experience->responsibilities as $responsibility)
                                                            <li>{{ $responsibility }}</li>
                                                        @endforeach
                                                    </ul>
                                                @endif
                                            </div>
                                        @endforeach
                                    </div>
                                </div>
                            @endif
                            <!-- Education -->
                            @if ($resume->education->count() > 0)
                                <div class="card mb-4">
                                    <div class="card-header">
                                        <h3 class="card-title">Education</h3>
                                    </div>
                                    <div class="card-body">
                                        @foreach ($resume->education as $education)
                                            <div class="timeline-event">
                                                <div class="d-flex align-items-center mb-2">
                                                    <div class="me-auto">
                                                        <h4 class="m-0">{{ $education->degree }}</h4>
                                                        <div class="text-muted">{{ $education->institution }}</div>
                                                    </div>
                                                    <div class="text-muted">{{ $education->start_date }} -
                                                        {{ $education->end_date ?? 'Present' }}</div>
                                                </div>
                                                @if ($education->description)
                                                    <p>{{ $education->description }}</p>
                                                @endif
                                            </div>
                                        @endforeach
                                    </div>
                                </div>
                            @endif

                            <!-- Projects -->
                            @if ($resume->projects->count() > 0)
                                <div class="card">
                                    <div class="card-header">
                                        <h3 class="card-title">Notable Projects</h3>
                                    </div>
                                    <div class="card-body">
                                        @foreach ($resume->projects as $project)
                                            <div class="timeline-event">
                                                <div class="d-flex align-items-center mb-2">
                                                    <div class="me-auto">
                                                        <h4 class="m-0">{{ $project->name }}</h4>
                                                    </div>
                                                    @if ($project->url)
                                                        <div>
                                                            <a href="{{ $project->url }}"
                                                                class="btn btn-sm btn-outline-primary"
                                                                target="_blank">View Project</a>
                                                        </div>
                                                    @endif
                                                </div>
                                                <p>{{ $project->description }}</p>
                                                @if (is_array($project->technologies) && count($project->technologies) > 0)
                                                    <div class="d-flex flex-wrap">
                                                        @foreach ($project->technologies as $tech)
                                                            <span
                                                                class="badge bg-blue-lt skill-badge">{{ $tech }}</span>
                                                        @endforeach
                                                    </div>
                                                @endif
                                            </div>
                                        @endforeach
                                    </div>
                                </div>
                            @endif
                        </div>
                    </div>
                @else
                    <div class="empty">
                        <div class="empty-img">
                            <i class="ti ti-file-cv" style="font-size: 4rem;"></i>
                        </div>
                        <p class="empty-title">No resume available</p>
                        <p class="empty-subtitle text-muted">
                            There is no active resume to display at the moment.
                        </p>
                    </div>
                @endif
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
