<!DOCTYPE html>
<html>
<head>
    <title>New Order</title>
    {{-- <style>
        /* Custom styling for the page */
        body {
            background-color: #f2f2f2;
        }
        .container {
            margin: 50px auto;
            padding-bottom: 20px;
            background-color: #fff;
            border-radius: 10px;
            box-shadow: 0px 0px 10px rgba(0, 0, 0, 0.2);
            text-align: center;
            font-family: Arial, sans-serif;
            color: #333;
            max-width: 500px;
        }
        h1 {
            font-size: 28px;
            margin-bottom: 20px;
        }
        p {
            font-size: 18px;
            line-height: 1.5;
            margin-bottom: 15px;
        }
        img.logo {
            max-width: 200px;
            margin-bottom: 20px;
        }
        .box{
            height:30vh;
            width: 100%;
            background-color: #ea9b24b7;
            display: flex;
            justify-content: center;
            align-items: center;
        }
        .order-list
        {
            display: flex;
            flex-direction: column;
            gap:20px;
            align-items: flex-start;
            padding: 0px 80px;

        }
        .order-list li{
            list-style: none;
            font-weight: bold;
            color:#333;
        }
        .order-list span{
            color:#000;
            font-weight: normal;
        }
        .logo
        {
            font-size: 30px;
            font-weight: bold;
            color:yellow;
        }
        .logo span{
            font-size: 30px;
            font-weight: bold;
            color:#fff;
        }
    </style> --}}
    <style>
        body {
          font-family: "Arial", sans-serif;
          background-color: #F4F4F4;
          margin: 0;
          padding: 0;
        }
        .container {
          max-width: 600px;
          margin: 20px auto;
          background-color: #fff;
          border-radius: 8px;
          box-shadow: 0 0 10px rgba(0, 0, 0, 0.1);
          padding: 20px;
        }
        h2 {
          color: #333;
        }
        p {
          color: #666;
        }
        .order-details {
          margin-top: 20px;
          border-top: 1px solid #ddd;
          padding-top: 0px;
        }
        .button {
          display: inline-block;
          font-size: 14px;
          color: #fff;
          background-color: #3498DB;
          padding: 10px 20px;
          text-decoration: none;
          border-radius: 4px;
          margin-top: 10px;
        }
        .button:hover {
          background-color: #2980B9;
        }
        .flavor-wave {
          width: 100%;
          font-size: 1.875rem; /* Equivalent to text-3xl in Tailwind (1rem = 16px) */
          color: #fff;
          padding-left: 0.75rem;
          padding-right: 0.75rem;
          padding-top: 2.5rem;
          padding-bottom: 2.5rem;
          margin-bottom: 0.75rem;
          font-family: serif;
          background-color: #3498DB;
        }
      </style>

</head>
<body>
{{-- <div class="container">

    <div class="box">
        <p class="logo">Flavor <span>Wave</span></p>
    </div>

    <div class="content">
        <h1>New Order was registered</h1>
        <p>Shine requested to order with <a href="#">ORD-30003</a>  </p>
        <p>Order Detail</p>
        <ul class="order-list">
            <li>Order ID: <span class="order-detail">ORD-30003</span></li>
            <li>Order Date: <span class="order-detail">2020-10-10</span></li>
            <li>Order Status: <span class="order-detail">Pending</span></li>
            <li>Order Total: <span class="order-detail">RM 100.00</span></li>
            <li>Order Region: <span class="order-detail">Yangon</span></li>
            <li>Need Transport Permit? <span class="order-detail">No</span></li>
            <li>Order Items: <span class="order-detail">1</span></li>
        </ul>

    </div>


</div> --}}
<div class="container">
    <div class="flavor-wave">Flavor wave</div>
    <h2>New Order Request</h2>
    <p>Hello Sale Manager,</p>
    <p>You have received a new order request. Here are the details:</p>
    <div class="order-details">
      <!-- Include order details here -->
      <p><strong>Order ID:</strong> {{ $order->order_no }}</p>
      <p><strong>Total:</strong> {{ $order->total }} Ks</p>
      <p><strong>Is Urgent:</strong>  {{ $order->is_urgent ? "Urget" : "Normal" }} </p>
      <p><strong>Start Order At:</strong> {{ $order->created_at }}</p>
      <p><strong>Estilimated At:</strong> {{ $order->due_date }}</p>
    </div>
    <p>Click the button below to view and process the order:</p>
    <a href="[Your Web App URL]" class="button">View Order</a>
  </div>
</body>
</html>
