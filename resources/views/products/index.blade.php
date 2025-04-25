<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Digital Products | {{ config('app.name', 'Wahyu Dedik') }}</title>
    <link rel="icon" href="{{ asset('img/logo.png') }}" type="image/x-icon">
    <!-- Tabler CSS -->
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/@tabler/core@1.0.0-beta17/dist/css/tabler.min.css">
    <!-- Tabler Icons -->
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/@tabler/icons-webfont@2.22.0/tabler-icons.min.css">
    <style>
        .product-card {
            transition: transform 0.3s ease;
        }

        .product-card:hover {
            transform: translateY(-5px);
        }

        .category-badge {
            position: absolute;
            top: 10px;
            right: 10px;
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
                            <li class="nav-item active">
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

        <!-- Page header -->
        <div class="page-header d-print-none mt-3">
            <div class="container-xl">
                <div class="row g-2 align-items-center">
                    <div class="col">
                        <h2 class="page-title">
                            Digital Products Store
                        </h2>
                        <div class="text-muted mt-1">Premium digital products for your needs</div>
                    </div>
                    <div class="col-auto ms-auto d-print-none">
                        <div class="d-flex">
                            <div class="me-3">
                                <div class="input-icon">
                                    <input type="text" class="form-control" placeholder="Search products...">
                                    <span class="input-icon-addon">
                                        <i class="ti ti-search"></i>
                                    </span>
                                </div>
                            </div>
                            <div>
                                <a href="#" class="btn btn-primary" data-bs-toggle="modal"
                                    data-bs-target="#modal-custom-order">
                                    <i class="ti ti-message-circle me-2"></i>
                                    Custom Order
                                </a>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>

        <!-- Page body -->
        <div class="page-body">
            <div class="container-xl">
                <!-- Categories -->
                <div class="mb-4">
                    <div class="d-flex flex-wrap gap-2">
                        <a href="#" class="btn btn-outline-primary active">All</a>
                        <a href="#" class="btn btn-outline-primary">E-books</a>
                        <a href="#" class="btn btn-outline-primary">Templates</a>
                        <a href="#" class="btn btn-outline-primary">Applications</a>
                    </div>
                </div>

                <!-- Products -->
                <div class="row row-cards">
                    <!-- Product 1 -->
                    <div class="col-sm-6 col-lg-4">
                        <div class="card card-sm product-card">
                            <div class="ribbon ribbon-top ribbon-bookmark bg-green">
                                <i class="ti ti-star"></i>
                            </div>
                            <a href="#" class="d-block">
                                <img src="https://via.placeholder.com/400x300?text=E-book" class="card-img-top"
                                    alt="E-book">
                            </a>
                            <div class="card-body">
                                <div class="d-flex align-items-center">
                                    <span class="badge bg-blue me-2">E-book</span>
                                    <div>
                                        <div class="text-truncate">
                                            <span class="text-warning me-1"><i class="ti ti-star-filled"></i></span>
                                            <span class="text-warning me-1"><i class="ti ti-star-filled"></i></span>
                                            <span class="text-warning me-1"><i class="ti ti-star-filled"></i></span>
                                            <span class="text-warning me-1"><i class="ti ti-star-filled"></i></span>
                                            <span class="text-warning me-1"><i class="ti ti-star-filled"></i></span>
                                            <span class="text-muted">(48)</span>
                                        </div>
                                    </div>
                                </div>
                                <h3 class="card-title mt-3">
                                    <a href="#">Web Development Guide 2023</a>
                                </h3>
                                <div class="text-muted">Comprehensive guide to modern web development techniques</div>
                                <div class="mt-3">
                                    <div class="d-flex justify-content-between align-items-center">
                                        <div class="h3 m-0">$29.99</div>
                                        <a href="#" class="btn btn-primary">
                                            <i class="ti ti-shopping-cart me-2"></i>Buy Now
                                        </a>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>

                    <!-- Product 2 -->
                    <div class="col-sm-6 col-lg-4">
                        <div class="card card-sm product-card">
                            <a href="#" class="d-block">
                                <img src="https://via.placeholder.com/400x300?text=Template" class="card-img-top"
                                    alt="Template">
                            </a>
                            <div class="card-body">
                                <div class="d-flex align-items-center">
                                    <span class="badge bg-purple me-2">Template</span>
                                    <div>
                                        <div class="text-truncate">
                                            <span class="text-warning me-1"><i class="ti ti-star-filled"></i></span>
                                            <span class="text-warning me-1"><i class="ti ti-star-filled"></i></span>
                                            <span class="text-warning me-1"><i class="ti ti-star-filled"></i></span>
                                            <span class="text-warning me-1"><i class="ti ti-star-filled"></i></span>
                                            <span class="text-muted"><i class="ti ti-star"></i></span>
                                            <span class="text-muted">(32)</span>
                                        </div>
                                    </div>
                                </div>
                                <h3 class="card-title mt-3">
                                    <a href="#">Modern Dashboard UI Kit</a>
                                </h3>
                                <div class="text-muted">Figma template for creating beautiful admin dashboards</div>
                                <div class="mt-3">
                                    <div class="d-flex justify-content-between align-items-center">
                                        <div class="h3 m-0">$49.99</div>
                                        <a href="#" class="btn btn-primary">
                                            <i class="ti ti-shopping-cart me-2"></i>Buy Now
                                        </a>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>

                    <!-- Product 3 -->
                    <div class="col-sm-6 col-lg-4">
                        <div class="card card-sm product-card">
                            <a href="#" class="d-block">
                                <img src="https://via.placeholder.com/400x300?text=Application" class="card-img-top"
                                    alt="Application">
                            </a>
                            <div class="card-body">
                                <div class="d-flex align-items-center">
                                    <span class="badge bg-green me-2">Application</span>
                                    <div>
                                        <div class="text-truncate">
                                            <span class="text-warning me-1"><i class="ti ti-star-filled"></i></span>
                                            <span class="text-warning me-1"><i class="ti ti-star-filled"></i></span>
                                            <span class="text-warning me-1"><i class="ti ti-star-filled"></i></span>
                                            <span class="text-warning me-1"><i class="ti ti-star-filled"></i></span>
                                            <span class="text-warning me-1"><i class="ti ti-star-filled"></i></span>
                                            <span class="text-muted">(56)</span>
                                        </div>
                                    </div>
                                </div>
                                <h3 class="card-title mt-3">
                                    <a href="#">Inventory Management System</a>
                                </h3>
                                <div class="text-muted">Complete solution for tracking and managing inventory</div>
                                <div class="mt-3">
                                    <div class="d-flex justify-content-between align-items-center">
                                        <div class="h3 m-0">$199.99</div>
                                        <a href="#" class="btn btn-primary">
                                            <i class="ti ti-shopping-cart me-2"></i>Buy Now
                                        </a>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>

                    <!-- More products can be added here -->
                </div>

                <!-- Pagination -->
                <div class="d-flex mt-4">
                    <ul class="pagination ms-auto">
                        <li class="page-item disabled">
                            <a class="page-link" href="#" tabindex="-1" aria-disabled="true">
                                <i class="ti ti-chevron-left"></i>
                                prev
                            </a>
                        </li>
                        <li class="page-item active"><a class="page-link" href="#">1</a></li>
                        <li class="page-item"><a class="page-link" href="#">2</a></li>
                        <li class="page-item"><a class="page-link" href="#">3</a></li>
                        <li class="page-item"><a class="page-link" href="#">4</a></li>
                        <li class="page-item"><a class="page-link" href="#">5</a></li>
                        <li class="page-item">
                            <a class="page-link" href="#">
                                next
                                <i class="ti ti-chevron-right"></i>
                            </a>
                        </li>
                    </ul>
                </div>
            </div>
        </div>

        <!-- Custom Order Modal -->
        <div class="modal modal-blur fade" id="modal-custom-order" tabindex="-1" role="dialog"
            aria-hidden="true">
            <div class="modal-dialog modal-lg" role="document">
                <div class="modal-content">
                    <div class="modal-header">
                        <h5 class="modal-title">Request Custom Order</h5>
                        <button type="button" class="btn-close" data-bs-dismiss="modal"
                            aria-label="Close"></button>
                    </div>
                    <div class="modal-body">
                        <div class="mb-3">
                            <label class="form-label">Your Name</label>
                            <input type="text" class="form-control" name="name" placeholder="Enter your name">
                        </div>
                        <div class="mb-3">
                            <label class="form-label">Email Address</label>
                            <input type="email" class="form-control" name="email"
                                placeholder="Enter your email">
                        </div>
                        <div class="mb-3">
                            <label class="form-label">WhatsApp Number</label>
                            <input type="text" class="form-control" name="whatsapp"
                                placeholder="Enter your WhatsApp number">
                        </div>
                        <div class="mb-3">
                            <label class="form-label">Project Details</label>
                            <textarea class="form-control" name="details" rows="4" placeholder="Describe what you need..."></textarea>
                        </div>
                        <div class="mb-3">
                            <label class="form-label">Budget Range</label>
                            <select class="form-select" name="budget">
                                <option value="">Select budget range</option>
                                <option value="under-100">Under $100</option>
                                <option value="100-500">$100 - $500</option>
                                <option value="500-1000">$500 - $1,000</option>
                                <option value="1000-plus">$1,000+</option>
                            </select>
                        </div>
                    </div>
                    <div class="modal-footer">
                        <a href="#" class="btn btn-link link-secondary" data-bs-dismiss="modal">
                            Cancel
                        </a>
                        <a href="#" class="btn btn-success ms-auto">
                            <i class="ti ti-brand-whatsapp me-2"></i>
                            Submit & Connect on WhatsApp
                        </a>
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
