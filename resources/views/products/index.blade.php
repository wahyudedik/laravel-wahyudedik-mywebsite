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
                        <a href="{{ route('products.index') }}"
                            class="btn btn-outline-primary {{ !request('category') ? 'active' : '' }}">All</a>
                        <a href="{{ route('products.index', ['category' => 'e-book']) }}"
                            class="btn btn-outline-primary {{ request('category') == 'e-book' ? 'active' : '' }}">E-books</a>
                        <a href="{{ route('products.index', ['category' => 'template']) }}"
                            class="btn btn-outline-primary {{ request('category') == 'template' ? 'active' : '' }}">Templates</a>
                        <a href="{{ route('products.index', ['category' => 'application']) }}"
                            class="btn btn-outline-primary {{ request('category') == 'application' ? 'active' : '' }}">Applications</a>
                    </div>
                </div>

                <!-- Products -->
                <div class="row row-cards">
                    @forelse ($products as $product)
                        <div class="col-sm-6 col-lg-4">
                            <div class="card card-sm product-card">
                                @if ($product->featured)
                                    <div class="ribbon ribbon-top ribbon-bookmark bg-green">
                                        <i class="ti ti-star"></i>
                                    </div>
                                @endif
                                <a href="{{ route('products.show', $product->slug) }}" class="d-block">
                                    <img src="{{ Storage::url($product->image) }}" class="card-img-top"
                                        alt="{{ $product->name }}">
                                </a>
                                <div class="card-body">
                                    <div class="d-flex align-items-center">
                                        <span
                                            class="badge 
                            @if ($product->category == 'e-book') bg-blue 
                            @elseif($product->category == 'template') bg-purple 
                            @elseif($product->category == 'application') bg-green @endif me-2">
                                            {{ ucfirst($product->category) }}
                                        </span>
                                        <div>
                                            <div class="text-truncate">
                                                @for ($i = 0; $i < 5; $i++)
                                                    @if ($i < $product->rating)
                                                        <span class="text-warning me-1"><i
                                                                class="ti ti-star-filled"></i></span>
                                                    @else
                                                        <span class="text-muted me-1"><i
                                                                class="ti ti-star"></i></span>
                                                    @endif
                                                @endfor
                                                <span class="text-muted">({{ $product->reviews_count }})</span>
                                            </div>
                                        </div>
                                    </div>
                                    <h3 class="card-title mt-3">
                                        <a
                                            href="{{ route('products.show', $product->slug) }}">{{ $product->name }}</a>
                                    </h3>
                                    <div class="text-muted">{{ Str::limit($product->description, 100) }}</div>
                                    <div class="mt-3">
                                        <div class="d-flex justify-content-between align-items-center">
                                            <div class="h3 m-0">${{ number_format($product->price_user, 2) }}</div>
                                            <a href="{{ route('products.show', $product->slug) }}"
                                                class="btn btn-primary">
                                                <i class="ti ti-shopping-cart me-2"></i>Buy Now
                                            </a>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                    @empty
                        <div class="col-12">
                            <div class="empty">
                                <div class="empty-img">
                                    <svg xmlns="http://www.w3.org/2000/svg"
                                        class="icon icon-tabler icon-tabler-shopping-cart-off" width="40"
                                        height="40" viewBox="0 0 24 24" stroke-width="2" stroke="currentColor"
                                        fill="none" stroke-linecap="round" stroke-linejoin="round">
                                        <path stroke="none" d="M0 0h24v24H0z" fill="none"></path>
                                        <path d="M6 19m-2 0a2 2 0 1 0 4 0a2 2 0 1 0 -4 0"></path>
                                        <path d="M17 17a2 2 0 1 0 2 2"></path>
                                        <path d="M17 17h-11v-11"></path>
                                        <path d="M9.239 5.231l10.761 .769l-1 7h-2m-4 0h-7"></path>
                                        <path d="M3 3l18 18"></path>
                                    </svg>
                                </div>
                                <p class="empty-title">No products found</p>
                                <p class="empty-subtitle text-muted">
                                    We're working on adding new products. Please check back later.
                                </p>
                            </div>
                        </div>
                    @endforelse
                </div>

                <!-- Pagination -->
                <div class="d-flex mt-4">
                    {{ $products->links('pagination.tabler') }}
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
                            <input type="tel" class="form-control" name="whatsapp"
                                placeholder="Enter your WhatsApp number 625897458354">
                        </div>
                        <div class="mb-3">
                            <label class="form-label">Project Details</label>
                            <textarea class="form-control" name="details" rows="4" placeholder="Describe what you need..."></textarea>
                        </div>
                        <div class="mb-3">
                            <label class="form-label">Budget Range</label>
                            <div class="input-group">
                                <select class="form-select" name="currency" style="max-width: 100px;">
                                    <option value="USD">USD</option>
                                    <option value="IDR">IDR</option>
                                </select>
                                <input type="number" class="form-control" name="budget"
                                    placeholder="Enter budget amount" min="0">
                            </div>
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
                                Copyright © {{ date('Y') }}
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
        document.addEventListener('DOMContentLoaded', function() {
            const whatsappButton = document.querySelector('#modal-custom-order .btn-success');

            whatsappButton.addEventListener('click', function(e) {
                e.preventDefault();

                // Get form values
                const name = document.querySelector('#modal-custom-order input[name="name"]').value;
                const email = document.querySelector('#modal-custom-order input[name="email"]').value;
                const whatsapp = document.querySelector('#modal-custom-order input[name="whatsapp"]').value;
                const details = document.querySelector('#modal-custom-order textarea[name="details"]')
                .value;
                const currency = document.querySelector('#modal-custom-order select[name="currency"]')
                .value;
                const budget = document.querySelector('#modal-custom-order input[name="budget"]').value;

                // Validate required fields
                if (!name || !whatsapp || !details) {
                    alert('Please fill in all required fields');
                    return;
                }

                // Construct message
                const message = `*New Custom Order Request*\n\n` +
                    `*Name:* ${name}\n` +
                    `*Email:* ${email}\n` +
                    `*WhatsApp:* ${whatsapp}\n\n` +
                    `*Project Details:*\n${details}\n\n` +
                    `*Budget:* ${currency} ${budget}`;

                // Replace with your WhatsApp number
                const whatsappNumber = '6281654932383'; // Change this to your actual WhatsApp number

                // Create WhatsApp URL
                const whatsappUrl = `https://wa.me/${whatsappNumber}?text=${encodeURIComponent(message)}`;

                // Open WhatsApp
                window.open(whatsappUrl, '_blank');
            });
        });
    </script>
</body>

</html>
