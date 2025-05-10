@extends('layouts.app')

@section('header')
    <h2 class="fs-2 m-0">
        {{ __('Add Project for') }} {{ $resume->full_name }}
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
            <form method="POST" action="{{ route('admin.resume.project.store', $resume) }}">
                @csrf

                <div class="row">
                    <div class="col-md-6">
                        <div class="mb-3">
                            <label for="name" class="form-label required">Project Title</label>
                            <input type="text" class="form-control @error('name') is-invalid @enderror" 
                                id="name" name="name" value="{{ old('name') }}" required>
                            @error('name')
                                <div class="invalid-feedback">{{ $message }}</div>
                            @enderror
                        </div>

                        <div class="mb-3">
                            <label for="url" class="form-label">Project URL (optional)</label>
                            <input type="url" class="form-control @error('url') is-invalid @enderror" 
                                id="url" name="url" value="{{ old('url') }}" placeholder="https://example.com">
                            @error('url')
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
                            <label for="technologies_input" class="form-label">Technologies Used</label>
                            <input type="text" class="form-control" id="technologies_input" 
                                placeholder="Add technologies and press Enter">
                            <div id="technologies_container" class="d-flex flex-wrap gap-1 mt-2"></div>
                            <input type="hidden" id="technologies_json" name="technologies" 
                                value="{{ old('technologies') }}">
                            @error('technologies')
                                <div class="invalid-feedback">{{ $message }}</div>
                            @enderror
                        </div>
                    </div>
                </div>

                <div class="d-flex justify-content-end mt-4">
                    <a href="{{ route('admin.resume.project.index', $resume) }}" 
                        class="btn btn-outline-secondary me-2">Cancel</a>
                    <button type="submit" class="btn btn-primary">
                        <i class="ti ti-device-floppy me-1"></i> Add Project
                    </button>
                </div>
            </form>
        </div>
    </div>
@endsection

@section('scripts')
<script>
    // Technologies handling
    const technologiesInput = document.getElementById('technologies_input');
    const technologiesContainer = document.getElementById('technologies_container');
    const technologiesJson = document.getElementById('technologies_json');
    let technologies = [];

    // Initialize technologies from existing value if any
    if (technologiesJson.value) {
        try {
            technologies = JSON.parse(technologiesJson.value);
            renderTechnologies();
        } catch (e) {
            console.error('Error parsing technologies JSON:', e);
        }
    }

    technologiesInput.addEventListener('keydown', function(e) {
        if (e.key === 'Enter' || e.key === ',') {
            e.preventDefault();
            const technology = this.value.trim();
            if (technology && !technologies.includes(technology)) {
                technologies.push(technology);
                renderTechnologies();
                updateTechnologiesJson();
            }
            this.value = '';
        }
    });

    function renderTechnologies() {
        technologiesContainer.innerHTML = '';
        technologies.forEach((technology, index) => {
            const badge = document.createElement('span');
            badge.className = 'badge bg-info bg-opacity-10 text-info p-2 d-flex align-items-center';
            badge.innerHTML = `
                ${technology}
                <button type="button" class="btn-close btn-close-sm ms-2" 
                    style="font-size: 0.5rem;" data-index="${index}"></button>
            `;
            badge.querySelector('button').addEventListener('click', function() {
                technologies.splice(this.dataset.index, 1);
                renderTechnologies();
                updateTechnologiesJson();
            });
            technologiesContainer.appendChild(badge);
        });
    }

    function updateTechnologiesJson() {
        technologiesJson.value = JSON.stringify(technologies);
    }
</script>
@endsection
