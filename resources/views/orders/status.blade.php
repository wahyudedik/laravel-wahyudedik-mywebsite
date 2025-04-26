<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Order Status | {{ config('app.name', 'Wahyu Dedik') }}</title>
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
                            <div class="card-body p-4">
                                <div class="mb-4 text-center">
                                    @if ($order->status == 'completed')
                                        <span class="avatar avatar-xl rounded-circle bg-green-lt mb-3">
                                            <i class="ti ti-check fs-1"></i>
                                        </span>
                                        <h2>Your order is complete!</h2>
                                        <div class="text-muted">You can now download your product.</div>
                                    @elseif($order->status == 'paid')
                                        <span class="avatar avatar-xl rounded-circle bg-blue-lt mb-3">
                                            <i class="ti ti-clock fs-1"></i>
                                        </span>
                                        <h2>Payment verified!</h2>
                                        <div class="text-muted">We're processing your order. You'll receive your
                                            download link soon.</div>
                                    @elseif($order->status == 'pending')
                                        <span class="avatar avatar-xl rounded-circle bg-yellow-lt mb-3">
                                            <i class="ti ti-hourglass fs-1"></i>
                                        </span>
                                        <h2>Waiting for payment</h2>
                                        <div class="text-muted">Please complete your payment to proceed.</div>
                                    @else
                                        <span class="avatar avatar-xl rounded-circle bg-red-lt mb-3">
                                            <i class="ti ti-x fs-1"></i>
                                        </span>
                                        <h2>Order cancelled</h2>
                                        <div class="text-muted">This order has been cancelled.</div>
                                    @endif
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
                                                <div class="datagrid-content">
                                                    {{ $order->created_at->format('F d, Y') }}</div>
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
                                                <div class="datagrid-content">${{ number_format($order->amount, 2) }}
                                                </div>
                                            </div>
                                            <div class="datagrid-item">
                                                <div class="datagrid-title">Status</div>
                                                <div class="datagrid-content">
                                                    <span
                                                        class="status 
                                                        @if ($order->status == 'completed') status-green
                                                        @elseif($order->status == 'paid') status-blue
                                                        @elseif($order->status == 'pending') status-yellow
                                                        @else status-red @endif">
                                                        {{ ucfirst($order->status) }}
                                                    </span>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                </div>

                                @if ($order->status == 'pending')
                                    <div class="card mb-4">
                                        <div class="card-header">
                                            <h3 class="card-title">Payment Instructions</h3>
                                        </div>
                                        <div class="card-body">
                                            <div class="mb-3">
                                                <p>Please transfer the payment to one of the following accounts:</p>
                                                <div class="row g-3 mt-2">
                                                    <div class="col-md-6">
                                                        <div class="card">
                                                            <div class="card-body">
                                                                <h4 class="card-title">Bank Transfer</h4>
                                                                <p class="mb-1"><strong>Bank:</strong> Bank Rakyat
                                                                    Indonesia (BRI)
                                                                </p>
                                                                <p class="mb-1"><strong>Account Number:</strong> 2118
                                                                    0100 8728
                                                                    508</p>
                                                                <p class="mb-1"><strong>Account Name:</strong> Wahyu
                                                                    Dedik Dwi
                                                                    Astono</p>
                                                            </div>
                                                        </div>
                                                    </div>
                                                    <div class="col-md-6">
                                                        <div class="card">
                                                            <div class="card-body">
                                                                <h4 class="card-title">PayPal</h4>
                                                                <p class="mb-1"><strong>Email:</strong>
                                                                    wdedyk@gmail.com</p>
                                                                <p class="mb-1"><strong>Name:</strong> Wahyu Dedik
                                                                </p>
                                                            </div>
                                                        </div>
                                                    </div>

                                                    {{-- <div class="col-md-6">
                                                        <div class="card">
                                                            <div class="card-body">
                                                                <h4 class="card-title">E-Wallet</h4>
                                                                <p class="mb-1"><strong>Provider:</strong> GoPay</p>
                                                                <p class="mb-1"><strong>Number:</strong> 081234567890
                                                                </p>
                                                                <p class="mb-1"><strong>Name:</strong> Wahyu Dedik
                                                                </p>
                                                            </div>
                                                        </div>
                                                    </div> --}}
                                                </div>
                                            </div>

                                            @if ($order->payment_proof)
                                                <div class="alert alert-success" role="alert">
                                                    <h4 class="alert-title">Payment proof uploaded!</h4>
                                                    <div class="text-muted">
                                                        <p>We're verifying your payment. This usually takes 1-24 hours.
                                                        </p>
                                                    </div>
                                                </div>
                                                <div class="mb-3">
                                                    <label class="form-label">Your Payment Proof</label>
                                                    <img src="{{ Storage::url($order->payment_proof) }}"
                                                        alt="Payment Proof" class="img-fluid rounded border">
                                                </div>
                                            @else
                                                <form
                                                    action="{{ route('orders.upload-proof', $order->order_number) }}"
                                                    method="POST" enctype="multipart/form-data" class="mt-3">
                                                    @csrf
                                                    <div class="mb-3">
                                                        <label class="form-label">Upload Payment Proof</label>
                                                        <input type="file" class="form-control"
                                                            name="payment_proof" accept="image/*" required>
                                                        <small class="form-hint">Accepted formats: JPG, PNG, PDF. Max
                                                            size: 2MB</small>
                                                    </div>
                                                    <div class="mb-3">
                                                        <label class="form-label">Additional Notes (Optional)</label>
                                                        <textarea class="form-control" name="notes" rows="3"
                                                            placeholder="Any additional information about your payment..."></textarea>
                                                    </div>
                                                    <button type="submit" class="btn btn-primary">
                                                        <i class="ti ti-upload me-2"></i>Upload Payment Proof
                                                    </button>
                                                </form>
                                            @endif
                                        </div>
                                    </div>
                                @endif

                                @if ($order->status == 'completed')
                                    <div class="card mb-4">
                                        <div class="card-header">
                                            <h3 class="card-title">Download Your Product</h3>
                                        </div>
                                        <div class="card-body">
                                            <div class="alert alert-success" role="alert">
                                                <h4 class="alert-title">Your product is ready!</h4>
                                                <div class="text-muted">
                                                    <p>Click the button below to download your product. We've also sent
                                                        the download link to your email at {{ $order->email }}.</p>
                                                    <p>The download link will expire in 7 days.</p>
                                                </div>
                                            </div>
                                            <a href="{{ route('products.download', ['order' => $order->order_number, 'token' => $order->download_token]) }}"
                                                class="btn btn-primary btn-lg w-100">
                                                <i class="ti ti-download me-2"></i>Download Product
                                            </a>
                                        </div>
                                    </div>
                                @endif

                                @if($order->status == 'completed' && !$order->review)
                                    <div class="card mb-4">
                                        <div class="card-header">
                                            <h3 class="card-title">Rate This Product</h3>
                                        </div>
                                        <div class="card-body">
                                            <form action="{{ route('products.review', $order->product->id) }}" method="POST">
                                                @csrf
                                                <input type="hidden" name="order_id" value="{{ $order->id }}">
                                                
                                                <div class="mb-3">
                                                    <label class="form-label">Your Rating</label>
                                                    <div class="rating">
                                                        <div class="form-selectgroup form-selectgroup-pills">
                                                            @for($i = 5; $i >= 1; $i--)
                                                                <label class="form-selectgroup-item">
                                                                    <input type="radio" name="rating" value="{{ $i }}" class="form-selectgroup-input" required>
                                                                    <span class="form-selectgroup-label">
                                                                        {{ $i }} <i class="ti ti-star-filled ms-1"></i>
                                                                    </span>
                                                                </label>
                                                            @endfor
                                                        </div>
                                                    </div>
                                                </div>
                                                
                                                <div class="mb-3">
                                                    <label class="form-label">Your Review (Optional)</label>
                                                    <textarea class="form-control" name="comment" rows="3" placeholder="Share your experience with this product..."></textarea>
                                                </div>
                                                
                                                <button type="submit" class="btn btn-primary">
                                                    <i class="ti ti-star me-2"></i>Submit Review
                                                </button>
                                            </form>
                                        </div>
                                    </div>
                                @endif

                                <div class="d-flex justify-content-between">
                                    <a href="{{ route('products.index') }}" class="btn btn-outline-primary">
                                        <i class="ti ti-arrow-left me-2"></i>Back to Products
                                    </a>
                                    <a href="https://wa.me/6281654932383?text=Hi,%20I'm%20checking%20on%20my%20order%20with%20number%20{{ $order->order_number }}."
                                        target="_blank" class="btn btn-success">
                                        <i class="ti ti-brand-whatsapp me-2"></i>Contact Support
                                    </a>
                                </div>
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
