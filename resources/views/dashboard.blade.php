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

            <!-- Products & Orders Stats -->
            <div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-4 gap-4 mb-8">
                <!-- Total Products Card -->
                <div class="bg-white dark:bg-gray-800 overflow-hidden shadow-sm sm:rounded-lg">
                    <div class="p-6">
                        <div class="text-gray-500 dark:text-gray-400 text-sm font-medium">Total Products</div>
                        <div class="text-3xl font-bold text-gray-900 dark:text-gray-100">
                            {{ \App\Models\Product::count() }}</div>
                    </div>
                </div>

                <!-- Total Orders Card -->
                <div class="bg-white dark:bg-gray-800 overflow-hidden shadow-sm sm:rounded-lg">
                    <div class="p-6">
                        <div class="text-gray-500 dark:text-gray-400 text-sm font-medium">Total Orders</div>
                        <div class="text-3xl font-bold text-gray-900 dark:text-gray-100">
                            {{ \App\Models\Order::count() }}</div>
                    </div>
                </div>

                <!-- Pending Orders Card -->
                <div class="bg-white dark:bg-gray-800 overflow-hidden shadow-sm sm:rounded-lg">
                    <div class="p-6">
                        <div class="text-gray-500 dark:text-gray-400 text-sm font-medium">Pending Orders</div>
                        <div class="text-3xl font-bold text-gray-900 dark:text-gray-100">
                            {{ \App\Models\Order::where('status', 'pending')->count() }}</div>
                    </div>
                </div>

                <!-- Revenue Card -->
                <div class="bg-white dark:bg-gray-800 overflow-hidden shadow-sm sm:rounded-lg">
                    <div class="p-6">
                        <div class="text-gray-500 dark:text-gray-400 text-sm font-medium">Total Revenue</div>
                        <div class="text-3xl font-bold text-gray-900 dark:text-gray-100">
                            ${{ number_format(\App\Models\Order::where('status', 'completed')->sum('amount'), 2) }}
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

            <!-- Recent Orders & Popular Products -->
            <div class="grid grid-cols-1 md:grid-cols-2 gap-6 mt-6">
                <!-- Recent Orders -->
                <div class="bg-white dark:bg-gray-800 overflow-hidden shadow-sm sm:rounded-lg">
                    <div class="p-6">
                        <h3 class="text-lg font-medium text-gray-900 dark:text-gray-100 mb-4">Recent Orders</h3>

                        @php
                            $recentOrders = \App\Models\Order::with('product')->orderBy('created_at', 'desc')->take(5)->get();
                        @endphp

                        @if ($recentOrders->isEmpty())
                            <p class="text-gray-500 dark:text-gray-400">No orders yet.</p>
                        @else
                            <div class="space-y-4">
                                @foreach ($recentOrders as $order)
                                    <div
                                        class="border-b border-gray-200 dark:border-gray-700 pb-4 last:border-0 last:pb-0">
                                        <div class="flex justify-between items-start">
                                            <div>
                                                <h4 class="font-medium text-gray-900 dark:text-gray-100">
                                                    Order #{{ $order->order_number }}</h4>
                                                <p class="text-sm text-gray-500 dark:text-gray-400">
                                                    {{ $order->product->name }} ({{ ucfirst($order->license_type) }} License)
                                                </p>
                                                <p class="text-sm text-gray-500 dark:text-gray-400">
                                                    ${{ number_format($order->amount, 2) }} - 
                                                    <span class="
                                                        @if($order->status == 'completed') text-green-600 dark:text-green-400
                                                        @elseif($order->status == 'paid') text-blue-600 dark:text-blue-400
                                                        @elseif($order->status == 'pending') text-yellow-600 dark:text-yellow-400
                                                        @else text-red-600 dark:text-red-400 @endif
                                                    ">
                                                        {{ ucfirst($order->status) }}
                                                    </span>
                                                </p>
                                            </div>
                                            <span
                                                class="text-xs text-gray-500 dark:text-gray-400">{{ $order->created_at->diffForHumans() }}</span>
                                        </div>
                                        <div class="mt-2">
                                            <a href="{{ route('admin.orders.show', $order->id) }}"
                                                class="text-sm text-blue-600 hover:text-blue-800 dark:text-blue-400 dark:hover:text-blue-300">
                                                View Order
                                            </a>
                                        </div>
                                    </div>
                                @endforeach
                            </div>

                            <div class="mt-4">
                                <a href="{{ route('admin.orders.index') }}"
                                    class="text-sm text-blue-600 hover:text-blue-800 dark:text-blue-400 dark:hover:text-blue-300">
                                    View All Orders →
                                </a>
                            </div>
                        @endif
                    </div>
                </div>

                <!-- Popular Products -->
                <div class="bg-white dark:bg-gray-800 overflow-hidden shadow-sm sm:rounded-lg">
                    <div class="p-6">
                        <h3 class="text-lg font-medium text-gray-900 dark:text-gray-100 mb-4">Popular Products</h3>

                        @php
                            $popularProducts = \App\Models\Product::orderBy('reviews_count', 'desc')->take(5)->get();
                        @endphp

                        @if ($popularProducts->isEmpty())
                            <p class="text-gray-500 dark:text-gray-400">No products yet.</p>
                        @else
                            <div class="space-y-4">
                                @foreach ($popularProducts as $product)
                                    <div
                                        class="border-b border-gray-200 dark:border-gray-700 pb-4 last:border-0 last:pb-0">
                                        <div class="flex justify-between items-start">
                                            <div class="flex items-center">
                                                @if ($product->image)
                                                    <img src="{{ Storage::url($product->image) }}" alt="{{ $product->name }}" class="h-10 w-10 rounded object-cover mr-3">
                                                @else
                                                    <div class="h-10 w-10 rounded bg-gray-200 dark:bg-gray-700 mr-3 flex items-center justify-center">
                                                        <svg class="h-6 w-6 text-gray-500 dark:text-gray-400" fill="none" stroke="currentColor" viewBox="0 0 24 24" xmlns="http://www.w3.org/2000/svg">
                                                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M4 16l4.586-4.586a2 2 0 012.828 0L16 16m-2-2l1.586-1.586a2 2 0 012.828 0L20 14m-6-6h.01M6 20h12a2 2 0 002-2V6a2 2 0 00-2-2H6a2 2 0 00-2 2v12a2 2 0 002 2z"></path>
                                                        </svg>
                                                    </div>
                                                @endif
                                                <div>
                                                    <h4 class="font-medium text-gray-900 dark:text-gray-100">
                                                        {{ $product->name }}</h4>
                                                    <p class="text-sm text-gray-500 dark:text-gray-400">
                                                        {{ ucfirst($product->category) }} - ${{ number_format($product->price_user, 2) }}
                                                    </p>
                                                </div>
                                            </div>
                                            <div class="flex items-center">
                                                <span class="text-yellow-500 mr-1">
                                                    <svg class="h-4 w-4" fill="currentColor" viewBox="0 0 20 20" xmlns="http://www.w3.org/2000/svg">
                                                        <path d="M9.049 2.927c.3-.921 1.603-.921 1.902 0l1.07 3.292a1 1 0 00.95.69h3.462c.969 0 1.371 1.24.588 1.81l-2.8 2.034a1 1 0 00-.364 1.118l1.07 3.292c.3.921-.755 1.688-1.54 1.118l-2.8-2.034a1 1 0 00-1.175 0l-2.8 2.034c-.784.57-1.838-.197-1.539-1.118l1.07-3.292a1 1 0 00-.364-1.118L2.98 8.72c-.783-.57-.38-1.81.588-1.81h3.461a1 1 0 00.951-.69l1.07-3.292z"></path>
                                                    </svg>
                                                </span>
                                                <span class="text-xs text-gray-500 dark:text-gray-400">
                                                    {{ number_format($product->average_rating, 1) }} ({{ $product->reviews_count }})
                                                </span>
                                            </div>
                                        </div>
                                        <div class="mt-2">
                                            <a href="{{ route('admin.products.edit', $product->id) }}"
                                                class="text-sm text-blue-600 hover:text-blue-800 dark:text-blue-400 dark:hover:text-blue-300">
                                                Edit Product
                                            </a>
                                        </div>
                                    </div>
                                @endforeach
                            </div>

                            <div class="mt-4">
                                <a href="{{ route('admin.products.index') }}"
                                    class="text-sm text-blue-600 hover:text-blue-800 dark:text-blue-400 dark:hover:text-blue-300">
                                    View All Products →
                                </a>
                            </div>
                        @endif
                    </div>
                </div>
            </div>

            <!-- Sales Analytics -->
            <div class="bg-white dark:bg-gray-800 overflow-hidden shadow-sm sm:rounded-lg mt-6">
                <div class="p-6">
                    <h3 class="text-lg font-medium text-gray-900 dark:text-gray-100 mb-4">Sales Analytics</h3>
                    
                    <div class="grid grid-cols-1 md:grid-cols-3 gap-4">
                        <!-- Sales by Category -->
                        <div class="border border-gray-200 dark:border-gray-700 rounded-lg p-4">
                            <h4 class="text-md font-medium text-gray-900 dark:text-gray-100 mb-3">Sales by Category</h4>
                            
                            @php
                                $categorySales = \App\Models\Order::where('status', 'completed')
                                    ->join('products', 'orders.product_id', '=', 'products.id')
                                    ->selectRaw('products.category, COUNT(*) as count, SUM(orders.amount) as total')
                                    ->groupBy('products.category')
                                    ->get();
                            @endphp
                            
                            @if($categorySales->isEmpty())
                                <p class="text-gray-500 dark:text-gray-400">No sales data available.</p>
                            @else
                                <div class="space-y-2">
                                    @foreach($categorySales as $category)
                                        <div class="flex justify-between items-center">
                                            <span class="text-sm text-gray-700 dark:text-gray-300">{{ ucfirst($category->category) }}</span>
                                            <span class="text-sm font-medium text-gray-900 dark:text-gray-100">${{ number_format($category->total, 2) }}</span>
                                        </div>
                                        <div class="w-full bg-gray-200 dark:bg-gray-700 rounded-full h-2.5">
                                            <div class="bg-blue-600 h-2.5 rounded-full" style="width: {{ min(100, ($category->total / $categorySales->sum('total') * 100)) }}%"></div>
                                        </div>
                                    @endforeach
                                </div>
                            @endif
                        </div>
                        
                        <!-- Sales by License Type -->
                        <div class="border border-gray-200 dark:border-gray-700 rounded-lg p-4">
                            <h4 class="text-md font-medium text-gray-900 dark:text-gray-100 mb-3">Sales by License</h4>
                            
                            @php
                                $licenseSales = \App\Models\Order::where('status', 'completed')
                                    ->selectRaw('license_type, COUNT(*) as count, SUM(amount) as total')
                                    ->groupBy('license_type')
                                    ->get();
                            @endphp
                            
                            @if($licenseSales->isEmpty())
                                <p class="text-gray-500 dark:text-gray-400">No sales data available.</p>
                            @else
                                <div class="space-y-2">
                                    @foreach($licenseSales as $license)
                                        <div class="flex justify-between items-center">
                                            <span class="text-sm text-gray-700 dark:text-gray-300">{{ ucfirst($license->license_type) }}</span>
                                            <span class="text-sm font-medium text-gray-900 dark:text-gray-100">${{ number_format($license->total, 2) }}</span>
                                        </div>
                                        <div class="w-full bg-gray-200 dark:bg-gray-700 rounded-full h-2.5">
                                            <div class="bg-green-600 h-2.5 rounded-full" style="width: {{ min(100, ($license->total / $licenseSales->sum('total') * 100)) }}%"></div>
                                        </div>
                                    @endforeach
                                </div>
                            @endif
                        </div>
                        
                        <!-- Monthly Sales -->
                        <div class="border border-gray-200 dark:border-gray-700 rounded-lg p-4">
                            <h4 class="text-md font-medium text-gray-900 dark:text-gray-100 mb-3">Monthly Sales</h4>
                            
                            @php
                                $monthlySales = \App\Models\Order::where('status', 'completed')
                                    ->where('created_at', '>=', now()->subMonths(3))
                                    ->selectRaw('MONTH(created_at) as month, YEAR(created_at) as year, SUM(amount) as total')
                                    ->groupBy('year', 'month')
                                    ->orderBy('year', 'desc')
                                    ->orderBy('month', 'desc')
                                    ->get()
                                    ->map(function($item) {
                                        $date = \Carbon\Carbon::createFromDate($item->year, $item->month, 1);
                                        return [
                                            'month' => $date->format('M Y'),
                                            'total' => $item->total
                                        ];
                                    });
                            @endphp
                            
                            @if($monthlySales->isEmpty())
                                <p class="text-gray-500 dark:text-gray-400">No sales data available.</p>
                            @else
                                <div class="space-y-2">
                                    @foreach($monthlySales as $month)
                                        <div class="flex justify-between items-center">
                                            <span class="text-sm text-gray-700 dark:text-gray-300">{{ $month['month'] }}</span>
                                            <span class="text-sm font-medium text-gray-900 dark:text-gray-100">${{ number_format($month['total'], 2) }}</span>
                                        </div>
                                        <div class="w-full bg-gray-200 dark:bg-gray-700 rounded-full h-2.5">
                                            <div class="bg-purple-600 h-2.5 rounded-full" style="width: {{ min(100, ($month['total'] / $monthlySales->max('total') * 100)) }}%"></div>
                                        </div>
                                    @endforeach
                                </div>
                            @endif
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</x-app-layout>
