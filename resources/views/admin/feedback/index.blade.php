@extends('layouts.app')

@section('header')
    <div class="d-flex justify-content-between align-items-center">
        <h2 class="fs-2 m-0">
            {{ __('Feedback Management') }}
        </h2>
        <a href="{{ route('admin.feedback.create') }}" class="btn btn-primary">
            <i class="ti ti-plus me-1"></i> Create Feedback Link
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
                            <th>Name</th>
                            <th>Position</th>
                            <th>Rating</th>
                            <th>Status</th>
                            <th>Created</th>
                            <th width="150">Actions</th>
                        </tr>
                    </thead>
                    <tbody>
                        @forelse ($feedbacks as $feedback)
                            <tr>
                                <td>{{ $feedback->name }}</td>
                                <td>{{ $feedback->position }}</td>
                                <td>
                                    @if ($feedback->rating)
                                        <div class="d-flex">
                                            @for ($i = 1; $i <= 5; $i++)
                                                @if ($i <= $feedback->rating)
                                                    <i class="ti ti-star-filled text-warning"></i>
                                                @else
                                                    <i class="ti ti-star text-muted"></i>
                                                @endif
                                            @endfor
                                        </div>
                                    @else
                                        <span class="text-muted">Not rated</span>
                                    @endif
                                </td>
                                <td>
                                    @if ($feedback->content)
                                        @if ($feedback->is_published)
                                            <span class="badge bg-success">Published</span>
                                        @else
                                            <span class="badge bg-warning text-dark">Unpublished</span>
                                        @endif
                                    @else
                                        <span class="badge bg-secondary">Pending</span>
                                    @endif
                                </td>
                                <td>{{ $feedback->created_at->format('M d, Y') }}</td>
                                <td>
                                    <div class="btn-group btn-group-sm">
                                        <a href="{{ route('admin.feedback.show', $feedback) }}" class="btn btn-outline-primary">
                                            <i class="ti ti-eye"></i>
                                        </a>
                                        <a href="{{ route('admin.feedback.edit', $feedback) }}" class="btn btn-outline-info">
                                            <i class="ti ti-edit"></i>
                                        </a>
                                        <button type="button" class="btn btn-outline-danger" 
                                            onclick="deleteFeedback('{{ $feedback->id }}', '{{ $feedback->name }}')">
                                            <i class="ti ti-trash"></i>
                                        </button>
                                    </div>
                                    <form id="delete-form-{{ $feedback->id }}" 
                                        action="{{ route('admin.feedback.destroy', $feedback) }}" 
                                        method="POST" class="d-none">
                                        @csrf
                                        @method('DELETE')
                                    </form>
                                </td>
                            </tr>
                        @empty
                            <tr>
                                <td colspan="6" class="text-center py-4">
                                    <div class="d-flex flex-column align-items-center">
                                        <i class="ti ti-message-off fs-1 text-muted mb-3"></i>
                                        <p class="text-muted">No feedback links created yet.</p>
                                    </div>
                                </td>
                            </tr>
                        @endforelse
                    </tbody>
                </table>
            </div>
            
            <div class="mt-4">
                {{ $feedbacks->links() }}
            </div>
        </div>
    </div>
@endsection

@section('scripts')
<script>
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