<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 dark:text-gray-200 leading-tight">
            {{ __('Dashboard') }}
        </h2>
    </x-slot>

    <div class="py-12">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
            <div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-4 gap-4 mb-8">
                <!-- Total Contacts Card -->
                <div class="bg-white dark:bg-gray-800 overflow-hidden shadow-sm sm:rounded-lg">
                    <div class="p-6">
                        <div class="text-gray-500 dark:text-gray-400 text-sm font-medium">Total Contacts</div>
                        <div class="text-3xl font-bold text-gray-900 dark:text-gray-100">
                            {{ \App\Models\Contact::count() }}</div>
                    </div>
                </div>

                <!-- Unread Contacts Card -->
                <div class="bg-white dark:bg-gray-800 overflow-hidden shadow-sm sm:rounded-lg">
                    <div class="p-6">
                        <div class="text-gray-500 dark:text-gray-400 text-sm font-medium">Unread Messages</div>
                        <div class="text-3xl font-bold text-gray-900 dark:text-gray-100">
                            {{ \App\Models\Contact::where('is_read', false)->count() }}</div>
                    </div>
                </div>

                <!-- Newsletter Subscribers Card -->
                <div class="bg-white dark:bg-gray-800 overflow-hidden shadow-sm sm:rounded-lg">
                    <div class="p-6">
                        <div class="text-gray-500 dark:text-gray-400 text-sm font-medium">Newsletter Subscribers</div>
                        <div class="text-3xl font-bold text-gray-900 dark:text-gray-100">
                            {{ \App\Models\Newsletter::where('is_active', true)->count() }}</div>
                    </div>
                </div>

                <!-- Recent Contacts Card -->
                <div class="bg-white dark:bg-gray-800 overflow-hidden shadow-sm sm:rounded-lg">
                    <div class="p-6">
                        <div class="text-gray-500 dark:text-gray-400 text-sm font-medium">Recent Contacts (7 days)</div>
                        <div class="text-3xl font-bold text-gray-900 dark:text-gray-100">
                            {{ \App\Models\Contact::where('created_at', '>=', now()->subDays(7))->count() }}
                        </div>
                    </div>
                </div>
            </div>

            <div class="grid grid-cols-1 md:grid-cols-2 gap-6">
                <!-- Recent Messages -->
                <div class="bg-white dark:bg-gray-800 overflow-hidden shadow-sm sm:rounded-lg">
                    <div class="p-6">
                        <h3 class="text-lg font-medium text-gray-900 dark:text-gray-100 mb-4">Recent Messages</h3>

                        @php
                            $recentContacts = \App\Models\Contact::orderBy('created_at', 'desc')->take(5)->get();
                        @endphp

                        @if ($recentContacts->isEmpty())
                            <p class="text-gray-500 dark:text-gray-400">No messages yet.</p>
                        @else
                            <div class="space-y-4">
                                @foreach ($recentContacts as $contact)
                                    <div
                                        class="border-b border-gray-200 dark:border-gray-700 pb-4 last:border-0 last:pb-0">
                                        <div class="flex justify-between items-start">
                                            <div>
                                                <h4 class="font-medium text-gray-900 dark:text-gray-100">
                                                    {{ $contact->name }}</h4>
                                                <p class="text-sm text-gray-500 dark:text-gray-400">
                                                    {{ $contact->subject }}</p>
                                            </div>
                                            <span
                                                class="text-xs text-gray-500 dark:text-gray-400">{{ $contact->created_at->diffForHumans() }}</span>
                                        </div>
                                        <div class="mt-2">
                                            <a href="{{ route('admin.contacts.show', $contact->id) }}"
                                                class="text-sm text-blue-600 hover:text-blue-800 dark:text-blue-400 dark:hover:text-blue-300">
                                                View Message
                                            </a>
                                        </div>
                                    </div>
                                @endforeach
                            </div>

                            <div class="mt-4">
                                <a href="{{ route('admin.contacts.index') }}"
                                    class="text-sm text-blue-600 hover:text-blue-800 dark:text-blue-400 dark:hover:text-blue-300">
                                    View All Messages →
                                </a>
                            </div>
                        @endif
                    </div>
                </div>

                <!-- Recent Subscribers -->
                <div class="bg-white dark:bg-gray-800 overflow-hidden shadow-sm sm:rounded-lg">
                    <div class="p-6">
                        <h3 class="text-lg font-medium text-gray-900 dark:text-gray-100 mb-4">Recent Subscribers</h3>

                        @php
                            $recentSubscribers = \App\Models\Newsletter::orderBy('created_at', 'desc')->take(5)->get();
                        @endphp

                        @if ($recentSubscribers->isEmpty())
                            <p class="text-gray-500 dark:text-gray-400">No subscribers yet.</p>
                        @else
                            <div class="space-y-4">
                                @foreach ($recentSubscribers as $subscriber)
                                    <div
                                        class="border-b border-gray-200 dark:border-gray-700 pb-4 last:border-0 last:pb-0">
                                        <div class="flex justify-between items-start">
                                            <div>
                                                <h4 class="font-medium text-gray-900 dark:text-gray-100">
                                                    {{ $subscriber->email }}</h4>
                                                <p class="text-sm text-gray-500 dark:text-gray-400">
                                                    @if ($subscriber->is_active)
                                                        <span class="text-green-600 dark:text-green-400">Active</span>
                                                    @else
                                                        <span class="text-red-600 dark:text-red-400">Inactive</span>
                                                    @endif
                                                </p>
                                            </div>
                                            <span
                                                class="text-xs text-gray-500 dark:text-gray-400">{{ $subscriber->created_at->diffForHumans() }}</span>
                                        </div>
                                    </div>
                                @endforeach
                            </div>

                            <div class="mt-4">
                                <a href="{{ route('admin.newsletter.index') }}"
                                    class="text-sm text-blue-600 hover:text-blue-800 dark:text-blue-400 dark:hover:text-blue-300">
                                    View All Subscribers →
                                </a>
                            </div>
                        @endif
                    </div>
                </div>
            </div>
        </div>
    </div>
</x-app-layout>
