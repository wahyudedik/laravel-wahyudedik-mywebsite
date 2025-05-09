@extends('layouts.app')

@section('header')
    <h2 class="fs-2 m-0">
        {{ __('Orders') }}
    </h2>
@endsection

@section('content')
    <div class="card shadow-sm">
        <div class="card-body">
            @if (session('success'))
                <div class="alert alert-success alert-dismissible fade show" role="alert">
                    {{ session('success') }}
                    <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
                </div>
            @endif

            <!-- Filters -->
            <div class="bg-light rounded p-3 mb-4">
                <form action="{{ route('admin.orders.index') }}" method="GET">
                    <div class="row g-3">
                        <div class="col-md-3">
                            <label for="status" class="form-label">Status</label>
                            <select id="status" name="status" class="form-select">
                                <option value="">All Statuses</option>
                                <option value="pending" {{ request('status') == 'pending' ? 'selected' : '' }}>Pending</option>
                                <option value="paid" {{ request('status') == 'paid' ? 'selected' : '' }}>Paid</option>
                                <option value="completed" {{ request('status') == 'completed' ? 'selected' : '' }}>Completed</option>
                                <option value="cancelled" {{ request('status') == 'cancelled' ? 'selected' : '' }}>Cancelled</option>
                            </select>
                        </div>
                        <div class="col-md-3">
                            <label for="product_id" class="form-label">Product</label>
                            <select id="product_id" name="product_id" class="form-select">
                                <option value="">All Products</option>
                                @foreach(\App\Models\Product::orderBy('name')->get() as $product)
                                    <option value="{{ $product->id }}" {{ request('product_id') == $product->id ? 'selected' : '' }}>{{ $product->name }}</option>
                                @endforeach
                            </select>
                        </div>
                        <div class="col-md-3">
                            <label for="search" class="form-label">Search</label>
                            <input type="text" id="search" name="search" value="{{ request('search') }}" 
                                placeholder="Order #, name, email..." class="form-control">
                        </div>
                        <div class="col-md-3 d-flex align-items-end">
                            <button type="submit" class="btn btn-primary me-2">
                                <i class="ti ti-filter me-1"></i> Filter
                            </button>
                            <a href="{{ route('admin.orders.index') }}" class="btn btn-outline-secondary">
                                <i class="ti ti-refresh me-1"></i> Reset
                            </a>
                        </div>
                    </div>
                </form>
            </div>

            <div class="table-responsive">
                <table class="table table-hover">
                    <thead>
                        <tr>
                            <th>Order #</th>
                            <th>Customer</th>
                            <th>Product</th>
                            <th>License</th>
                            <th>Amount</th>
                            <th>Status</th>
                            <th>Date</th>
                            <th width="80">Actions</th>
                        </tr>
                    </thead>
                    <tbody>
                        @forelse ($orders as $order)
                            <tr>
                                <td>{{ $order->order_number }}</td>
                                <td>
                                    <div>{{ $order->name }}</div>
                                    <div class="small text-muted">{{ $order->email }}</div>
                                    <div class="small text-muted">{{ $order->whatsapp }}</div>
                                </td>
                                <td>{{ $order->product->name }}</td>
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
                                <td>
                                    <a href="{{ route('admin.orders.show', $order) }}" class="btn btn-sm btn-outline-primary">
                                        <i class="ti ti-eye"></i>
                                    </a>
                                </td>
                            </tr>
                        @empty
                            <tr>
                                <td colspan="8" class="text-center py-4">
                                    <div class="d-flex flex-column align-items-center">
                                        <i class="ti ti-shopping-cart-off fs-1 text-muted mb-3"></i>
                                        <p class="text-muted">No orders found.</p>
                                    </div>
                                </td>
                            </tr>
                        @endforelse
                    </tbody>
                </table>
            </div>

            <div class="mt-4">
                {{ $orders->links() }}
            </div>
        </div>
    </div>
@endsection