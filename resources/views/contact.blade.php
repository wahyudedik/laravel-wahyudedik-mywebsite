<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Contact | {{ config('app.name', 'Wahyu Dedik') }}</title>
    <link rel="icon" href="{{ asset('img/logo.png') }}" type="image/x-icon">
    <!-- Tabler CSS -->
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/@tabler/core@1.0.0-beta17/dist/css/tabler.min.css">
    <!-- Tabler Icons -->
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/@tabler/icons-webfont@2.22.0/tabler-icons.min.css">
    <style>
        .contact-icon {
            width: 48px;
            height: 48px;
            display: flex;
            align-items: center;
            justify-content: center;
            border-radius: 50%;
            margin-right: 1rem;
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
                            <li class="nav-item">
                                <a class="nav-link" href="{{ url('/resume') }}">
                                    <span class="nav-link-icon d-md-none d-lg-inline-block">
                                        <i class="ti ti-file-cv"></i>
                                    </span>
                                    <span class="nav-link-title">Resume</span>
                                </a>
                            </li>
                            <li class="nav-item active">
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
                            Contact Me
                        </h2>
                        <div class="text-muted mt-1">Get in touch for inquiries, feedback, or collaboration</div>
                    </div>
                </div>
            </div>
        </div>

        <!-- Page body -->
        <div class="page-body">
            <div class="container-xl">
                <div class="row">
                    <!-- Contact Information -->
                    <div class="col-lg-4">
                        <div class="card mb-4">
                            <div class="card-header">
                                <h3 class="card-title">Contact Information</h3>
                            </div>
                            <div class="card-body">
                                <div class="d-flex align-items-center mb-4">
                                    <div class="contact-icon bg-primary-lt">
                                        <i class="ti ti-mail fs-2 text-primary"></i>
                                    </div>
                                    <div>
                                        <div class="text-muted mb-1">Email</div>
                                        <a href="mailto:contact@wahyudedik.com"
                                            class="h3">contact@wahyudedik.com</a>
                                    </div>
                                </div>

                                <div class="d-flex align-items-center mb-4">
                                    <div class="contact-icon bg-green-lt">
                                        <i class="ti ti-brand-whatsapp fs-2 text-green"></i>
                                    </div>
                                    <div>
                                        <div class="text-muted mb-1">WhatsApp</div>
                                        <a href="https://wa.me/6281234567890" class="h3">+62 812 3456 7890</a>
                                    </div>
                                </div>

                                <div class="d-flex align-items-center mb-4">
                                    <div class="contact-icon bg-purple-lt">
                                        <i class="ti ti-map-pin fs-2 text-purple"></i>
                                    </div>
                                    <div>
                                        <div class="text-muted mb-1">Location</div>
                                        <div class="h3">Jakarta, Indonesia</div>
                                    </div>
                                </div>

                                <hr class="my-4">

                                <h4 class="mb-3">Social Media</h4>
                                <div class="d-flex gap-3">
                                    <a href="#" class="btn btn-icon btn-outline-primary" target="_blank">
                                        <i class="ti ti-brand-linkedin"></i>
                                    </a>
                                    <a href="#" class="btn btn-icon btn-outline-primary" target="_blank">
                                        <i class="ti ti-brand-github"></i>
                                    </a>
                                    <a href="#" class="btn btn-icon btn-outline-primary" target="_blank">
                                        <i class="ti ti-brand-twitter"></i>
                                    </a>
                                    <a href="#" class="btn btn-icon btn-outline-primary" target="_blank">
                                        <i class="ti ti-brand-instagram"></i>
                                    </a>
                                </div>
                            </div>
                        </div>

                        <div class="card">
                            <div class="card-header">
                                <h3 class="card-title">Business Hours</h3>
                            </div>
                            <div class="card-body">
                                <div class="d-flex justify-content-between mb-3">
                                    <div>Monday - Friday</div>
                                    <div class="text-muted">9:00 AM - 6:00 PM</div>
                                </div>
                                <div class="d-flex justify-content-between mb-3">
                                    <div>Saturday</div>
                                    <div class="text-muted">10:00 AM - 4:00 PM</div>
                                </div>
                                <div class="d-flex justify-content-between">
                                    <div>Sunday</div>
                                    <div class="text-muted">Closed</div>
                                </div>

                                <div class="alert alert-info mt-4" role="alert">
                                    <div class="d-flex">
                                        <div>
                                            <i class="ti ti-info-circle me-2"></i>
                                        </div>
                                        <div>
                                            <h4 class="alert-title">Response Time</h4>
                                            <div class="text-muted">I typically respond to inquiries within 24 hours
                                                during business hours.</div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>

                    <!-- Contact Form -->
                    <div class="col-lg-8">
                        <div class="card">
                            <div class="card-header">
                                <h3 class="card-title">Send a Message</h3>
                            </div>
                            <div class="card-body">
                                <form action="{{ route('contact.submit') }}" method="POST">
                                    @csrf
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

                                    <div class="mb-3">
                                        <label class="form-label required">Subject</label>
                                        <input type="text" class="form-control" name="subject"
                                            placeholder="Message subject" required>
                                    </div>

                                    <div class="mb-3">
                                        <label class="form-label required">Message</label>
                                        <textarea class="form-control" name="message" rows="6" placeholder="Your message..." required></textarea>
                                    </div>

                                    <div class="mb-3">
                                        <label class="form-check">
                                            <input class="form-check-input" type="checkbox" name="newsletter">
                                            <span class="form-check-label">Subscribe to newsletter</span>
                                        </label>
                                    </div>

                                    <div class="form-footer">
                                        <button type="submit" class="btn btn-primary w-100">
                                            <i class="ti ti-send me-2"></i>
                                            Send Message
                                        </button>
                                    </div>
                                </form>
                            </div>
                        </div>

                        <!-- FAQ Section -->
                        <div class="card mt-4">
                            <div class="card-header">
                                <h3 class="card-title">Frequently Asked Questions</h3>
                            </div>
                            <div class="card-body">
                                <div class="accordion" id="faq-accordion">
                                    <div class="accordion-item">
                                        <h2 class="accordion-header" id="faq-heading-1">
                                            <button class="accordion-button" type="button" data-bs-toggle="collapse"
                                                data-bs-target="#faq-collapse-1" aria-expanded="true">
                                                What services do you offer?
                                            </button>
                                        </h2>
                                        <div id="faq-collapse-1" class="accordion-collapse collapse show"
                                            data-bs-parent="#faq-accordion">
                                            <div class="accordion-body pt-0">
                                                <p>I offer a wide range of services including web development, mobile
                                                    app development, UI/UX design, and digital product creation. You can
                                                    find more details on the Collaboration page or contact me directly
                                                    for specific requirements.</p>
                                            </div>
                                        </div>
                                    </div>

                                    <div class="accordion-item">
                                        <h2 class="accordion-header" id="faq-heading-2">
                                            <button class="accordion-button collapsed" type="button"
                                                data-bs-toggle="collapse" data-bs-target="#faq-collapse-2">
                                                How can I purchase your digital products?
                                            </button>
                                        </h2>
                                        <div id="faq-collapse-2" class="accordion-collapse collapse"
                                            data-bs-parent="#faq-accordion">
                                            <div class="accordion-body pt-0">
                                                <p>You can browse and purchase my digital products on the Products page.
                                                    After selecting a product, follow the checkout process. Payment can
                                                    be made through the available payment methods, and you'll receive
                                                    access to your purchase via email.</p>
                                            </div>
                                        </div>
                                    </div>

                                    <div class="accordion-item">
                                        <h2 class="accordion-header" id="faq-heading-3">
                                            <button class="accordion-button collapsed" type="button"
                                                data-bs-toggle="collapse" data-bs-target="#faq-collapse-3">
                                                What is your project collaboration process?
                                            </button>
                                        </h2>
                                        <div id="faq-collapse-3" class="accordion-collapse collapse"
                                            data-bs-parent="#faq-accordion">
                                            <div class="accordion-body pt-0">
                                                <p>My collaboration process typically involves an initial discussion
                                                    about your requirements, followed by a proposal with timeline and
                                                    pricing. Once agreed, I begin development with regular updates and
                                                    milestone reviews. The project concludes with final delivery and
                                                    support as needed.</p>
                                            </div>
                                        </div>
                                    </div>

                                    <div class="accordion-item">
                                        <h2 class="accordion-header" id="faq-heading-4">
                                            <button class="accordion-button collapsed" type="button"
                                                data-bs-toggle="collapse" data-bs-target="#faq-collapse-4">
                                                Do you offer support after project completion?
                                            </button>
                                        </h2>
                                        <div id="faq-collapse-4" class="accordion-collapse collapse"
                                            data-bs-parent="#faq-accordion">
                                            <div class="accordion-body pt-0">
                                                <p>Yes, I provide post-project support to ensure everything runs
                                                    smoothly. The duration and terms of support depend on the project
                                                    scope and are outlined in our agreement. Additional support beyond
                                                    the agreed period can be arranged at an hourly or monthly rate.</p>
                                            </div>
                                        </div>
                                    </div>

                                    <div class="accordion-item">
                                        <h2 class="accordion-header" id="faq-heading-5">
                                            <button class="accordion-button collapsed" type="button"
                                                data-bs-toggle="collapse" data-bs-target="#faq-collapse-5">
                                                How quickly do you respond to inquiries?
                                            </button>
                                        </h2>
                                        <div id="faq-collapse-5" class="accordion-collapse collapse"
                                            data-bs-parent="#faq-accordion">
                                            <div class="accordion-body pt-0">
                                                <p>I typically respond to all inquiries within 24 hours during business
                                                    days. For urgent matters, you can reach me directly via WhatsApp for
                                                    faster response.</p>
                                            </div>
                                        </div>
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
