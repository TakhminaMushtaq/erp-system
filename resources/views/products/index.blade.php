<x-app-layout>
    <x-slot name="header">
        <h2 class="text-xl font-semibold leading-tight text-gray-800 dark:text-gray-200">
            {{ __('Products') }}
        </h2>
    </x-slot>

    <div class="py-6">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
            <div class="flex justify-between items-center mb-4">
                <h3 class="text-lg font-medium text-gray-900 dark:text-gray-100">Product List</h3>
                <a href="{{ route('products.create') }}"
                   class="px-4 py-2 bg-blue-600 text-white rounded hover:bg-blue-700">
                    Add Product
                </a>
            </div>

            @if(session('success'))
                <div class="mb-4 text-green-600 font-semibold">{{ session('success') }}</div>
            @endif

            <div class="bg-white dark:bg-gray-800 overflow-hidden shadow sm:rounded-lg p-4">
                <table class="min-w-full text-sm">
                    <thead class="border-b dark:border-gray-600">
                        <tr>
                            <th class="px-4 py-2 text-left">Name</th>
                            <th class="px-4 py-2 text-left">SKU</th>
                            <th class="px-4 py-2 text-left">Price</th>
                            <th class="px-4 py-2 text-left">Quantity</th>
                            <th class="px-4 py-2 text-left">Actions</th>
                        </tr>
                    </thead>
                    <tbody>
                        @forelse($products as $product)
                            <tr class="border-t dark:border-gray-700">
                                <td class="px-4 py-2">{{ $product->name }}</td>
                                <td class="px-4 py-2">{{ $product->sku }}</td>
                                <td class="px-4 py-2">₹{{ number_format($product->price, 2) }}</td>
                                <td class="px-4 py-2">{{ $product->quantity }}</td>
                                <td class="px-4 py-2 space-x-2">
                                    <a href="{{ route('products.edit', $product) }}"
                                       class="text-yellow-600 hover:underline">Edit</a>
                                    <form action="{{ route('products.destroy', $product) }}"
                                          method="POST" class="inline">
                                        @csrf
                                        @method('DELETE')
                                        <button onclick="return confirm('Delete this product?')"
                                                class="text-red-600 hover:underline">Delete</button>
                                    </form>
                                </td>
                            </tr>
                        @empty
                            <tr><td colspan="5" class="px-4 py-4 text-gray-500">No products found.</td></tr>
                        @endforelse
                    </tbody>
                </table>
            </div>
        </div>
    </div>
</x-app-layout>