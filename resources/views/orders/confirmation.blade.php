<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Order Confirmation | {{ config('app.name', 'Wahyu Dedik') }}</title>
    <link rel="icon" href="{{ asset('img/logo.png') }}" type="image/x-icon">
    <!-- Tabler CSS -->
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/@tabler/core@1.0.0-beta17/dist/css/tabler.min.css">
    <!-- Tabler Icons -->
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/@tabler/icons-webfont@2.22.0/tabler-icons.min.css">
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

        <!-- Page body -->
        <div class="page-body">
            <div class="container-xl">
                <!-- Notification messages -->
                @if (session('success'))
                    <div class="alert alert-success mb-4" role="alert">
                        <div class="d-flex">
                            <div>
                                <i class="ti ti-check me-2"></i>
                            </div>
                            <div>
                                {{ session('success') }}
                            </div>
                        </div>
                    </div>
                @endif

                @if (session('error'))
                    <div class="alert alert-danger mb-4" role="alert">
                        <div class="d-flex">
                            <div>
                                <i class="ti ti-alert-circle me-2"></i>
                            </div>
                            <div>
                                {{ session('error') }}
                            </div>
                        </div>
                    </div>
                @endif

                <div class="row justify-content-center">
                    <div class="col-md-8">
                        <div class="card">
                            <div class="card-body p-4 text-center">
                                <div class="mb-4">
                                    <span class="avatar avatar-xl rounded-circle bg-green-lt mb-3">
                                        <i class="ti ti-check fs-1"></i>
                                    </span>
                                    <h2>Thank you for your order!</h2>
                                    <div class="text-muted">Your order has been placed successfully.</div>
                                </div>

                                <div class="card mb-4">
                                    <div class="card-header">
                                        <h3 class="card-title">Order Details</h3>
                                    </div>
                                    <div class="card-body">
                                        <div class="datagrid">
                                            <div class="datagrid-item">
                                                <div class="datagrid-title">Order Number</div>
                                                <div class="datagrid-content">{{ $order->order_number }}</div>
                                            </div>
                                            <div class="datagrid-item">
                                                <div class="datagrid-title">Date</div>
                                                <div class="datagrid-content">{{ $order->created_at->format('F d, Y') }}</div>
                                            </div>
                                            <div class="datagrid-item">
                                                <div class="datagrid-title">Product</div>
                                                <div class="datagrid-content">{{ $order->product->name }}</div>
                                            </div>
                                            <div class="datagrid-item">
                                                <div class="datagrid-title">License Type</div>
                                                <div class="datagrid-content">{{ ucfirst($order->license_type) }}</div>
                                            </div>
                                            <div class="datagrid-item">
                                                <div class="datagrid-title">Amount</div>
                                                <div class="datagrid-content">${{ number_format($order->amount, 2) }}</div>
                                            </div>
                                            <div class="datagrid-item">
                                                <div class="datagrid-title">Status</div>
                                                <div class="datagrid-content">
                                                    <span class="status status-yellow">Pending Verification</span>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                </div>

                                <div class="alert alert-success" role="alert">
                                    <div class="d-flex">
                                        <div>
                                            <i class="ti ti-check me-2"></i>
                                        </div>
                                        <div>
                                            <h4 class="alert-title">Payment proof uploaded successfully!</h4>
                                            <div class="text-muted">
                                                We've received your payment proof and will verify it shortly. You'll receive your product once the payment is verified.
                                            </div>
                                        </div>
                                    </div>
                                </div>

                                <div class="alert alert-info" role="alert">
                                    <div class="d-flex">
                                        <div>
                                            <i class="ti ti-info-circle me-2"></i>
                                        </div>
                                        <div>
                                            <h4 class="alert-title">What happens next?</h4>
                                            <div class="text-muted">
                                                <p>1. Our team will verify your payment (usually within 24 hours).</p>
                                                <p>2. Once verified, you'll receive an email with download instructions.</p>
                                                <p>3. You can also check your order status anytime using the button below.</p>
                                            </div>
                                        </div>
                                    </div>
                                </div>

                                <div class="d-flex justify-content-between mt-4">
                                    <a href="{{ route('products.index') }}" class="btn btn-outline-primary">
                                        <i class="ti ti-arrow-left me-2"></i>Continue Shopping
                                    </a>
                                    <a href="{{ route('orders.status', $order->order_number) }}" class="btn btn-primary">
                                        <i class="ti ti-eye me-2"></i>Check Order Status
                                    </a>
                                </div>

                                @if(session('whatsapp_message'))
                                <div class="mt-4">
                                    <a href="https://wa.me/6281654932383?text={{ session('whatsapp_message') }}" target="_blank" class="btn btn-success w-100">
                                        <i class="ti ti-brand-whatsapp me-2"></i>Notify Us on WhatsApp
                                    </a>
                                </div>
                                @endif
                            </div>
                        </div>
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
</body>

</html>
