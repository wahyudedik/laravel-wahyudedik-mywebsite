@extends('layouts.app')

@section('header')
    <h2 class="fs-2 m-0">
        {{ __('Add Work Experience for') }} {{ $resume->full_name }}
    </h2>
@endsection

@section('content')
    @if (session('error'))
        <div class="alert alert-danger alert-dismissible fade show" role="alert">
            {{ session('error') }}
            <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
        </div>
    @endif
    
    @if (session('success'))
        <div class="alert alert-success alert-dismissible fade show" role="alert">
            {{ session('success') }}
            <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
        </div>
    @endif

    <div class="card shadow-sm">
        <div class="card-body">
            <form method="POST" action="{{ route('admin.resume.experience.store', $resume) }}">
                @csrf

                <div class="row">
                    <div class="col-md-6">
                        <div class="mb-3">
                            <label for="position" class="form-label required">Position</label>
                            <input type="text" class="form-control @error('position') is-invalid @enderror" 
                                id="position" name="position" value="{{ old('position') }}" required>
                            @error('position')
                                <div class="invalid-feedback">{{ $message }}</div>
                            @enderror
                        </div>

                        <div class="mb-3">
                            <label for="company" class="form-label required">Company</label>
                            <input type="text" class="form-control @error('company') is-invalid @enderror" 
                                id="company" name="company" value="{{ old('company') }}" required>
                            @error('company')
                                <div class="invalid-feedback">{{ $message }}</div>
                            @enderror
                        </div>

                        <div class="mb-3">
                            <label for="start_date" class="form-label required">Start Date</label>
                            <input type="text" class="form-control @error('start_date') is-invalid @enderror" 
                                id="start_date" name="start_date" value="{{ old('start_date') }}" 
                                placeholder="e.g. Jan 2020" required>
                            @error('start_date')
                                <div class="invalid-feedback">{{ $message }}</div>
                            @enderror
                        </div>

                        <div class="mb-3">
                            <div class="form-check">
                                <input class="form-check-input" type="checkbox" id="current_job" 
                                    name="current_job" value="1" {{ old('current_job') ? 'checked' : '' }}>
                                <label class="form-check-label" for="current_job">
                                    Current Job
                                </label>
                            </div>
                        </div>

                        <div class="mb-3" id="end_date_container">
                            <label for="end_date" class="form-label">End Date</label>
                            <input type="text" class="form-control @error('end_date') is-invalid @enderror" 
                                id="end_date" name="end_date" value="{{ old('end_date') }}" 
                                placeholder="e.g. Dec 2022">
                            @error('end_date')
                                <div class="invalid-feedback">{{ $message }}</div>
                            @enderror
                        </div>

                        <div class="mb-3">
                            <label for="order" class="form-label">Display Order (lower numbers appear first)</label>
                            <input type="number" class="form-control @error('order') is-invalid @enderror" 
                                id="order" name="order" value="{{ old('order', 0) }}" min="0">
                            @error('order')
                                <div class="invalid-feedback">{{ $message }}</div>
                            @enderror
                        </div>
                    </div>

                    <div class="col-md-6">
                        <div class="mb-3">
                            <label for="description" class="form-label required">Description</label>
                            <textarea class="form-control @error('description') is-invalid @enderror" 
                                id="description" name="description" rows="4" required>{{ old('description') }}</textarea>
                            @error('description')
                                <div class="invalid-feedback">{{ $message }}</div>
                            @enderror
                        </div>

                        <div class="mb-3">
                            <label for="responsibilities_text" class="form-label">Responsibilities (one per line)</label>
                            <textarea class="form-control @error('responsibilities') is-invalid @enderror" 
                                id="responsibilities_text" rows="6">{{ old('responsibilities_text') }}</textarea>
                            <input type="hidden" id="responsibilities_json" name="responsibilities" value="[]">
                            @error('responsibilities')
                                <div class="invalid-feedback">{{ $message }}</div>
                            @enderror
                        </div>
                    </div>
                </div>

                <div class="d-flex justify-content-end mt-4">
                    <a href="{{ route('admin.resume.experience.index', $resume) }}" 
                        class="btn btn-outline-secondary me-2">Cancel</a>
                    <button type="submit" class="btn btn-primary">
                        <i class="ti ti-device-floppy me-1"></i> Add Experience
                    </button>
                </div>
            </form>
        </div>
    </div>
@endsection

@section('scripts')
<script>
    // Handle current job checkbox
    const currentJobCheckbox = document.getElementById('current_job');
    const endDateContainer = document.getElementById('end_date_container');
    const endDateInput = document.getElementById('end_date');

    function toggleEndDate() {
        if (currentJobCheckbox.checked) {
            endDateContainer.style.display = 'none';
            endDateInput.value = '';
        } else {
            endDateContainer.style.display = 'block';
        }
    }

    currentJobCheckbox.addEventListener('change', toggleEndDate);
    toggleEndDate(); // Initial state

    // Handle responsibilities
    const responsibilitiesText = document.getElementById('responsibilities_text');
    const responsibilitiesJson = document.getElementById('responsibilities_json');

    // Initialize from existing JSON if any
    if (responsibilitiesJson.value) {
        try {
            const responsibilities = JSON.parse(responsibilitiesJson.value);
            responsibilitiesText.value = responsibilities.join('\n');
        } catch (e) {
            console.error('Error parsing responsibilities JSON:', e);
        }
    }

    // Update JSON when text changes
    responsibilitiesText.addEventListener('input', function() {
        const lines = this.value.split('\n').filter(line => line.trim() !== '');
        responsibilitiesJson.value = JSON.stringify(lines);
    });

    // Initial conversion
    responsibilitiesText.dispatchEvent(new Event('input'));
</script>
@endsection
