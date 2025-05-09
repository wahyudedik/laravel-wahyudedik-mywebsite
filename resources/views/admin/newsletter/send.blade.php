@extends('layouts.app')

@section('header')
    <div class="d-flex justify-content-between align-items-center">
        <h2 class="fs-2 m-0">
            {{ __('Send Newsletter') }}
        </h2>
        <a href="{{ route('admin.newsletter.index') }}" class="btn btn-outline-secondary">
            <i class="ti ti-arrow-left me-1"></i> Back to Subscribers
        </a>
    </div>
@endsection

@section('content')
    <div class="card shadow-sm">
        <div class="card-body">
            @if(session('success'))
                <div class="alert alert-success alert-dismissible fade show" role="alert">
                    {{ session('success') }}
                    <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
                </div>
            @endif 

            @if(session('error'))
                <div class="alert alert-danger alert-dismissible fade show" role="alert">
                    {{ session('error') }}
                    <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
                </div>
            @endif

            <form action="{{ route('admin.newsletter.send') }}" method="POST">
                @csrf
                <div class="mb-4">
                    <label for="subject" class="form-label required">Subject</label>
                    <input type="text" name="subject" id="subject" class="form-control @error('subject') is-invalid @enderror" required>
                    @error('subject')
                        <div class="invalid-feedback">{{ $message }}</div>
                    @enderror
                </div>

                <div class="mb-4">
                    <label for="content" class="form-label required">Content</label>
                    <textarea name="content" id="content" rows="10" class="form-control @error('content') is-invalid @enderror" required></textarea>
                    <div class="form-text">HTML is supported.</div>
                    @error('content')
                        <div class="invalid-feedback">{{ $message }}</div>
                    @enderror
                </div>

                <div class="mb-4">
                    <label for="test_email" class="form-label">Test Email (Optional)</label>
                    <input type="email" name="test_email" id="test_email" class="form-control @error('test_email') is-invalid @enderror">
                    <div class="form-text">If provided, the newsletter will only be sent to this email for testing.</div>
                    @error('test_email')
                        <div class="invalid-feedback">{{ $message }}</div>
                    @enderror
                </div>

                <div class="d-flex justify-content-between align-items-center">
                    <div class="form-check">
                        <input id="confirm" name="confirm" type="checkbox" class="form-check-input" required>
                        <label for="confirm" class="form-check-label">
                            I confirm that I want to send this newsletter
                        </label>
                    </div>
                    <button type="submit" class="btn btn-primary">
                        <i class="ti ti-send me-1"></i> Send Newsletter
                    </button>
                </div>
            </form>
        </div>
    </div>
@endsection

@section('scripts')
<script>
    document.addEventListener('DOMContentLoaded', function() {
        // You could add a rich text editor here if needed
        // For example:
        // if (typeof tinymce !== 'undefined') {
        //     tinymce.init({
        //         selector: '#content',
        //         plugins: 'link lists image code table',
        //         toolbar: 'undo redo | formatselect | bold italic | alignleft aligncenter alignright | bullist numlist outdent indent | link image | code'
        //     });
        // }
    });
</script>
@endsection