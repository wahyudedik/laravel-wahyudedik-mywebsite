@extends('layouts.app')

@section('header')
    <div class="d-flex justify-content-between align-items-center">
        <h2 class="fs-2 m-0">
            {{ __('Edit Product') }}: {{ $product->name }}
        </h2>
        <a href="{{ route('admin.products.index') }}" class="btn btn-outline-secondary">
            <i class="ti ti-arrow-left me-1"></i> Back to Products
        </a>
    </div>
@endsection

@section('content')
    <div class="card shadow-sm">
        <div class="card-body">
            <form action="{{ route('admin.products.update', $product) }}" method="POST" enctype="multipart/form-data">
                @csrf
                @method('PUT')

                <div class="row g-4">
                    <div class="col-md-6">
                        <div class="mb-3">
                            <label for="name" class="form-label required">Product Name</label>
                            <input type="text" class="form-control @error('name') is-invalid @enderror" 
                                id="name" name="name" value="{{ old('name', $product->name) }}" required autofocus>
                            @error('name')
                                <div class="invalid-feedback">{{ $message }}</div>
                            @enderror
                        </div>
                    </div>

                    <div class="col-md-6">
                        <div class="mb-3">
                            <label for="category" class="form-label required">Category</label>
                            <select class="form-select @error('category') is-invalid @enderror" 
                                id="category" name="category" required>
                                <option value="e-book" {{ old('category', $product->category) == 'e-book' ? 'selected' : '' }}>E-book</option>
                                <option value="template" {{ old('category', $product->category) == 'template' ? 'selected' : '' }}>Template</option>
                                <option value="application" {{ old('category', $product->category) == 'application' ? 'selected' : '' }}>Application</option>
                            </select>
                            @error('category')
                                <div class="invalid-feedback">{{ $message }}</div>
                            @enderror
                        </div>
                    </div>

                    <div class="col-md-6">
                        <div class="mb-3">
                            <label for="price_user" class="form-label required">User License Price ($)</label>
                            <input type="number" class="form-control @error('price_user') is-invalid @enderror" 
                                id="price_user" name="price_user" value="{{ old('price_user', $product->price_user) }}" 
                                step="0.01" min="0" required>
                            @error('price_user')
                                <div class="invalid-feedback">{{ $message }}</div>
                            @enderror
                        </div>
                    </div>

                    <div class="col-md-6">
                        <div class="mb-3">
                            <label for="price_developer" class="form-label required">Developer License Price ($)</label>
                            <input type="number" class="form-control @error('price_developer') is-invalid @enderror" 
                                id="price_developer" name="price_developer" value="{{ old('price_developer', $product->price_developer) }}" 
                                step="0.01" min="0" required>
                            @error('price_developer')
                                <div class="invalid-feedback">{{ $message }}</div>
                            @enderror
                        </div>
                    </div>

                    <div class="col-md-6">
                        <div class="mb-3">
                            <label for="demo_link" class="form-label">Demo Link (Optional)</label>
                            <input type="url" class="form-control @error('demo_link') is-invalid @enderror" 
                                id="demo_link" name="demo_link" value="{{ old('demo_link', $product->demo_link) }}" 
                                placeholder="https://example.com">
                            @error('demo_link')
                                <div class="invalid-feedback">{{ $message }}</div>
                            @enderror
                        </div>
                    </div>

                    <div class="col-md-6">
                        <div class="mb-3">
                            <label class="form-label d-block">Featured Product</label>
                            <div class="form-check">
                                <input class="form-check-input" type="checkbox" name="featured" 
                                    value="1" id="featured" {{ old('featured', $product->featured) ? 'checked' : '' }}>
                                <label class="form-check-label" for="featured">
                                    Yes, make this a featured product
                                </label>
                            </div>
                            @error('featured')
                                <div class="text-danger small mt-1">{{ $message }}</div>
                            @enderror
                        </div>
                    </div>

                    <div class="col-12">
                        <div class="mb-3">
                            <label for="description" class="form-label required">Product Description</label>
                            <textarea class="form-control @error('description') is-invalid @enderror" 
                                id="description" name="description" rows="5" required>{{ old('description', $product->description) }}</textarea>
                            @error('description')
                                <div class="invalid-feedback">{{ $message }}</div>
                            @enderror
                        </div>
                    </div>

                    <div class="col-md-6">
                        <div class="mb-3">
                            <label for="image" class="form-label">Product Image</label>
                            
                            @if ($product->image)
                                <div class="mb-3">
                                    <img src="{{ Storage::url($product->image) }}" alt="{{ $product->name }}"
                                        class="img-thumbnail" style="max-height: 150px;">
                                </div>
                            @endif
                            
                            <input type="file" class="form-control @error('image') is-invalid @enderror" 
                                id="image" name="image">
                            <div class="form-text">Upload a new image or leave empty to keep the current one. Max size: 2MB.</div>
                            @error('image')
                                <div class="invalid-feedback">{{ $message }}</div>
                            @enderror
                        </div>
                    </div>

                    <div class="col-md-6">
                        <div class="mb-3">
                            <label for="product_file" class="form-label">Product File</label>
                            <input type="file" class="form-control @error('product_file') is-invalid @enderror" 
                                id="product_file" name="product_file">
                            <div class="form-text">
                                Upload a new file or leave empty to keep the current one. Max size: 50MB.
                                @if ($product->file_path)
                                    <br>Current file: <span class="badge bg-success">{{ basename($product->file_path) }}</span>
                                @endif
                            </div>
                            @error('product_file')
                                <div class="invalid-feedback">{{ $message }}</div>
                            @enderror
                        </div>
                    </div>
                </div>

                <div class="d-flex justify-content-end mt-4">
                    <a href="{{ route('admin.products.index') }}" class="btn btn-outline-secondary me-2">Cancel</a>
                    <button type="submit" class="btn btn-primary">
                        <i class="ti ti-device-floppy me-1"></i> Update Product
                    </button>
                </div>
            </form>
        </div>
    </div>
@endsection
