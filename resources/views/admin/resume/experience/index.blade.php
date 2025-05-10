@extends('layouts.app')

@section('header')
    <div class="d-flex justify-content-between align-items-center">
        <h2 class="fs-2 m-0">
            {{ __('Work Experience for') }} {{ $resume->full_name }}
        </h2>
        <div class="d-flex gap-2">
            <a href="{{ route('admin.resume.index') }}" class="btn btn-secondary">
                <i class="ti ti-arrow-left me-1"></i> Back to Resumes
            </a>
            <a href="{{ route('admin.resume.experience.create', $resume) }}" class="btn btn-primary">
                <i class="ti ti-plus me-1"></i> Add Experience
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
            @if ($experiences->count() > 0)
                <div class="d-flex flex-column gap-4">
                    @foreach ($experiences as $experience)
                        <div class="card border">
                            <div class="card-body">
                                <div class="d-flex justify-content-between align-items-start">
                                    <div>
                                        <h4 class="card-title">{{ $experience->position }}</h4>
                                        <h6 class="card-subtitle mb-2 text-muted">{{ $experience->company }}</h6>
                                        <p class="card-text text-muted small">
                                            {{ $experience->start_date }} -
                                            {{ $experience->current_job ? 'Present' : $experience->end_date }}
                                        </p>
                                    </div>
                                    <div class="d-flex gap-2">
                                        <a href="{{ route('admin.resume.experience.edit', [$resume, $experience]) }}"
                                            class="btn btn-sm btn-outline-primary">
                                            <i class="ti ti-edit"></i> Edit
                                        </a>
                                        <button type="button" class="btn btn-sm btn-outline-danger delete-experience-btn"
                                            data-id="{{ $experience->id }}">
                                            <i class="ti ti-trash"></i> Delete
                                        </button>
                                        <form id="delete-form-{{ $experience->id }}"
                                            action="{{ route('admin.resume.experience.destroy', [$resume, $experience]) }}"
                                            method="POST" class="d-none">
                                            @csrf
                                            @method('DELETE')
                                        </form>
                                    </div>
                                </div>
                                <div class="mt-3">
                                    <p>{{ $experience->description }}</p>
                                </div>
                                @if (is_array($experience->responsibilities) && count($experience->responsibilities) > 0)
                                    <div class="mt-3">
                                        <ul class="list-group list-group-flush">
                                            @foreach ($experience->responsibilities as $responsibility)
                                                <li class="list-group-item bg-transparent px-0">
                                                    <i class="ti ti-point text-primary me-2"></i>{{ $responsibility }}
                                                </li>
                                            @endforeach
                                        </ul>
                                    </div>
                                @endif
                                <div class="mt-2 text-muted small">
                                    Order: {{ $experience->order }}
                                </div>
                            </div>
                        </div>
                    @endforeach
                </div>
            @else
                <div class="text-center py-5">
                    <i class="ti ti-briefcase fs-1 text-muted mb-3"></i>
                    <p class="text-muted">No work experience entries found. Add your first work experience.</p>
                    <a href="{{ route('admin.resume.experience.create', $resume) }}"
                        class="btn btn-primary mt-2">
                        <i class="ti ti-plus me-1"></i> Add Experience
                    </a>
                </div>
            @endif
        </div>
    </div>
@endsection

@section('scripts')
<script>
    document.addEventListener('DOMContentLoaded', function() {
        document.querySelectorAll('.delete-experience-btn').forEach(button => {
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
