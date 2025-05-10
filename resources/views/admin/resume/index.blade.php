@extends('layouts.app')

@section('header')
    <div class="d-flex justify-content-between align-items-center">
        <h2 class="fs-2 m-0">
            {{ __('Resume Management') }}
        </h2>
        <a href="{{ route('admin.resume.create') }}" class="btn btn-primary">
            <i class="ti ti-plus me-1"></i> Create New Resume
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

    <div class="card shadow-sm">
        <div class="card-body">
            <div class="table-responsive">
                <table class="table table-hover">
                    <thead>
                        <tr>
                            <th>Name</th>
                            <th>Title</th>
                            <th>Status</th>
                            <th width="300">Actions</th>
                        </tr>
                    </thead>
                    <tbody>
                        @forelse ($resumes as $resume)
                            <tr>
                                <td>{{ $resume->full_name }}</td>
                                <td>{{ $resume->title }}</td>
                                <td>
                                    @if ($resume->is_active)
                                        <span class="badge bg-success">Active</span>
                                    @else
                                        <span class="badge bg-secondary">Inactive</span>
                                    @endif
                                </td>
                                <td>
                                    <div class="btn-group btn-group-sm">
                                        <a href="{{ route('admin.resume.edit', $resume) }}" class="btn btn-outline-primary">
                                            <i class="ti ti-edit"></i> Edit
                                        </a>
                                        <a href="{{ route('admin.resume.show', $resume) }}" class="btn btn-outline-info">
                                            <i class="ti ti-eye"></i> Show
                                        </a>
                                        <a href="{{ route('admin.resume.experience.index', $resume) }}" class="btn btn-outline-success">
                                            <i class="ti ti-briefcase"></i> Experiences
                                        </a>
                                        <a href="{{ route('admin.resume.education.index', $resume) }}" class="btn btn-outline-secondary">
                                            <i class="ti ti-school"></i> Education
                                        </a>
                                        <a href="{{ route('admin.resume.project.index', $resume) }}" class="btn btn-outline-warning">
                                            <i class="ti ti-code"></i> Projects
                                        </a>
                                        <button type="button" class="btn btn-outline-danger" 
                                            onclick="deleteResume('{{ $resume->id }}', '{{ $resume->full_name }}')">
                                            <i class="ti ti-trash"></i>
                                        </button>
                                    </div>
                                    <form id="delete-form-{{ $resume->id }}" 
                                        action="{{ route('admin.resume.destroy', $resume) }}" 
                                        method="POST" class="d-none">
                                        @csrf
                                        @method('DELETE')
                                    </form>
                                </td>
                            </tr>
                        @empty
                            <tr>
                                <td colspan="4" class="text-center py-4">
                                    <div class="d-flex flex-column align-items-center">
                                        <i class="ti ti-file-off fs-1 text-muted mb-3"></i>
                                        <p class="text-muted">No resumes found</p>
                                    </div>
                                </td>
                            </tr>
                        @endforelse
                    </tbody>
                </table>
            </div>
        </div>
    </div>
@endsection

@section('scripts')
<script>
    function deleteResume(id, name) {
        Swal.fire({
            title: 'Are you sure?',
            text: `You will not be able to recover this resume for ${name}!`,
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
