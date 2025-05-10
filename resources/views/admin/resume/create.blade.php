@extends('layouts.app')

@section('header')
    <h2 class="fs-2 m-0">
        {{ __('Create Resume') }}
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
            <form method="POST" action="{{ route('admin.resume.store') }}" enctype="multipart/form-data">
                @csrf

                <div class="row">
                    <!-- Personal Information -->
                    <div class="col-md-6">
                        <h4 class="mb-3">Personal Information</h4>

                        <div class="mb-3">
                            <label for="full_name" class="form-label required">Full Name</label>
                            <input type="text" class="form-control @error('full_name') is-invalid @enderror" 
                                id="full_name" name="full_name" value="{{ old('full_name') }}" required>
                            @error('full_name')
                                <div class="invalid-feedback">{{ $message }}</div>
                            @enderror
                        </div>

                        <div class="mb-3">
                            <label for="title" class="form-label required">Professional Title</label>
                            <input type="text" class="form-control @error('title') is-invalid @enderror" 
                                id="title" name="title" value="{{ old('title') }}" required>
                            @error('title')
                                <div class="invalid-feedback">{{ $message }}</div>
                            @enderror
                        </div>

                        <div class="mb-3">
                            <label for="email" class="form-label required">Email</label>
                            <input type="email" class="form-control @error('email') is-invalid @enderror" 
                                id="email" name="email" value="{{ old('email') }}" required>
                            @error('email')
                                <div class="invalid-feedback">{{ $message }}</div>
                            @enderror
                        </div>

                        <div class="mb-3">
                            <label for="phone" class="form-label required">Phone</label>
                            <input type="text" class="form-control @error('phone') is-invalid @enderror" 
                                id="phone" name="phone" value="{{ old('phone') }}" required>
                            @error('phone')
                                <div class="invalid-feedback">{{ $message }}</div>
                            @enderror
                        </div>

                        <div class="mb-3">
                            <label for="location" class="form-label required">Location</label>
                            <input type="text" class="form-control @error('location') is-invalid @enderror" 
                                id="location" name="location" value="{{ old('location') }}" required>
                            @error('location')
                                <div class="invalid-feedback">{{ $message }}</div>
                            @enderror
                        </div>

                        <div class="mb-3">
                            <label for="website" class="form-label">Website</label>
                            <input type="url" class="form-control @error('website') is-invalid @enderror" 
                                id="website" name="website" value="{{ old('website') }}">
                            @error('website')
                                <div class="invalid-feedback">{{ $message }}</div>
                            @enderror
                        </div>

                        <div class="mb-3">
                            <label for="photo" class="form-label">Profile Photo</label>
                            <input type="file" class="form-control @error('photo') is-invalid @enderror" 
                                id="photo" name="photo">
                            @error('photo')
                                <div class="invalid-feedback">{{ $message }}</div>
                            @enderror
                        </div>

                        <div class="mb-3">
                            <div class="form-check">
                                <input class="form-check-input" type="checkbox" id="is_active" 
                                    name="is_active" value="1" checked>
                                <label class="form-check-label" for="is_active">
                                    Active
                                </label>
                            </div>
                        </div>
                    </div>

                    <!-- About Me and Skills -->
                    <div class="col-md-6">
                        <h4 class="mb-3">About Me & Skills</h4>

                        <div class="mb-3">
                            <label for="about_me" class="form-label required">About Me</label>
                            <textarea class="form-control @error('about_me') is-invalid @enderror" 
                                id="about_me" name="about_me" rows="5" required>{{ old('about_me') }}</textarea>
                            @error('about_me')
                                <div class="invalid-feedback">{{ $message }}</div>
                            @enderror
                        </div>

                        <div class="mb-3">
                            <label for="skills_input" class="form-label">Skills (comma separated)</label>
                            <input type="text" class="form-control @error('skills') is-invalid @enderror" 
                                id="skills_input" name="skills_input" value="{{ old('skills_input') }}">
                            <div id="skills_container" class="d-flex flex-wrap gap-1 mt-2"></div>
                            <input type="hidden" id="skills_json" name="skills" value="[]">
                            @error('skills')
                                <div class="invalid-feedback">{{ $message }}</div>
                            @enderror
                        </div>

                        <div class="mb-3">
                            <label class="form-label">Social Links</label>

                            <div class="mt-2">
                                <div class="input-group mb-2">
                                    <span class="input-group-text" style="width: 100px;">GitHub</span>
                                    <input type="url" class="form-control @error('social_links.github') is-invalid @enderror" 
                                        name="social_links[github]" value="{{ old('social_links.github') }}" 
                                        placeholder="https://github.com/username">
                                </div>

                                <div class="input-group mb-2">
                                    <span class="input-group-text" style="width: 100px;">LinkedIn</span>
                                    <input type="url" class="form-control @error('social_links.linkedin') is-invalid @enderror" 
                                        name="social_links[linkedin]" value="{{ old('social_links.linkedin') }}" 
                                        placeholder="https://linkedin.com/in/username">
                                </div>

                                <div class="input-group mb-2">
                                    <span class="input-group-text" style="width: 100px;">Twitter</span>
                                    <input type="url" class="form-control @error('social_links.twitter') is-invalid @enderror" 
                                        name="social_links[twitter]" value="{{ old('social_links.twitter') }}" 
                                        placeholder="https://twitter.com/username">
                                </div>
                            </div>
                        </div>

                        <div class="mb-3">
                            <label class="form-label">Languages</label>

                            <div id="languages_container" class="mt-2">
                                <div class="language-item border rounded p-3 mb-2">
                                    <div class="row mb-2">
                                        <div class="col">
                                            <input type="text" class="form-control" name="languages[0][name]" 
                                                placeholder="Language name">
                                        </div>
                                        <div class="col">
                                            <select name="languages[0][level]" class="form-select">
                                                <option value="Native">Native</option>
                                                <option value="Fluent">Fluent</option>
                                                <option value="Intermediate">Intermediate</option>
                                                <option value="Basic">Basic</option>
                                            </select>
                                        </div>
                                    </div>
                                    <div class="d-flex align-items-center">
                                        <span class="me-2 text-muted small">Proficiency:</span>
                                        <input type="number" class="form-control form-control-sm" 
                                            style="width: 70px;" name="languages[0][percentage]" 
                                            min="1" max="100" value="100">
                                        <span class="ms-1 text-muted small">%</span>
                                    </div>
                                </div>
                            </div>

                            <button type="button" id="add_language" class="btn btn-outline-secondary btn-sm mt-2">
                                <i class="ti ti-plus me-1"></i> Add Language
                            </button>
                        </div>
                    </div>
                </div>

                <div class="d-flex justify-content-end mt-4">
                    <a href="{{ route('admin.resume.index') }}" class="btn btn-outline-secondary me-2">
                        Cancel
                    </a>
                    <button type="submit" class="btn btn-primary">
                        <i class="ti ti-device-floppy me-1"></i> Create Resume
                    </button>
                </div>
            </form>
        </div>
    </div>
@endsection

@section('scripts')
<script>
    // Skills handling
    const skillsInput = document.getElementById('skills_input');
    const skillsContainer = document.getElementById('skills_container');
    const skillsJson = document.getElementById('skills_json');
    let skills = [];

    // Initialize skills from existing value if any
    if (skillsJson.value) {
        try {
            skills = JSON.parse(skillsJson.value);
            renderSkills();
        } catch (e) {
            console.error('Error parsing skills JSON', e);
        }
    }

    skillsInput.addEventListener('keydown', function(e) {
        if (e.key === 'Enter' || e.key === ',') {
            e.preventDefault();
            const value = this.value.trim();
            if (value && !skills.includes(value)) {
                skills.push(value);
                renderSkills();
                updateSkillsJson();
            }
            this.value = '';
        }
    });

    function renderSkills() {
        skillsContainer.innerHTML = '';
        skills.forEach((skill, index) => {
            const badge = document.createElement('span');
            badge.className = 'badge bg-primary me-1 mb-1 p-2';
            badge.innerHTML = `${skill} <i class="ti ti-x ms-1 cursor-pointer" onclick="removeSkill(${index})"></i>`;
            skillsContainer.appendChild(badge);
        });
    }

    function removeSkill(index) {
        skills.splice(index, 1);
        renderSkills();
        updateSkillsJson();
    }

    function updateSkillsJson() {
        skillsJson.value = JSON.stringify(skills);
    }

    // Languages handling
    const languagesContainer = document.getElementById('languages_container');
    const addLanguageBtn = document.getElementById('add_language');
    let languageCount = 1;

    addLanguageBtn.addEventListener('click', function() {
        const languageItem = document.createElement('div');
        languageItem.className = 'language-item border rounded p-3 mb-2';
        languageItem.innerHTML = `
            <div class="d-flex justify-content-between mb-2">
                <h6 class="mb-0">Language ${languageCount}</h6>
                <button type="button" class="btn btn-sm btn-outline-danger" onclick="removeLanguage(this)">
                    <i class="ti ti-trash"></i>
                </button>
            </div>
            <div class="row mb-2">
                <div class="col">
                    <input type="text" class="form-control" name="languages[${languageCount}][name]" 
                        placeholder="Language name">
                </div>
                <div class="col">
                    <select name="languages[${languageCount}][level]" class="form-select">
                        <option value="Native">Native</option>
                        <option value="Fluent">Fluent</option>
                        <option value="Intermediate">Intermediate</option>
                        <option value="Basic">Basic</option>
                    </select>
                </div>
            </div>
            <div class="d-flex align-items-center">
                <span class="me-2 text-muted small">Proficiency:</span>
                <input type="number" class="form-control form-control-sm" 
                    style="width: 70px;" name="languages[${languageCount}][percentage]" 
                    min="1" max="100" value="100">
                <span class="ms-1 text-muted small">%</span>
            </div>
        `;
        languagesContainer.appendChild(languageItem);
        languageCount++;
    });

    function removeLanguage(button) {
        const languageItem = button.closest('.language-item');
        languageItem.remove();
    }
</script>
@endsection
