@extends('layouts.app')

@section('header')
    <div class="d-flex justify-content-between align-items-center">
        <h2 class="fs-2 m-0">
            {{ __('Products') }}
        </h2>
        <a href="{{ route('admin.products.create') }}" class="btn btn-primary">
            <i class="ti ti-plus me-1"></i> Add New Product
        </a>
    </div>
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

            <div class="table-responsive">
                <table class="table table-hover">
                    <thead>
                        <tr>
                            <th width="80">Image</th>
                            <th>Name</th>
                            <th>Category</th>
                            <th>User Price</th>
                            <th>Dev Price</th>
                            <th>Featured</th>
                            <th width="150">Actions</th>
                        </tr>
                    </thead>
                    <tbody>
                        @forelse ($products as $product)
                            <tr>
                                <td>
                                    @if ($product->image)
                                        <img src="{{ Storage::url($product->image) }}" alt="{{ $product->name }}" 
                                            class="img-thumbnail" style="width: 50px; height: 50px; object-fit: cover;">
                                    @else
                                        <div class="bg-light d-flex align-items-center justify-content-center" 
                                            style="width: 50px; height: 50px;">
                                            <i class="ti ti-photo-off text-muted"></i>
                                        </div>
                                    @endif
                                </td>
                                <td>{{ $product->name }}</td>
                                <td>
                                    <span class="badge 
                                        @if ($product->category == 'e-book') bg-info
                                        @elseif($product->category == 'template') bg-purple 
                                        @else bg-success @endif">
                                        {{ ucfirst($product->category) }}
                                    </span>
                                </td>
                                <td>${{ number_format($product->price_user, 2) }}</td>
                                <td>${{ number_format($product->price_developer, 2) }}</td>
                                <td>
                                    @if ($product->featured)
                                        <span class="badge bg-success">Yes</span>
                                    @else
                                        <span class="badge bg-secondary">No</span>
                                    @endif
                                </td>
                                <td>
                                    <div class="btn-group btn-group-sm">
                                        <a href="{{ route('admin.products.show', $product) }}" class="btn btn-outline-primary">
                                            <i class="ti ti-eye"></i>
                                        </a>
                                        <a href="{{ route('admin.products.edit', $product) }}" class="btn btn-outline-info">
                                            <i class="ti ti-edit"></i>
                                        </a>
                                        <button type="button" class="btn btn-outline-danger" 
                                            onclick="deleteProduct('{{ $product->id }}', '{{ $product->name }}')">
                                            <i class="ti ti-trash"></i>
                                        </button>
                                    </div>
                                    <form id="delete-form-{{ $product->id }}" 
                                        action="{{ route('admin.products.destroy', $product) }}" 
                                        method="POST" class="d-none">
                                        @csrf
                                        @method('DELETE')
                                    </form>
                                </td>
                            </tr>
                        @empty
                            <tr>
                                <td colspan="7" class="text-center py-4">
                                    <div class="d-flex flex-column align-items-center">
                                        <i class="ti ti-shopping-cart-off fs-1 text-muted mb-3"></i>
                                        <p class="text-muted">No products found.</p>
                                        <a href="{{ route('admin.products.create') }}" class="btn btn-sm btn-primary mt-2">
                                            Add your first product
                                        </a>
                                    </div>
                                </td>
                            </tr>
                        @endforelse
                    </tbody>
                </table>
            </div>

            <div class="mt-4">
                {{ $products->links() }}
            </div>
        </div>
    </div>
@endsection

@section('scripts')
<script>
    function deleteProduct(id, name) {
        Swal.fire({
            title: 'Are you sure?',
            text: `You want to delete "${name}"?`,
            icon: 'warning',
            showCancelButton: true,
            confirmButtonColor: '#dc3545',
            cancelButtonColor: '#6c757d',
            confirmButtonText: 'Yes, delete it!',
            cancelButtonText: 'Cancel'
        }).then((result) => {
            if (result.isConfirmed) {
                document.getElementById('delete-form-' + id).submit();
            }
        });
    }
</script>
@endsection
