<x-app-layout>
    <x-slot name="header">
        <div class="flex justify-between items-center">
            <h2 class="font-semibold text-xl text-gray-800 dark:text-gray-200 leading-tight">
                {{ __('Resume Details') }}
            </h2>
            <div class="flex space-x-2">
                <a href="{{ route('admin.resume.index') }}" class="bg-gray-500 hover:bg-gray-700 text-white font-bold py-2 px-4 rounded">
                    Back to Resumes
                </a>
                <a href="{{ route('admin.resume.edit', $resume) }}" class="bg-blue-500 hover:bg-blue-700 text-white font-bold py-2 px-4 rounded">
                    Edit Resume
                </a>
            </div>
        </div>
    </x-slot>

    <div class="py-12">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
            <div class="bg-white dark:bg-gray-800 overflow-hidden shadow-sm sm:rounded-lg">
                <div class="p-6 text-gray-900 dark:text-gray-100">
                    <div class="grid grid-cols-1 md:grid-cols-3 gap-6">
                        <!-- Left column - Personal Info -->
                        <div>
                            <div class="mb-6 text-center">
                                @if($resume->photo_path)
                                    <img src="{{ Storage::url($resume->photo_path) }}" alt="{{ $resume->full_name }}" class="w-32 h-32 object-cover rounded-full mx-auto mb-4">
                                @else
                                    <div class="w-32 h-32 bg-gray-200 dark:bg-gray-700 rounded-full flex items-center justify-center mx-auto mb-4">
                                        <span class="text-4xl text-gray-500 dark:text-gray-400">
                                            {{ strtoupper(substr($resume->full_name, 0, 1)) }}
                                        </span>
                                    </div>
                                @endif
                                <h2 class="text-2xl font-bold">{{ $resume->full_name }}</h2>
                                <p class="text-gray-600 dark:text-gray-400">{{ $resume->title }}</p>
                                <div class="mt-2">
                                    <span class="px-2 py-1 text-xs rounded-full {{ $resume->is_active ? 'bg-green-100 text-green-800 dark:bg-green-900 dark:text-green-300' : 'bg-gray-100 text-gray-800 dark:bg-gray-700 dark:text-gray-300' }}">
                                        {{ $resume->is_active ? 'Active' : 'Inactive' }}
                                    </span>
                                </div>
                            </div>

                            <div class="border-t dark:border-gray-700 pt-4">
                                <h3 class="text-lg font-semibold mb-3">Contact Information</h3>
                                <div class="space-y-2">
                                    <div class="flex items-center">
                                        <span class="w-8 text-gray-500 dark:text-gray-400">
                                            <i class="ti ti-mail"></i>
                                        </span>
                                        <span>{{ $resume->email }}</span>
                                    </div>
                                    <div class="flex items-center">
                                        <span class="w-8 text-gray-500 dark:text-gray-400">
                                            <i class="ti ti-phone"></i>
                                        </span>
                                        <span>{{ $resume->phone }}</span>
                                    </div>
                                    <div class="flex items-center">
                                        <span class="w-8 text-gray-500 dark:text-gray-400">
                                            <i class="ti ti-map-pin"></i>
                                        </span>
                                        <span>{{ $resume->location }}</span>
                                    </div>
                                    @if($resume->website)
                                    <div class="flex items-center">
                                        <span class="w-8 text-gray-500 dark:text-gray-400">
                                            <i class="ti ti-world"></i>
                                        </span>
                                        <a href="{{ $resume->website }}" target="_blank" class="text-blue-600 dark:text-blue-400 hover:underline">
                                            {{ $resume->website }}
                                        </a>
                                    </div>
                                    @endif
                                </div>
                            </div>

                            @if(is_array($resume->social_links) && count($resume->social_links) > 0)
                            <div class="border-t dark:border-gray-700 pt-4 mt-4">
                                <h3 class="text-lg font-semibold mb-3">Social Profiles</h3>
                                <div class="space-y-2">
                                    @foreach($resume->social_links as $platform => $url)
                                        @if($url)
                                        <div class="flex items-center">
                                            <span class="w-8 text-gray-500 dark:text-gray-400">
                                                <i class="ti ti-brand-{{ $platform }}"></i>
                                            </span>
                                            <a href="{{ $url }}" target="_blank" class="text-blue-600 dark:text-blue-400 hover:underline">
                                                {{ $platform }}
                                            </a>
                                        </div>
                                        @endif
                                    @endforeach
                                </div>
                            </div>
                            @endif

                            @if(is_array($resume->languages) && count($resume->languages) > 0)
                            <div class="border-t dark:border-gray-700 pt-4 mt-4">
                                <h3 class="text-lg font-semibold mb-3">Languages</h3>
                                <div class="space-y-3">
                                    @foreach($resume->languages as $language)
                                        <div>
                                            <div class="flex justify-between mb-1">
                                                <span>{{ $language['name'] ?? 'Language' }}</span>
                                                <span>{{ $language['level'] ?? 'Proficient' }}</span>
                                            </div>
                                            <div class="w-full bg-gray-200 rounded-full h-2.5 dark:bg-gray-700">
                                                <div class="bg-blue-600 h-2.5 rounded-full" style="width: {{ $language['percentage'] ?? 100 }}%"></div>
                                            </div>
                                        </div>
                                    @endforeach
                                </div>
                            </div>
                            @endif
                        </div>

                        <!-- Middle and Right columns -->
                        <div class="md:col-span-2">
                            <div class="mb-6">
                                <h3 class="text-lg font-semibold mb-3">About Me</h3>
                                <div class="bg-gray-50 dark:bg-gray-900 p-4 rounded-lg">
                                    <p>{{ $resume->about_me }}</p>
                                </div>
                            </div>

                            @if(is_array($resume->skills) && count($resume->skills) > 0)
                            <div class="mb-6">
                                <h3 class="text-lg font-semibold mb-3">Skills</h3>
                                <div class="flex flex-wrap gap-2">
                                    @foreach($resume->skills as $skill)
                                        <span class="bg-blue-100 text-blue-800 text-xs font-medium px-2.5 py-0.5 rounded dark:bg-blue-900 dark:text-blue-300">
                                            {{ $skill }}
                                        </span>
                                    @endforeach
                                </div>
                            </div>
                            @endif

                            <!-- Work Experience Section -->
                            <div class="mb-6">
                                <div class="flex justify-between items-center mb-3">
                                    <h3 class="text-lg font-semibold">Work Experience</h3>
                                    <a href="{{ route('admin.resume.experience.index', $resume) }}" class="text-blue-600 dark:text-blue-400 hover:underline">
                                        Manage Experiences
                                    </a>
                                </div>
                                
                                @if($resume->workExperiences->count() > 0)
                                    <div class="space-y-4">
                                        @foreach($resume->workExperiences as $experience)
                                            <div class="bg-gray-50 dark:bg-gray-900 p-4 rounded-lg">
                                                <div class="flex justify-between">
                                                    <div>
                                                        <h4 class="font-semibold">{{ $experience->position }}</h4>
                                                        <p class="text-gray-600 dark:text-gray-400">{{ $experience->company }}</p>
                                                        <p class="text-sm text-gray-500 dark:text-gray-500">
                                                            {{ $experience->start_date }} - {{ $experience->current_job ? 'Present' : $experience->end_date }}
                                                        </p>
                                                    </div>
                                                    <a href="{{ route('admin.resume.experience.edit', [$resume, $experience]) }}" class="text-blue-600 dark:text-blue-400 hover:underline">
                                                        Edit
                                                    </a>
                                                </div>
                                                <p class="mt-2">{{ $experience->description }}</p>
                                                @if(is_array($experience->responsibilities) && count($experience->responsibilities) > 0)
                                                    <ul class="list-disc list-inside mt-2">
                                                        @foreach($experience->responsibilities as $responsibility)
                                                            <li>{{ $responsibility }}</li>
                                                        @endforeach
                                                    </ul>
                                                @endif
                                            </div>
                                        @endforeach
                                    </div>
                                @else
                                    <div class="bg-gray-50 dark:bg-gray-900 p-4 rounded-lg text-center">
                                        <p class="text-gray-500 dark:text-gray-400">No work experience added yet.</p>
                                        <a href="{{ route('admin.resume.experience.create', $resume) }}" class="mt-2 inline-block text-blue-600 dark:text-blue-400 hover:underline">
                                            Add Work Experience
                                        </a>
                                    </div>
                                @endif
                            </div>

                            <!-- Education Section -->
                            <div class="mb-6">
                                <div class="flex justify-between items-center mb-3">
                                    <h3 class="text-lg font-semibold">Education</h3>
                                    <a href="{{ route('admin.resume.education.index', $resume) }}" class="text-blue-600 dark:text-blue-400 hover:underline">
                                        Manage Education
                                    </a>
                                </div>
                                
                                @if($resume->education->count() > 0)
                                    <div class="space-y-4">
                                        @foreach($resume->education as $edu)
                                            <div class="bg-gray-50 dark:bg-gray-900 p-4 rounded-lg">
                                                <div class="flex justify-between">
                                                    <div>
                                                        <h4 class="font-semibold">{{ $edu->degree }}</h4>
                                                        <p class="text-gray-600 dark:text-gray-400">{{ $edu->institution }}</p>
                                                        <p class="text-sm text-gray-500 dark:text-gray-500">
                                                            {{ $edu->start_date }} - {{ $edu->end_date ?? 'Present' }}
                                                        </p>
                                                    </div>
                                                    <a href="{{ route('admin.resume.education.edit', [$resume, $edu]) }}" class="text-blue-600 dark:text-blue-400 hover:underline">
                                                        Edit
                                                    </a>
                                                </div>
                                                @if($edu->description)
                                                    <p class="mt-2">{{ $edu->description }}</p>
                                                @endif
                                            </div>
                                        @endforeach
                                    </div>
                                @else
                                    <div class="bg-gray-50 dark:bg-gray-900 p-4 rounded-lg text-center">
                                        <p class="text-gray-500 dark:text-gray-400">No education added yet.</p>
                                        <a href="{{ route('admin.resume.education.create', $resume) }}" class="mt-2 inline-block text-blue-600 dark:text-blue-400 hover:underline">
                                            Add Education
                                        </a>
                                    </div>
                                @endif
                            </div>

                            <!-- Projects Section -->
                            <div>
                                <div class="flex justify-between items-center mb-3">
                                    <h3 class="text-lg font-semibold">Projects</h3>
                                    <a href="{{ route('admin.resume.project.index', $resume) }}" class="text-blue-600 dark:text-blue-400 hover:underline">
                                        Manage Projects
                                    </a>
                                </div>
                                
                                @if($resume->projects->count() > 0)
                                    <div class="space-y-4">
                                        @foreach($resume->projects as $project)
                                            <div class="bg-gray-50 dark:bg-gray-900 p-4 rounded-lg">
                                                <div class="flex justify-between">
                                                    <div>
                                                        <h4 class="font-semibold">{{ $project->title }}</h4>
                                                        @if($project->url)
                                                            <a href="{{ $project->url }}" target="_blank" class="text-blue-600 dark:text-blue-400 hover:underline">
                                                                {{ $project->url }}
                                                            </a>
                                                        @endif
                                                    </div>
                                                    <a href="{{ route('admin.resume.project.edit', [$resume, $project]) }}" class="text-blue-600 dark:text-blue-400 hover:underline">
                                                        Edit
                                                    </a>
                                                </div>
                                                <p class="mt-2">{{ $project->description }}</p>
                                                @if(is_array($project->technologies) && count($project->technologies) > 0)
                                                    <div class="mt-2 flex flex-wrap gap-1">
                                                        @foreach($project->technologies as $tech)
                                                            <span class="bg-blue-100 text-blue-800 text-xs font-medium px-2.5 py-0.5 rounded dark:bg-blue-900 dark:text-blue-300">
                                                                {{ $tech }}
                                                            </span>
                                                        @endforeach
                                                    </div>
                                                @endif
                                            </div>
                                        @endforeach
                                    </div>
                                @else
                                    <div class="bg-gray-50 dark:bg-gray-900 p-4 rounded-lg text-center">
                                        <p class="text-gray-500 dark:text-gray-400">No projects added yet.</p>
                                        <a href="{{ route('admin.resume.project.create', $resume) }}" class="mt-2 inline-block text-blue-600 dark:text-blue-400 hover:underline">
                                            Add Project
                                        </a>
                                    </div>
                                @endif
                            </div>
                        </div>
                    </div>
                </div>
            </div>

            <div class="mt-6 flex justify-between">
                <a href="{{ route('admin.resume.index') }}" class="bg-gray-500 hover:bg-gray-700 text-white font-bold py-2 px-4 rounded">
                    Back to Resumes
                </a>
                <div class="flex space-x-2">
                    <a href="{{ route('admin.resume.edit', $resume) }}" class="bg-blue-500 hover:bg-blue-700 text-white font-bold py-2 px-4 rounded">
                        Edit Resume
                    </a>
                    <form action="{{ route('admin.resume.destroy', $resume) }}" method="POST" class="inline">
                        @csrf
                        @method('DELETE')
                        <button type="submit" class="bg-red-500 hover:bg-red-700 text-white font-bold py-2 px-4 rounded" onclick="return confirm('Are you sure you want to delete this resume?')">
                            Delete Resume
                        </button>
                    </form>
                </div>
            </div>
        </div>
    </div>
</x-app-layout>