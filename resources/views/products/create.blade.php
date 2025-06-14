<x-app-layout>
    <x-slot name="header">
        <h2 class="text-xl font-semibold text-gray-800 dark:text-gray-200">
            {{ __('Add Product') }}
        </h2>
    </x-slot>

    <div class="py-6">
        <div class="max-w-2xl mx-auto sm:px-6 lg:px-8">
            <div class="bg-white dark:bg-gray-800 p-6 shadow sm:rounded-lg">
                <form action="{{ route('products.store') }}" method="POST">
                    @csrf
                    @include('products.form')
                    <div class="mt-4 flex justify-end space-x-2">
                        <button type="submit" class="px-4 py-2 bg-blue-600 text-white rounded hover:bg-blue-700">
                            Save
                        </button>
                        <a href="{{ route('products.index') }}"
                           class="px-4 py-2 bg-gray-300 text-black rounded hover:bg-gray-400">
                            Cancel
                        </a>
                    </div>
                </form>
            </div>
        </div>
    </div>
</x-app-layout>
