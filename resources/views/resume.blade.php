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
                <div class="row">
                    <!-- Left column - Personal Info -->
                    <div class="col-lg-4">
                        <div class="card mb-4">
                            <div class="card-body">
                                <div class="text-center mb-4">
                                    <span class="avatar avatar-xl mb-3"
                                        style="background-image: url(https://via.placeholder.com/200x200)"></span>
                                    <h2 class="mb-1">Wahyu Dedik</h2>
                                    <div class="text-muted">Full Stack Developer</div>
                                </div>

                                <div class="mb-3">
                                    <div class="d-flex align-items-center mb-2">
                                        <i class="ti ti-mail me-2 text-muted"></i>
                                        <div>
                                            <a href="mailto:contact@wahyudedik.com">contact@wahyudedik.com</a>
                                        </div>
                                    </div>
                                    <div class="d-flex align-items-center mb-2">
                                        <i class="ti ti-phone me-2 text-muted"></i>
                                        <div>
                                            <a href="tel:+6281234567890">+62 812 3456 7890</a>
                                        </div>
                                    </div>
                                    <div class="d-flex align-items-center mb-2">
                                        <i class="ti ti-map-pin me-2 text-muted"></i>
                                        <div>
                                            Jakarta, Indonesia
                                        </div>
                                    </div>
                                    <div class="d-flex align-items-center">
                                        <i class="ti ti-world me-2 text-muted"></i>
                                        <div>
                                            <a href="https://wahyudedik.com" target="_blank">wahyudedik.com</a>
                                        </div>
                                    </div>
                                </div>

                                <hr class="my-3">

                                <!-- Social Links -->
                                <div class="mb-3">
                                    <h3 class="card-title mb-3">Social Profiles</h3>
                                    <div class="d-flex align-items-center mb-2">
                                        <i class="ti ti-brand-github me-2 text-muted"></i>
                                        <div>
                                            <a href="https://github.com/wahyudedik"
                                                target="_blank">github.com/wahyudedik</a>
                                        </div>
                                    </div>
                                    <div class="d-flex align-items-center mb-2">
                                        <i class="ti ti-brand-linkedin me-2 text-muted"></i>
                                        <div>
                                            <a href="#" target="_blank">linkedin.com/in/wahyudedik</a>
                                        </div>
                                    </div>
                                    <div class="d-flex align-items-center">
                                        <i class="ti ti-brand-twitter me-2 text-muted"></i>
                                        <div>
                                            <a href="#" target="_blank">twitter.com/wahyudedik</a>
                                        </div>
                                    </div>
                                </div>

                                <hr class="my-3">

                                <!-- Skills -->
                                <div>
                                    <h3 class="card-title mb-3">Skills</h3>
                                    <div class="d-flex flex-wrap">
                                        <span class="badge bg-blue-lt skill-badge">PHP</span>
                                        <span class="badge bg-blue-lt skill-badge">Laravel</span>
                                        <span class="badge bg-blue-lt skill-badge">JavaScript</span>
                                        <span class="badge bg-blue-lt skill-badge">Vue.js</span>
                                        <span class="badge bg-blue-lt skill-badge">React</span>
                                        <span class="badge bg-blue-lt skill-badge">MySQL</span>
                                        <span class="badge bg-blue-lt skill-badge">PostgreSQL</span>
                                        <span class="badge bg-blue-lt skill-badge">HTML/CSS</span>
                                        <span class="badge bg-blue-lt skill-badge">Tailwind CSS</span>
                                        <span class="badge bg-blue-lt skill-badge">Bootstrap</span>
                                        <span class="badge bg-blue-lt skill-badge">Git</span>
                                        <span class="badge bg-blue-lt skill-badge">Docker</span>
                                        <span class="badge bg-blue-lt skill-badge">AWS</span>
                                        <span class="badge bg-blue-lt skill-badge">RESTful APIs</span>
                                    </div>
                                </div>

                                <hr class="my-3">

                                <!-- Languages -->
                                <div>
                                    <h3 class="card-title mb-3">Languages</h3>
                                    <div class="mb-2">
                                        <div class="d-flex align-items-center mb-1">
                                            <div class="me-auto">Indonesian</div>
                                            <div>Native</div>
                                        </div>
                                        <div class="progress progress-sm">
                                            <div class="progress-bar bg-primary" style="width: 100%"
                                                role="progressbar" aria-valuenow="100" aria-valuemin="0"
                                                aria-valuemax="100" aria-label="100% Complete">
                                                <span class="visually-hidden">100% Complete</span>
                                            </div>
                                        </div>
                                    </div>
                                    <div>
                                        <div class="d-flex align-items-center mb-1">
                                            <div class="me-auto">English</div>
                                            <div>Fluent</div>
                                        </div>
                                        <div class="progress progress-sm">
                                            <div class="progress-bar bg-primary" style="width: 85%"
                                                role="progressbar" aria-valuenow="85" aria-valuemin="0"
                                                aria-valuemax="100" aria-label="85% Complete">
                                                <span class="visually-hidden">85% Complete</span>
                                            </div>
                                        </div>
                                    </div>
                                </div>
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
                                <p>Experienced Full Stack Developer with a passion for creating efficient, scalable, and
                                    user-friendly web applications. Specialized in Laravel, JavaScript frameworks, and
                                    modern frontend technologies. Committed to delivering high-quality code and
                                    exceptional user experiences.</p>
                                <p>With over 7 years of experience in the industry, I've worked on a wide range of
                                    projects from e-commerce platforms to complex enterprise applications. I enjoy
                                    solving challenging problems and continuously learning new technologies to stay at
                                    the forefront of web development.</p>
                            </div>
                        </div>

                        <!-- Work Experience -->
                        <div class="card mb-4">
                            <div class="card-header">
                                <h3 class="card-title">Work Experience</h3>
                            </div>
                            <div class="card-body">
                                <div class="timeline-event">
                                    <div class="d-flex align-items-center mb-2">
                                        <div class="me-auto">
                                            <h4 class="m-0">Senior Full Stack Developer</h4>
                                            <div class="text-muted">TechInnovate Solutions</div>
                                        </div>
                                        <div class="text-muted">2020 - Present</div>
                                    </div>
                                    <p>Lead developer for multiple enterprise-level web applications using Laravel,
                                        Vue.js, and MySQL. Responsible for architecture design, code review, and
                                        mentoring junior developers.</p>
                                    <ul>
                                        <li>Developed a scalable e-commerce platform that increased client sales by 35%
                                        </li>
                                        <li>Implemented CI/CD pipelines that reduced deployment time by 70%</li>
                                        <li>Optimized database queries resulting in 40% faster page load times</li>
                                        <li>Led a team of 5 developers to successfully deliver projects on time and
                                            within budget</li>
                                    </ul>
                                </div>

                                <div class="timeline-event">
                                    <div class="d-flex align-items-center mb-2">
                                        <div class="me-auto">
                                            <h4 class="m-0">Web Developer</h4>
                                            <div class="text-muted">Digital Creations Agency</div>
                                        </div>
                                        <div class="text-muted">2017 - 2020</div>
                                    </div>
                                    <p>Developed responsive websites and web applications for various clients using PHP,
                                        Laravel, JavaScript, and MySQL.</p>
                                    <ul>
                                        <li>Built custom CMS solutions for content management</li>
                                        <li>Integrated third-party APIs for payment processing and social media</li>
                                        <li>Implemented responsive designs ensuring cross-browser compatibility</li>
                                        <li>Collaborated with designers to create intuitive user interfaces</li>
                                    </ul>
                                </div>

                                <div class="timeline-event">
                                    <div class="d-flex align-items-center mb-2">
                                        <div class="me-auto">
                                            <h4 class="m-0">Junior Developer</h4>
                                            <div class="text-muted">WebSolutions Inc.</div>
                                        </div>
                                        <div class="text-muted">2015 - 2017</div>
                                    </div>
                                    <p>Started as a junior developer working on frontend development and gradually moved
                                        to full stack development.</p>
                                    <ul>
                                        <li>Developed and maintained client websites</li>
                                        <li>Created responsive layouts using HTML, CSS, and JavaScript</li>
                                        <li>Assisted senior developers with backend functionality</li>
                                        <li>Participated in code reviews and team meetings</li>
                                    </ul>
                                </div>
                            </div>
                        </div>

                        <!-- Education -->
                        <div class="card mb-4">
                            <div class="card-header">
                                <h3 class="card-title">Education</h3>
                            </div>
                            <div class="card-body">
                                <div class="timeline-event">
                                    <div class="d-flex align-items-center mb-2">
                                        <div class="me-auto">
                                            <h4 class="m-0">Bachelor of Computer Science</h4>
                                            <div class="text-muted">University of Indonesia</div>
                                        </div>
                                        <div class="text-muted">2011 - 2015</div>
                                    </div>
                                    <p>Graduated with honors. Specialized in Software Engineering with a focus on web
                                        technologies and database systems.</p>
                                </div>

                                <div class="timeline-event">
                                    <div class="d-flex align-items-center mb-2">
                                        <div class="me-auto">
                                            <h4 class="m-0">Web Development Certification</h4>
                                            <div class="text-muted">Tech Academy</div>
                                        </div>
                                        <div class="text-muted">2014</div>
                                    </div>
                                    <p>Intensive 6-month program covering modern web development technologies and best
                                        practices.</p>
                                </div>
                            </div>
                        </div>

                        <!-- Projects -->
                        <div class="card">
                            <div class="card-header">
                                <h3 class="card-title">Notable Projects</h3>
                            </div>
                            <div class="card-body">
                                <div class="timeline-event">
                                    <div class="d-flex align-items-center mb-2">
                                        <div class="me-auto">
                                            <h4 class="m-0">E-commerce Platform</h4>
                                        </div>
                                        <div>
                                            <a href="#" class="btn btn-sm btn-outline-primary">View Project</a>
                                        </div>
                                    </div>
                                    <p>A full-featured e-commerce platform with inventory management, payment
                                        processing, and customer management.</p>
                                    <div class="d-flex flex-wrap">
                                        <span class="badge bg-blue-lt skill-badge">Laravel</span>
                                        <span class="badge bg-blue-lt skill-badge">Vue.js</span>
                                        <span class="badge bg-blue-lt skill-badge">MySQL</span>
                                        <span class="badge bg-blue-lt skill-badge">Stripe API</span>
                                    </div>
                                </div>

                                <div class="timeline-event">
                                    <div class="d-flex align-items-center mb-2">
                                        <div class="me-auto">
                                            <h4 class="m-0">Project Management Tool</h4>
                                        </div>
                                        <div>
                                            <a href="#" class="btn btn-sm btn-outline-primary">View Project</a>
                                        </div>
                                    </div>
                                    <p>A collaborative project management application with real-time updates, task
                                        tracking, and reporting features.</p>
                                    <div class="d-flex flex-wrap">
                                        <span class="badge bg-blue-lt skill-badge">Laravel</span>
                                        <span class="badge bg-blue-lt skill-badge">React</span>
                                        <span class="badge bg-blue-lt skill-badge">PostgreSQL</span>
                                        <span class="badge bg-blue-lt skill-badge">WebSockets</span>
                                    </div>
                                </div>

                                <div class="timeline-event">
                                    <div class="d-flex align-items-center mb-2">
                                        <div class="me-auto">
                                            <h4 class="m-0">Content Management System</h4>
                                        </div>
                                        <div>
                                            <a href="#" class="btn btn-sm btn-outline-primary">View Project</a>
                                        </div>
                                    </div>
                                    <p>A custom CMS built for a media company to manage articles, multimedia content,
                                        and user subscriptions.</p>
                                    <div class="d-flex flex-wrap">
                                        <span class="badge bg-blue-lt skill-badge">Laravel</span>
                                        <span class="badge bg-blue-lt skill-badge">Alpine.js</span>
                                        <span class="badge bg-blue-lt skill-badge">MySQL</span>
                                        <span class="badge bg-blue-lt skill-badge">AWS S3</span>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
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
