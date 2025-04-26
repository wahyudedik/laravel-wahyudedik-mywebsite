<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 dark:text-gray-200 leading-tight">
            {{ __('Edit Feedback') }}
        </h2>
    </x-slot>

    <div class="py-12">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
            <div class="bg-white dark:bg-gray-800 overflow-hidden shadow-sm sm:rounded-lg">
                <div class="p-6 text-gray-900 dark:text-gray-100">
                    <form method="POST" action="{{ route('admin.feedback.update', $feedback) }}">
                        @csrf
                        @method('PUT')
                        
                        <div class="mb-4">
                            <x-input-label for="name" :value="__('Client Name')" />
                            <x-text-input id="name" class="block mt-1 w-full" type="text" name="name" :value="old('name', $feedback->name)" required />
                            <x-input-error :messages="$errors->get('name')" class="mt-2" />
                        </div>
                        
                        <div class="mb-4">
                            <x-input-label for="position" :value="__('Position/Company')" />
                            <x-text-input id="position" class="block mt-1 w-full" type="text" name="position" :value="old('position', $feedback->position)" />
                            <x-input-error :messages="$errors->get('position')" class="mt-2" />
                        </div>
                        
                        @if ($feedback->content)
                            <div class="mb-4">
                                <x-input-label for="content" :value="__('Feedback Content')" />
                                <textarea id="content" name="content" rows="4" class="block mt-1 w-full rounded-md border-gray-300 dark:border-gray-700 dark:bg-gray-900 dark:text-gray-300 focus:border-indigo-500 dark:focus:border-indigo-600 focus:ring-indigo-500 dark:focus:ring-indigo-600 shadow-sm">{{ old('content', $feedback->content) }}</textarea>
                                <x-input-error :messages="$errors->get('content')" class="mt-2" />
                            </div>
                            
                            <div class="mb-4">
                                <x-input-label for="rating" :value="__('Rating')" />
                                <select id="rating" name="rating" class="block mt-1 w-full rounded-md border-gray-300 dark:border-gray-700 dark:bg-gray-900 dark:text-gray-300 focus:border-indigo-500 dark:focus:border-indigo-600 focus:ring-indigo-500 dark:focus:ring-indigo-600 shadow-sm">
                                    @for ($i = 5; $i >= 1; $i--)
                                        <option value="{{ $i }}" {{ old('rating', $feedback->rating) == $i ? 'selected' : '' }}>
                                            {{ $i }} {{ Str::plural('Star', $i) }}
                                        </option>
                                    @endfor
                                </select>
                                <x-input-error :messages="$errors->get('rating')" class="mt-2" />
                            </div>
                            
                            <div class="mb-4">
                                <label class="inline-flex items-center">
                                    <input type="checkbox" name="is_published" value="1" class="rounded border-gray-300 text-indigo-600 shadow-sm focus:ring-indigo-500 dark:focus:ring-indigo-600 dark:focus:ring-offset-gray-800" {{ old('is_published', $feedback->is_published) ? 'checked' : '' }}>
                                    <span class="ml-2 text-sm text-gray-600 dark:text-gray-400">{{ __('Publish on website') }}</span>
                                </label>
                            </div>
                        @endif
                        
                        <div class="flex items-center justify-end mt-4">
                            <a href="{{ route('admin.feedback.index') }}" class="text-gray-500 hover:text-gray-700 dark:text-gray-300 dark:hover:text-gray-100 mr-4">
                                Cancel
                            </a>
                            <x-primary-button>
                                {{ __('Update Feedback') }}
                            </x-primary-button>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>
</x-app-layout>