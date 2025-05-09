@extends('layouts.app')

@section('header')
    <div class="d-flex justify-content-between align-items-center">
        <h2 class="fs-2 m-0">
            {{ __('Product Details') }}
        </h2>
        <div>
            <a href="{{ route('admin.products.edit', $product) }}" class="btn btn-info me-2">
                <i class="ti ti-edit me-1"></i> Edit Product
            </a>
            <a href="{{ route('admin.products.index') }}" class="btn btn-outline-secondary">
                <i class="ti ti-arrow-left me-1"></i> Back to List
            </a>
        </div>
    </div>
@endsection

@section('content')
    <div class="row">
        <div class="col-md-4">
            <div class="card shadow-sm mb-4">
                <div class="card-body">
                    @if ($product->image)
                        <img src="{{ Storage::url($product->image) }}" alt="{{ $product->name }}" 
                            class="img-fluid rounded mb-3 w-100">
                    @else
                        <div class="bg-light d-flex align-items-center justify-content-center rounded mb-3" 
                            style="height: 200px;">
                            <i class="ti ti-photo-off fs-1 text-muted"></i>
                        </div>
                    @endif

                    <div class="bg-light rounded p-3 mb-3">
                        <h5 class="mb-3">Quick Info</h5>
                        <div class="mb-2 d-flex justify-content-between">
                            <span class="text-muted">Category:</span>
                            <span class="fw-medium">{{ ucfirst($product->category) }}</span>
                        </div>
                        <div class="mb-2 d-flex justify-content-between">
                            <span class="text-muted">User License:</span>
                            <span class="fw-medium">${{ number_format($product->price_user, 2) }}</span>
                        </div>
                        <div class="mb-2 d-flex justify-content-between">
                            <span class="text-muted">Developer License:</span>
                            <span class="fw-medium">${{ number_format($product->price_developer, 2) }}</span>
                        </div>
                        <div class="mb-2 d-flex justify-content-between">
                            <span class="text-muted">Featured:</span>
                            <span class="fw-medium">{{ $product->featured ? 'Yes' : 'No' }}</span>
                        </div>
                        <div class="mb-2 d-flex justify-content-between">
                            <span class="text-muted">Created:</span>
                            <span class="fw-medium">{{ $product->created_at->format('M d, Y') }}</span>
                        </div>
                        <div class="d-flex justify-content-between">
                            <span class="text-muted">Last Updated:</span>
                            <span class="fw-medium">{{ $product->updated_at->format('M d, Y') }}</span>
                        </div>
                    </div>

                    @if ($product->demo_link)
                        <a href="{{ $product->demo_link }}" target="_blank" class="btn btn-primary w-100">
                            <i class="ti ti-player-play me-1"></i> View Demo
                        </a>
                    @endif
                </div>
            </div>
        </div>

        <div class="col-md-8">
            <div class="card shadow-sm mb-4">
                <div class="card-body">
                    <h3 class="card-title mb-4">{{ $product->name }}</h3>
                    
                    <h5 class="mb-3">Description</h5>
                    <div class="bg-light rounded p-3 mb-4">
                        <p class="mb-0">{{ $product->description }}</p>
                    </div>

                    <h5 class="mb-3">Recent Orders</h5>
                    @if($product->orders->count() > 0)
                        <div class="table-responsive">
                            <table class="table table-hover">
                                <thead>
                                    <tr>
                                        <th>Order #</th>
                                        <th>Customer</th>
                                        <th>License</th>
                                        <th>Amount</th>
                                        <th>Status</th>
                                        <th>Date</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    @foreach($product->orders->take(5) as $order)
                                        <tr>
                                            <td>
                                                <a href="{{ route('admin.orders.show', $order) }}" class="text-decoration-none">
                                                    {{ $order->order_number }}
                                                </a>
                                            </td>
                                            <td>{{ $order->name }}</td>
                                            <td>{{ ucfirst($order->license_type) }}</td>
                                            <td>${{ number_format($order->amount, 2) }}</td>
                                            <td>
                                                <span class="badge 
                                                    @if($order->status == 'completed') bg-success 
                                                    @elseif($order->status == 'paid') bg-info 
                                                    @elseif($order->status == 'pending') bg-warning 
                                                    @else bg-danger @endif">
                                                    {{ ucfirst($order->status) }}
                                                </span>
                                            </td>
                                            <td>{{ $order->created_at->format('M d, Y') }}</td>
                                        </tr>
                                    @endforeach
                                </tbody>
                            </table>
                        </div>
                        @if($product->orders->count() > 5)
                            <div class="text-end">
                                <a href="{{ route('admin.orders.index', ['product_id' => $product->id]) }}" 
                                    class="text-decoration-none">
                                    View all orders <i class="ti ti-arrow-right ms-1"></i>
                                </a>
                            </div>
                        @endif
                    @else
                        <div class="text-center py-4">
                            <i class="ti ti-shopping-cart-off fs-1 text-muted mb-3"></i>
                            <p class="text-muted">No orders yet for this product.</p>
                        </div>
                    @endif
                </div>
            </div>
        </div>
    </div>
@endsection