@extends('layouts.app')

@section('header')
    <div class="d-flex justify-content-between align-items-center">
        <h2 class="fs-2 m-0">
            {{ __('Education for') }} {{ $resume->full_name }}
        </h2>
        <div class="d-flex gap-2">
            <a href="{{ route('admin.resume.index') }}" class="btn btn-secondary">
                <i class="ti ti-arrow-left me-1"></i> Back to Resumes
            </a>
            <a href="{{ route('admin.resume.education.create', $resume) }}" class="btn btn-primary">
                <i class="ti ti-plus me-1"></i> Add Education
            </a>
        </div>
    </div>
@endsection

@section('content')
    @if (session('success'))
        <div class="alert alert-success alert-dismissible fade show" role="alert">
            {{ session('success') }}
            <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
        </div>
    @endif

    <div class="card shadow-sm">
        <div class="card-body">
            @if ($educations->count() > 0)
                <div class="d-flex flex-column gap-4">
                    @foreach ($educations as $education)
                        <div class="card border">
                            <div class="card-body">
                                <div class="d-flex justify-content-between align-items-start">
                                    <div>
                                        <h4 class="card-title">{{ $education->degree }}</h4>
                                        <h6 class="card-subtitle mb-2 text-muted">{{ $education->institution }}</h6>
                                        <p class="card-text text-muted small">
                                            {{ $education->start_date }} -
                                            {{ $education->end_date ?? 'Present' }}
                                        </p>
                                    </div>
                                    <div class="d-flex gap-2">
                                        <a href="{{ route('admin.resume.education.edit', [$resume, $education]) }}"
                                            class="btn btn-sm btn-outline-primary">
                                            <i class="ti ti-edit"></i> Edit
                                        </a>
                                        <button type="button" class="btn btn-sm btn-outline-danger delete-education-btn"
                                            data-id="{{ $education->id }}">
                                            <i class="ti ti-trash"></i> Delete
                                        </button>
                                        <form id="delete-form-{{ $education->id }}"
                                            action="{{ route('admin.resume.education.destroy', [$resume, $education]) }}"
                                            method="POST" class="d-none">
                                            @csrf
                                            @method('DELETE')
                                        </form>
                                    </div>
                                </div>
                                @if ($education->description)
                                    <div class="mt-3">
                                        <p>{{ $education->description }}</p>
                                    </div>
                                @endif
                                <div class="mt-2 text-muted small">
                                    Order: {{ $education->order }}
                                </div>
                            </div>
                        </div>
                    @endforeach
                </div>
            @else
                <div class="text-center py-5">
                    <i class="ti ti-school fs-1 text-muted mb-3"></i>
                    <p class="text-muted">No education entries found. Add your first education.</p>
                    <a href="{{ route('admin.resume.education.create', $resume) }}"
                        class="btn btn-primary mt-2">
                        <i class="ti ti-plus me-1"></i> Add Education
                    </a>
                </div>
            @endif
        </div>
    </div>
@endsection

@section('scripts')
<script>
    document.addEventListener('DOMContentLoaded', function() {
        document.querySelectorAll('.delete-education-btn').forEach(button => {
            button.addEventListener('click', function() {
                const id = this.getAttribute('data-id');
                
                Swal.fire({
                    title: 'Are you sure?',
                    text: "You won't be able to revert this!",
                    icon: 'warning',
                    showCancelButton: true,
                    confirmButtonColor: '#dc3545',
                    cancelButtonColor: '#6c757d',
                    confirmButtonText: 'Yes, delete it!'
                }).then((result) => {
                    if (result.isConfirmed) {
                        document.getElementById('delete-form-' + id).submit();
                    }
                });
            });
        });
    });
</script>
@endsection
