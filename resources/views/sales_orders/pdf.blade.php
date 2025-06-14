<!DOCTYPE html>
<html>
<head>
    <meta charset="utf-8">
    <title>Sales Order #{{ $salesOrder->id }}</title>
    <style>
        body { font-family: sans-serif; }
        table { width: 100%; border-collapse: collapse; margin-top: 20px; }
        th, td { border: 1px solid #ccc; padding: 8px; text-align: left; }
        th { background-color: #f2f2f2; }
    </style>
</head>
<body>
    <h2>Sales Order #{{ $salesOrder->id }}</h2>
    <p><strong>Customer:</strong> {{ $salesOrder->customer_name }}</p>
    <p><strong>Sale Date:</strong> {{ $salesOrder->sale_date }}</p>

    <h4>Items</h4>
    <table>
        <thead>
            <tr>
                <th>Product</th>
                <th>Qty</th>
                <th>Price</th>
                <th>Sub Total</th>
            </tr>
        </thead>
        <tbody>
            @foreach($salesOrder->items as $item)
            <tr>
                <td>{{ $item->product->name ?? 'Deleted Product' }}</td>
                <td>{{ $item->quantity }}</td>
                <td>{{ number_format($item->price, 2) }}</td>
                <td>{{ number_format($item->price * $item->quantity, 2) }}</td>
            </tr>
            @endforeach
        </tbody>
    </table>

    <h4>Total: {{ number_format($salesOrder->total_amount, 2) }}</h4>
</body>
</html>