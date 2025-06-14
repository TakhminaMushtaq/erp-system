<div class="space-y-4">
    <div>
        <label class="block text-sm font-medium text-gray-700 dark:text-gray-300">Name</label>
        <input type="text" name="name" value="{{ old('name', $product->name ?? '') }}"
               class="mt-1 block w-full rounded-md shadow-sm dark:bg-gray-700 dark:text-white">
        @error('name') <span class="text-red-500 text-sm">{{ $message }}</span> @enderror
    </div>

    <div>
        <label class="block text-sm font-medium text-gray-700 dark:text-gray-300">SKU</label>
        <input type="text" name="sku" value="{{ old('sku', $product->sku ?? '') }}"
               class="mt-1 block w-full rounded-md shadow-sm dark:bg-gray-700 dark:text-white">
        @error('sku') <span class="text-red-500 text-sm">{{ $message }}</span> @enderror
    </div>

    <div>
        <label class="block text-sm font-medium text-gray-700 dark:text-gray-300">Price</label>
        <input type="number" step="0.01" name="price" value="{{ old('price', $product->price ?? '') }}"
               class="mt-1 block w-full rounded-md shadow-sm dark:bg-gray-700 dark:text-white">
        @error('price') <span class="text-red-500 text-sm">{{ $message }}</span> @enderror
    </div>

    <div>
        <label class="block text-sm font-medium text-gray-700 dark:text-gray-300">Quantity</label>
        <input type="number" name="quantity" value="{{ old('quantity', $product->quantity ?? '') }}"
               class="mt-1 block w-full rounded-md shadow-sm dark:bg-gray-700 dark:text-white">
        @error('quantity') <span class="text-red-500 text-sm">{{ $message }}</span> @enderror
    </div>
</div>