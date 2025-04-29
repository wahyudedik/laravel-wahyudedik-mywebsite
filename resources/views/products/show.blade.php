<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>{{ $product->name }} | {{ config('app.name', 'Wahyu Dedik') }}</title>
    <link rel="icon" href="{{ asset('img/logo.png') }}" type="image/x-icon">
    <!-- Tabler CSS -->
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/@tabler/core@1.0.0-beta17/dist/css/tabler.min.css">
    <!-- Tabler Icons -->
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/@tabler/icons-webfont@2.22.0/tabler-icons.min.css">
    <style>
        .product-image {
            max-height: 500px;
            object-fit: contain;
        }

        .license-card {
            transition: transform 0.3s ease, border-color 0.3s ease;
            cursor: pointer;
        }

        .license-card:hover {
            transform: translateY(-5px);
        }

        .license-card.selected {
            border-color: #206bc4;
            border-width: 2px;
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

        <!-- Page body -->
        <div class="page-body">
            <div class="container-xl">
                <div class="row g-4">
                    <div class="col-md-6">
                        <div class="card">
                            <div class="card-body p-2">
                                <img src="{{ Storage::url($product->image) }}" alt="{{ $product->name }}"
                                    class="product-image w-100 rounded">
                            </div>
                        </div>
                    </div>
                    <div class="col-md-6">
                        <div class="card">
                            <div class="card-body">
                                <div class="d-flex align-items-center mb-3">
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
                                                    <span class="text-muted me-1"><i class="ti ti-star"></i></span>
                                                @endif
                                            @endfor
                                            <span class="text-muted">({{ $product->reviews_count }})</span>
                                        </div>
                                    </div>
                                </div>

                                <h1 class="mb-3">{{ $product->name }}</h1>
                                <p class="text-muted mb-4">{{ $product->description }}</p>

                                <form action="{{ route('orders.store') }}" method="POST" id="order-form">
                                    @csrf
                                    <input type="hidden" name="product_id" value="{{ $product->id }}">
                                    <input type="hidden" name="license_type" id="license_type" value="user">

                                    <div class="mb-4">
                                        <label class="form-label">Choose License</label>
                                        <div class="row g-3">
                                            <div class="col-md-6">
                                                <div class="card license-card selected" id="user-license"
                                                    onclick="selectLicense('user')">
                                                    <div class="card-body">
                                                        <h3 class="card-title">User License</h3>
                                                        <p class="text-muted">For personal use only</p>
                                                        <div class="h2 mb-0">
                                                            ${{ number_format($product->price_user, 2) }}</div>
                                                    </div>
                                                </div>
                                            </div>
                                            <div class="col-md-6">
                                                <div class="card license-card" id="developer-license"
                                                    onclick="selectLicense('developer')">
                                                    <div class="card-body">
                                                        <h3 class="card-title">Developer License</h3>
                                                        <p class="text-muted">For commercial projects</p>
                                                        <div class="h2 mb-0">
                                                            ${{ number_format($product->price_developer, 2) }}</div>
                                                    </div>
                                                </div>
                                            </div>
                                        </div>
                                    </div>

                                    <div class="mb-4">
                                        <div class="row g-3">
                                            <div class="col-md-6">
                                                <label class="form-label">Your Name</label>
                                                <input type="text" class="form-control" name="name" required>
                                            </div>
                                            <div class="col-md-6">
                                                <label class="form-label">Email Address</label>
                                                <input type="email" class="form-control" name="email" required>
                                            </div>
                                            <div class="col-md-6">
                                                <label class="form-label">WhatsApp Number</label>
                                                <input type="tel" class="form-control" name="whatsapp"
                                                    placeholder="628123456789" required>
                                            </div>
                                        </div>
                                    </div>

                                    <div class="d-flex justify-content-between align-items-center">
                                        <div>
                                            <span class="h3 mb-0"
                                                id="selected-price">${{ number_format($product->price_user, 2) }}</span>
                                        </div>
                                        <button type="submit" class="btn btn-primary btn-lg">
                                            <i class="ti ti-shopping-cart me-2"></i>Buy Now
                                        </button>
                                    </div>
                                </form>
                            </div>
                        </div>

                        @if ($product->demo_link)
                            <div class="mt-3">
                                <a href="{{ $product->demo_link }}" target="_blank"
                                    class="btn btn-outline-primary w-100">
                                    <i class="ti ti-external-link me-2"></i>View Demo
                                </a>
                            </div>
                        @endif
                    </div>
                </div>

                <!-- Reviews Section -->
                <div class="card mt-4">
                    <div class="card-header">
                        <h3 class="card-title">Customer Reviews</h3>
                    </div>
                    <div class="card-body">
                        <div class="d-flex align-items-center mb-4">
                            <div class="me-3">
                                <div class="text-center">
                                    <div class="h1 m-0">{{ number_format($product->rating, 1) }}</div>
                                    <div class="text-muted">out of 5</div>
                                </div>
                            </div>
                            <div>
                                <div class="mb-1">
                                    @for ($i = 0; $i < 5; $i++)
                                        @if ($i < $product->rating)
                                            <span class="text-warning me-1"><i class="ti ti-star-filled"></i></span>
                                        @else
                                            <span class="text-muted me-1"><i class="ti ti-star"></i></span>
                                        @endif
                                    @endfor
                                </div>
                                <div class="text-muted">Based on {{ $product->reviews_count }} reviews</div>
                            </div>
                        </div>

                        @if (isset($reviews) && $reviews->count() > 0)
                            <div class="divide-y">
                                @foreach ($reviews as $review)
                                    <div class="py-3">
                                        <div class="d-flex">
                                            <div class="flex-grow-1">
                                                <div class="mb-1">
                                                    @for ($i = 0; $i < 5; $i++)
                                                        @if ($i < $review->rating)
                                                            <span class="text-warning me-1"><i
                                                                    class="ti ti-star-filled"></i></span>
                                                        @else
                                                            <span class="text-muted me-1"><i
                                                                    class="ti ti-star"></i></span>
                                                        @endif
                                                    @endfor
                                                </div>
                                                <div class="mb-2">
                                                    <strong>{{ $review->name }}</strong>
                                                    <span
                                                        class="text-muted ms-2">{{ $review->created_at->format('M d, Y') }}</span>
                                                </div>
                                                <div class="text-muted">{{ $review->comment }}</div>
                                            </div>
                                        </div>
                                    </div>
                                @endforeach
                            </div>
                        @else
                            <div class="text-center py-4">
                                <div class="mb-3">
                                    <svg xmlns="http://www.w3.org/2000/svg"
                                        class="icon icon-tabler icon-tabler-message-circle-2" width="40"
                                        height="40" viewBox="0 0 24 24" stroke-width="2" stroke="currentColor"
                                        fill="none" stroke-linecap="round" stroke-linejoin="round">
                                        <path stroke="none" d="M0 0h24v24H0z" fill="none"></path>
                                        <path d="M3 20l1.3 -3.9a9 8 0 1 1 3.4 2.9l-4.7 1"></path>
                                    </svg>
                                </div>
                                <h3 class="mb-1">No reviews yet</h3>
                                <div class="text-muted">Be the first to review this product</div>
                            </div>
                        @endif
                    </div>
                </div>

                <!-- Related Products -->
                <div class="mt-5">
                    <h2 class="mb-4">Related Products</h2>
                    <div class="row row-cards">
                        @foreach ($relatedProducts as $relatedProduct)
                            <div class="col-sm-6 col-lg-3">
                                <div class="card card-sm product-card">
                                    <a href="{{ route('products.show', $relatedProduct->slug) }}" class="d-block">
                                        <img src="{{ Storage::url($relatedProduct->image) }}" class="card-img-top"
                                            alt="{{ $relatedProduct->name }}">
                                    </a>
                                    <div class="card-body">
                                        <div class="d-flex align-items-center">
                                            <span
                                                class="badge 
                                                @if ($relatedProduct->category == 'e-book') bg-blue 
                                                @elseif($relatedProduct->category == 'template') bg-purple 
                                                @elseif($relatedProduct->category == 'application') bg-green @endif me-2">
                                                {{ ucfirst($relatedProduct->category) }}
                                            </span>
                                        </div>
                                        <h3 class="card-title mt-3">
                                            <a
                                                href="{{ route('products.show', $relatedProduct->slug) }}">{{ $relatedProduct->name }}</a>
                                        </h3>
                                        <div class="mt-3">
                                            <div class="d-flex justify-content-between align-items-center">
                                                <div class="h3 m-0">
                                                    ${{ number_format($relatedProduct->price_user, 2) }}</div>
                                                <a href="{{ route('products.show', $relatedProduct->slug) }}"
                                                    class="btn btn-primary">
                                                    <i class="ti ti-shopping-cart me-2"></i>Buy Now
                                                </a>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        @endforeach
                    </div>
                </div>
            </div>
        </div>

        <!-- Footer -->
        <footer class="footer footer-transparent d-print-none mt-5">
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
        function selectLicense(type) {
            // Update hidden input
            document.getElementById('license_type').value = type;

            // Update UI
            if (type === 'user') {
                document.getElementById('user-license').classList.add('selected');
                document.getElementById('developer-license').classList.remove('selected');
                document.getElementById('selected-price').textContent = '${{ number_format($product->price_user, 2) }}';
            } else {
                document.getElementById('user-license').classList.remove('selected');
                document.getElementById('developer-license').classList.add('selected');
                document.getElementById('selected-price').textContent =
                    '${{ number_format($product->price_developer, 2) }}';
            }
        }
    </script>
</body>

</html>
