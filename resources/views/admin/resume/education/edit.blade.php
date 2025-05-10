@extends('layouts.app')

@section('header')
    <h2 class="fs-2 m-0">
        {{ __('Edit Education for') }} {{ $resume->full_name }}
    </h2>
@endsection

@section('content')
    @if (session('error'))
        <div class="alert alert-danger alert-dismissible fade show" role="alert">
            {{ session('error') }}
            <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
        </div>
    @endif
    
    @if (session('success'))
        <div class="alert alert-success alert-dismissible fade show" role="alert">
            {{ session('success') }}
            <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
        </div>
    @endif

    <div class="card shadow-sm">
        <div class="card-body">
            <form method="POST" action="{{ route('admin.resume.education.update', [$resume, $education]) }}">
                @csrf
                @method('PUT')

                <div class="row">
                    <div class="col-md-6">
                        <div class="mb-3">
                            <label for="degree" class="form-label required">Degree/Certificate</label>
                            <input type="text" class="form-control @error('degree') is-invalid @enderror" 
                                id="degree" name="degree" value="{{ old('degree', $education->degree) }}" required>
                            @error('degree')
                                <div class="invalid-feedback">{{ $message }}</div>
                            @enderror
                        </div>

                        <div class="mb-3">
                            <label for="institution" class="form-label required">Institution</label>
                            <input type="text" class="form-control @error('institution') is-invalid @enderror" 
                                id="institution" name="institution" value="{{ old('institution', $education->institution) }}" required>
                            @error('institution')
                                <div class="invalid-feedback">{{ $message }}</div>
                            @enderror
                        </div>

                        <div class="mb-3">
                            <label for="start_date" class="form-label required">Start Date</label>
                            <input type="text" class="form-control @error('start_date') is-invalid @enderror" 
                                id="start_date" name="start_date" value="{{ old('start_date', $education->start_date) }}" 
                                placeholder="e.g. 2015" required>
                            @error('start_date')
                                <div class="invalid-feedback">{{ $message }}</div>
                            @enderror
                        </div>

                        <div class="mb-3">
                            <label for="end_date" class="form-label">End Date</label>
                            <input type="text" class="form-control @error('end_date') is-invalid @enderror" 
                                id="end_date" name="end_date" value="{{ old('end_date', $education->end_date) }}" 
                                placeholder="e.g. 2019 (leave empty if ongoing)">
                            @error('end_date')
                                <div class="invalid-feedback">{{ $message }}</div>
                            @enderror
                        </div>

                        <div class="mb-3">
                            <label for="order" class="form-label">Display Order (lower numbers appear first)</label>
                            <input type="number" class="form-control @error('order') is-invalid @enderror" 
                                id="order" name="order" value="{{ old('order', $education->order) }}" min="0">
                            @error('order')
                                <div class="invalid-feedback">{{ $message }}</div>
                            @enderror
                        </div>
                    </div>

                    <div class="col-md-6">
                        <div class="mb-3">
                            <label for="description" class="form-label">Description (optional)</label>
                            <textarea class="form-control @error('description') is-invalid @enderror" 
                                id="description" name="description" rows="6">{{ old('description', $education->description) }}</textarea>
                            @error('description')
                                <div class="invalid-feedback">{{ $message }}</div>
                            @enderror
                        </div>
                    </div>
                </div>

                <div class="d-flex justify-content-end mt-4">
                    <a href="{{ route('admin.resume.education.index', $resume) }}" 
                        class="btn btn-outline-secondary me-2">Cancel</a>
                    <button type="submit" class="btn btn-primary">
                        <i class="ti ti-device-floppy me-1"></i> Update Education
                    </button>
                </div>
            </form>
        </div>
    </div>
@endsection
