@extends('layouts.app')

@section('header')
    <h2 class="fs-4 fw-semibold text-body">
        {{ __('Dashboard') }}
    </h2>
@endsection

@section('content')
    <div class="py-4">
        <div class="container">
            <!-- Stats Cards Row 1 -->
            <div class="row g-4 mb-4">
                <!-- Total Contacts Card -->
                <div class="col-md-6 col-lg-3">
                    <div class="card">
                        <div class="card-body">
                            <div class="text-muted small fw-medium">Total Contacts</div>
                            <div class="fs-1 fw-bold">
                                {{ \App\Models\Contact::count() }}
                            </div> 
                        </div>
                    </div>
                </div>

                <!-- Unread Contacts Card -->
                <div class="col-md-6 col-lg-3">
                    <div class="card">
                        <div class="card-body">
                            <div class="text-muted small fw-medium">Unread Messages</div>
                            <div class="fs-1 fw-bold">
                                {{ \App\Models\Contact::where('is_read', false)->count() }}
                            </div>
                        </div>
                    </div>
                </div>

                <!-- Newsletter Subscribers Card -->
                <div class="col-md-6 col-lg-3">
                    <div class="card">
                        <div class="card-body">
                            <div class="text-muted small fw-medium">Newsletter Subscribers</div>
                            <div class="fs-1 fw-bold">
                                {{ \App\Models\Newsletter::where('is_active', true)->count() }}
                            </div>
                        </div>
                    </div>
                </div>

                <!-- Recent Contacts Card -->
                <div class="col-md-6 col-lg-3">
                    <div class="card">
                        <div class="card-body">
                            <div class="text-muted small fw-medium">Recent Contacts (7 days)</div>
                            <div class="fs-1 fw-bold">
                                {{ \App\Models\Contact::where('created_at', '>=', now()->subDays(7))->count() }}
                            </div>
                        </div>
                    </div>
                </div>
            </div>

            <!-- Products & Orders Stats -->
            <div class="row g-4 mb-4">
                <!-- Total Products Card -->
                <div class="col-md-6 col-lg-3">
                    <div class="card">
                        <div class="card-body">
                            <div class="text-muted small fw-medium">Total Products</div>
                            <div class="fs-1 fw-bold">
                                {{ \App\Models\Product::count() }}
                            </div>
                        </div>
                    </div>
                </div>

                <!-- Total Orders Card -->
                <div class="col-md-6 col-lg-3">
                    <div class="card">
                        <div class="card-body">
                            <div class="text-muted small fw-medium">Total Orders</div>
                            <div class="fs-1 fw-bold">
                                {{ \App\Models\Order::count() }}
                            </div>
                        </div>
                    </div>
                </div>

                <!-- Pending Orders Card -->
                <div class="col-md-6 col-lg-3">
                    <div class="card">
                        <div class="card-body">
                            <div class="text-muted small fw-medium">Pending Orders</div>
                            <div class="fs-1 fw-bold">
                                {{ \App\Models\Order::where('status', 'pending')->count() }}
                            </div>
                        </div>
                    </div>
                </div>

                <!-- Revenue Card -->
                <div class="col-md-6 col-lg-3">
                    <div class="card">
                        <div class="card-body">
                            <div class="text-muted small fw-medium">Total Revenue</div>
                            <div class="fs-1 fw-bold">
                                ${{ number_format(\App\Models\Order::where('status', 'completed')->sum('amount'), 2) }}
                            </div>
                        </div>
                    </div>
                </div>
            </div>

            <div class="row g-4 mb-4">
                <!-- Recent Messages -->
                <div class="col-md-6">
                    <div class="card">
                        <div class="card-body">
                            <h3 class="card-title">Recent Messages</h3>

                            @php
                                $recentContacts = \App\Models\Contact::orderBy('created_at', 'desc')->take(5)->get();
                            @endphp

                            @if ($recentContacts->isEmpty())
                                <p class="text-muted">No messages yet.</p>
                            @else
                                <div class="list-group list-group-flush">
                                    @foreach ($recentContacts as $contact)
                                        <div class="list-group-item px-0">
                                            <div class="d-flex justify-content-between align-items-start">
                                                <div>
                                                    <h5 class="mb-1">{{ $contact->name }}</h5>
                                                    <p class="mb-1 text-muted small">{{ $contact->subject }}</p>
                                                </div>
                                                <span class="badge bg-light text-muted">{{ $contact->created_at->diffForHumans() }}</span>
                                            </div>
                                            <div class="mt-2">
                                                <a href="{{ route('admin.contacts.show', $contact->id) }}" class="btn btn-sm btn-outline-primary">
                                                    View Message
                                                </a>
                                            </div>
                                        </div>
                                    @endforeach
                                </div>

                                <div class="mt-3">
                                    <a href="{{ route('admin.contacts.index') }}" class="btn btn-link ps-0">
                                        View All Messages →
                                    </a>
                                </div>
                            @endif
                        </div>
                    </div>
                </div>

                <!-- Recent Subscribers -->
                <div class="col-md-6">
                    <div class="card">
                        <div class="card-body">
                            <h3 class="card-title">Recent Subscribers</h3>

                            @php
                                $recentSubscribers = \App\Models\Newsletter::orderBy('created_at', 'desc')->take(5)->get();
                            @endphp

                            @if ($recentSubscribers->isEmpty())
                                <p class="text-muted">No subscribers yet.</p>
                            @else
                                <div class="list-group list-group-flush">
                                    @foreach ($recentSubscribers as $subscriber)
                                        <div class="list-group-item px-0">
                                            <div class="d-flex justify-content-between align-items-start">
                                                <div>
                                                    <h5 class="mb-1">{{ $subscriber->email }}</h5>
                                                    <p class="mb-1">
                                                        @if ($subscriber->is_active)
                                                            <span class="badge bg-success">Active</span>
                                                        @else
                                                            <span class="badge bg-danger">Inactive</span>
                                                        @endif
                                                    </p>
                                                </div>
                                                <span class="badge bg-light text-muted">{{ $subscriber->created_at->diffForHumans() }}</span>
                                            </div>
                                        </div>
                                    @endforeach
                                </div>

                                <div class="mt-3">
                                    <a href="{{ route('admin.newsletter.index') }}" class="btn btn-link ps-0">
                                        View All Subscribers →
                                    </a>
                                </div>
                            @endif
                        </div>
                    </div>
                </div>
            </div>

            <!-- Recent Orders & Popular Products -->
            <div class="row g-4 mb-4">
                <!-- Recent Orders -->
                <div class="col-md-6">
                    <div class="card">
                        <div class="card-body">
                            <h3 class="card-title">Recent Orders</h3>

                            @php
                                $recentOrders = \App\Models\Order::with('product')->orderBy('created_at', 'desc')->take(5)->get();
                            @endphp

                            @if ($recentOrders->isEmpty())
                                <p class="text-muted">No orders yet.</p>
                            @else
                                <div class="list-group list-group-flush">
                                    @foreach ($recentOrders as $order)
                                        <div class="list-group-item px-0">
                                            <div class="d-flex justify-content-between align-items-start">
                                                <div>
                                                    <h5 class="mb-1">Order #{{ $order->order_number }}</h5>
                                                    <p class="mb-1 text-muted small">
                                                        {{ $order->product->name }} ({{ ucfirst($order->license_type) }} License)
                                                    </p>
                                                    <p class="mb-1 small">
                                                        ${{ number_format($order->amount, 2) }} - 
                                                        <span class="
                                                            @if($order->status == 'completed') badge bg-success
                                                            @elseif($order->status == 'paid') badge bg-info
                                                            @elseif($order->status == 'pending') badge bg-warning
                                                            @else badge bg-danger @endif
                                                        ">
                                                            {{ ucfirst($order->status) }}
                                                        </span>
                                                    </p>
                                                </div>
                                                <span class="badge bg-light text-muted">{{ $order->created_at->diffForHumans() }}</span>
                                            </div>
                                            <div class="mt-2">
                                                <a href="{{ route('admin.orders.show', $order->id) }}" class="btn btn-sm btn-outline-primary">
                                                    View Order
                                                </a>
                                            </div>
                                        </div>
                                    @endforeach
                                </div>

                                <div class="mt-3">
                                    <a href="{{ route('admin.orders.index') }}" class="btn btn-link ps-0">
                                        View All Orders →
                                    </a>
                                </div>
                            @endif
                        </div>
                    </div>
                </div>

                <!-- Popular Products -->
                <div class="col-md-6">
                    <div class="card">
                        <div class="card-body">
                            <h3 class="card-title">Popular Products</h3>

                            @php
                                $popularProducts = \App\Models\Product::orderBy('reviews_count', 'desc')->take(5)->get();
                            @endphp

                            @if ($popularProducts->isEmpty())
                                <p class="text-muted">No products yet.</p>
                            @else
                                <div class="list-group list-group-flush">
                                    @foreach ($popularProducts as $product)
                                        <div class="list-group-item px-0">
                                            <div class="d-flex justify-content-between align-items-start">
                                                <div class="d-flex align-items-center">
                                                    @if ($product->image)
                                                        <img src="{{ Storage::url($product->image) }}" alt="{{ $product->name }}" class="rounded me-3" style="width: 40px; height: 40px; object-fit: cover;">
                                                    @else
                                                        <div class="rounded me-3 bg-light d-flex align-items-center justify-content-center" style="width: 40px; height: 40px;">
                                                            <i class="ti ti-photo text-muted"></i>
                                                        </div>
                                                    @endif
                                                    <div>
                                                        <h5 class="mb-1">{{ $product->name }}</h5>
                                                        <p class="mb-1 text-muted small">
                                                            {{ ucfirst($product->category) }} - ${{ number_format($product->price_user, 2) }}
                                                        </p>
                                                    </div>
                                                </div>
                                                <div class="d-flex align-items-center">
                                                    <span class="text-warning me-1">
                                                        <i class="ti ti-star-filled"></i>
                                                    </span>
                                                    <span class="small text-muted">
                                                        {{ number_format($product->average_rating, 1) }} ({{ $product->reviews_count }})
                                                    </span>
                                                </div>
                                            </div>
                                            <div class="mt-2">
                                                <a href="{{ route('admin.products.edit', $product->id) }}" class="btn btn-sm btn-outline-primary">
                                                    Edit Product
                                                </a>
                                            </div>
                                        </div>
                                    @endforeach
                                </div>

                                <div class="mt-3">
                                    <a href="{{ route('admin.products.index') }}" class="btn btn-link ps-0">
                                        View All Products →
                                    </a>
                                </div>
                            @endif
                        </div>
                    </div>
                </div>
            </div>

            <!-- Sales Analytics -->
            <div class="card mb-4">
                <div class="card-body">
                    <h3 class="card-title">Sales Analytics</h3>
                    
                    <div class="row g-4">
                        <!-- Sales by Category -->
                        <div class="col-md-4">
                            <div class="card border">
                                <div class="card-body">
                                    <h4 class="card-title h5">Sales by Category</h4>
                                    
                                    @php
                                        $categorySales = \App\Models\Order::where('status', 'completed')
                                            ->join('products', 'orders.product_id', '=', 'products.id')
                                            ->selectRaw('products.category, COUNT(*) as count, SUM(orders.amount) as total')
                                            ->groupBy('products.category')
                                            ->get();
                                    @endphp
                                    
                                    @if($categorySales->isEmpty())
                                        <p class="text-muted">No sales data available.</p>
                                    @else
                                        <div class="d-flex flex-column gap-3">
                                            @foreach($categorySales as $category)
                                                <div>
                                                    <div class="d-flex justify-content-between align-items-center mb-1">
                                                        <span class="small text-body">{{ ucfirst($category->category) }}</span>
                                                        <span class="small fw-medium">${{ number_format($category->total, 2) }}</span>
                                                    </div>
                                                    <div class="progress" style="height: 6px;">
                                                        <div class="progress-bar bg-primary" role="progressbar" 
                                                             style="width: {{ min(100, ($category->total / $categorySales->sum('total') * 100)) }}%" 
                                                             aria-valuenow="{{ min(100, ($category->total / $categorySales->sum('total') * 100)) }}" 
                                                             aria-valuemin="0" aria-valuemax="100"></div>
                                                    </div>
                                                </div>
                                            @endforeach
                                        </div>
                                    @endif
                                </div>
                            </div>
                        </div>
                        
                        <!-- Sales by License Type -->
                        <div class="col-md-4">
                            <div class="card border">
                                <div class="card-body">
                                    <h4 class="card-title h5">Sales by License</h4>
                                    
                                    @php
                                        $licenseSales = \App\Models\Order::where('status', 'completed')
                                            ->selectRaw('license_type, COUNT(*) as count, SUM(amount) as total')
                                            ->groupBy('license_type')
                                            ->get();
                                    @endphp
                                    
                                    @if($licenseSales->isEmpty())
                                        <p class="text-muted">No sales data available.</p>
                                    @else
                                        <div class="d-flex flex-column gap-3">
                                            @foreach($licenseSales as $license)
                                                <div>
                                                    <div class="d-flex justify-content-between align-items-center mb-1">
                                                        <span class="small text-body">{{ ucfirst($license->license_type) }}</span>
                                                        <span class="small fw-medium">${{ number_format($license->total, 2) }}</span>
                                                    </div>
                                                    <div class="progress" style="height: 6px;">
                                                        <div class="progress-bar bg-success" role="progressbar" 
                                                             style="width: {{ min(100, ($license->total / $licenseSales->sum('total') * 100)) }}%" 
                                                             aria-valuenow="{{ min(100, ($license->total / $licenseSales->sum('total') * 100)) }}" 
                                                             aria-valuemin="0" aria-valuemax="100"></div>
                                                    </div>
                                                </div>
                                            @endforeach
                                        </div>
                                    @endif
                                </div>
                            </div>
                        </div>
                        
                        <!-- Monthly Sales -->
                        <div class="col-md-4">
                            <div class="card border">
                                <div class="card-body">
                                    <h4 class="card-title h5">Monthly Sales</h4>
                                    
                                    @php
                                        $monthlySales = \App\Models\Order::where('status', 'completed')
                                            ->where('created_at', '>=', now()->subMonths(3))
                                            ->selectRaw('MONTH(created_at) as month, YEAR(created_at) as year, SUM(amount) as total')
                                            ->groupBy('year', 'month')
                                            ->orderBy('year', 'desc')
                                            ->orderBy('month', 'desc')
                                            ->get()
                                            ->map(function($item) {
                                                $date = \Carbon\Carbon::createFromDate($item->year, $item->month, 1);
                                                return [
                                                    'month' => $date->format('M Y'),
                                                    'total' => $item->total
                                                ];
                                            });
                                    @endphp
                                    
                                    @if($monthlySales->isEmpty())
                                        <p class="text-muted">No sales data available.</p>
                                    @else
                                        <div class="d-flex flex-column gap-3">
                                            @foreach($monthlySales as $month)
                                                <div>
                                                    <div class="d-flex justify-content-between align-items-center mb-1">
                                                        <span class="small text-body">{{ $month['month'] }}</span>
                                                        <span class="small fw-medium">${{ number_format($month['total'], 2) }}</span>
                                                    </div>
                                                    <div class="progress" style="height: 6px;">
                                                        <div class="progress-bar bg-info" role="progressbar" 
                                                             style="width: {{ min(100, ($month['total'] / $monthlySales->max('total') * 100)) }}%" 
                                                             aria-valuenow="{{ min(100, ($month['total'] / $monthlySales->max('total') * 100)) }}" 
                                                             aria-valuemin="0" aria-valuemax="100"></div>
                                                    </div>
                                                </div>
                                            @endforeach
                                        </div>
                                    @endif
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection

@section('scripts')
<script>
    document.addEventListener('DOMContentLoaded', function() {
        // Any dashboard-specific JavaScript can go here
        console.log('Dashboard loaded');
    });
</script>
@endsection
