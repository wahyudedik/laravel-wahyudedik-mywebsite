<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 dark:text-gray-200 leading-tight">
            {{ __('Create Feedback Link') }}
        </h2>
    </x-slot>

    <div class="py-12">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
            <div class="bg-white dark:bg-gray-800 overflow-hidden shadow-sm sm:rounded-lg">
                <div class="p-6 text-gray-900 dark:text-gray-100">
                    <form method="POST" action="{{ route('admin.feedback.store') }}">
                        @csrf
                        
                        <div class="mb-4">
                            <x-input-label for="name" :value="__('Client Name')" />
                            <x-text-input id="name" class="block mt-1 w-full" type="text" name="name" :value="old('name')" required autofocus />
                            <x-input-error :messages="$errors->get('name')" class="mt-2" />
                        </div>
                        
                        <div class="mb-4">
                            <x-input-label for="position" :value="__('Position/Company')" />
                            <x-text-input id="position" class="block mt-1 w-full" type="text" name="position" :value="old('position')" />
                            <x-input-error :messages="$errors->get('position')" class="mt-2" />
                            <p class="text-sm text-gray-500 dark:text-gray-400 mt-1">Example: Marketing Specialist, CEO at Company Name, etc.</p>
                        </div>
                        
                        <div class="flex items-center justify-end mt-4">
                            <a href="{{ route('admin.feedback.index') }}" class="text-gray-500 hover:text-gray-700 dark:text-gray-300 dark:hover:text-gray-100 mr-4">
                                Cancel
                            </a>
                            <x-primary-button>
                                {{ __('Create Feedback Link') }}
                            </x-primary-button>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>
</x-app-layout>