@extends('layouts.app')


@section('content')
  <div class="relative overflow-x-auto max-w-screen-lg mx-auto ">

    <a href="{{ route('trucks.show', ['truck_id' => $truck_id]) }}"> <button type="button"
        class="py-2.5 px-5  text-sm font-medium text-gray-900 focus:outline-none bg-white rounded-md border border-gray-200 hover:bg-gray-100 focus:z-10 focus:ring-4 focus:ring-gray-200 dark:focus:ring-gray-700 dark:bg-gray-800 dark:text-gray-200 dark:border-gray-600 dark:hover:text-white dark:hover:bg-gray-700">Back</button>
    </a>


    <div class="flex justify-between mt-6">
      <!-- Header -->
      <h2 class="font-semibold mb-6 text-xl dark:text-white text-gray-800 leading-tight">
        {{ $order->order_no }}
      </h2>
      <!-- change order status -->
      <div class="flex flex-row gap-5">
        @if (
            $order->status == \App\Constants\OrderStatusEnum::Assigned->value or
                $order->status == \App\Constants\OrderStatusEnum::Shipped->value)
          <div>
            <div class="hidden" id="status-{{ $order->id }}">{{ $order->status }}</div>
            <button id="update-order-status-btn" class="bg-blue-500 text-white py-2 px-4 rounded"
              data-order-id="{{ $order->id }}">
              {{ $order->status === \App\Constants\OrderStatusEnum::Assigned->value ? 'Loaded' : 'Delivered' }}
            </button>
          </div>
        @endif
        <div id="return-order-container">
          @if ($order->status == \App\Constants\OrderStatusEnum::Shipped->value)
            <!-- Form to update order status to return state -->
            <form method="POST"
              action="{{ route('trucks.returnOrder', ['truck_id' => $truck_id, 'order_id' => $order->id]) }}">
              @csrf
              @method('PUT')
              <input type="hidden" name="dummy">
              <button type="submit" class="bg-red-500 text-white py-2 px-4 rounded">Return Order</button>
            </form>
          @endif
        </div>
      </div>
    </div>
    <!-- Order information -->
    <p class="text-xl my-6 text-gray-900 dark:text-white font-semibold">
      Order Information
    </p>
    <div class="text-black dark:text-white bg-gray-50 mb-5 rounded-lg  dark:bg-gray-800 p-6 flex flex-col gap-3 ">
      <div id="status"><span class="font-bold ">Status :</span>
        {{ \App\Constants\OrderStatusEnum::getLabelForAdmins($order->status) }}</div>
      <div class=""><span class="font-bold ">Due date :</span> {{ $order->due_date->format('Y-m-d') }}</div>

      <div class=""><span class="font-bold ">Company name :</span> {{ $order->distributor->name }}</div>
      <div class=""><span class="font-bold ">Phone number :</span> {{ $order->distributor->phone_number }}</div>
      <div class=""><span class="font-bold ">Deliver to :</span> {{ $order->distributor->address }}</div>
    </div>

    <!-- Table -->
    <p class="text-xl my-6 text-gray-900 dark:text-white font-semibold">
      Product List
    </p>
    <div class="relative overflow-x-auto shadow-md sm:rounded-lg">

      <table class="w-full text-sm text-left rtl:text-right text-gray-500 dark:text-gray-400">
        <thead class="text-xs text-gray-700 uppercase bg-gray-50 dark:bg-gray-700 dark:text-gray-400">
          <tr>
            <th scope="col" class="px-6 py-3">
              Product name
            </th>
            <th scope="col" class="px-6 py-3">
              Price
            </th>
            <th scope="col" class="px-6 py-3">
              Quantity
            </th>
            <th scope="col" class="px-6 py-3">
              Total price
            </th>
          </tr>
        </thead>
        <tbody>
          @foreach ($order->products as $product)
            <tr class="bg-white border-b  dark:bg-gray-800 dark:border-gray-700 hover:bg-gray-50 dark:hover:bg-gray-600">
              <th scope="row" class="px-6 py-4 font-medium text-gray-900 whitespace-nowrap dark:text-white">
                {{ $product->title }}
              </th>
              <td class="px-6 py-4">
                {{ $product->price }} Ks
              </td>
              <td class="px-6 py-4">
                {{ $product->pivot->quantity }} box
              </td>
              <td class="px-6 py-4">
                {{ $product->price * $product->pivot->quantity }} Ks
              </td>
            </tr>
          @endforeach
        </tbody>
      </table>
    </div>
  </div>
@endsection

@section('scripts')
  <script>
    document.addEventListener("DOMContentLoaded", function() {


      function updateOrderStatus(truckId, orderId) {
        console.log(truckId, orderId);
        let oldOrderStatus = document.querySelector(`#status-${orderId}`).innerText;
        const newStatus = parseInt(oldOrderStatus) + 1;
        console.log(newStatus);

        const returnOrderContainer = document.querySelector("#return-order-container");

        if (newStatus > 5) {
          return
        };

        fetch(`/trucks/${truckId}/orders/${orderId}/update-status`, {
            method: 'PUT',
            headers: {
              'Content-Type': 'application/json',
              'X-CSRF-TOKEN': '{{ csrf_token() }}',
            },
            body: JSON.stringify({
              status: newStatus,
            }),
          })
          .then(response => response.json())
          .then(data => {
            console.log(data);
            // Update the button text and disable the button if status is 'delivered'
            const button = document.querySelector(`button[data-order-id="${orderId}"]`);
            const statusTag = document.querySelector("#status");

            if (newStatus === 4) {
              button.innerText = "Delivered";
              statusTag.innerText = "Status: Shipped";
              document.querySelector(`#status-${orderId}`).innerText = 4;

              // Show return order btn
              returnOrderContainer.innerHTML = `
                <form method="POST" action="{{ route('trucks.returnOrder', ['truck_id' => $truck_id, 'order_id' => $order->id]) }}"> @csrf
                  @method('PUT')
                  <input type="hidden" name="dummy">
                  <button type="submit" class="bg-blue-500 text-white py-2 px-4 rounded">Return Order</button>
                </form>
              `;
            }
            if (newStatus === 5) {
              button.disabled = true;
              button.remove()
              returnOrderContainer.remove();
              statusTag.innerText = "Status: Delivered";
              document.querySelector(`#status-${orderId}`).innerText = 5;
            }
          })
          .catch(error => console.error('Error:', error));
      };


      var updateOrderStatusBtn = document.querySelector("#update-order-status-btn");

      if (updateOrderStatusBtn) {
        updateOrderStatusBtn.addEventListener("click", () => {
          updateOrderStatus({{ $truck_id }}, {{ $order->id }})
        })
      }

    });
  </script>
@endsection
