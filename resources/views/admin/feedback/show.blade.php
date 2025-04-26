<x-app-layout>
    <x-slot name="header">
        <div class="flex justify-between items-center">
            <h2 class="font-semibold text-xl text-gray-800 dark:text-gray-200 leading-tight">
                {{ __('Feedback Link for') }}: {{ $feedback->name }}
            </h2>
            <a href="{{ route('admin.feedback.index') }}" class="text-blue-600 hover:text-blue-800 dark:text-blue-400 dark:hover:text-blue-300">
                Back to List
            </a>
        </div>
    </x-slot>

    <div class="py-12">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
            @if (session('success'))
                <div class="bg-green-100 border border-green-400 text-green-700 px-4 py-3 rounded relative mb-4" role="alert">
                    <span class="block sm:inline">{{ session('success') }}</span>
                </div>
            @endif

            <div class="bg-white dark:bg-gray-800 overflow-hidden shadow-sm sm:rounded-lg mb-6">
                <div class="p-6 text-gray-900 dark:text-gray-100">
                    <h3 class="text-lg font-medium mb-4">Share this link with your client</h3>
                    
                    <div class="mb-4">
                        <div class="flex">
                            <input type="text" id="feedback-url" value="{{ $feedbackUrl }}" class="block w-full rounded-l-md border-gray-300 dark:border-gray-700 dark:bg-gray-900 dark:text-gray-300 focus:border-indigo-500 dark:focus:border-indigo-600 focus:ring-indigo-500 dark:focus:ring-indigo-600 shadow-sm" readonly>
                            <button onclick="copyToClipboard()" class="px-4 py-2 bg-blue-500 text-white rounded-r-md hover:bg-blue-600 focus:outline-none focus:ring-2 focus:ring-blue-500 focus:ring-offset-2">
                                Copy
                            </button>
                        </div>
                        <p class="text-sm text-gray-500 dark:text-gray-400 mt-2">
                            This link allows your client to submit a testimonial without needing to create an account.
                        </p>
                    </div>
                    
                    <div class="mt-6">
                        <h4 class="font-medium mb-2">Client Information</h4>
                        <p><strong>Name:</strong> {{ $feedback->name }}</p>
                        <p><strong>Position:</strong> {{ $feedback->position ?: 'Not specified' }}</p>
                        <p><strong>Created:</strong> {{ $feedback->created_at->format('M d, Y H:i') }}</p>
                        <p><strong>Status:</strong> 
                            @if ($feedback->content)
                                @if ($feedback->is_published)
                                    <span class="px-2 inline-flex text-xs leading-5 font-semibold rounded-full bg-green-100 text-green-800">
                                        Published
                                    </span>
                                @else
                                    <span class="px-2 inline-flex text-xs leading-5 font-semibold rounded-full bg-yellow-100 text-yellow-800">
                                        Unpublished
                                    </span>
                                @endif
                            @else
                                <span class="px-2 inline-flex text-xs leading-5 font-semibold rounded-full bg-gray-100 text-gray-800">
                                    Pending Response
                                </span>
                            @endif
                        </p>
                    </div>
                    
                    @if ($feedback->content)
                        <div class="mt-6">
                            <h4 class="font-medium mb-2">Feedback Content</h4>
                            <div class="bg-gray-50 dark:bg-gray-700 p-4 rounded">
                                <div class="flex mb-2">
                                    @for ($i = 1; $i <= 5; $i++)
                                        @if ($i <= $feedback->rating)
                                            <svg class="w-5 h-5 text-yellow-400" fill="currentColor" viewBox="0 0 20 20" xmlns="http://www.w3.org/2000/svg">
                                                <path d="M9.049 2.927c.3-.921 1.603-.921 1.902 0l1.07 3.292a1 1 0 00.95.69h3.462c.969 0 1.371 1.24.588 1.81l-2.8 2.034a1 1 0 00-.364 1.118l1.07 3.292c.3.921-.755 1.688-1.54 1.118l-2.8-2.034a1 1 0 00-1.175 0l-2.8 2.034c-.784.57-1.838-.197-1.539-1.118l1.07-3.292a1 1 0 00-.364-1.118L2.98 8.72c-.783-.57-.38-1.81.588-1.81h3.461a1 1 0 00.951-.69l1.07-3.292z"></path>
                                            </svg>
                                        @else
                                            <svg class="w-5 h-5 text-gray-300 dark:text-gray-500" fill="currentColor" viewBox="0 0 20 20" xmlns="http://www.w3.org/2000/svg">
                                                <path d="M9.049 2.927c.3-.921 1.603-.921 1.902 0l1.07 3.292a1 1 0 00.95.69h3.462c.969 0 1.371 1.24.588 1.81l-2.8 2.034a1 1 0 00-.364 1.118l1.07 3.292c.3.921-.755 1.688-1.54 1.118l-2.8-2.034a1 1 0 00-1.175 0l-2.8 2.034c-.784.57-1.838-.197-1.539-1.118l1.07-3.292a1 1 0 00-.364-1.118L2.98 8.72c-.783-.57-.38-1.81.588-1.81h3.461a1 1 0 00.951-.69l1.07-3.292z"></path>
                                            </svg>
                                        @endif
                                    @endfor
                                </div>
                                <p class="text-gray-700 dark:text-gray-300">{{ $feedback->content }}</p>
                            </div>
                        </div>
                        
                        <div class="mt-6">
                            <form action="{{ route('admin.feedback.update', $feedback) }}" method="POST">
                                @csrf
                                @method('PUT')
                                <input type="hidden" name="name" value="{{ $feedback->name }}">
                                <input type="hidden" name="position" value="{{ $feedback->position }}">
                                <input type="hidden" name="content" value="{{ $feedback->content }}">
                                <input type="hidden" name="rating" value="{{ $feedback->rating }}">
                                <input type="hidden" name="is_published" value="{{ $feedback->is_published ? 0 : 1 }}">
                                
                                <button type="submit" class="px-4 py-2 {{ $feedback->is_published ? 'bg-yellow-500 hover:bg-yellow-600' : 'bg-green-500 hover:bg-green-600' }} text-white rounded-md focus:outline-none focus:ring-2 focus:ring-offset-2 focus:ring-blue-500">
                                    {{ $feedback->is_published ? 'Unpublish Feedback' : 'Publish Feedback' }}
                                </button>
                            </form>
                        </div>
                    @endif
                </div>
            </div>
            
            <div class="flex justify-between">
                <a href="{{ route('admin.feedback.edit', $feedback) }}" class="inline-flex items-center px-4 py-2 bg-blue-500 border border-transparent rounded-md font-semibold text-xs text-white uppercase tracking-widest hover:bg-blue-600 focus:bg-blue-600 active:bg-blue-700 focus:outline-none focus:ring-2 focus:ring-indigo-500 focus:ring-offset-2 transition ease-in-out duration-150">
                    Edit Client Information
                </a>
                
                <form action="{{ route('admin.feedback.destroy', $feedback) }}" method="POST" onsubmit="return confirm('Are you sure you want to delete this feedback?');">
                    @csrf
                    @method('DELETE')
                    <button type="submit" class="inline-flex items-center px-4 py-2 bg-red-500 border border-transparent rounded-md font-semibold text-xs text-white uppercase tracking-widest hover:bg-red-600 focus:bg-red-600 active:bg-red-700 focus:outline-none focus:ring-2 focus:ring-red-500 focus:ring-offset-2 transition ease-in-out duration-150">
                        Delete Feedback
                    </button>
                </form>
            </div>
        </div>
    </div>
    
    <script>
        function copyToClipboard() {
            const feedbackUrl = document.getElementById('feedback-url');
            feedbackUrl.select();
            document.execCommand('copy');
            alert('Feedback URL copied to clipboard!');
        }
    </script>
</x-app-layout>