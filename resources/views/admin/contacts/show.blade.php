@extends('layouts.app')

@section('header')
    <div class="d-flex justify-content-between align-items-center">
        <h2 class="fs-2 m-0">
            {{ __('Contact Message Details') }}
        </h2>
        <a href="{{ route('admin.contacts.index') }}" class="btn btn-outline-secondary">
            <i class="ti ti-arrow-left me-1"></i> Back to List
        </a>
    </div>
@endsection

@section('content')
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
    
    <div class="card shadow-sm">
        <div class="card-body">
            <div class="mb-4">
                <h5 class="card-title mb-3">Message Information</h5>
                <div class="row bg-light rounded p-3">
                    <div class="col-md-6 mb-3">
                        <p class="text-muted small mb-1">From:</p>
                        <p class="mb-0">{{ $contact->name }} ({{ $contact->email }})</p>
                    </div>
                    <div class="col-md-6 mb-3">
                        <p class="text-muted small mb-1">Date:</p>
                        <p class="mb-0">{{ $contact->created_at->format('F d, Y \a\t h:i A') }}</p>
                    </div>
                    <div class="col-md-6 mb-3">
                        <p class="text-muted small mb-1">Subject:</p>
                        <p class="mb-0">{{ $contact->subject }}</p>
                    </div>
                    <div class="col-md-6 mb-3">
                        <p class="text-muted small mb-1">Newsletter:</p>
                        <p class="mb-0">
                            @if($contact->newsletter)
                                <span class="badge bg-success">Subscribed</span>
                            @else
                                <span class="badge bg-secondary">Not subscribed</span>
                            @endif
                        </p>
                    </div>
                </div>
            </div>

            <div class="mb-4">
                <h5 class="card-title mb-3">Message</h5>
                <div class="bg-light rounded p-3">
                    <p class="mb-0">{{ $contact->message }}</p>
                </div>
            </div>

            <div class="d-flex justify-content-between">
                <div>
                    <button type="button" class="btn btn-primary me-2" data-bs-toggle="modal" data-bs-target="#replyModal">
                        <i class="ti ti-mail-forward me-1"></i> Reply via Email
                    </button>
                    <a href="mailto:{{ $contact->email }}" class="btn btn-outline-secondary">
                        <i class="ti ti-mail me-1"></i> Open in Email Client
                    </a>
                </div>
                <button type="button" class="btn btn-danger" onclick="deleteContact('{{ $contact->id }}')">
                    <i class="ti ti-trash me-1"></i> Delete Message
                </button>
                <form id="delete-form-{{ $contact->id }}" 
                    action="{{ route('admin.contacts.destroy', $contact->id) }}" 
                    method="POST" class="d-none">
                    @csrf
                    @method('DELETE')
                </form>
            </div>
        </div>
    </div>
    
    <!-- Email Reply Modal -->
    <div class="modal fade" id="replyModal" tabindex="-1" aria-labelledby="replyModalLabel" aria-hidden="true">
        <div class="modal-dialog modal-lg">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title" id="replyModalLabel">Reply to {{ $contact->name }}</h5>
                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                </div>
                <div class="modal-body">
                    <form action="{{ route('admin.contacts.reply', $contact->id) }}" method="POST">
                        @csrf
                        <div class="mb-3">
                            <label for="to" class="form-label">To:</label>
                            <input type="email" class="form-control" id="to" name="to" value="{{ $contact->email }}" readonly>
                        </div>

                        <div class="mb-3">
                            <label for="subject" class="form-label">Subject:</label>
                            <input type="text" class="form-control" id="subject" name="subject" value="Re: {{ $contact->subject }}">
                        </div>

                        <div class="mb-3">
                            <label for="message" class="form-label">Message:</label>
                            <textarea class="form-control" id="message" name="message" rows="6"></textarea>
                        </div>

                        <div class="d-flex justify-content-end">
                            <button type="button" class="btn btn-outline-secondary me-2" data-bs-dismiss="modal">
                                Cancel
                            </button>
                            <button type="submit" class="btn btn-primary">
                                <i class="ti ti-send me-1"></i> Send Reply
                            </button>
                        </div>
                    </form>
                </div>
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
