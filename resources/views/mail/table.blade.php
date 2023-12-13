<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>PDF</title>
</head>

<body>
    <div class="container">
        <div class="flavor-wave">Flavor wave</div>
        <h2>New Order Request</h2>
        <p>Hello [Admin Name],</p>
        <p>You have received a new order request. Here are the details:</p>
        <div class="order-details">
            <!-- Include order details here -->
            <p><strong>Order ID:</strong> #123456</p>
            <p><strong>Product:</strong> [Product Name]</p>
            <p><strong>Quantity:</strong> 2</p>
            <p><strong>Total:</strong> $50.00</p>
        </div>
        <p>Click the button below to view and process the order:</p>
        <a href="[Your Web App URL]" class="button">View Order</a>

        <div class="relative overflow-x-auto my-9">
            <table class="w-full text-left text-sm text-gray-500 rtl:text-right">
                <thead class="bg-gray-50 text-xs uppercase text-gray-700">
                    <tr>
                        <th scope="col" class="px-6 py-3">Product name</th>
                        <th scope="col" class="px-6 py-3">Color</th>
                        <th scope="col" class="px-6 py-3">Category</th>
                        <th scope="col" class="px-6 py-3">Price</th>
                    </tr>
                </thead>
                <tbody>
                    <tr class="border-b bg-white">
                        <th scope="row" class="whitespace-nowrap px-6 py-4 font-medium text-gray-900">Apple MacBook
                            Pro 17"</th>
                        <td class="px-6 py-4">Silver</td>
                        <td class="px-6 py-4">Laptop</td>
                        <td class="px-6 py-4">$2999</td>
                    </tr>
                    <tr class="border-b bg-white">
                        <th scope="row" class="whitespace-nowrap px-6 py-4 font-medium text-gray-900">Microsoft
                            Surface Pro</th>
                        <td class="px-6 py-4">White</td>
                        <td class="px-6 py-4">Laptop PC</td>
                        <td class="px-6 py-4">$1999</td>
                    </tr>
                    <tr class="bg-white">
                        <th scope="row" class="whitespace-nowrap px-6 py-4 font-medium text-gray-900">Magic Mouse 2
                        </th>
                        <td class="px-6 py-4">Black</td>
                        <td class="px-6 py-4">Accessories</td>
                        <td class="px-6 py-4">$99</td>
                    </tr>
                </tbody>
            </table>
        </div>
    </div>

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
            padding-top: 20px;
        }

        .button {
            display: inline-block;
            font-size: 14px;
            color: #fff;
            background-color: #3498DB;
            padding: 10px 20px;
            text-decoration: none;
            border-radius: 4px;
            margin-top: 20px;
        }

        .button:hover {
            background-color: #2980B9;
        }

        .flavor-wave {
            width: 100%;
            font-size: 1.875rem;
            /* Equivalent to text-3xl in Tailwind (1rem = 16px) */
            color: #fff;
            padding-left: 0.75rem;
            padding-right: 0.75rem;
            padding-top: 2.5rem;
            padding-bottom: 2.5rem;
            margin-bottom: 0.75rem;
            font-family: serif;
            background-color: #3498DB;
        }

        .relative {
            position: relative;
        }

        .overflow-x-auto {
            overflow-x: auto;
        }

        .my-9 {
            margin-top: 2.25rem;
            margin-bottom: 2.25rem;
        }

        .w-full {
            width: 100%;
        }

        .text-left {
            text-align: left;
        }

        .text-sm {
            font-size: 0.875rem;
        }

        .text-gray-500 {
            color: #718096;
        }

        .rtl\:text-right {
            text-align: right;
        }

        .bg-gray-50 {
            background-color: #f7fafc;
        }

        .text-xs {
            font-size: 0.75rem;
        }

        .uppercase {
            text-transform: uppercase;
        }

        .text-gray-700 {
            color: #4a5568;
        }

        .border-b {
            border-bottom-width: 1px;
            border-bottom-style: solid;
        }

        .bg-white {
            background-color: #ffffff;
        }

        .whitespace-nowrap {
            white-space: nowrap;
        }

        .px-6 {
            padding-left: 1.5rem;
            padding-right: 1.5rem;
        }

        .py-3 {
            padding-top: 0.75rem;
            padding-bottom: 0.75rem;
        }

        .py-4 {
            padding-top: 1rem;
            padding-bottom: 1rem;
        }

        .font-medium {
            font-weight: 500;
        }

        .text-gray-900 {
            color: #1a202c;
        }

        .table {
            display: table;
            width: 100%;
            border-collapse: collapse;
            border-spacing: 0;
        }

        .text-right {
            text-align: right;
        }

        .border {
            border-width: 1px;
            border-style: solid;
        }

        .laptop,
        .laptop-pc,
        .accessories {
            display: table-cell;
        }

        .price {
            display: table-cell;
        }

        .$2999,
        .$1999,
        .$99 {
            display: table-cell;
        }
    </style>


</body>

</html>
