@extends('layouts.app')

@section('header')
    <div class="d-flex justify-content-between align-items-center">
        <h2 class="fs-2 m-0">
            {{ __('Edit Feedback') }}
        </h2>
        <a href="{{ route('admin.feedback.index') }}" class="btn btn-outline-secondary">
            <i class="ti ti-arrow-left me-1"></i> Back to List
        </a>
    </div>
@endsection

@section('content')
    <div class="card shadow-sm">
        <div class="card-body">
            <form method="POST" action="{{ route('admin.feedback.update', $feedback) }}">
                @csrf
                @method('PUT')
                
                <div class="mb-3">
                    <label for="name" class="form-label required">Client Name</label>
                    <input type="text" class="form-control @error('name') is-invalid @enderror" 
                        id="name" name="name" value="{{ old('name', $feedback->name) }}" required>
                    @error('name')
                        <div class="invalid-feedback">{{ $message }}</div>
                    @enderror
                </div>
                
                <div class="mb-3">
                    <label for="position" class="form-label">Position/Company</label>
                    <input type="text" class="form-control @error('position') is-invalid @enderror" 
                        id="position" name="position" value="{{ old('position', $feedback->position) }}">
                    @error('position')
                        <div class="invalid-feedback">{{ $message }}</div>
                    @enderror
                </div> 
                
                @if ($feedback->content)
                    <div class="mb-3">
                        <label for="content" class="form-label">Feedback Content</label>
                        <textarea id="content" name="content" rows="4" 
                            class="form-control @error('content') is-invalid @enderror">{{ old('content', $feedback->content) }}</textarea>
                        @error('content')
                            <div class="invalid-feedback">{{ $message }}</div>
                        @enderror
                    </div>
                    
                    <div class="mb-3">
                        <label for="rating" class="form-label">Rating</label>
                        <select id="rating" name="rating" class="form-select @error('rating') is-invalid @enderror">
                            @for ($i = 5; $i >= 1; $i--)
                                <option value="{{ $i }}" {{ old('rating', $feedback->rating) == $i ? 'selected' : '' }}>
                                    {{ $i }} {{ Str::plural('Star', $i) }}
                                </option>
                            @endfor
                        </select>
                        @error('rating')
                            <div class="invalid-feedback">{{ $message }}</div>
                        @enderror
                    </div>
                    
                    <div class="mb-4">
                        <div class="form-check">
                            <input type="checkbox" class="form-check-input" id="is_published" 
                                name="is_published" value="1" {{ old('is_published', $feedback->is_published) ? 'checked' : '' }}>
                            <label class="form-check-label" for="is_published">Publish on website</label>
                        </div>
                    </div>
                @endif
                
                <div class="d-flex justify-content-end mt-4">
                    <a href="{{ route('admin.feedback.index') }}" class="btn btn-outline-secondary me-2">
                        Cancel
                    </a>
                    <button type="submit" class="btn btn-primary">
                        <i class="ti ti-device-floppy me-1"></i> Update Feedback
                    </button>
                </div>
            </form>
        </div>
    </div>
@endsection