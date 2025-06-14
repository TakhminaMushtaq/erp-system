<!DOCTYPE html>
<html>
<head>
    <meta charset="utf-8">
    <title>Sales Order #{{ $salesOrder->id }}</title>
    <style>
        body {
            font-family: DejaVu Sans, sans-serif;
            font-size: 14px;
            margin: 40px;
            color: #333;
        }
        .header {
            display: flex;
            align-items: center;
            justify-content: space-between;
            border-bottom: 2px solid #666;
            padding-bottom: 10px;
            margin-bottom: 20px;
        }
        .header img {
            height: 50px;
        }
        .title {
            font-size: 20px;
            font-weight: bold;
        }
        .info {
            margin-bottom: 20px;
        }
        .info p {
            margin: 4px 0;
        }
        h4 {
            margin-bottom: 10px;
            border-bottom: 1px solid #aaa;
            padding-bottom: 4px;
        }
        table {
            width: 100%;
            border-collapse: collapse;
            margin-top: 10px;
        }
        th, td {
            border: 1px solid #aaa;
            padding: 8px;
            text-align: left;
        }
        th {
            background-color: #f4f4f4;
        }
        .total {
            text-align: right;
            margin-top: 20px;
            font-weight: bold;
        }
    </style>
</head>
<body>
    <div class="header">
        <div>
            <img src="{{ public_path('erpLogo.png') }}" alt="ERP Logo">
        </div>
        <div class="title">Sales ERP System</div>
    </div>

    <div class="info">
        <p><strong>Sales Order #:</strong> {{ $salesOrder->id }}</p>
        <p><strong>Customer:</strong> {{ $salesOrder->customer_name }}</p>
        <p><strong>Sale Date:</strong> {{ \Carbon\Carbon::parse($salesOrder->sale_date)->format('d M Y') }}</p>
    </div>

    <h4>Order Items</h4>
    <table>
        <thead>
            <tr>
                <th>Product</th>
                <th>Qty</th>
                <th>Price (₹)</th>
                <th>Subtotal (₹)</th>
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

    <p class="total">Total Amount: ₹{{ number_format($salesOrder->total_amount, 2) }}</p>
</body>
</html>