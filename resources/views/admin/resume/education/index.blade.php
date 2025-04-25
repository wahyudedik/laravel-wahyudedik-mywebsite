<x-app-layout>
    <x-slot name="header">
        <div class="flex justify-between">
            <h2 class="font-semibold text-xl text-gray-800 dark:text-gray-200 leading-tight">
                {{ __('Education for') }} {{ $resume->full_name }}
            </h2>
            <div class="flex space-x-2">
                <a href="{{ route('admin.resume.index') }}"
                    class="bg-gray-500 hover:bg-gray-700 text-white font-bold py-2 px-4 rounded">
                    Back to Resumes
                </a>
                <a href="{{ route('admin.resume.education.create', $resume) }}"
                    class="bg-blue-500 hover:bg-blue-700 text-white font-bold py-2 px-4 rounded">
                    Add Education
                </a>
            </div>
        </div>
    </x-slot>

    <div class="py-12">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
            @if (session('success'))
                <div class="bg-green-100 border border-green-400 text-green-700 px-4 py-3 rounded relative mb-4"
                    role="alert">
                    <span class="block sm:inline">{{ session('success') }}</span>
                </div>
            @endif

            <div class="bg-white dark:bg-gray-800 overflow-hidden shadow-sm sm:rounded-lg">
                <div class="p-6 text-gray-900 dark:text-gray-100">
                    @if ($educations->count() > 0)
                        <div class="space-y-4">
                            @foreach ($educations as $education)
                                <div class="border dark:border-gray-700 rounded-lg p-4">
                                    <div class="flex justify-between items-start">
                                        <div>
                                            <h3 class="text-lg font-semibold">{{ $education->degree }}</h3>
                                            <p class="text-gray-600 dark:text-gray-400">{{ $education->institution }}
                                            </p>
                                            <p class="text-sm text-gray-500 dark:text-gray-500">
                                                {{ $education->start_date }} - {{ $education->end_date ?? 'Present' }}
                                            </p>
                                        </div>
                                        <div class="flex space-x-2">
                                            <a href="{{ route('admin.resume.education.edit', [$resume, $education]) }}"
                                                class="text-blue-600 hover:text-blue-900 dark:text-blue-400 dark:hover:text-blue-600">Edit</a>
                                            <form
                                                action="{{ route('admin.resume.education.destroy', [$resume, $education]) }}"
                                                method="POST" class="inline delete-education-form">
                                                @csrf
                                                @method('DELETE')
                                                <button type="button"
                                                    class="text-red-600 hover:text-red-900 dark:text-red-400 dark:hover:text-red-600 delete-education-btn">Delete</button>
                                            </form>
                                            <script>
                                                document.querySelectorAll('.delete-education-btn').forEach(button => {
                                                    button.addEventListener('click', function() {
                                                        Swal.fire({
                                                            title: 'Are you sure?',
                                                            text: "You won't be able to revert this!",
                                                            icon: 'warning',
                                                            showCancelButton: true,
                                                            confirmButtonColor: '#3085d6',
                                                            cancelButtonColor: '#d33',
                                                            confirmButtonText: 'Yes, delete it!'
                                                        }).then((result) => {
                                                            if (result.isConfirmed) {
                                                                this.closest('form').submit();
                                                            }
                                                        });
                                                    });
                                                });
                                            </script>
                                        </div>
                                    </div>
                                    @if ($education->description)
                                        <div class="mt-2">
                                            <p>{{ $education->description }}</p>
                                        </div>
                                    @endif
                                    <div class="mt-2 text-sm text-gray-500 dark:text-gray-500">
                                        Order: {{ $education->order }}
                                    </div>
                                </div>
                            @endforeach
                        </div>
                    @else
                        <div class="text-center py-8">
                            <p class="text-gray-500 dark:text-gray-400">No education entries found. Add your first
                                education.</p>
                            <a href="{{ route('admin.resume.education.create', $resume) }}"
                                class="mt-4 inline-block bg-blue-500 hover:bg-blue-700 text-white font-bold py-2 px-4 rounded">
                                Add Education
                            </a>
                        </div>
                    @endif
                </div>
            </div>
        </div>
    </div>
</x-app-layout>
