@extends('layouts.app')

@section('header')
    <div class="d-flex justify-content-between align-items-center">
        <h2 class="fs-2 m-0">
            {{ __('Resume Details') }}
        </h2>
        <div class="d-flex gap-2">
            <a href="{{ route('admin.resume.index') }}" class="btn btn-outline-secondary">
                <i class="ti ti-arrow-left me-1"></i> Back to Resumes
            </a>
            <a href="{{ route('admin.resume.edit', $resume) }}" class="btn btn-primary">
                <i class="ti ti-edit me-1"></i> Edit Resume
            </a>
        </div>
    </div>
@endsection

@section('content')
    <div class="card shadow-sm">
        <div class="card-body">
            <div class="row">
                <!-- Left column - Personal Info -->
                <div class="col-md-4">
                    <div class="text-center mb-4">
                        @if($resume->photo_path)
                            <img src="{{ Storage::url($resume->photo_path) }}" alt="{{ $resume->full_name }}" 
                                class="rounded-circle mb-3" style="width: 150px; height: 150px; object-fit: cover;">
                        @else
                            <div class="bg-light rounded-circle d-flex align-items-center justify-content-center mx-auto mb-3"
                                style="width: 150px; height: 150px;">
                                <span class="display-4 text-muted">
                                    {{ strtoupper(substr($resume->full_name, 0, 1)) }}
                                </span>
                            </div>
                        @endif
                        <h3 class="mb-1">{{ $resume->full_name }}</h3>
                        <p class="text-muted">{{ $resume->title }}</p>
                        <div>
                            <span class="badge {{ $resume->is_active ? 'bg-success' : 'bg-secondary' }}">
                                {{ $resume->is_active ? 'Active' : 'Inactive' }}
                            </span>
                        </div>
                    </div>

                    <div class="border-top pt-3">
                        <h5 class="mb-3">Contact Information</h5>
                        <div class="mb-2">
                            <div class="d-flex align-items-center mb-2">
                                <i class="ti ti-mail text-primary me-2"></i>
                                <span>{{ $resume->email }}</span>
                            </div>
                            <div class="d-flex align-items-center mb-2">
                                <i class="ti ti-phone text-primary me-2"></i>
                                <span>{{ $resume->phone }}</span>
                            </div>
                            <div class="d-flex align-items-center mb-2">
                                <i class="ti ti-map-pin text-primary me-2"></i>
                                <span>{{ $resume->location }}</span>
                            </div>
                            @if($resume->website)
                            <div class="d-flex align-items-center mb-2">
                                <i class="ti ti-world text-primary me-2"></i>
                                <a href="{{ $resume->website }}" target="_blank" class="text-decoration-none">
                                    {{ $resume->website }}
                                </a>
                            </div>
                            @endif
                        </div>
                    </div>

                    @if(is_array($resume->social_links) && count(array_filter($resume->social_links)) > 0)
                    <div class="border-top pt-3 mt-3">
                        <h5 class="mb-3">Social Profiles</h5>
                        <div class="mb-2">
                            @foreach($resume->social_links as $platform => $url)
                                @if($url)
                                <div class="d-flex align-items-center mb-2">
                                    <i class="ti ti-brand-{{ $platform }} text-primary me-2"></i>
                                    <a href="{{ $url }}" target="_blank" class="text-decoration-none">
                                        {{ ucfirst($platform) }}
                                    </a>
                                </div>
                                @endif
                            @endforeach
                        </div>
                    </div>
                    @endif

                    @if(is_array($resume->languages) && count($resume->languages) > 0)
                    <div class="border-top pt-3 mt-3">
                        <h5 class="mb-3">Languages</h5>
                        <div class="mb-2">
                            @foreach($resume->languages as $language)
                                @if(isset($language['name']) && $language['name'])
                                <div class="mb-3">
                                    <div class="d-flex justify-content-between mb-1">
                                        <span>{{ $language['name'] }}</span>
                                        <span class="text-muted">{{ $language['level'] ?? 'Proficient' }}</span>
                                    </div>
                                    <div class="progress" style="height: 6px;">
                                        <div class="progress-bar bg-primary" role="progressbar" 
                                            style="width: {{ $language['percentage'] ?? 100 }}%"></div>
                                    </div>
                                </div>
                                @endif
                            @endforeach
                        </div>
                    </div>
                    @endif
                </div>

                <!-- Middle and Right columns -->
                <div class="col-md-8">
                    <div class="mb-4">
                        <h5 class="mb-3">About Me</h5>
                        <div class="bg-light p-3 rounded">
                            <p class="mb-0">{{ $resume->about_me }}</p>
                        </div>
                    </div>

                    @if(is_array($resume->skills) && count($resume->skills) > 0)
                    <div class="mb-4">
                        <h5 class="mb-3">Skills</h5>
                        <div class="d-flex flex-wrap gap-2">
                            @foreach($resume->skills as $skill)
                                <span class="badge bg-primary bg-opacity-10 text-primary p-2">
                                    {{ $skill }}
                                </span>
                            @endforeach
                        </div>
                    </div>
                    @endif

                    <!-- Work Experience Section -->
                    <div class="mb-4">
                        <div class="d-flex justify-content-between align-items-center mb-3">
                            <h5 class="mb-0">Work Experience</h5>
                            <a href="{{ route('admin.resume.experience.index', $resume) }}" class="btn btn-sm btn-outline-primary">
                                <i class="ti ti-settings me-1"></i> Manage Experiences
                            </a>
                        </div>
                        
                        @if($resume->workExperiences->count() > 0)
                            <div class="timeline">
                                @foreach($resume->workExperiences as $experience)
                                    <div class="card mb-3">
                                        <div class="card-body">
                                            <div class="d-flex justify-content-between">
                                                <div>
                                                    <h5 class="card-title">{{ $experience->position }}</h5>
                                                    <h6 class="card-subtitle mb-2 text-muted">{{ $experience->company }}</h6>
                                                    <p class="card-text text-muted small">
                                                        {{ $experience->start_date }} - {{ $experience->current_job ? 'Present' : $experience->end_date }}
                                                    </p>
                                                </div>
                                                <a href="{{ route('admin.resume.experience.edit', [$resume, $experience]) }}" 
                                                    class="btn btn-sm btn-outline-secondary">
                                                    <i class="ti ti-edit"></i>
                                                </a>
                                            </div>
                                            <p class="card-text mt-2">{{ $experience->description }}</p>
                                            @if(is_array($experience->responsibilities) && count($experience->responsibilities) > 0)
                                                <ul class="list-group list-group-flush mt-2">
                                                    @foreach($experience->responsibilities as $responsibility)
                                                        <li class="list-group-item bg-transparent px-0">
                                                            <i class="ti ti-point text-primary me-2"></i>{{ $responsibility }}
                                                        </li>
                                                    @endforeach
                                                </ul>
                                            @endif
                                        </div>
                                    </div>
                                @endforeach
                            </div>
                        @else
                            <div class="text-center py-4 bg-light rounded">
                                <i class="ti ti-briefcase fs-1 text-muted mb-2"></i>
                                <p class="text-muted">No work experience added yet.</p>
                                <a href="{{ route('admin.resume.experience.create', $resume) }}" class="btn btn-sm btn-outline-primary mt-2">
                                    <i class="ti ti-plus me-1"></i> Add Work Experience
                                </a>
                            </div>
                        @endif
                    </div>

                    <!-- Education Section -->
                    <div class="mb-4">
                        <div class="d-flex justify-content-between align-items-center mb-3">
                            <h5 class="mb-0">Education</h5>
                            <a href="{{ route('admin.resume.education.index', $resume) }}" class="btn btn-sm btn-outline-primary">
                                <i class="ti ti-settings me-1"></i> Manage Education
                            </a>
                        </div>
                        
                        @if($resume->education->count() > 0)
                            <div class="timeline">
                                @foreach($resume->education as $edu)
                                    <div class="card mb-3">
                                        <div class="card-body">
                                            <div class="d-flex justify-content-between">
                                                <div>
                                                    <h5 class="card-title">{{ $edu->degree }}</h5>
                                                    <h6 class="card-subtitle mb-2 text-muted">{{ $edu->institution }}</h6>
                                                    <p class="card-text text-muted small">
                                                        {{ $edu->start_date }} - {{ $edu->end_date ?? 'Present' }}
                                                    </p>
                                                </div>
                                                <a href="{{ route('admin.resume.education.edit', [$resume, $edu]) }}" 
                                                    class="btn btn-sm btn-outline-secondary">
                                                    <i class="ti ti-edit"></i>
                                                </a>
                                            </div>
                                            @if($edu->description)
                                                <p class="card-text mt-2">{{ $edu->description }}</p>
                                            @endif
                                        </div>
                                    </div>
                                @endforeach
                            </div>
                        @else
                            <div class="text-center py-4 bg-light rounded">
                                <i class="ti ti-school fs-1 text-muted mb-2"></i>
                                <p class="text-muted">No education added yet.</p>
                                <a href="{{ route('admin.resume.education.create', $resume) }}" class="btn btn-sm btn-outline-primary mt-2">
                                    <i class="ti ti-plus me-1"></i> Add Education
                                </a>
                            </div>
                        @endif
                    </div>

                    <!-- Projects Section -->
                    <div>
                        <div class="d-flex justify-content-between align-items-center mb-3">
                            <h5 class="mb-0">Projects</h5>
                            <a href="{{ route('admin.resume.project.index', $resume) }}" class="btn btn-sm btn-outline-primary">
                                <i class="ti ti-settings me-1"></i> Manage Projects
                            </a>
                        </div>
                        
                        @if($resume->projects->count() > 0)
                            <div class="timeline">
                                @foreach($resume->projects as $project)
                                    <div class="card mb-3">
                                        <div class="card-body">
                                            <div class="d-flex justify-content-between">
                                                <div>
                                                    <h5 class="card-title">{{ $project->title }}</h5>
                                                    @if($project->url)
                                                        <a href="{{ $project->url }}" target="_blank" class="text-decoration-none">
                                                            <i class="ti ti-link me-1"></i>{{ $project->url }}
                                                        </a>
                                                    @endif
                                                </div>
                                                <a href="{{ route('admin.resume.project.edit', [$resume, $project]) }}" 
                                                    class="btn btn-sm btn-outline-secondary">
                                                    <i class="ti ti-edit"></i>
                                                </a>
                                            </div>
                                            <p class="card-text mt-2">{{ $project->description }}</p>
                                            @if(is_array($project->technologies) && count($project->technologies) > 0)
                                                <div class="mt-2 d-flex flex-wrap gap-1">
                                                    @foreach($project->technologies as $tech)
                                                        <span class="badge bg-info bg-opacity-10 text-info p-2">
                                                            {{ $tech }}
                                                        </span>
                                                    @endforeach
                                                </div>
                                            @endif
                                        </div>
                                    </div>
                                @endforeach
                            </div>
                        @else
                            <div class="text-center py-4 bg-light rounded">
                                <i class="ti ti-code fs-1 text-muted mb-2"></i>
                                <p class="text-muted">No projects added yet.</p>
                                <a href="{{ route('admin.resume.project.create', $resume) }}" class="btn btn-sm btn-outline-primary mt-2">
                                    <i class="ti ti-plus me-1"></i> Add Project
                                </a>
                            </div>
                        @endif
                    </div>
                </div>
            </div>
        </div>
    </div>

    <div class="d-flex justify-content-between mt-4">
        <a href="{{ route('admin.resume.index') }}" class="btn btn-outline-secondary">
            <i class="ti ti-arrow-left me-1"></i> Back to Resumes
        </a>
        <div class="d-flex gap-2">
            <a href="{{ route('admin.resume.edit', $resume) }}" class="btn btn-primary">
                <i class="ti ti-edit me-1"></i> Edit Resume
            </a>
            <button type="button" class="btn btn-danger" onclick="deleteResume()">
                <i class="ti ti-trash me-1"></i> Delete Resume
            </button>
            <form id="delete-form" action="{{ route('admin.resume.destroy', $resume) }}" method="POST" class="d-none">
                @csrf
                @method('DELETE')
            </form>
        </div>
    </div>
@endsection

@section('scripts')
<script>
    function deleteResume() {
        Swal.fire({
            title: 'Are you sure?',
            text: "You will not be able to recover this resume!",
            icon: 'warning',
            showCancelButton: true,
            confirmButtonColor: '#dc3545',
            cancelButtonColor: '#6c757d',
            confirmButtonText: 'Yes, delete it!',
            cancelButtonText: 'Cancel'
        }).then((result) => {
            if (result.isConfirmed) {
                document.getElementById('delete-form').submit();
            }
        });
    }
</script>
@endsection
