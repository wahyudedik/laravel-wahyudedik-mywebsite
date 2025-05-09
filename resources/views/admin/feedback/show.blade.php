@extends('layouts.app')

@section('header')
    <div class="d-flex justify-content-between align-items-center">
        <h2 class="fs-2 m-0">
            {{ __('Feedback Link for') }}: {{ $feedback->name }}
        </h2>
        <a href="{{ route('admin.feedback.index') }}" class="btn btn-outline-secondary">
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

    <div class="card shadow-sm mb-4">
        <div class="card-body">
            <h5 class="card-title mb-3">Share this link with your client</h5>
            
            <div class="mb-4">
                <div class="input-group">
                    <input type="text" id="feedback-url" value="{{ $feedbackUrl }}" 
                        class="form-control" readonly>
                    <button onclick="copyToClipboard()" class="btn btn-primary">
                        <i class="ti ti-copy me-1"></i> Copy
                    </button>
                </div>
                <div class="form-text">
                    This link allows your client to submit a testimonial without needing to create an account.
                </div>
            </div>
            
            <div class="mt-4">
                <h5 class="mb-3">Client Information</h5>
                <div class="bg-light rounded p-3">
                    <div class="row">
                        <div class="col-md-6 mb-2">
                            <p class="mb-1"><strong>Name:</strong></p>
                            <p>{{ $feedback->name }}</p>
                        </div>
                        <div class="col-md-6 mb-2">
                            <p class="mb-1"><strong>Position:</strong></p>
                            <p>{{ $feedback->position ?: 'Not specified' }}</p>
                        </div>
                        <div class="col-md-6 mb-2">
                            <p class="mb-1"><strong>Created:</strong></p>
                            <p>{{ $feedback->created_at->format('M d, Y H:i') }}</p>
                        </div>
                        <div class="col-md-6 mb-2">
                            <p class="mb-1"><strong>Status:</strong></p>
                            <p>
                                @if ($feedback->content)
                                    @if ($feedback->is_published)
                                        <span class="badge bg-success">Published</span>
                                    @else
                                        <span class="badge bg-warning text-dark">Unpublished</span>
                                    @endif
                                @else
                                    <span class="badge bg-secondary">Pending Response</span>
                                @endif
                            </p>
                        </div>
                    </div>
                </div>
            </div>
            
            @if ($feedback->content)
                <div class="mt-4">
                    <h5 class="mb-3">Feedback Content</h5>
                    <div class="bg-light rounded p-3">
                        <div class="mb-2">
                            @for ($i = 1; $i <= 5; $i++)
                                @if ($i <= $feedback->rating)
                                    <i class="ti ti-star-filled text-warning"></i>
                                @else
                                    <i class="ti ti-star text-muted"></i>
                                @endif
                            @endfor
                        </div>
                        <p class="mb-0">{{ $feedback->content }}</p>
                    </div>
                </div>
                
                <div class="mt-4">
                    <form action="{{ route('admin.feedback.update', $feedback) }}" method="POST">
                        @csrf
                        @method('PUT')
                        <input type="hidden" name="name" value="{{ $feedback->name }}">
                        <input type="hidden" name="position" value="{{ $feedback->position }}">
                        <input type="hidden" name="content" value="{{ $feedback->content }}">
                        <input type="hidden" name="rating" value="{{ $feedback->rating }}">
                        <input type="hidden" name="is_published" value="{{ $feedback->is_published ? 0 : 1 }}">
                        
                        <button type="submit" class="btn {{ $feedback->is_published ? 'btn-warning' : 'btn-success' }}">
                            <i class="ti {{ $feedback->is_published ? 'ti-eye-off' : 'ti-eye' }} me-1"></i>
                            {{ $feedback->is_published ? 'Unpublish Feedback' : 'Publish Feedback' }}
                        </button>
                    </form>
                </div>
            @endif
        </div>
    </div>
    
    <div class="d-flex justify-content-between">
        <a href="{{ route('admin.feedback.edit', $feedback) }}" class="btn btn-primary">
            <i class="ti ti-edit me-1"></i> Edit Client Information
        </a>
        
        <button type="button" class="btn btn-danger" onclick="deleteFeedback('{{ $feedback->id }}', '{{ $feedback->name }}')">
            <i class="ti ti-trash me-1"></i> Delete Feedback
        </button>
        <form id="delete-form-{{ $feedback->id }}" 
            action="{{ route('admin.feedback.destroy', $feedback) }}" 
            method="POST" class="d-none">
            @csrf
            @method('DELETE')
        </form>
    </div>
@endsection

@section('scripts')
<script>
    function copyToClipboard() {
        const feedbackUrl = document.getElementById('feedback-url');
        feedbackUrl.select();
        document.execCommand('copy');
        
        // Show a toast notification
        Swal.fire({
            toast: true,
            position: 'top-end',
            icon: 'success',
            title: 'Feedback URL copied to clipboard!',
            showConfirmButton: false,
            timer: 3000
        });
    }
    
    function deleteFeedback(id, name) {
        Swal.fire({
            title: 'Are you sure?',
            text: `You want to delete feedback from ${name}?`,
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