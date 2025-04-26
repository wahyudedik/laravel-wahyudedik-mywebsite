<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 dark:text-gray-200 leading-tight">
            {{ __('Edit Product') }}: {{ $product->name }}
        </h2>
    </x-slot>

    <div class="py-12">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
            <div class="bg-white dark:bg-gray-800 overflow-hidden shadow-sm sm:rounded-lg">
                <div class="p-6 text-gray-900 dark:text-gray-100">
                    <form action="{{ route('admin.products.update', $product) }}" method="POST"
                        enctype="multipart/form-data">
                        @csrf
                        @method('PUT')

                        <div class="grid grid-cols-1 md:grid-cols-2 gap-6">
                            <div>
                                <x-input-label for="name" :value="__('Product Name')" />
                                <x-text-input id="name" class="block mt-1 w-full" type="text" name="name"
                                    :value="old('name', $product->name)" required autofocus />
                                <x-input-error :messages="$errors->get('name')" class="mt-2" />
                            </div>

                            <div>
                                <x-input-label for="category" :value="__('Category')" />
                                <select id="category" name="category"
                                    class="block mt-1 w-full border-gray-300 dark:border-gray-700 dark:bg-gray-900 dark:text-gray-300 focus:border-indigo-500 dark:focus:border-indigo-600 focus:ring-indigo-500 dark:focus:ring-indigo-600 rounded-md shadow-sm">
                                    <option value="e-book"
                                        {{ old('category', $product->category) == 'e-book' ? 'selected' : '' }}>E-book
                                    </option>
                                    <option value="template"
                                        {{ old('category', $product->category) == 'template' ? 'selected' : '' }}>
                                        Template</option>
                                    <option value="application"
                                        {{ old('category', $product->category) == 'application' ? 'selected' : '' }}>
                                        Application</option>
                                </select>
                                <x-input-error :messages="$errors->get('category')" class="mt-2" />
                            </div>

                            <div>
                                <x-input-label for="price_user" :value="__('User License Price ($)')" />
                                <x-text-input id="price_user" class="block mt-1 w-full" type="number" name="price_user"
                                    :value="old('price_user', $product->price_user)" step="0.01" min="0" required />
                                <x-input-error :messages="$errors->get('price_user')" class="mt-2" />
                            </div>

                            <div>
                                <x-input-label for="price_developer" :value="__('Developer License Price ($)')" />
                                <x-text-input id="price_developer" class="block mt-1 w-full" type="number"
                                    name="price_developer" :value="old('price_developer', $product->price_developer)" step="0.01" min="0" required />
                                <x-input-error :messages="$errors->get('price_developer')" class="mt-2" />
                            </div>

                            <div>
                                <x-input-label for="demo_link" :value="__('Demo Link (Optional)')" />
                                <x-text-input id="demo_link" class="block mt-1 w-full" type="url" name="demo_link"
                                    :value="old('demo_link', $product->demo_link)" placeholder="https://example.com" />
                                <x-input-error :messages="$errors->get('demo_link')" class="mt-2" />
                            </div>

                            <div>
                                <x-input-label for="featured" :value="__('Featured Product')" />
                                <div class="mt-2">
                                    <label class="inline-flex items-center">
                                        <input type="checkbox" name="featured" value="1"
                                            {{ old('featured', $product->featured) ? 'checked' : '' }}
                                            class="rounded dark:bg-gray-900 border-gray-300 dark:border-gray-700 text-indigo-600 shadow-sm focus:ring-indigo-500 dark:focus:ring-indigo-600 dark:focus:ring-offset-gray-800">
                                        <span class="ml-2 text-sm text-gray-600 dark:text-gray-400">Yes, make this a
                                            featured product</span>
                                    </label>
                                </div>
                                <x-input-error :messages="$errors->get('featured')" class="mt-2" />
                            </div>

                            <div class="col-span-2">
                                <x-input-label for="description" :value="__('Product Description')" />
                                <textarea id="description" name="description" rows="6"
                                    class="block mt-1 w-full border-gray-300 dark:border-gray-700 dark:bg-gray-900 dark:text-gray-300 focus:border-indigo-500 dark:focus:border-indigo-600 focus:ring-indigo-500 dark:focus:ring-indigo-600 rounded-md shadow-sm"
                                    required>{{ old('description', $product->description) }}</textarea>
                                <x-input-error :messages="$errors->get('description')" class="mt-2" />
                            </div>

                            <div class="col-span-2">
                                <x-input-label for="image" :value="__('Product Image')" />

                                @if ($product->image)
                                    <div class="mt-2 mb-4">
                                        <p class="text-sm text-gray-500 dark:text-gray-400 mb-2">Current image:</p>
                                        <img src="{{ Storage::url($product->image) }}" alt="{{ $product->name }}"
                                            class="h-40 w-auto object-cover rounded">
                                    </div>
                                @endif

                                <input type="file" id="image" name="image"
                                    class="block mt-1 w-full text-sm text-gray-600 dark:text-gray-400 file:mr-4 file:py-2 file:px-4 file:rounded-md file:border-0 file:text-sm file:font-semibold file:bg-indigo-50 file:text-indigo-700 hover:file:bg-indigo-100 dark:file:bg-indigo-900 dark:file:text-indigo-300" />
                                <p class="mt-1 text-sm text-gray-500 dark:text-gray-400">Upload a new product image (max
                                    2MB) or leave empty to keep the current one. Recommended size: 800x600px.</p>
                                <x-input-error :messages="$errors->get('image')" class="mt-2" />
                            </div>

                            <div class="mb-3">
                                <x-input-label for="product_file" :value="__('Product File')" />
                                <input type="file" id="product_file" name="product_file"
                                    class="block mt-1 w-full text-sm text-gray-600 dark:text-gray-400 file:mr-4 file:py-2 file:px-4 file:rounded-md file:border-0 file:text-sm file:font-semibold file:bg-indigo-50 file:text-indigo-700 hover:file:bg-indigo-100 dark:file:bg-indigo-900 dark:file:text-indigo-300" />
                                <p class="mt-1 text-sm text-gray-500 dark:text-gray-400">Upload the product file (ZIP,
                                    PDF, etc). Max size: 50MB.</p>
                                <x-input-error :messages="$errors->get('product_file')" class="mt-2" />

                                @if (isset($product) && $product->file_path)
                                    <div class="mt-2">
                                        <span class="badge bg-green">File uploaded</span>
                                        <small class="text-muted">{{ basename($product->file_path) }}</small>
                                    </div>
                                @endif
                            </div>
                        </div>

                        <div class="flex items-center justify-end mt-6">
                            <a href="{{ route('admin.products.index') }}"
                                class="text-gray-500 hover:text-gray-700 dark:text-gray-300 dark:hover:text-gray-100 mr-4">Cancel</a>
                            <x-primary-button>
                                {{ __('Update Product') }}
                            </x-primary-button>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>
</x-app-layout>
