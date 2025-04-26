<x-app-layout>
    <x-slot name="header">
        <div class="flex justify-between items-center">
            <h2 class="font-semibold text-xl text-gray-800 dark:text-gray-200 leading-tight">
                {{ __('Product Details') }}
            </h2>
            <div class="flex space-x-2">
                <a href="{{ route('admin.products.edit', $product) }}" class="bg-indigo-500 hover:bg-indigo-700 text-white font-bold py-2 px-4 rounded">
                    Edit Product
                </a>
                <a href="{{ route('admin.products.index') }}" class="bg-gray-500 hover:bg-gray-700 text-white font-bold py-2 px-4 rounded">
                    Back to List
                </a>
            </div>
        </div>
    </x-slot>

    <div class="py-12">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
            <div class="bg-white dark:bg-gray-800 overflow-hidden shadow-sm sm:rounded-lg">
                <div class="p-6 text-gray-900 dark:text-gray-100">
                    <div class="grid grid-cols-1 md:grid-cols-3 gap-6">
                        <div class="md:col-span-1">
                            @if ($product->image)
                                <img src="{{ Storage::url($product->image) }}" alt="{{ $product->name }}" class="w-full h-auto rounded-lg shadow-md">
                            @else
                                <div class="w-full h-64 bg-gray-200 dark:bg-gray-700 rounded-lg shadow-md flex items-center justify-center">
                                    <span class="text-gray-500 dark:text-gray-400">No Image</span>
                                </div>
                            @endif

                            <div class="mt-6 bg-gray-100 dark:bg-gray-700 rounded-lg p-4">
                                <h3 class="text-lg font-semibold mb-2">Quick Info</h3>
                                <div class="space-y-2">
                                    <div class="flex justify-between">
                                        <span class="text-gray-600 dark:text-gray-400">Category:</span>
                                        <span class="font-medium">{{ ucfirst($product->category) }}</span>
                                    </div>
                                    <div class="flex justify-between">
                                        <span class="text-gray-600 dark:text-gray-400">User License:</span>
                                        <span class="font-medium">${{ number_format($product->price_user, 2) }}</span>
                                    </div>
                                    <div class="flex justify-between">
                                        <span class="text-gray-600 dark:text-gray-400">Developer License:</span>
                                        <span class="font-medium">${{ number_format($product->price_developer, 2) }}</span>
                                    </div>
                                    <div class="flex justify-between">
                                        <span class="text-gray-600 dark:text-gray-400">Featured:</span>
                                        <span class="font-medium">{{ $product->featured ? 'Yes' : 'No' }}</span>
                                    </div>
                                    <div class="flex justify-between">
                                        <span class="text-gray-600 dark:text-gray-400">Created:</span>
                                        <span class="font-medium">{{ $product->created_at->format('M d, Y') }}</span>
                                    </div>
                                    <div class="flex justify-between">
                                        <span class="text-gray-600 dark:text-gray-400">Last Updated:</span>
                                        <span class="font-medium">{{ $product->updated_at->format('M d, Y') }}</span>
                                    </div>
                                </div>
                            </div>

                            @if ($product->demo_link)
                                <div class="mt-4">
                                    <a href="{{ $product->demo_link }}" target="_blank" class="w-full inline-flex justify-center items-center px-4 py-2 bg-blue-600 border border-transparent rounded-md font-semibold text-white hover:bg-blue-700 focus:outline-none focus:ring-2 focus:ring-offset-2 focus:ring-blue-500 transition ease-in-out duration-150">
                                        <svg xmlns="http://www.w3.org/2000/svg" class="h-5 w-5 mr-2" viewBox="0 0 20 20" fill="currentColor">
                                            <path fill-rule="evenodd" d="M10 18a8 8 0 100-16 8 8 0 000 16zM9.555 7.168A1 1 0 008 8v4a1 1 0 001.555.832l3-2a1 1 0 000-1.664l-3-2z" clip-rule="evenodd" />
                                        </svg>
                                        View Demo
                                    </a>
                                </div>
                            @endif
                        </div>

                        <div class="md:col-span-2">
                            <h1 class="text-2xl font-bold mb-4">{{ $product->name }}</h1>
                            
                            <div class="mb-6">
                                <h3 class="text-lg font-semibold mb-2">Description</h3>
                                <div class="bg-gray-50 dark:bg-gray-700 rounded-lg p-4">
                                    <p class="whitespace-pre-line">{{ $product->description }}</p>
                                </div>
                            </div>

                            <div class="mb-6">
                                <h3 class="text-lg font-semibold mb-2">Recent Orders</h3>
                                @if($product->orders->count() > 0)
                                    <div class="overflow-x-auto">
                                        <table class="min-w-full bg-white dark:bg-gray-700 rounded-lg">
                                            <thead>
                                                <tr>
                                                    <th class="py-3 px-4 border-b border-gray-200 dark:border-gray-600 text-left text-xs font-medium text-gray-500 dark:text-gray-300 uppercase tracking-wider">Order #</th>
                                                    <th class="py-3 px-4 border-b border-gray-200 dark:border-gray-600 text-left text-xs font-medium text-gray-500 dark:text-gray-300 uppercase tracking-wider">Customer</th>
                                                    <th class="py-3 px-4 border-b border-gray-200 dark:border-gray-600 text-left text-xs font-medium text-gray-500 dark:text-gray-300 uppercase tracking-wider">License</th>
                                                    <th class="py-3 px-4 border-b border-gray-200 dark:border-gray-600 text-left text-xs font-medium text-gray-500 dark:text-gray-300 uppercase tracking-wider">Amount</th>
                                                    <th class="py-3 px-4 border-b border-gray-200 dark:border-gray-600 text-left text-xs font-medium text-gray-500 dark:text-gray-300 uppercase tracking-wider">Status</th>
                                                    <th class="py-3 px-4 border-b border-gray-200 dark:border-gray-600 text-left text-xs font-medium text-gray-500 dark:text-gray-300 uppercase tracking-wider">Date</th>
                                                </tr>
                                            </thead>
                                            <tbody>
                                                @foreach($product->orders->take(5) as $order)
                                                    <tr>
                                                        <td class="py-3 px-4 border-b border-gray-200 dark:border-gray-600">
                                                            <a href="{{ route('admin.orders.show', $order) }}" class="text-blue-600 hover:text-blue-900 dark:text-blue-400 dark:hover:text-blue-300">
                                                                {{ $order->order_number }}
                                                            </a>
                                                        </td>
                                                        <td class="py-3 px-4 border-b border-gray-200 dark:border-gray-600">{{ $order->name }}</td>
                                                        <td class="py-3 px-4 border-b border-gray-200 dark:border-gray-600">{{ ucfirst($order->license_type) }}</td>
                                                        <td class="py-3 px-4 border-b border-gray-200 dark:border-gray-600">${{ number_format($order->amount, 2) }}</td>
                                                        <td class="py-3 px-4 border-b border-gray-200 dark:border-gray-600">
                                                            <span class="px-2 inline-flex text-xs leading-5 font-semibold rounded-full 
                                                                @if($order->status == 'completed') bg-green-100 text-green-800 
                                                                @elseif($order->status == 'paid') bg-blue-100 text-blue-800 
                                                                @elseif($order->status == 'pending') bg-yellow-100 text-yellow-800 
                                                                @else bg-red-100 text-red-800 @endif">
                                                                {{ ucfirst($order->status) }}
                                                            </span>
                                                        </td>
                                                        <td class="py-3 px-4 border-b border-gray-200 dark:border-gray-600">{{ $order->created_at->format('M d, Y') }}</td>
                                                    </tr>
                                                @endforeach
                                            </tbody>
                                        </table>
                                    </div>
                                    @if($product->orders->count() > 5)
                                        <div class="mt-2 text-right">
                                            <a href="{{ route('admin.orders.index', ['product_id' => $product->id]) }}" class="text-sm text-blue-600 hover:text-blue-900 dark:text-blue-400 dark:hover:text-blue-300">
                                                View all orders →
                                            </a>
                                        </div>
                                    @endif
                                @else
                                    <p class="text-gray-500 dark:text-gray-400">No orders yet for this product.</p>
                                @endif
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</x-app-layout>