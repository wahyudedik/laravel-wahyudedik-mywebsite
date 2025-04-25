<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 dark:text-gray-200 leading-tight">
            {{ __('Create Resume') }}
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
                    <form method="POST" action="{{ route('admin.resume.store') }}" enctype="multipart/form-data">
                        @csrf

                        <div class="grid grid-cols-1 md:grid-cols-2 gap-6">
                            <!-- Personal Information -->
                            <div>
                                <h3 class="text-lg font-medium mb-4">Personal Information</h3>

                                <div class="mb-4">
                                    <x-input-label for="full_name" :value="__('Full Name')" />
                                    <x-text-input id="full_name" class="block mt-1 w-full" type="text"
                                        name="full_name" :value="old('full_name')" required />
                                    <x-input-error :messages="$errors->get('full_name')" class="mt-2" />
                                </div>

                                <div class="mb-4">
                                    <x-input-label for="title" :value="__('Professional Title')" />
                                    <x-text-input id="title" class="block mt-1 w-full" type="text" name="title"
                                        :value="old('title')" required />
                                    <x-input-error :messages="$errors->get('title')" class="mt-2" />
                                </div>

                                <div class="mb-4">
                                    <x-input-label for="email" :value="__('Email')" />
                                    <x-text-input id="email" class="block mt-1 w-full" type="email" name="email"
                                        :value="old('email')" required />
                                    <x-input-error :messages="$errors->get('email')" class="mt-2" />
                                </div>

                                <div class="mb-4">
                                    <x-input-label for="phone" :value="__('Phone')" />
                                    <x-text-input id="phone" class="block mt-1 w-full" type="text" name="phone"
                                        :value="old('phone')" required />
                                    <x-input-error :messages="$errors->get('phone')" class="mt-2" />
                                </div>

                                <div class="mb-4">
                                    <x-input-label for="location" :value="__('Location')" />
                                    <x-text-input id="location" class="block mt-1 w-full" type="text"
                                        name="location" :value="old('location')" required />
                                    <x-input-error :messages="$errors->get('location')" class="mt-2" />
                                </div>

                                <div class="mb-4">
                                    <x-input-label for="website" :value="__('Website')" />
                                    <x-text-input id="website" class="block mt-1 w-full" type="url" name="website"
                                        :value="old('website')" />
                                    <x-input-error :messages="$errors->get('website')" class="mt-2" />
                                </div>

                                <div class="mb-4">
                                    <x-input-label for="photo" :value="__('Profile Photo')" />
                                    <input id="photo" class="block mt-1 w-full" type="file" name="photo" />
                                    <x-input-error :messages="$errors->get('photo')" class="mt-2" />
                                </div>

                                <div class="mb-4">
                                    <label for="is_active" class="inline-flex items-center">
                                        <input id="is_active" type="checkbox"
                                            class="rounded dark:bg-gray-900 border-gray-300 dark:border-gray-700 text-indigo-600 shadow-sm focus:ring-indigo-500 dark:focus:ring-indigo-600 dark:focus:ring-offset-gray-800"
                                            name="is_active" value="1" checked>
                                        <span
                                            class="ml-2 text-sm text-gray-600 dark:text-gray-400">{{ __('Active') }}</span>
                                    </label>
                                </div>
                            </div>

                            <!-- About Me and Skills -->
                            <div>
                                <h3 class="text-lg font-medium mb-4">About Me & Skills</h3>

                                <div class="mb-4">
                                    <x-input-label for="about_me" :value="__('About Me')" />
                                    <textarea id="about_me" name="about_me" rows="5"
                                        class="block mt-1 w-full rounded-md shadow-sm border-gray-300 dark:border-gray-700 dark:bg-gray-900 dark:text-gray-300 focus:border-indigo-500 dark:focus:border-indigo-600 focus:ring-indigo-500 dark:focus:ring-indigo-600"
                                        required>{{ old('about_me') }}</textarea>
                                    <x-input-error :messages="$errors->get('about_me')" class="mt-2" />
                                </div>

                                <div class="mb-4">
                                    <x-input-label for="skills" :value="__('Skills (comma separated)')" />
                                    <x-text-input id="skills_input" class="block mt-1 w-full" type="text"
                                        name="skills_input" :value="old('skills_input')" />
                                    <div id="skills_container" class="mt-2 flex flex-wrap gap-2"></div>
                                    <input type="hidden" id="skills_json" name="skills" value="[]">
                                    <x-input-error :messages="$errors->get('skills')" class="mt-2" />
                                </div>

                                <div class="mb-4">
                                    <x-input-label :value="__('Social Links')" />

                                    <div class="mt-2 space-y-2">
                                        <div class="flex items-center space-x-2">
                                            <span class="text-gray-500 dark:text-gray-400 w-24">GitHub:</span>
                                            <x-text-input class="block w-full" type="url"
                                                name="social_links[github]" :value="old('social_links.github')"
                                                placeholder="https://github.com/username" />
                                        </div>

                                        <div class="flex items-center space-x-2">
                                            <span class="text-gray-500 dark:text-gray-400 w-24">LinkedIn:</span>
                                            <x-text-input class="block w-full" type="url"
                                                name="social_links[linkedin]" :value="old('social_links.linkedin')"
                                                placeholder="https://linkedin.com/in/username" />
                                        </div>

                                        <div class="flex items-center space-x-2">
                                            <span class="text-gray-500 dark:text-gray-400 w-24">Twitter:</span>
                                            <x-text-input class="block w-full" type="url"
                                                name="social_links[twitter]" :value="old('social_links.twitter')"
                                                placeholder="https://twitter.com/username" />
                                        </div>
                                    </div>
                                </div>

                                <div class="mb-4">
                                    <x-input-label :value="__('Languages')" />

                                    <div id="languages_container" class="mt-2 space-y-2">
                                        <div class="language-item border dark:border-gray-700 p-3 rounded-md">
                                            <div class="flex items-center justify-between mb-2">
                                                <x-text-input class="w-1/2" type="text" name="languages[0][name]"
                                                    placeholder="Language name" />
                                                <select name="languages[0][level]"
                                                    class="rounded-md shadow-sm border-gray-300 dark:border-gray-700 dark:bg-gray-900 dark:text-gray-300 focus:border-indigo-500 dark:focus:border-indigo-600 focus:ring-indigo-500 dark:focus:ring-indigo-600">
                                                    <option value="Native">Native</option>
                                                    <option value="Fluent">Fluent</option>
                                                    <option value="Intermediate">Intermediate</option>
                                                    <option value="Basic">Basic</option>
                                                </select>
                                            </div>
                                            <div class="flex items-center">
                                                <span
                                                    class="text-sm text-gray-500 dark:text-gray-400 mr-2">Proficiency:</span>
                                                <x-text-input class="w-16" type="number"
                                                    name="languages[0][percentage]" min="1" max="100"
                                                    value="100" />
                                                <span class="ml-1 text-sm text-gray-500 dark:text-gray-400">%</span>
                                            </div>
                                        </div>
                                    </div>

                                    <button type="button" id="add_language"
                                        class="mt-2 px-4 py-2 bg-gray-200 dark:bg-gray-700 text-gray-700 dark:text-gray-300 rounded-md hover:bg-gray-300 dark:hover:bg-gray-600 transition">
                                        Add Language
                                    </button>
                                </div>
                            </div>
                        </div>

                        <div class="flex items-center justify-end mt-4">
                            <a href="{{ route('admin.resume.index') }}"
                                class="mr-3 font-medium text-blue-600 dark:text-blue-500 hover:underline">Cancel</a>
                            <x-primary-button>
                                {{ __('Create Resume') }}
                            </x-primary-button>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>

    <x-slot name="scripts">
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
                    console.error('Error parsing skills JSON:', e);
                }
            }

            skillsInput.addEventListener('keydown', function(e) {
                if (e.key === 'Enter' || e.key === ',') {
                    e.preventDefault();
                    const skill = this.value.trim();
                    if (skill && !skills.includes(skill)) {
                        skills.push(skill);
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
                    badge.className =
                        'bg-blue-100 text-blue-800 text-xs font-medium px-2.5 py-0.5 rounded dark:bg-blue-900 dark:text-blue-300 flex items-center';
                    badge.innerHTML = `
                        ${skill}
                        <button type="button" class="ml-1 text-blue-800 dark:text-blue-300 hover:text-blue-900 dark:hover:text-blue-400" data-index="${index}">
                            ×
                        </button>
                    `;
                    badge.querySelector('button').addEventListener('click', function() {
                        skills.splice(this.dataset.index, 1);
                        renderSkills();
                        updateSkillsJson();
                    });
                    skillsContainer.appendChild(badge);
                });
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
                languageItem.className = 'language-item border dark:border-gray-700 p-3 rounded-md';
                languageItem.innerHTML = `
                    <div class="flex items-center justify-between mb-2">
                        <x-text-input class="w-1/2" type="text" name="languages[${languageCount}][name]" placeholder="Language name" />
                        <select name="languages[${languageCount}][level]" class="rounded-md shadow-sm border-gray-300 dark:border-gray-700 dark:bg-gray-900 dark:text-gray-300 focus:border-indigo-500 dark:focus:border-indigo-600 focus:ring-indigo-500 dark:focus:ring-indigo-600">
                            <option value="Native">Native</option>
                            <option value="Fluent">Fluent</option>
                            <option value="Intermediate">Intermediate</option>
                            <option value="Basic">Basic</option>
                        </select>
                    </div>
                    <div class="flex items-center justify-between">
                        <div class="flex items-center">
                            <span class="text-sm text-gray-500 dark:text-gray-400 mr-2">Proficiency:</span>
                            <x-text-input class="w-16" type="number" name="languages[${languageCount}][percentage]" min="1" max="100" value="80" />
                            <span class="ml-1 text-sm text-gray-500 dark:text-gray-400">%</span>
                        </div>
                        <button type="button" class="remove-language text-red-500 hover:text-red-700">
                            Remove
                        </button>
                    </div>
                `.replace(/x-text-input/g,
                    'input class="rounded-md shadow-sm border-gray-300 dark:border-gray-700 dark:bg-gray-900 dark:text-gray-300 focus:border-indigo-500 dark:focus:border-indigo-600 focus:ring-indigo-500 dark:focus:ring-indigo-600"'
                    );

                languagesContainer.appendChild(languageItem);

                languageItem.querySelector('.remove-language').addEventListener('click', function() {
                    languageItem.remove();
                });

                languageCount++;
            });
        </script>
    </x-slot>
</x-app-layout>
