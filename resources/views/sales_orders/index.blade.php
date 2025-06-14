<x-app-layout>
    <x-slot name="header">
        <h2 class="h4 font-weight-bold">
            {{ __('Sales Orders') }}
        </h2>
    </x-slot>

    <div class="container py-4">
        @if (session('success'))
            <div class="alert alert-success">{{ session('success') }}</div>
        @endif

        <div class="mb-3 text-end">
            <a href="{{ route('sales_orders.create') }}" class="btn btn-success">
                <i class="fas fa-plus"></i> Sales Order
            </a>
        </div>

        <div class="table-responsive">
            <table class="table table-bordered table-striped align-middle">
                <thead class="table-dark">
                    <tr>
                        <th>#ID</th>
                        <th>Customer</th>
                        <th>Date</th>
                        <th>Total (₹)</th>
                        <th>Items</th>
                        <th>Actions</th>
                    </tr>
                </thead>
                <tbody>
                    @forelse ($orders as $order)
                        <tr>
                            <td>{{ $order->id }}</td>
                            <td>{{ $order->customer_name }}</td>
                            <td>{{ $order->sale_date }}</td>
                            <td>{{ number_format($order->total_amount, 2) }}</td>
                            <td>
                                <ul class="list-unstyled mb-0">
                                    @foreach ($order->items as $item)
                                        <li>
                                            {{ $item->product->name }} (x{{ $item->quantity }}) - ₹{{ $item->price }}
                                        </li>
                                    @endforeach
                                </ul>
                            </td>
                            <td>
                                <a href="{{ route('sales_orders.show', $order) }}" class="btn btn-info btn-sm">
                                    <i class="fas fa-eye"></i>
                                </a>
                                <a href="{{ route('sales_orders.pdf', $order->id) }}" class="btn btn-sm btn-danger">
                                    <i class="fas fa-file-pdf"></i>
                                </a>
                            </td>
                        </tr>
                    @empty
                        <tr>
                            <td colspan="6" class="text-center">No sales orders found.</td>
                        </tr>
                    @endforelse
                </tbody>
            </table>
        </div>
    </div>
</x-app-layout>
