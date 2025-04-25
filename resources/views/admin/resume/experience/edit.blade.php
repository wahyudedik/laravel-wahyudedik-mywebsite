<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 dark:text-gray-200 leading-tight">
            {{ __('Edit Work Experience for') }} {{ $resume->full_name }}
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
                    <form method="POST" action="{{ route('admin.resume.experience.update', [$resume, $experience]) }}">
                        @csrf
                        @method('PUT')

                        <div class="grid grid-cols-1 md:grid-cols-2 gap-6">
                            <div>
                                <div class="mb-4">
                                    <x-input-label for="position" :value="__('Position')" />
                                    <x-text-input id="position" class="block mt-1 w-full" type="text"
                                        name="position" :value="old('position', $experience->position)" required />
                                    <x-input-error :messages="$errors->get('position')" class="mt-2" />
                                </div>

                                <div class="mb-4">
                                    <x-input-label for="company" :value="__('Company')" />
                                    <x-text-input id="company" class="block mt-1 w-full" type="text" name="company"
                                        :value="old('company', $experience->company)" required />
                                    <x-input-error :messages="$errors->get('company')" class="mt-2" />
                                </div>

                                <div class="mb-4">
                                    <x-input-label for="start_date" :value="__('Start Date')" />
                                    <x-text-input id="start_date" class="block mt-1 w-full" type="text"
                                        name="start_date" :value="old('start_date', $experience->start_date)" placeholder="e.g. Jan 2020" required />
                                    <x-input-error :messages="$errors->get('start_date')" class="mt-2" />
                                </div>

                                <div class="mb-4">
                                    <label for="current_job" class="inline-flex items-center">
                                        <input id="current_job" type="checkbox"
                                            class="rounded dark:bg-gray-900 border-gray-300 dark:border-gray-700 text-indigo-600 shadow-sm focus:ring-indigo-500 dark:focus:ring-indigo-600 dark:focus:ring-offset-gray-800"
                                            name="current_job" value="1"
                                            {{ old('current_job', $experience->current_job) ? 'checked' : '' }}>
                                        <span
                                            class="ml-2 text-sm text-gray-600 dark:text-gray-400">{{ __('Current Job') }}</span>
                                    </label>
                                </div>

                                <div class="mb-4" id="end_date_container">
                                    <x-input-label for="end_date" :value="__('End Date')" />
                                    <x-text-input id="end_date" class="block mt-1 w-full" type="text"
                                        name="end_date" :value="old('end_date', $experience->end_date)" placeholder="e.g. Dec 2022" />
                                    <x-input-error :messages="$errors->get('end_date')" class="mt-2" />
                                </div>

                                <div class="mb-4">
                                    <x-input-label for="order" :value="__('Display Order (lower numbers appear first)')" />
                                    <x-text-input id="order" class="block mt-1 w-full" type="number" name="order"
                                        :value="old('order', $experience->order)" min="0" />
                                    <x-input-error :messages="$errors->get('order')" class="mt-2" />
                                </div>
                            </div>

                            <div>
                                <div class="mb-4">
                                    <x-input-label for="description" :value="__('Description')" />
                                    <textarea id="description" name="description" rows="4"
                                        class="block mt-1 w-full rounded-md shadow-sm border-gray-300 dark:border-gray-700 dark:bg-gray-900 dark:text-gray-300 focus:border-indigo-500 dark:focus:border-indigo-600 focus:ring-indigo-500 dark:focus:ring-indigo-600"
                                        required>{{ old('description', $experience->description) }}</textarea>
                                    <x-input-error :messages="$errors->get('description')" class="mt-2" />
                                </div>

                                <div class="mb-4">
                                    <x-input-label for="responsibilities" :value="__('Responsibilities (one per line)')" />
                                    <textarea id="responsibilities_text" rows="6"
                                        class="block mt-1 w-full rounded-md shadow-sm border-gray-300 dark:border-gray-700 dark:bg-gray-900 dark:text-gray-300 focus:border-indigo-500 dark:focus:border-indigo-600 focus:ring-indigo-500 dark:focus:ring-indigo-600">{{ old('responsibilities_text', is_array($experience->responsibilities) ? implode("\n", $experience->responsibilities) : '') }}</textarea>
                                    <input type="hidden" id="responsibilities_json" name="responsibilities"
                                        value="{{ old('responsibilities', json_encode($experience->responsibilities)) }}">
                                    <x-input-error :messages="$errors->get('responsibilities')" class="mt-2" />
                                </div>
                            </div>
                        </div>

                        <div class="flex items-center justify-end mt-4">
                            <a href="{{ route('admin.resume.experience.index', $resume) }}"
                                class="mr-3 font-medium text-blue-600 dark:text-blue-500 hover:underline">Cancel</a>
                            <x-primary-button>
                                {{ __('Update Experience') }}
                            </x-primary-button>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>

    <x-slot name="scripts">
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
    </x-slot>
</x-app-layout>
