<nav class="navbar navbar-expand-lg navbar-light bg-white border-bottom" x-data="{ open: false }">
    <div class="container">
        <!-- Logo -->
        <a class="navbar-brand" href="{{ route('admin.dashboard') }}">
            <img src="{{ asset('img/logo.png') }}" alt="Logo" height="30">
        </a>

        <!-- Mobile Toggle Button -->
        <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#navbarContent"
            aria-controls="navbarContent" aria-expanded="false" aria-label="Toggle navigation"
            @click="open = !open">
            <span class="navbar-toggler-icon"></span>
        </button>

        <!-- Navigation Content -->
        <div class="collapse navbar-collapse" id="navbarContent">
            <!-- Left Side Navigation -->
            <ul class="navbar-nav me-auto mb-2 mb-lg-0">
                <li class="nav-item">
                    <a class="nav-link {{ request()->routeIs('admin.dashboard') ? 'active fw-bold' : '' }}"
                        href="{{ route('admin.dashboard') }}">{{ __('Dashboard') }}</a>
                </li>
                <li class="nav-item">
                    <a class="nav-link {{ request()->routeIs('admin.products.*') ? 'active fw-bold' : '' }}"
                        href="{{ route('admin.products.index') }}">{{ __('Products') }}</a>
                </li>
                <li class="nav-item">
                    <a class="nav-link {{ request()->routeIs('admin.orders.*') ? 'active fw-bold' : '' }}"
                        href="{{ route('admin.orders.index') }}">{{ __('Orders') }}</a>
                </li>
                <li class="nav-item">
                    <a class="nav-link {{ request()->routeIs('admin.contacts.*') ? 'active fw-bold' : '' }}"
                        href="{{ route('admin.contacts.index') }}">{{ __('Contacts') }}</a>
                </li>
                <li class="nav-item">
                    <a class="nav-link {{ request()->routeIs('admin.newsletter.*') ? 'active fw-bold' : '' }}"
                        href="{{ route('admin.newsletter.index') }}">{{ __('Newsletter') }}</a>
                </li>
                <li class="nav-item">
                    <a class="nav-link {{ request()->routeIs('admin.resume.*') ? 'active fw-bold' : '' }}"
                        href="{{ route('admin.resume.index') }}">{{ __('Resume') }}</a>
                </li>
                <li class="nav-item">
                    <a class="nav-link {{ request()->routeIs('admin.feedback.*') ? 'active fw-bold' : '' }}"
                        href="{{ route('admin.feedback.index') }}">{{ __('Feedback') }}</a>
                </li>
            </ul>

            <!-- Right Side Navigation -->
            <div class="d-flex align-items-center">
                <!-- Notifications Dropdown -->
                <div class="dropdown me-3">
                    <button class="btn btn-light position-relative" type="button" id="notificationsDropdown"
                        data-bs-toggle="dropdown" aria-expanded="false">
                        <i class="ti ti-bell"></i>
                        @php
                            $unreadCount = auth()->user()->unreadNotifications->count();
                        @endphp
                        @if ($unreadCount > 0)
                            <span
                                class="position-absolute top-0 start-100 translate-middle badge rounded-pill bg-danger">
                                {{ $unreadCount }}
                                <span class="visually-hidden">unread notifications</span>
                            </span>
                        @endif
                    </button>
                    <div class="dropdown-menu dropdown-menu-end shadow" aria-labelledby="notificationsDropdown"
                        style="width: 320px; max-height: 400px; overflow-y: auto;">
                        <div class="dropdown-header d-flex justify-content-between align-items-center">
                            <span>Notifications</span>
                            @if ($unreadCount > 0)
                                <span class="badge bg-danger rounded-pill">{{ $unreadCount }}</span>
                            @endif
                        </div>
                        <div class="dropdown-divider"></div>

                        @forelse(auth()->user()->notifications->take(5) as $notification)
                            <a class="dropdown-item {{ $notification->read_at ? '' : 'fw-bold' }} py-2"
                                href="{{ isset($notification->data['contact_id'])
                                    ? route('admin.contacts.show', $notification->data['contact_id'])
                                    : (isset($notification->data['url'])
                                        ? $notification->data['url']
                                        : '#') }}">
                                @if (isset($notification->data['subject']))
                                    <div class="d-flex align-items-start">
                                        <div class="me-2">
                                            <i class="ti ti-mail text-primary fs-5"></i>
                                        </div>
                                        <div>
                                            <div>New message from {{ $notification->data['name'] }}</div>
                                            <div class="small text-muted">
                                                {{ \Illuminate\Support\Str::limit($notification->data['subject'], 30) }}
                                            </div>
                                            <div class="small text-muted">
                                                {{ $notification->created_at->diffForHumans() }}</div>
                                        </div>
                                    </div>
                                @elseif(isset($notification->data['order_id']))
                                    <div class="d-flex align-items-start">
                                        <div class="me-2">
                                            <i class="ti ti-shopping-cart text-success fs-5"></i>
                                        </div>
                                        <div>
                                            <div>New order #{{ $notification->data['order_number'] }}</div>
                                            <div class="small text-muted">
                                                {{ $notification->data['message'] ?? 'New order received' }}</div>
                                            <div class="small text-muted">
                                                {{ $notification->created_at->diffForHumans() }}</div>
                                        </div>
                                    </div>
                                @else
                                    <div class="d-flex align-items-start">
                                        <div class="me-2">
                                            <i class="ti ti-bell text-info fs-5"></i>
                                        </div>
                                        <div>
                                            <div>{{ $notification->data['message'] ?? 'Notification' }}</div>
                                            <div class="small text-muted">
                                                {{ $notification->created_at->diffForHumans() }}</div>
                                        </div>
                                    </div>
                                @endif
                            </a>
                        @empty
                            <div class="dropdown-item text-center py-3">
                                <i class="ti ti-bell-off text-muted mb-2 fs-3"></i>
                                <p class="mb-0">No notifications</p>
                            </div>
                        @endforelse

                        @if (auth()->user()->notifications->count() > 0)
                            <div class="dropdown-divider"></div>
                            <div class="dropdown-item d-flex justify-content-between">
                                <form action="{{ route('admin.notifications.mark-all-read') }}" method="POST">
                                    @csrf
                                    <button type="submit" class="btn btn-sm btn-outline-primary">
                                        <i class="ti ti-check me-1"></i>Mark all as read
                                    </button>
                                </form>
                                <a href="#" class="btn btn-sm btn-outline-secondary">
                                    <i class="ti ti-list me-1"></i>View all
                                </a>
                            </div>
                        @endif
                    </div>
                </div>

                <!-- User Dropdown -->
                <div class="dropdown">
                    <button class="btn btn-light dropdown-toggle d-flex align-items-center" type="button"
                        id="userDropdown" data-bs-toggle="dropdown" aria-expanded="false">
                        <div class="d-none d-md-block me-2">{{ Auth::user()->name }}</div>
                    </button>
                    <ul class="dropdown-menu dropdown-menu-end shadow" aria-labelledby="userDropdown">
                        <li>
                            <div class="dropdown-header">
                                <div class="fw-bold">{{ Auth::user()->name }}</div>
                                <div class="small text-muted">{{ Auth::user()->email }}</div>
                            </div>
                        </li>
                        <li>
                            <hr class="dropdown-divider">
                        </li>
                        <li>
                            <a class="dropdown-item d-flex align-items-center" href="{{ route('profile.edit') }}">
                                <i class="ti ti-user me-2"></i>{{ __('Profile') }}
                            </a>
                        </li>
                        <li>
                            <a class="dropdown-item d-flex align-items-center" href="{{ url('/') }}">
                                <i class="ti ti-home me-2"></i>{{ __('Home Page') }}
                            </a>
                        </li>
                        <li>
                            <hr class="dropdown-divider">
                        </li>
                        <li>
                            <form method="POST" action="{{ route('logout') }}" id="logout-form">
                                @csrf
                                <button type="submit" class="dropdown-item d-flex align-items-center text-danger">
                                    <i class="ti ti-logout me-2"></i>{{ __('Log Out') }}
                                </button>
                            </form>
                        </li>
                    </ul>
                </div>
            </div>
        </div>
    </div>
</nav>

<!-- Mobile Navigation Menu (Visible on small screens) -->
<div class="d-block d-lg-none bg-light border-bottom py-2">
    <div class="container">
        <div class="row">
            <div class="col-12">
                <div class="d-flex justify-content-between align-items-center">
                    <div>
                        @if (request()->routeIs('admin.dashboard'))
                            <h5 class="mb-0">Dashboard</h5>
                        @elseif(request()->routeIs('admin.products.*'))
                            <h5 class="mb-0">Products</h5>
                        @elseif(request()->routeIs('admin.orders.*'))
                            <h5 class="mb-0">Orders</h5>
                        @elseif(request()->routeIs('admin.contacts.*'))
                            <h5 class="mb-0">Contacts</h5>
                        @elseif(request()->routeIs('admin.newsletter.*'))
                            <h5 class="mb-0">Newsletter</h5>
                        @elseif(request()->routeIs('admin.resume.*'))
                            <h5 class="mb-0">Resume</h5>
                        @elseif(request()->routeIs('admin.feedback.*'))
                            <h5 class="mb-0">Feedback</h5>
                        @elseif(request()->routeIs('profile.edit'))
                            <h5 class="mb-0">Profile</h5>
                        @else
                            <h5 class="mb-0">{{ config('app.name') }}</h5>
                        @endif
                    </div>
                    <div>
                        <a href="{{ url()->previous() }}" class="btn btn-sm btn-outline-secondary">
                            <i class="ti ti-arrow-left"></i> Back
                        </a>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
