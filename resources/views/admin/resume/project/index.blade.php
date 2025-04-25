<x-app-layout>
    <x-slot name="header">
        <div class="flex justify-between">
            <h2 class="font-semibold text-xl text-gray-800 dark:text-gray-200 leading-tight">
                {{ __('Projects for') }} {{ $resume->full_name }}
            </h2>
            <div class="flex space-x-2">
                <a href="{{ route('admin.resume.index') }}" class="bg-gray-500 hover:bg-gray-700 text-white font-bold py-2 px-4 rounded">
                    Back to Resumes
                </a>
                <a href="{{ route('admin.resume.project.create', $resume) }}" class="bg-blue-500 hover:bg-blue-700 text-white font-bold py-2 px-4 rounded">
                    Add Project
                </a>
            </div>
        </div>
    </x-slot>

    <div class="py-12">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
            @if (session('success'))
                <div class="bg-green-100 border border-green-400 text-green-700 px-4 py-3 rounded relative mb-4" role="alert">
                    <span class="block sm:inline">{{ session('success') }}</span>
                </div>
            @endif

            <div class="bg-white dark:bg-gray-800 overflow-hidden shadow-sm sm:rounded-lg">
                <div class="p-6 text-gray-900 dark:text-gray-100">
                    @if($projects->count() > 0)
                        <div class="space-y-4">
                            @foreach($projects as $project)
                                <div class="border dark:border-gray-700 rounded-lg p-4">
                                    <div class="flex justify-between items-start">
                                        <div>
                                            <h3 class="text-lg font-semibold">{{ $project->name }}</h3>
                                            @if($project->url)
                                                <p class="text-blue-600 dark:text-blue-400">
                                                    <a href="{{ $project->url }}" target="_blank" class="hover:underline">
                                                        {{ $project->url }}
                                                    </a>
                                                </p>
                                            @endif
                                        </div>
                                        <div class="flex space-x-2">
                                            <a href="{{ route('admin.resume.project.edit', [$resume, $project]) }}" class="text-blue-600 hover:text-blue-900 dark:text-blue-400 dark:hover:text-blue-600">Edit</a>
                                            <form action="{{ route('admin.resume.project.destroy', [$resume, $project]) }}" method="POST" class="inline">
                                                @csrf
                                                @method('DELETE')
                                                <button type="submit" class="text-red-600 hover:text-red-900 dark:text-red-400 dark:hover:text-red-600" onclick="return confirm('Are you sure you want to delete this project?')">Delete</button>
                                            </form>
                                        </div>
                                    </div>
                                    <div class="mt-2">
                                        <p>{{ $project->description }}</p>
                                    </div>
                                    @if(is_array($project->technologies) && count($project->technologies) > 0)
                                        <div class="mt-2 flex flex-wrap gap-1">
                                            @foreach($project->technologies as $tech)
                                                <span class="bg-blue-100 text-blue-800 text-xs font-medium px-2.5 py-0.5 rounded dark:bg-blue-900 dark:text-blue-300">
                                                    {{ $tech }}
                                                </span>
                                            @endforeach
                                        </div>
                                    @endif
                                    <div class="mt-2 text-sm text-gray-500 dark:text-gray-500">
                                        Order: {{ $project->order }}
                                    </div>
                                </div>
                            @endforeach
                        </div>
                    @else
                        <div class="text-center py-8">
                            <p class="text-gray-500 dark:text-gray-400">No projects found. Add your first project.</p>
                            <a href="{{ route('admin.resume.project.create', $resume) }}" class="mt-4 inline-block bg-blue-500 hover:bg-blue-700 text-white font-bold py-2 px-4 rounded">
                                Add Project
                            </a>
                        </div>
                    @endif
                </div>
            </div>
        </div>
    </div>
</x-app-layout>