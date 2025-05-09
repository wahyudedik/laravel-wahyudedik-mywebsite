@extends('layouts.app')

@section('header')
    <div class="d-flex justify-content-between align-items-center">
        <h2 class="fs-2 m-0">
            {{ __('Order Details') }}: {{ $order->order_number }}
        </h2>
        <a href="{{ route('admin.orders.index') }}" class="btn btn-outline-secondary">
            <i class="ti ti-arrow-left me-1"></i> Back to List
        </a>
    </div>
@endsection

@section('content')
    @if (session('success'))
        <div class="alert alert-success alert-dismissible fade show" role="alert">
            {{ session('success') }}
            <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
        </div>
    @endif

    <div class="row">
        <div class="col-md-8">
            <div class="card shadow-sm mb-4">
                <div class="card-body">
                    <div class="d-flex justify-content-between align-items-start mb-4">
                        <div>
                            <h3 class="card-title mb-1">Order #{{ $order->order_number }}</h3>
                            <p class="text-muted small">Placed on {{ $order->created_at->format('F d, Y \a\t h:i A') }}</p>
                        </div>
                        <span class="badge 
                            @if($order->status == 'completed') bg-success 
                            @elseif($order->status == 'paid') bg-info 
                            @elseif($order->status == 'pending') bg-warning 
                            @else bg-danger @endif">
                            {{ ucfirst($order->status) }}
                        </span>
                    </div>

                    <h5 class="mb-3">Customer Information</h5>
                    <div class="row bg-light rounded p-3 mb-4">
                        <div class="col-md-6 mb-3">
                            <p class="text-muted small mb-1">Name</p>
                            <p>{{ $order->name }}</p>
                        </div>
                        <div class="col-md-6 mb-3">
                            <p class="text-muted small mb-1">Email</p>
                            <p>{{ $order->email }}</p>
                        </div>
                        <div class="col-md-6 mb-3">
                            <p class="text-muted small mb-1">WhatsApp</p>
                            <p>{{ $order->whatsapp }}</p>
                        </div>
                        <div class="col-md-6 mb-3">
                            <p class="text-muted small mb-1">License Type</p>
                            <p>{{ ucfirst($order->license_type) }}</p>
                        </div>
                    </div>

                    <h5 class="mb-3">Product Information</h5>
                    <div class="d-flex bg-light rounded p-3 mb-4">
                        <div class="me-3">
                            @if ($order->product->image)
                                <img src="{{ Storage::url($order->product->image) }}" alt="{{ $order->product->name }}" 
                                    class="img-thumbnail" style="width: 80px; height: 80px; object-fit: cover;">
                            @else
                                <div class="bg-secondary d-flex align-items-center justify-content-center" 
                                    style="width: 80px; height: 80px;">
                                    <span class="text-white small">No Image</span>
                                </div>
                            @endif
                        </div>
                        <div>
                            <h5 class="mb-1">{{ $order->product->name }}</h5>
                            <p class="text-muted small mb-1">Category: {{ ucfirst($order->product->category) }}</p>
                            <p class="text-muted small mb-0">Price: ${{ number_format($order->amount, 2) }}</p>
                        </div>
                    </div>

                    @if ($order->notes)
                        <h5 class="mb-3">Notes</h5>
                        <div class="bg-light rounded p-3 mb-4">
                            <p class="mb-0">{{ $order->notes }}</p>
                        </div>
                    @endif

                    <h5 class="mb-3">Update Order Status</h5>
                    <div class="bg-light rounded p-3">
                        <form action="{{ route('admin.orders.update', $order) }}" method="POST">
                            @csrf
                            @method('PUT')
                            
                            <div class="mb-3">
                                <label for="status" class="form-label">Status</label>
                                <select id="status" name="status" class="form-select">
                                    <option value="pending" {{ $order->status == 'pending' ? 'selected' : '' }}>Pending</option>
                                    <option value="paid" {{ $order->status == 'paid' ? 'selected' : '' }}>Paid</option>
                                    <option value="completed" {{ $order->status == 'completed' ? 'selected' : '' }}>Completed</option>
                                    <option value="cancelled" {{ $order->status == 'cancelled' ? 'selected' : '' }}>Cancelled</option>
                                </select>
                            </div>
                            
                            <div class="mb-3">
                                <label for="notes" class="form-label">Admin Notes</label>
                                <textarea id="notes" name="notes" rows="3" class="form-control">{{ $order->notes }}</textarea>
                                <div class="form-text">These notes are for internal use only.</div>
                            </div>
                            
                            <div class="text-end">
                                <button type="submit" class="btn btn-primary">
                                    <i class="ti ti-device-floppy me-1"></i> Update Order
                                </button>
                            </div>
                        </form>
                    </div>
                </div>
            </div>
        </div>

        <div class="col-md-4">
            <div class="card shadow-sm mb-4">
                <div class="card-body">
                    <h5 class="card-title mb-3">Payment Details</h5>
                    <div class="mb-4">
                        <p class="text-muted small mb-1">Amount</p>
                        <p class="fs-4 fw-bold">${{ number_format($order->amount, 2) }}</p>
                    </div>

                    @if ($order->payment_proof)
                        <div class="mb-4">
                            <p class="text-muted small mb-2">Payment Proof</p>
                            <a href="{{ Storage::url($order->payment_proof) }}" target="_blank">
                                <img src="{{ Storage::url($order->payment_proof) }}" alt="Payment Proof" 
                                    class="img-fluid rounded border mb-2">
                            </a>
                            @if($order->payment_proof_uploaded_at && !is_string($order->payment_proof_uploaded_at))
                                <p class="text-muted small">Uploaded on {{ $order->payment_proof_uploaded_at->format('M d, Y \a\t h:i A') }}</p>
                            @elseif($order->payment_proof_uploaded_at)
                                <p class="text-muted small">Uploaded on {{ $order->payment_proof_uploaded_at }}</p>
                            @else
                                <p class="text-muted small">Upload date not recorded</p>
                            @endif
                        </div> 
                    @else
                        <div class="alert alert-warning mb-4" role="alert">
                            <i class="ti ti-alert-triangle me-1"></i> No payment proof has been uploaded yet.
                        </div>
                    @endif

                    <h5 class="mb-3">Actions</h5>
                    <div class="d-grid gap-2 mb-4">
                        <a href="https://wa.me/{{ preg_replace('/[^0-9]/', '', $order->whatsapp) }}" target="_blank" 
                            class="btn btn-success">
                            <i class="ti ti-brand-whatsapp me-1"></i> Contact on WhatsApp
                        </a>
                        
                        <a href="mailto:{{ $order->email }}" class="btn btn-info">
                            <i class="ti ti-mail me-1"></i> Send Email
                        </a>
                    </div>

                    <h5 class="mb-3">Order Timeline</h5>
                    <div class="position-relative">
                        <!-- Order Created -->
                        <div class="d-flex mb-3">
                            <div class="position-relative me-3">
                                <div class="bg-primary rounded-circle d-flex align-items-center justify-content-center" 
                                    style="width: 32px; height: 32px; z-index: 1;">
                                    <i class="ti ti-clock text-white"></i>
                                </div>
                                <div class="position-absolute top-100 start-50 translate-middle-x border-start border-2" 
                                    style="height: 30px; z-index: 0;"></div>
                            </div>
                            <div>
                                <p class="fw-medium mb-0">Order Created</p>
                                <p class="text-muted small">{{ $order->created_at->format('M d, Y \a\t h:i A') }}</p>
                            </div>
                        </div>

                        <!-- Payment Proof Uploaded -->
                        @if ($order->payment_proof_uploaded_at)
                            <div class="d-flex mb-3">
                                <div class="position-relative me-3">
                                    <div class="bg-success rounded-circle d-flex align-items-center justify-content-center" 
                                        style="width: 32px; height: 32px; z-index: 1;">
                                        <i class="ti ti-receipt text-white"></i>
                                    </div>
                                    <div class="position-absolute top-100 start-50 translate-middle-x border-start border-2" 
                                        style="height: 30px; z-index: 0;"></div>
                                </div>
                                <div>
                                    <p class="fw-medium mb-0">Payment Proof Uploaded</p>
                                    <p class="text-muted small">{{ $order->payment_proof_uploaded_at->format('M d, Y \a\t h:i A') }}</p>
                                </div>
                            </div>
                        @endif

                        <!-- Payment Verified -->
                        @if ($order->status == 'paid' || $order->status == 'completed')
                            <div class="d-flex mb-3">
                                <div class="position-relative me-3">
                                    <div class="bg-info rounded-circle d-flex align-items-center justify-content-center" 
                                        style="width: 32px; height: 32px; z-index: 1;">
                                        <i class="ti ti-check text-white"></i>
                                    </div>
                                    @if ($order->status == 'completed')
                                        <div class="position-absolute top-100 start-50 translate-middle-x border-start border-2" 
                                            style="height: 30px; z-index: 0;"></div>
                                    @endif
                                </div>
                                <div>
                                    <p class="fw-medium mb-0">Payment Verified</p>
                                    <p class="text-muted small">{{ $order->updated_at->format('M d, Y \a\t h:i A') }}</p>
                                </div>
                            </div>
                        @endif

                        <!-- Order Completed -->
                        @if ($order->status == 'completed')
                            <div class="d-flex mb-3">
                                <div class="position-relative me-3">
                                    <div class="bg-success rounded-circle d-flex align-items-center justify-content-center" 
                                        style="width: 32px; height: 32px; z-index: 1;">
                                        <i class="ti ti-download text-white"></i>
                                    </div>
                                </div>
                                <div>
                                    <p class="fw-medium mb-0">Order Completed</p>
                                    <p class="text-muted small">{{ $order->updated_at->format('M d, Y \a\t h:i A') }}</p>
                                </div>
                            </div>
                        @endif

                        <!-- Order Cancelled -->
                        @if ($order->status == 'cancelled')
                            <div class="d-flex">
                                <div class="position-relative me-3">
                                    <div class="bg-danger rounded-circle d-flex align-items-center justify-content-center" 
                                        style="width: 32px; height: 32px; z-index: 1;">
                                        <i class="ti ti-x text-white"></i>
                                    </div>
                                </div>
                                <div>
                                    <p class="fw-medium mb-0">Order Cancelled</p>
                                    <p class="text-muted small">{{ $order->updated_at->format('M d, Y \a\t h:i A') }}</p>
                                </div>
                            </div>
                        @endif
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection
