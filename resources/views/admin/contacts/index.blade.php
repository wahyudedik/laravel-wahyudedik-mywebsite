@extends('layouts.app')

@section('header')
    <h2 class="fs-2 m-0">
        {{ __('Contact Messages') }}
    </h2>
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
                            <th>Email</th>
                            <th>Subject</th>
                            <th>Date</th>
                            <th>Status</th>
                            <th width="120">Actions</th>
                        </tr>
                    </thead>
                    <tbody>
                        @forelse($contacts as $contact)
                            <tr>
                                <td>{{ $contact->name }}</td>
                                <td>{{ $contact->email }}</td>
                                <td>{{ $contact->subject }}</td>
                                <td>{{ $contact->created_at->format('M d, Y') }}</td>
                                <td>
                                    @if ($contact->is_read)
                                        <span class="badge bg-success">Read</span>
                                    @else
                                        <span class="badge bg-danger">Unread</span>
                                    @endif
                                </td>
                                <td>
                                    <div class="btn-group btn-group-sm">
                                        <a href="{{ route('admin.contacts.show', $contact->id) }}" 
                                            class="btn btn-outline-primary">
                                            <i class="ti ti-eye"></i>
                                        </a>
                                        <button type="button" class="btn btn-outline-danger" 
                                            onclick="deleteContact('{{ $contact->id }}')">
                                            <i class="ti ti-trash"></i>
                                        </button>
                                    </div>
                                    <form id="delete-form-{{ $contact->id }}" 
                                        action="{{ route('admin.contacts.destroy', $contact->id) }}" 
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
                                        <i class="ti ti-mail-off fs-1 text-muted mb-3"></i>
                                        <p class="text-muted">No contact messages found.</p>
                                    </div>
                                </td>
                            </tr>
                        @endforelse
                    </tbody>
                </table>
            </div>

            <div class="mt-4">
                {{ $contacts->links() }}
            </div>
        </div>
    </div>
@endsection

@section('scripts')
<script>
    function deleteContact(id) {
        Swal.fire({
            title: 'Are you sure?',
            text: "You want to delete this message?",
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
