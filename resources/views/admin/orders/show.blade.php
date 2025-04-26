<x-app-layout>
    <x-slot name="header">
        <div class="flex justify-between items-center">
            <h2 class="font-semibold text-xl text-gray-800 dark:text-gray-200 leading-tight">
                {{ __('Order Details') }}: {{ $order->order_number }}
            </h2>
            <a href="{{ route('admin.orders.index') }}" class="bg-gray-500 hover:bg-gray-700 text-white font-bold py-2 px-4 rounded">
                Back to List
            </a>
        </div>
    </x-slot>

    <div class="py-12">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
            <div class="bg-white dark:bg-gray-800 overflow-hidden shadow-sm sm:rounded-lg">
                <div class="p-6 text-gray-900 dark:text-gray-100">
                    @if (session('success'))
                        <div class="bg-green-100 border border-green-400 text-green-700 px-4 py-3 rounded relative mb-4" role="alert">
                            <span class="block sm:inline">{{ session('success') }}</span>
                        </div>
                    @endif

                    <div class="grid grid-cols-1 md:grid-cols-3 gap-6">
                        <div class="md:col-span-2">
                            <div class="bg-gray-50 dark:bg-gray-700 rounded-lg p-6 mb-6">
                                <div class="flex justify-between items-start">
                                    <div>
                                        <h3 class="text-lg font-bold mb-1">Order #{{ $order->order_number }}</h3>
                                        <p class="text-sm text-gray-500 dark:text-gray-400">Placed on {{ $order->created_at->format('F d, Y \a\t h:i A') }}</p>
                                    </div>
                                    <span class="px-3 py-1 text-sm font-semibold rounded-full 
                                        @if($order->status == 'completed') bg-green-100 text-green-800 
                                        @elseif($order->status == 'paid') bg-blue-100 text-blue-800 
                                        @elseif($order->status == 'pending') bg-yellow-100 text-yellow-800 
                                        @else bg-red-100 text-red-800 @endif">
                                        {{ ucfirst($order->status) }}
                                    </span>
                                </div>

                                <div class="mt-6">
                                    <h4 class="text-md font-semibold mb-2">Customer Information</h4>
                                    <div class="grid grid-cols-1 md:grid-cols-2 gap-4">
                                        <div>
                                            <p class="text-sm text-gray-500 dark:text-gray-400">Name</p>
                                            <p>{{ $order->name }}</p>
                                        </div>
                                        <div>
                                            <p class="text-sm text-gray-500 dark:text-gray-400">Email</p>
                                            <p>{{ $order->email }}</p>
                                        </div>
                                        <div>
                                            <p class="text-sm text-gray-500 dark:text-gray-400">WhatsApp</p>
                                            <p>{{ $order->whatsapp }}</p>
                                        </div>
                                        <div>
                                            <p class="text-sm text-gray-500 dark:text-gray-400">License Type</p>
                                            <p>{{ ucfirst($order->license_type) }}</p>
                                        </div>
                                    </div>
                                </div>

                                <div class="mt-6">
                                    <h4 class="text-md font-semibold mb-2">Product Information</h4>
                                    <div class="flex items-center">
                                        <div class="flex-shrink-0 mr-4">
                                            @if ($order->product->image)
                                                <img src="{{ Storage::url($order->product->image) }}" alt="{{ $order->product->name }}" class="h-16 w-16 object-cover rounded">
                                            @else
                                                <div class="h-16 w-16 bg-gray-200 dark:bg-gray-600 rounded flex items-center justify-center">
                                                    <span class="text-gray-500 dark:text-gray-400 text-xs">No Image</span>
                                                </div>
                                            @endif
                                        </div>
                                        <div>
                                            <h5 class="font-semibold">{{ $order->product->name }}</h5>
                                            <p class="text-sm text-gray-500 dark:text-gray-400">Category: {{ ucfirst($order->product->category) }}</p>
                                            <p class="text-sm text-gray-500 dark:text-gray-400">Price: ${{ number_format($order->amount, 2) }}</p>
                                        </div>
                                    </div>
                                </div>

                                @if ($order->notes)
                                    <div class="mt-6">
                                        <h4 class="text-md font-semibold mb-2">Notes</h4>
                                        <div class="bg-white dark:bg-gray-800 rounded p-3 border border-gray-200 dark:border-gray-600">
                                            <p class="whitespace-pre-line">{{ $order->notes }}</p>
                                        </div>
                                    </div>
                                @endif
                            </div>

                            <div class="bg-gray-50 dark:bg-gray-700 rounded-lg p-6">
                                <h3 class="text-lg font-bold mb-4">Update Order Status</h3>
                                <form action="{{ route('admin.orders.update', $order) }}" method="POST">
                                    @csrf
                                    @method('PUT')
                                    
                                    <div class="mb-4">
                                        <label for="status" class="block text-sm font-medium text-gray-700 dark:text-gray-300 mb-1">Status</label>
                                        <select id="status" name="status" class="block w-full border-gray-300 dark:border-gray-700 dark:bg-gray-900 dark:text-gray-300 focus:border-indigo-500 dark:focus:border-indigo-600 focus:ring-indigo-500 dark:focus:ring-indigo-600 rounded-md shadow-sm">
                                            <option value="pending" {{ $order->status == 'pending' ? 'selected' : '' }}>Pending</option>
                                            <option value="paid" {{ $order->status == 'paid' ? 'selected' : '' }}>Paid</option>
                                            <option value="completed" {{ $order->status == 'completed' ? 'selected' : '' }}>Completed</option>
                                            <option value="cancelled" {{ $order->status == 'cancelled' ? 'selected' : '' }}>Cancelled</option>
                                        </select>
                                    </div>
                                    
                                    <div class="mb-4">
                                        <label for="notes" class="block text-sm font-medium text-gray-700 dark:text-gray-300 mb-1">Admin Notes</label>
                                        <textarea id="notes" name="notes" rows="3" class="block w-full border-gray-300 dark:border-gray-700 dark:bg-gray-900 dark:text-gray-300 focus:border-indigo-500 dark:focus:border-indigo-600 focus:ring-indigo-500 dark:focus:ring-indigo-600 rounded-md shadow-sm">{{ $order->notes }}</textarea>
                                        <p class="mt-1 text-sm text-gray-500 dark:text-gray-400">These notes are for internal use only.</p>
                                    </div>
                                    
                                    <div class="flex justify-end">
                                        <button type="submit" class="bg-indigo-500 hover:bg-indigo-700 text-white font-bold py-2 px-4 rounded">
                                            Update Order
                                        </button>
                                    </div>
                                </form>
                            </div>
                        </div>

                        <div class="md:col-span-1">
                            <div class="bg-gray-50 dark:bg-gray-700 rounded-lg p-6 mb-6">
                                <h3 class="text-lg font-bold mb-4">Payment Details</h3>
                                <div class="mb-4">
                                    <p class="text-sm text-gray-500 dark:text-gray-400">Amount</p>
                                    <p class="text-xl font-bold">${{ number_format($order->amount, 2) }}</p>
                                </div>

                                @if ($order->payment_proof)
                                    <div class="mb-4">
                                        <p class="text-sm text-gray-500 dark:text-gray-400 mb-2">Payment Proof</p>
                                        <a href="{{ Storage::url($order->payment_proof) }}" target="_blank" class="block">
                                            <img src="{{ Storage::url($order->payment_proof) }}" alt="Payment Proof" class="w-full h-auto rounded border border-gray-200 dark:border-gray-600">
                                        </a>
                                        @if($order->payment_proof_uploaded_at && !is_string($order->payment_proof_uploaded_at))
                                            <p class="mt-1 text-xs text-gray-500 dark:text-gray-400">Uploaded on {{ $order->payment_proof_uploaded_at->format('M d, Y \a\t h:i A') }}</p>
                                        @elseif($order->payment_proof_uploaded_at)
                                            <p class="mt-1 text-xs text-gray-500 dark:text-gray-400">Uploaded on {{ $order->payment_proof_uploaded_at }}</p>
                                        @else
                                            <p class="mt-1 text-xs text-gray-500 dark:text-gray-400">Upload date not recorded</p>
                                        @endif
                                    </div>
                                @else
                                    <div class="mb-4 p-4 bg-yellow-50 dark:bg-yellow-900 text-yellow-700 dark:text-yellow-300 rounded-lg">
                                        <p class="text-sm">No payment proof has been uploaded yet.</p>
                                    </div>
                                @endif

                                <div class="mt-6">
                                    <h4 class="text-md font-semibold mb-2">Actions</h4>
                                    <div class="space-y-2">
                                        <a href="https://wa.me/{{ preg_replace('/[^0-9]/', '', $order->whatsapp) }}" target="_blank" class="w-full inline-flex justify-center items-center px-4 py-2 bg-green-600 border border-transparent rounded-md font-semibold text-white hover:bg-green-700 focus:outline-none focus:ring-2 focus:ring-offset-2 focus:ring-green-500 transition ease-in-out duration-150">
                                            <svg xmlns="http://www.w3.org/2000/svg" class="h-5 w-5 mr-2" viewBox="0 0 20 20" fill="currentColor">
                                                <path fill-rule="evenodd" d="M18 10c0 3.866-3.582 7-8 7a8.841 8.841 0 01-4.083-.98L2 17l1.338-3.123C2.493 12.767 2 11.434 2 10c0-3.866 3.582-7 8-7s8 3.134 8 7zM7 9H5v2h2V9zm8 0h-2v2h2V9zM9 9h2v2H9V9z" clip-rule="evenodd" />
                                            </svg>
                                            Contact on WhatsApp
                                        </a>
                                        
                                        <a href="mailto:{{ $order->email }}" class="w-full inline-flex justify-center items-center px-4 py-2 bg-blue-600 border border-transparent rounded-md font-semibold text-white hover:bg-blue-700 focus:outline-none focus:ring-2 focus:ring-offset-2 focus:ring-blue-500 transition ease-in-out duration-150">
                                            <svg xmlns="http://www.w3.org/2000/svg" class="h-5 w-5 mr-2" viewBox="0 0 20 20" fill="currentColor">
                                                <path d="M2.003 5.884L10 9.882l7.997-3.998A2 2 0 0016 4H4a2 2 0 00-1.997 1.884z" />
                                                <path d="M18 8.118l-8 4-8-4V14a2 2 0 002 2h12a2 2 0 002-2V8.118z" />
                                            </svg>
                                            Send Email
                                        </a>
                                    </div>
                                </div>
                            </div>

                            <div class="bg-gray-50 dark:bg-gray-700 rounded-lg p-6">
                                <h3 class="text-lg font-bold mb-4">Order Timeline</h3>
                                <div class="space-y-4">
                                    <div class="flex">
                                        <div class="flex-shrink-0 mr-3">
                                            <div class="h-8 w-8 rounded-full bg-blue-500 flex items-center justify-center">
                                                <svg xmlns="http://www.w3.org/2000/svg" class="h-4 w-4 text-white" viewBox="0 0 20 20" fill="currentColor">
                                                    <path fill-rule="evenodd" d="M10 18a8 8 0 100-16 8 8 0 000 16zm1-12a1 1 0 10-2 0v4a1 1 0 00.293.707l2.828 2.829a1 1 0 101.415-1.415L11 9.586V6z" clip-rule="evenodd" />
                                                </svg>
                                            </div>
                                        </div>
                                        <div>
                                            <p class="font-medium">Order Created</p>
                                            <p class="text-sm text-gray-500 dark:text-gray-400">{{ $order->created_at->format('M d, Y \a\t h:i A') }}</p>
                                        </div>
                                    </div>

                                    @if ($order->payment_proof_uploaded_at)
                                        <div class="flex">
                                            <div class="flex-shrink-0 mr-3">
                                                <div class="h-8 w-8 rounded-full bg-green-500 flex items-center justify-center">
                                                    <svg xmlns="http://www.w3.org/2000/svg" class="h-4 w-4 text-white" viewBox="0 0 20 20" fill="currentColor">
                                                        <path fill-rule="evenodd" d="M4 4a2 2 0 00-2 2v4a2 2 0 002 2V6h10a2 2 0 00-2-2H4zm2 6a2 2 0 012-2h8a2 2 0 012 2v4a2 2 0 01-2 2H8a2 2 0 01-2-2v-4zm6 4a2 2 0 100-4 2 2 0 000 4z" clip-rule="evenodd" />
                                                    </svg>
                                                </div>
                                            </div>
                                            <div>
                                                <p class="font-medium">Payment Proof Uploaded</p>
                                                <p class="text-sm text-gray-500 dark:text-gray-400">{{ $order->payment_proof_uploaded_at->format('M d, Y \a\t h:i A') }}</p>
                                            </div>
                                        </div>
                                    @endif

                                    @if ($order->status == 'paid' || $order->status == 'completed')
                                        <div class="flex">
                                            <div class="flex-shrink-0 mr-3">
                                                <div class="h-8 w-8 rounded-full bg-indigo-500 flex items-center justify-center">
                                                    <svg xmlns="http://www.w3.org/2000/svg" class="h-4 w-4 text-white" viewBox="0 0 20 20" fill="currentColor">
                                                        <path fill-rule="evenodd" d="M16.707 5.293a1 1 0 010 1.414l-8 8a1 1 0 01-1.414 0l-4-4a1 1 0 011.414-1.414L8 12.586l7.293-7.293a1 1 0 011.414 0z" clip-rule="evenodd" />
                                                    </svg>
                                                </div>
                                            </div>
                                            <div>
                                                <p class="font-medium">Payment Verified</p>
                                                <p class="text-sm text-gray-500 dark:text-gray-400">{{ $order->updated_at->format('M d, Y \a\t h:i A') }}</p>
                                            </div>
                                        </div>
                                    @endif

                                    @if ($order->status == 'completed')
                                        <div class="flex">
                                            <div class="flex-shrink-0 mr-3">
                                                <div class="h-8 w-8 rounded-full bg-purple-500 flex items-center justify-center">
                                                    <svg xmlns="http://www.w3.org/2000/svg" class="h-4 w-4 text-white" viewBox="0 0 20 20" fill="currentColor">
                                                        <path fill-rule="evenodd" d="M3 17a1 1 0 011-1h12a1 1 0 110 2H4a1 1 0 01-1-1zm3.293-7.707a1 1 0 011.414 0L9 10.586V3a1 1 0 112 0v7.586l1.293-1.293a1 1 0 111.414 1.414l-3 3a1 1 0 01-1.414 0l-3-3a1 1 0 010-1.414z" clip-rule="evenodd" />
                                                    </svg>
                                                </div>
                                            </div>
                                            <div>
                                                <p class="font-medium">Order Completed</p>
                                                <p class="text-sm text-gray-500 dark:text-gray-400">{{ $order->updated_at->format('M d, Y \a\t h:i A') }}</p>
                                            </div>
                                        </div>
                                    @endif

                                    @if ($order->status == 'cancelled')
                                        <div class="flex">
                                            <div class="flex-shrink-0 mr-3">
                                                <div class="h-8 w-8 rounded-full bg-red-500 flex items-center justify-center">
                                                    <svg xmlns="http://www.w3.org/2000/svg" class="h-4 w-4 text-white" viewBox="0 0 20 20" fill="currentColor">
                                                        <path fill-rule="evenodd" d="M4.293 4.293a1 1 0 011.414 0L10 8.586l4.293-4.293a1 1 0 111.414 1.414L11.414 10l4.293 4.293a1 1 0 01-1.414 1.414L10 11.414l-4.293 4.293a1 1 0 01-1.414-1.414L8.586 10 4.293 5.707a1 1 0 010-1.414z" clip-rule="evenodd" />
                                                    </svg>
                                                </div>
                                            </div>
                                            <div>
                                                <p class="font-medium">Order Cancelled</p>
                                                <p class="text-sm text-gray-500 dark:text-gray-400">{{ $order->updated_at->format('M d, Y \a\t h:i A') }}</p>
                                            </div>
                                        </div>
                                    @endif
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</x-app-layout>