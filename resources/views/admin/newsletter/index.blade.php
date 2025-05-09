@extends('layouts.app')

@section('header')
    <div class="d-flex justify-content-between align-items-center">
        <h2 class="fs-2 m-0">
            {{ __('Newsletter Subscribers') }}
        </h2>
        <a href="{{ route('admin.newsletter.send.form') }}" class="btn btn-primary">
            <i class="ti ti-mail-forward me-1"></i> Send Newsletter
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

            <div class="table-responsive">
                <table class="table table-hover">
                    <thead>
                        <tr>
                            <th>Email</th>
                            <th>Status</th>
                            <th>Subscribed Date</th>
                            <th width="150">Actions</th>
                        </tr>
                    </thead>
                    <tbody>
                        @forelse($subscribers as $subscriber)
                            <tr>
                                <td>{{ $subscriber->email }}</td>
                                <td>
                                    @if($subscriber->is_active)
                                        <span class="badge bg-success">Active</span>
                                    @else
                                        <span class="badge bg-secondary">Inactive</span>
                                    @endif
                                </td>
                                <td>{{ $subscriber->created_at->format('M d, Y') }}</td>
                                <td>
                                    <div class="btn-group btn-group-sm">
                                        <form action="{{ route('admin.newsletter.toggle', $subscriber->id) }}" method="POST" class="d-inline">
                                            @csrf
                                            @method('PATCH')
                                            <button type="submit" class="btn btn-outline-primary">
                                                @if($subscriber->is_active)
                                                    <i class="ti ti-eye-off"></i>
                                                @else
                                                    <i class="ti ti-eye"></i>
                                                @endif
                                            </button>
                                        </form>
                                        <button type="button" class="btn btn-outline-danger" 
                                            onclick="deleteSubscriber('{{ $subscriber->id }}', '{{ $subscriber->email }}')">
                                            <i class="ti ti-trash"></i>
                                        </button>
                                    </div>
                                    <form id="delete-form-{{ $subscriber->id }}" 
                                        action="{{ route('admin.newsletter.destroy', $subscriber->id) }}" 
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
                                        <i class="ti ti-mail-off fs-1 text-muted mb-3"></i>
                                        <p class="text-muted">No subscribers found.</p>
                                    </div>
                                </td>
                            </tr>
                        @endforelse
                    </tbody>
                </table>
            </div>
            
            <div class="mt-4">
                {{ $subscribers->links() }}
            </div>
        </div>
    </div>
@endsection

@section('scripts')
<script>
    function deleteSubscriber(id, email) {
        Swal.fire({
            title: 'Are you sure?',
            text: `You want to remove ${email} from subscribers?`,
            icon: 'warning',
            showCancelButton: true,
            confirmButtonColor: '#dc3545',
            cancelButtonColor: '#6c757d',
            confirmButtonText: 'Yes, remove it!',
            cancelButtonText: 'Cancel'
        }).then((result) => {
            if (result.isConfirmed) {
                document.getElementById('delete-form-' + id).submit();
            }
        });
    }
</script>
@endsection