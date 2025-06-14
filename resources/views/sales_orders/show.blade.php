<x-app-layout>
    <x-slot name="header">
        <h2 class="h4 font-weight-bold">
            {{ __('Sales Orders') }}
        </h2>
    </x-slot>
<div class="container mt-4">
    <h2>Sales Order Details</h2>

    <div class="card mt-3">
        <div class="card-body">
            <p><strong>Customer Name:</strong> {{ $salesOrder->customer_name }}</p>
            <p><strong>Sale Date:</strong> {{ $salesOrder->sale_date }}</p>
            <p><strong>Total Amount:</strong> ₹{{ number_format($salesOrder->total_amount, 2) }}</p>
        </div>
    </div>

    <h5 class="mt-4">Items</h5>
    <table class="table table-bordered mt-2">
        <thead>
            <tr>
                <th>Product</th>
                <th>Qty</th>
                <th>Price</th>
                <th>Subtotal</th>
            </tr>
        </thead>
        <tbody>
            @foreach($salesOrder->items as $item)
                <tr>
                    <td>{{ $item->product->name ?? 'Deleted Product' }}</td>
                    <td>{{ $item->quantity }}</td>
                    <td>₹{{ number_format($item->price, 2) }}</td>
                    <td>₹{{ number_format($item->price * $item->quantity, 2) }}</td>
                </tr>
            @endforeach
        </tbody>
    </table>

    <a href="{{ route('sales_orders.index') }}" class="btn btn-secondary mt-3">Back</a>
</div>
</x-app-layout>
