<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <meta name="csrf-token" content="{{ csrf_token() }}">

    <title>{{ config('app.name', 'Laravel') }} - Feedback</title>

    <!-- Fonts -->
    <link rel="preconnect" href="https://fonts.bunny.net">
    <link href="https://fonts.bunny.net/css?family=figtree:400,500,600&display=swap" rel="stylesheet" />

    <!-- Scripts -->
    @vite(['resources/css/app.css', 'resources/js/app.js'])
</head>
<body class="font-sans text-gray-900 antialiased">
    <div class="min-h-screen flex flex-col sm:justify-center items-center pt-6 sm:pt-0 bg-gray-100 dark:bg-gray-900">
        <div class="w-full sm:max-w-md mt-6 px-6 py-4 bg-white dark:bg-gray-800 shadow-md overflow-hidden sm:rounded-lg">
            <div class="mb-6 text-center">
                <h2 class="text-2xl font-bold text-gray-900 dark:text-gray-100">Share Your Feedback</h2>
                <p class="mt-2 text-gray-600 dark:text-gray-400">Thank you for taking the time to provide your feedback!</p>
            </div>
            
            <form method="POST" action="{{ route('feedback.update', $feedback->token) }}">
                @csrf
                
                <div class="mb-6">
                    <label for="rating" class="block text-sm font-medium text-gray-700 dark:text-gray-300 mb-2">
                        How would you rate your experience?
                    </label>
                    <div class="flex space-x-2">
                        @for ($i = 5; $i >= 1; $i--)
                            <label class="flex flex-col items-center cursor-pointer">
                                <input type="radio" name="rating" value="{{ $i }}" class="sr-only peer" {{ old('rating', $feedback->rating ?: 5) == $i ? 'checked' : '' }} required>
                                <div class="w-12 h-12 flex items-center justify-center rounded-full border-2 border-gray-300 peer-checked:border-yellow-400 peer-checked:bg-yellow-50 dark:border-gray-600 dark:peer-checked:border-yellow-500 dark:peer-checked:bg-gray-700">
                                    <span class="text-xl {{ old('rating', $feedback->rating ?: 5) == $i ? 'text-yellow-400' : 'text-gray-400' }}">★</span>
                                </div>
                                <span class="mt-1 text-sm text-gray-600 dark:text-gray-400">{{ $i }}</span>
                            </label>
                        @endfor
                    </div>
                    <x-input-error :messages="$errors->get('rating')" class="mt-2" />
                </div>
                
                <div class="mb-6">
                    <label for="content" class="block text-sm font-medium text-gray-700 dark:text-gray-300 mb-2">
                        Your Feedback
                    </label>
                    <textarea id="content" name="content" rows="5" class="block w-full rounded-md border-gray-300 dark:border-gray-700 dark:bg-gray-900 dark:text-gray-300 focus:border-indigo-500 dark:focus:border-indigo-600 focus:ring-indigo-500 dark:focus:ring-indigo-600 shadow-sm" placeholder="Please share your experience..." required>{{ old('content', $feedback->content) }}</textarea>
                    <x-input-error :messages="$errors->get('content')" class="mt-2" />
                </div>
                
                <div class="flex items-center justify-end">
                    <button type="submit" class="inline-flex items-center px-4 py-2 bg-blue-600 border border-transparent rounded-md font-semibold text-xs text-white uppercase tracking-widest hover:bg-blue-700 focus:bg-blue-700 active:bg-blue-800 focus:outline-none focus:ring-2 focus:ring-indigo-500 focus:ring-offset-2 dark:focus:ring-offset-gray-800 transition ease-in-out duration-150">
                        Submit Feedback
                    </button>
                </div>
            </form>
        </div>
    </div>
    
    <script>
        // Add interactivity to star rating
        document.querySelectorAll('input[name="rating"]').forEach(input => {
            input.addEventListener('change', function() {
                // Reset all stars
                document.querySelectorAll('input[name="rating"] + div span').forEach(star => {
                    star.classList.remove('text-yellow-400');
                    star.classList.add('text-gray-400');
                });
                
                // Highlight selected star and all stars above it
                const selectedValue = parseInt(this.value);
                document.querySelectorAll('input[name="rating"]').forEach(radio => {
                    const value = parseInt(radio.value);
                    if (value <= selectedValue) {
                        const star = radio.nextElementSibling.querySelector('span');
                        star.classList.remove('text-gray-400');
                        star.classList.add('text-yellow-400');
                    }
                });
            });
        });
    </script>
</body>
</html>