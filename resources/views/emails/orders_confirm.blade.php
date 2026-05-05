<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <title>Order Confirmation</title>
</head>
<body style="font-family: Arial; padding: 30px; background: #f8f9fa;">
    <div style="max-width:600px; margin:auto; background:#fff; padding:30px; border-radius:8px;">
        <h2 style="color:#28a745;">Order Received!</h2>
        <p>Dear Customer, your order has been placed successfully.</p>
        <h4>Order Details:</h4>
        <table width="100%" border="1" cellpadding="8" cellspacing="0" style="border-collapse:collapse;">
            <thead style="background:#f0f0f0;">
                <tr>
                    <th>Product</th>
                    <th>Qty</th>
                    <th>Price</th>
                    <th>Subtotal</th>
                </tr>
            </thead>
            <tbody>
                @foreach($items as $item)
                <tr>
                    <td>{{ $item->product->name ?? 'N/A' }}</td>
                    <td>{{ $item->quantity }}</td>
                    <td>{{ number_format($item->price, 2) }}</td>
                    <td>{{ number_format($item->subtotal, 2) }}</td>
                </tr>
                @endforeach
            </tbody>
        </table>
        <h3 style="margin-top:20px;">Total: Rs. {{ number_format($order->total_amount, 2) }}</h3>
        <p>Payment Method: {{ $order->payment_method }}</p>
        <p>Address: {{ $order->address }}</p>
        <p style="margin-top:30px; color:#888;">Thank you for shopping with us!</p>
    </div>
</body>
</html>