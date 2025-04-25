<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 dark:text-gray-200 leading-tight">
            {{ __('Edit Education for') }} {{ $resume->full_name }}
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
                    <form method="POST" action="{{ route('admin.resume.education.update', [$resume, $education]) }}">
                        @csrf
                        @method('PUT')

                        <div class="grid grid-cols-1 md:grid-cols-2 gap-6">
                            <div>
                                <div class="mb-4">
                                    <x-input-label for="degree" :value="__('Degree/Certificate')" />
                                    <x-text-input id="degree" class="block mt-1 w-full" type="text" name="degree"
                                        :value="old('degree', $education->degree)" required />
                                    <x-input-error :messages="$errors->get('degree')" class="mt-2" />
                                </div>

                                <div class="mb-4">
                                    <x-input-label for="institution" :value="__('Institution')" />
                                    <x-text-input id="institution" class="block mt-1 w-full" type="text"
                                        name="institution" :value="old('institution', $education->institution)" required />
                                    <x-input-error :messages="$errors->get('institution')" class="mt-2" />
                                </div>

                                <div class="mb-4">
                                    <x-input-label for="start_date" :value="__('Start Date')" />
                                    <x-text-input id="start_date" class="block mt-1 w-full" type="text"
                                        name="start_date" :value="old('start_date', $education->start_date)" placeholder="e.g. 2015" required />
                                    <x-input-error :messages="$errors->get('start_date')" class="mt-2" />
                                </div>

                                <div class="mb-4">
                                    <x-input-label for="end_date" :value="__('End Date')" />
                                    <x-text-input id="end_date" class="block mt-1 w-full" type="text"
                                        name="end_date" :value="old('end_date', $education->end_date)"
                                        placeholder="e.g. 2019 (leave empty if ongoing)" />
                                    <x-input-error :messages="$errors->get('end_date')" class="mt-2" />
                                </div>

                                <div class="mb-4">
                                    <x-input-label for="order" :value="__('Display Order (lower numbers appear first)')" />
                                    <x-text-input id="order" class="block mt-1 w-full" type="number" name="order"
                                        :value="old('order', $education->order)" min="0" />
                                    <x-input-error :messages="$errors->get('order')" class="mt-2" />
                                </div>
                            </div>

                            <div>
                                <div class="mb-4">
                                    <x-input-label for="description" :value="__('Description (optional)')" />
                                    <textarea id="description" name="description" rows="4"
                                        class="block mt-1 w-full rounded-md shadow-sm border-gray-300 dark:border-gray-700 dark:bg-gray-900 dark:text-gray-300 focus:border-indigo-500 dark:focus:border-indigo-600 focus:ring-indigo-500 dark:focus:ring-indigo-600">{{ old('description', $education->description) }}</textarea>
                                    <x-input-error :messages="$errors->get('description')" class="mt-2" />
                                </div>
                            </div>
                        </div>

                        <div class="flex items-center justify-end mt-4">
                            <a href="{{ route('admin.resume.education.index', $resume) }}"
                                class="mr-3 font-medium text-blue-600 dark:text-blue-500 hover:underline">Cancel</a>
                            <x-primary-button>
                                {{ __('Update Education') }}
                            </x-primary-button>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>
</x-app-layout>
