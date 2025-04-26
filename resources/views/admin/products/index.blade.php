<x-app-layout>
    <x-slot name="header">
        <div class="flex justify-between items-center">
            <h2 class="font-semibold text-xl text-gray-800 dark:text-gray-200 leading-tight">
                {{ __('Products') }}
            </h2>
            <a href="{{ route('admin.products.create') }}"
                class="bg-blue-500 hover:bg-blue-700 text-white font-bold py-2 px-4 rounded">
                Add New Product
            </a>
        </div>
    </x-slot>

    <div class="py-12">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
            <div class="bg-white dark:bg-gray-800 overflow-hidden shadow-sm sm:rounded-lg">
                <div class="p-6 text-gray-900 dark:text-gray-100">
                    @if (session('success'))
                        <div class="bg-green-100 border border-green-400 text-green-700 px-4 py-3 rounded relative mb-4"
                            role="alert">
                            <span class="block sm:inline">{{ session('success') }}</span>
                        </div>
                    @endif

                    <div class="overflow-x-auto">
                        <table class="min-w-full bg-white dark:bg-gray-700">
                            <thead>
                                <tr>
                                    <th
                                        class="py-3 px-4 border-b border-gray-200 dark:border-gray-600 text-left text-xs font-medium text-gray-500 dark:text-gray-300 uppercase tracking-wider">
                                        Image</th>
                                    <th
                                        class="py-3 px-4 border-b border-gray-200 dark:border-gray-600 text-left text-xs font-medium text-gray-500 dark:text-gray-300 uppercase tracking-wider">
                                        Name</th>
                                    <th
                                        class="py-3 px-4 border-b border-gray-200 dark:border-gray-600 text-left text-xs font-medium text-gray-500 dark:text-gray-300 uppercase tracking-wider">
                                        Category</th>
                                    <th
                                        class="py-3 px-4 border-b border-gray-200 dark:border-gray-600 text-left text-xs font-medium text-gray-500 dark:text-gray-300 uppercase tracking-wider">
                                        User Price</th>
                                    <th
                                        class="py-3 px-4 border-b border-gray-200 dark:border-gray-600 text-left text-xs font-medium text-gray-500 dark:text-gray-300 uppercase tracking-wider">
                                        Dev Price</th>
                                    <th
                                        class="py-3 px-4 border-b border-gray-200 dark:border-gray-600 text-left text-xs font-medium text-gray-500 dark:text-gray-300 uppercase tracking-wider">
                                        Featured</th>
                                    <th
                                        class="py-3 px-4 border-b border-gray-200 dark:border-gray-600 text-left text-xs font-medium text-gray-500 dark:text-gray-300 uppercase tracking-wider">
                                        Actions</th>
                                </tr>
                            </thead>
                            <tbody>
                                @forelse ($products as $product)
                                    <tr>
                                        <td class="py-4 px-4 border-b border-gray-200 dark:border-gray-600">
                                            @if ($product->image)
                                                <img src="{{ Storage::url($product->image) }}"
                                                    alt="{{ $product->name }}" class="h-12 w-12 object-cover rounded">
                                            @else
                                                <div
                                                    class="h-12 w-12 bg-gray-200 dark:bg-gray-600 rounded flex items-center justify-center">
                                                    <span class="text-gray-500 dark:text-gray-400">No Image</span>
                                                </div>
                                            @endif
                                        </td>
                                        <td class="py-4 px-4 border-b border-gray-200 dark:border-gray-600">
                                            {{ $product->name }}</td>
                                        <td class="py-4 px-4 border-b border-gray-200 dark:border-gray-600">
                                            <span
                                                class="px-2 inline-flex text-xs leading-5 font-semibold rounded-full 
                                                @if ($product->category == 'e-book') bg-blue-100 text-blue-800 
                                                @elseif($product->category == 'template') bg-purple-100 text-purple-800 
                                                @else bg-green-100 text-green-800 @endif">
                                                {{ $product->category }}
                                            </span>
                                        </td>
                                        <td class="py-4 px-4 border-b border-gray-200 dark:border-gray-600">
                                            ${{ number_format($product->price_user, 2) }}</td>
                                        <td class="py-4 px-4 border-b border-gray-200 dark:border-gray-600">
                                            ${{ number_format($product->price_developer, 2) }}</td>
                                        <td class="py-4 px-4 border-b border-gray-200 dark:border-gray-600">
                                            @if ($product->featured)
                                                <span
                                                    class="px-2 inline-flex text-xs leading-5 font-semibold rounded-full bg-green-100 text-green-800">Yes</span>
                                            @else
                                                <span
                                                    class="px-2 inline-flex text-xs leading-5 font-semibold rounded-full bg-gray-100 text-gray-800">No</span>
                                            @endif
                                        </td>
                                        <td class="py-4 px-4 border-b border-gray-200 dark:border-gray-600">
                                            <div class="flex space-x-2">
                                                <a href="{{ route('admin.products.edit', $product) }}"
                                                    class="text-indigo-600 hover:text-indigo-900 dark:text-indigo-400 dark:hover:text-indigo-300">Edit</a>
                                                <a href="{{ route('admin.products.show', $product) }}"
                                                    class="text-blue-600 hover:text-blue-900 dark:text-blue-400 dark:hover:text-blue-300">View</a>
                                                <form action="{{ route('admin.products.destroy', $product) }}"
                                                    method="POST" class="inline">
                                                    @csrf
                                                    @method('DELETE')
                                                    <button type="submit"
                                                        class="text-red-600 hover:text-red-900 dark:text-red-400 dark:hover:text-red-600"
                                                        onclick="event.preventDefault();
                                                        Swal.fire({
                                                            title: 'Are you sure?',
                                                            text: 'You will not be able to recover this product!',
                                                            icon: 'warning',
                                                            showCancelButton: true,
                                                            confirmButtonColor: '#d33',
                                                            cancelButtonColor: '#3085d6',
                                                            confirmButtonText: 'Yes, delete it!',
                                                            cancelButtonText: 'No, cancel!'
                                                        }).then((result) => {
                                                            if (result.isConfirmed) {
                                                                this.closest('form').submit();
                                                            }
                                                        })">Delete</button>
                                                </form>
                                            </div>
                                        </td>
                                    </tr>
                                @empty
                                    <tr>
                                        <td colspan="7"
                                            class="py-4 px-4 border-b border-gray-200 dark:border-gray-600 text-center">
                                            No products found.</td>
                                    </tr>
                                @endforelse
                            </tbody>
                        </table>
                    </div>

                    <div class="mt-4">
                        {{ $products->links() }}
                    </div>
                </div>
            </div>
        </div>
    </div>
</x-app-layout>
