<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Project Collaboration | {{ config('app.name', 'Wahyu Dedik') }}</title>
    <link rel="icon" href="{{ asset('img/logo.png') }}" type="image/x-icon">
    <!-- Tabler CSS -->
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/@tabler/core@1.0.0-beta17/dist/css/tabler.min.css">
    <!-- Tabler Icons -->
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/@tabler/icons-webfont@2.22.0/tabler-icons.min.css">
    <style>
        .service-card {
            transition: transform 0.3s ease;
            height: 100%;
        }

        .service-card:hover {
            transform: translateY(-5px);
        }

        .process-step {
            position: relative;
        }

        .process-step:not(:last-child)::after {
            content: '';
            position: absolute;
            top: 2.5rem;
            width: 100%;
            border-top: 2px dashed #e6e7e9;
            z-index: 0;
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
                            <li class="nav-item active">
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

        <!-- Page header -->
        <div class="page-header d-print-none mt-3">
            <div class="container-xl">
                <div class="row g-2 align-items-center">
                    <div class="col">
                        <div class="page-pretitle">
                            Let's work together
                        </div>
                        <h2 class="page-title">
                            Project Collaboration
                        </h2>
                    </div>
                    <div class="col-auto ms-auto d-print-none">
                        <div class="btn-list">
                            <a href="#collaboration-form" class="btn btn-primary d-none d-sm-inline-block">
                                <i class="ti ti-message-circle me-2"></i>
                                Start a Project
                            </a>
                            <a href="#collaboration-form" class="btn btn-primary d-sm-none btn-icon">
                                <i class="ti ti-message-circle"></i>
                            </a>
                        </div>
                    </div>
                </div>
            </div>
        </div>

        <!-- Page body -->
        <div class="page-body">
            <div class="container-xl">
                <!-- Services Section -->
                <div class="row mb-5">
                    <div class="col-12 text-center mb-4">
                        <h2 class="mb-2">Services I Offer</h2>
                        <p class="text-muted">Collaborate with me on various types of projects</p>
                    </div>

                    <!-- Service 1 -->
                    <div class="col-md-6 col-lg-4">
                        <div class="card service-card">
                            <div class="card-body text-center">
                                <div class="icon-box bg-primary-lt mx-auto mb-3"
                                    style="width: 64px; height: 64px; border-radius: 50%; display: flex; align-items: center; justify-content: center;">
                                    <i class="ti ti-device-laptop fs-1 text-primary"></i>
                                </div>
                                <h3 class="card-title">Web Development</h3>
                                <p class="text-muted">Custom websites, web applications, e-commerce solutions, and CMS
                                    development.</p>
                                <ul class="list-unstyled mt-3 text-start">
                                    <li class="mb-2"><i class="ti ti-check text-success me-2"></i>Responsive Design
                                    </li>
                                    <li class="mb-2"><i class="ti ti-check text-success me-2"></i>Frontend & Backend
                                    </li>
                                    <li class="mb-2"><i class="ti ti-check text-success me-2"></i>API Integration</li>
                                    <li><i class="ti ti-check text-success me-2"></i>Performance Optimization</li>
                                </ul>
                            </div>
                        </div>
                    </div>

                    <!-- Service 2 -->
                    <div class="col-md-6 col-lg-4">
                        <div class="card service-card">
                            <div class="card-body text-center">
                                <div class="icon-box bg-green-lt mx-auto mb-3"
                                    style="width: 64px; height: 64px; border-radius: 50%; display: flex; align-items: center; justify-content: center;">
                                    <i class="ti ti-device-mobile fs-1 text-green"></i>
                                </div>
                                <h3 class="card-title">Mobile Development</h3>
                                <p class="text-muted">Native and cross-platform mobile applications for iOS and Android.
                                </p>
                                <ul class="list-unstyled mt-3 text-start">
                                    <li class="mb-2"><i class="ti ti-check text-success me-2"></i>User-Friendly
                                        UI/UX
                                    </li>
                                    <li class="mb-2"><i class="ti ti-check text-success me-2"></i>Cross-Platform
                                        Solutions</li>
                                    <li class="mb-2"><i class="ti ti-check text-success me-2"></i>Offline
                                        Capabilities</li>
                                    <li><i class="ti ti-check text-success me-2"></i>App Store Deployment</li>
                                </ul>
                            </div>
                        </div>
                    </div>

                    <!-- Service 3 -->
                    <div class="col-md-6 col-lg-4">
                        <div class="card service-card">
                            <div class="card-body text-center">
                                <div class="icon-box bg-purple-lt mx-auto mb-3"
                                    style="width: 64px; height: 64px; border-radius: 50%; display: flex; align-items: center; justify-content: center;">
                                    <i class="ti ti-template fs-1 text-purple"></i>
                                </div>
                                <h3 class="card-title">UI/UX Design</h3>
                                <p class="text-muted">User interface and experience design for web and mobile
                                    applications.</p>
                                <ul class="list-unstyled mt-3 text-start">
                                    <li class="mb-2"><i class="ti ti-check text-success me-2"></i>Wireframing &
                                        Prototyping</li>
                                    <li class="mb-2"><i class="ti ti-check text-success me-2"></i>User Research</li>
                                    <li class="mb-2"><i class="ti ti-check text-success me-2"></i>Visual Design</li>
                                    <li><i class="ti ti-check text-success me-2"></i>Usability Testing</li>
                                </ul>
                            </div>
                        </div>
                    </div>
                </div>

                <!-- Process Section -->
                <div class="row mb-5">
                    <div class="col-12 text-center mb-4">
                        <h2 class="mb-2">How We Collaborate</h2>
                        <p class="text-muted">A simple and effective process for successful projects</p>
                    </div>

                    <div class="col-12">
                        <div class="row g-4 text-center position-relative">
                            <!-- Step 1 -->
                            <div class="col-md-3 process-step">
                                <div class="card border-0 bg-transparent">
                                    <div class="card-body">
                                        <div class="avatar avatar-xl bg-primary text-white mx-auto mb-3">1</div>
                                        <h3 class="card-title">Initial Discussion</h3>
                                        <p class="text-muted">We discuss your project requirements, goals, and
                                            expectations via WhatsApp.</p>
                                    </div>
                                </div>
                            </div>

                            <!-- Step 2 -->
                            <div class="col-md-3 process-step">
                                <div class="card border-0 bg-transparent">
                                    <div class="card-body">
                                        <div class="avatar avatar-xl bg-green text-white mx-auto mb-3">2</div>
                                        <h3 class="card-title">Proposal & Quote</h3>
                                        <p class="text-muted">I provide a detailed proposal with timeline,
                                            deliverables, and pricing.</p>
                                    </div>
                                </div>
                            </div>

                            <!-- Step 3 -->
                            <div class="col-md-3 process-step">
                                <div class="card border-0 bg-transparent">
                                    <div class="card-body">
                                        <div class="avatar avatar-xl bg-purple text-white mx-auto mb-3">3</div>
                                        <h3 class="card-title">Development</h3>
                                        <p class="text-muted">I work on your project with regular updates and milestone
                                            reviews.</p>
                                    </div>
                                </div>
                            </div>

                            <!-- Step 4 -->
                            <div class="col-md-3 process-step">
                                <div class="card border-0 bg-transparent">
                                    <div class="card-body">
                                        <div class="avatar avatar-xl bg-orange text-white mx-auto mb-3">4</div>
                                        <h3 class="card-title">Delivery & Support</h3>
                                        <p class="text-muted">Final delivery with documentation and ongoing support as
                                            needed.</p>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>

                <!-- Collaboration Form -->
                <div class="row" id="collaboration-form">
                    <div class="col-12 text-center mb-4">
                        <h2 class="mb-2">Start a Project</h2>
                        <p class="text-muted">Fill out the form below to begin our collaboration</p>
                    </div>

                    <div class="col-md-8 mx-auto">
                        <div class="card">
                            <div class="card-body">
                                <form id="whatsappForm" onsubmit="submitToWhatsApp(event)">
                                    <div class="row">
                                        <div class="col-md-6 mb-3">
                                            <label class="form-label required">Full Name</label>
                                            <input type="text" class="form-control" name="name"
                                                placeholder="Your name" required>
                                        </div>
                                        <div class="col-md-6 mb-3">
                                            <label class="form-label required">Email Address</label>
                                            <input type="email" class="form-control" name="email"
                                                placeholder="Your email" required>
                                        </div>
                                    </div>

                                    <div class="row">
                                        <div class="col-md-6 mb-3">
                                            <label class="form-label required">WhatsApp Number</label>
                                            <input type="tel" class="form-control" name="whatsapp"
                                                placeholder="Your WhatsApp number" required>
                                        </div>
                                        <div class="col-md-6 mb-3">
                                            <label class="form-label required">Project Type</label>
                                            <select class="form-select" name="project_type" required>
                                                <option value="">Select project type</option>
                                                <option value="web">Web Development</option>
                                                <option value="mobile">Mobile Development</option>
                                                <option value="ui-ux">UI/UX Design</option>
                                                <option value="other">Other</option>
                                            </select>
                                        </div>
                                    </div>

                                    <div class="mb-3">
                                        <label class="form-label required">Project Description</label>
                                        <textarea class="form-control" name="description" rows="4" placeholder="Describe your project in detail..."
                                            required></textarea>
                                    </div>

                                    <div class="row">
                                        <div class="col-md-6 mb-3">
                                            <label class="form-label">Budget Range</label>
                                            <div class="input-group">
                                                <select class="form-select" name="currency"
                                                    style="max-width: 100px;">
                                                    <option value="USD">USD</option>
                                                    <option value="IDR">IDR</option>
                                                </select>
                                                <input type="number" class="form-control" name="budget"
                                                    placeholder="Enter budget amount" min="0">
                                            </div>
                                        </div>
                                        <div class="col-md-6 mb-3">
                                            <label class="form-label">Timeline</label>
                                            <select class="form-select" name="timeline">
                                                <option value="">Select timeline</option>
                                                <option value="urgent">Urgent (< 1 week)</option>
                                                <option value="short">Short (1-2 weeks)</option>
                                                <option value="medium">Medium (2-4 weeks)</option>
                                                <option value="long">Long (1+ months)</option>
                                            </select>
                                        </div>
                                    </div>

                                    <div class="mb-3">
                                        <label class="form-label">Additional Information</label>
                                        <textarea class="form-control" name="additional_info" rows="3"
                                            placeholder="Any other details you'd like to share..."></textarea>
                                    </div>

                                    <div class="form-footer">
                                        <button type="submit" class="btn btn-success w-100">
                                            <i class="ti ti-brand-whatsapp me-2"></i>
                                            Submit & Connect on WhatsApp
                                        </button>
                                    </div>
                                </form>
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

    <script>
        function submitToWhatsApp(event) {
            event.preventDefault();

            // Get form data
            const form = document.getElementById('whatsappForm');
            const formData = new FormData(form);

            // Prepare message text
            let message = "Hello, I'd like to start a project with you!\n\n";

            // Add all form fields to message
            for (const [key, value] of formData.entries()) {
                if (value) {
                    // Get the field label
                    const labelElement = form.querySelector(`label[for="${key}"]`) ||
                        form.querySelector(
                            `label:has(input[name="${key}"], select[name="${key}"], textarea[name="${key}"])`);

                    let fieldName = key.charAt(0).toUpperCase() + key.slice(1).replace(/_/g, ' ');
                    if (labelElement) {
                        fieldName = labelElement.textContent.replace('*', '').trim();
                    }

                    // Handle select elements to get the selected text instead of value
                    if (form.elements[key].tagName === 'SELECT' && form.elements[key].selectedIndex > 0) {
                        const selectedOption = form.elements[key].options[form.elements[key].selectedIndex];
                        message += `${fieldName}: ${selectedOption.text}\n`;
                    }
                    // Handle textareas with special formatting
                    else if (form.elements[key].tagName === 'TEXTAREA') {
                        message += `${fieldName}:\n${value}\n\n`;
                    }
                    // Handle all other inputs
                    else {
                        message += `${fieldName}: ${value}\n`;
                    }
                }
            }

            // Encode the message for URL
            const encodedMessage = encodeURIComponent(message);

            // Your WhatsApp number
            const whatsappNumber = "6281654932383";

            // Create WhatsApp URL
            const whatsappUrl = `https://wa.me/${whatsappNumber}?text=${encodedMessage}`;

            // Redirect to WhatsApp
            window.open(whatsappUrl, '_blank');
        }
    </script>
</body>

</html>
