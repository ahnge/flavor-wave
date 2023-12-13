<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>Daily Orders</title>
    <style>
        /* General Styles */
        body {
            font-family: "Arial", sans-serif;
            background-color: #f7fafc;
            margin: 0;
            padding: 0;
            color: #333;
        }

        .container {
            max-width: 800px;
            margin: 20px auto;
            background-color: #fff;
            border-radius: 8px;
            box-shadow: 0 0 10px rgba(0, 0, 0, 0.1);
            padding: 20px;
        }

        /* Header Styles */
        h2 {
            font-size: 24px;
            padding-bottom: 10px;
            border-bottom: 2px solid #3498DB;
            text-align: center;
        }

        p {
            line-height: 1.5;
            margin-bottom: 10px;
        }

        /* Order Line Styles */
        .order-line {
            margin-bottom: 20px;
            border-bottom: 1px solid #ddd;
            padding-bottom: 10px;
        }

        .order-line p {
            font-size: 0.9rem;
            margin: 5px 0;
        }

        /* Flavor Wave Section */
        .flavor-wave {
            width: 100%;
            font-size: 1.875rem;
            color: #fff;
            padding: 1.5rem;
            text-align: center;
            font-family: serif;
            background-color: #3498DB;
            margin-bottom: 20px;
        }

        /* Footer Styles */
        .footer {
            text-align: center;
            margin-top: 20px;
            color: #666;
        }
    </style>
</head>

<body>
    <div class="container">
        <h2>Daily Orders</h2>
        <p>Hello {{ $driver->user->name }},</p>
        <p>Here's the list of orders. Please update the status of your order in the application as soon as you
            deliver!</p>

        @foreach ($orders as $order)
        <div class="order-line">
            <p><strong>Order No:</strong> {{ $order->order_no }}</p>
            <p><strong>Customer Name:</strong> {{ $order->distributor->name }}</p>
            <p><strong>Contact No:</strong> {{ $order->phone_no }}</p>
            <p><strong>Region:</strong> {{ getRegionName($order->region_code) }}</p>
            <p><strong>Address:</strong> {{ $order->address }}</p>
            <p><strong>Total Price:</strong> {{ $order->total }} Ks</p>
            <p><strong>Due Date:</strong> {{ $order->due_date->format('d-m-Y') }}</p>
            <p><strong>Ordered At:</strong> {{ $order->created_at->format('d-m-Y') }}</p>
        </div>
        @endforeach

        <div class="footer">
            <p>Logistic Manager</p>
            <p>{{ config('app.name') }}</p>
        </div>
    </div>
</body>

</html>
