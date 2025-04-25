<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 dark:text-gray-200 leading-tight">
            {{ __('Edit Project for') }} {{ $resume->full_name }}
        </h2>
    </x-slot>

    <div class="py-12">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
            @if (session('error'))
                <div class="bg-red-100 border border-red-400 text-red-700 px-4 py-3 rounded relative mb-4" role="alert">
                    <span class="block sm:inline">{{ session('error') }}</span>
                </div>
            @endif
            @if (session('success'))
                <div class="bg-green-100 border border-green-400 text-green-700 px-4 py-3 rounded relative mb-4"
                    role="alert">
                    <span class="block sm:inline">{{ session('success') }}</span>
                </div>
            @endif
            <div class="bg-white dark:bg-gray-800 overflow-hidden shadow-sm sm:rounded-lg">
                <div class="p-6 text-gray-900 dark:text-gray-100">
                    <form method="POST" action="{{ route('admin.resume.project.update', [$resume, $project]) }}">
                        @csrf
                        @method('PUT')

                        <div class="grid grid-cols-1 md:grid-cols-2 gap-6">
                            <div>
                                <div class="mb-4">
                                    <x-input-label for="name" :value="__('Project name')" />
                                    <x-text-input id="name" class="block mt-1 w-full" type="text" name="name"
                                        :value="old('name', $project->name)" required />
                                    <x-input-error :messages="$errors->get('name')" class="mt-2" />
                                </div>

                                <div class="mb-4">
                                    <x-input-label for="url" :value="__('Project URL (optional)')" />
                                    <x-text-input id="url" class="block mt-1 w-full" type="url" name="url"
                                        :value="old('url', $project->url)" placeholder="https://example.com" />
                                    <x-input-error :messages="$errors->get('url')" class="mt-2" />
                                </div>

                                <div class="mb-4">
                                    <x-input-label for="order" :value="__('Display Order (lower numbers appear first)')" />
                                    <x-text-input id="order" class="block mt-1 w-full" type="number" name="order"
                                        :value="old('order', $project->order)" min="0" />
                                    <x-input-error :messages="$errors->get('order')" class="mt-2" />
                                </div>
                            </div>

                            <div>
                                <div class="mb-4">
                                    <x-input-label for="description" :value="__('Description')" />
                                    <textarea id="description" name="description" rows="4"
                                        class="block mt-1 w-full rounded-md shadow-sm border-gray-300 dark:border-gray-700 dark:bg-gray-900 dark:text-gray-300 focus:border-indigo-500 dark:focus:border-indigo-600 focus:ring-indigo-500 dark:focus:ring-indigo-600"
                                        required>{{ old('description', $project->description) }}</textarea>
                                    <x-input-error :messages="$errors->get('description')" class="mt-2" />
                                </div>

                                <div class="mb-4">
                                    <x-input-label for="technologies" :value="__('Technologies Used')" />
                                    <x-text-input id="technologies_input" class="block mt-1 w-full" type="text"
                                        name="technologies_input" placeholder="Add technologies and press Enter" />
                                    <div id="technologies_container" class="mt-2 flex flex-wrap gap-2"></div>
                                    <input type="hidden" id="technologies_json" name="technologies"
                                        value="{{ old('technologies', json_encode($project->technologies)) }}">
                                    <x-input-error :messages="$errors->get('technologies')" class="mt-2" />
                                </div>
                            </div>
                        </div>

                        <div class="flex items-center justify-end mt-4">
                            <a href="{{ route('admin.resume.project.index', $resume) }}"
                                class="mr-3 font-medium text-blue-600 dark:text-blue-500 hover:underline">Cancel</a>
                            <x-primary-button>
                                {{ __('Update Project') }}
                            </x-primary-button>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>

    <x-slot name="scripts">
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
                    badge.className =
                        'bg-blue-100 text-blue-800 text-xs font-medium px-2.5 py-0.5 rounded dark:bg-blue-900 dark:text-blue-300 flex items-center';
                    badge.innerHTML = `
                        ${technology}
                        <button type="button" class="ml-1 text-blue-800 dark:text-blue-300 hover:text-blue-900 dark:hover:text-blue-400" data-index="${index}">
                            ×
                        </button>
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
    </x-slot>
</x-app-layout>
