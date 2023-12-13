@extends('layouts.app')

@section('header')
  <h2 class="font-semibold text-xl text-gray-800 leading-tight">
    {{ __('Truck Details') }}
  </h2>
@endsection

@section('content')
  <div class="max-w-screen-lg p-8 mx-auto">
    <!-- Truck information -->
    <p class="text-lg">Truck Number: {{ $truck->truck_no }}</p>
    <p class="text-lg">Driver Name: {{ $truck->driver_name }}</p>
    <p class="text-lg">Capacity: {{ $truck->capacity }}</p>
    <p class="text-lg" id="truck-status">Truck status: {{ \App\Constants\TruckStatusEnum::getLabel($truck->status) }}
    </p>

    <div class="flex flex-row justify-between items-center">
      <p class="text-xl my-6 text-gray-900 dark:text-white font-semibold">
        Assigned Order List
      </p>

      <div class="flex flex-row gap-3">
        <select id="countries" onchange="updateTruckStatus(this.value, {{ $truck->id }})">
          class="bg-gray-50 border border-gray-300 text-gray-900 text-sm rounded-lg focus:ring-blue-500 focus:border-blue-500 block w-full p-2.5 dark:bg-gray-700 dark:border-gray-600 dark:placeholder-gray-400 dark:text-white dark:focus:ring-blue-500 dark:focus:border-blue-500">
          <option selected disabled>Change truck status</option>
          <option value="0">At warehouse</option>
          <option value="1">On the road</option>
        </select>
      </div>
    </div>
    <!-- Table -->
    <div class="relative overflow-x-auto shadow-md sm:rounded-lg">
      <table class="w-full text-sm text-left rtl:text-right text-gray-500 dark:text-gray-400">
        <thead class="text-xs text-gray-700 uppercase bg-gray-50 dark:bg-gray-700 dark:text-gray-400">
          <tr>
            <th scope="col" class="px-6 py-3">Order number</th>
            <th scope="col" class="px-6 py-3">Status</th>
            <th scope="col" class="px-6 py-3">Due Date</th>
            <th scope="col" class="px-6 py-3">Distributor Name</th>
            <th scope="col" class="px-6 py-3">Distributor ph no</th>
            <th scope="col" class="px-6 py-3">Deliver to</th>
            <th scope="col" class="px-6 py-3"></th>
          </tr>
        </thead>
        <tbody>
          @if ($truck->orders->isEmpty())
            <p>No orders associated with this truck.</p>
          @else
            @foreach ($truck->orders as $order)
              @if ($order->status !== \App\Constants\OrderStatusEnum::Delivered->value)
                <tr
                  class="bg-white border-b dark:bg-gray-800 dark:border-gray-700 hover:bg-gray-50 dark:hover:bg-gray-600">
                  <td class="px-6 py-4">

                    <a href="{{ route('trucks.orderDetail', ['id' => $truck->id, 'orderId' => $order->id]) }}">
                      {{ $order->order_no }}
                    </a>
                  </td>
                  <td class="px-6 py-4" data-order-id="{{ $order->id }}">
                    {{ \App\Constants\OrderStatusEnum::getLabelForAdmins($order->status) }}</td>
                  <td class="px-6 py-4">{{ $order->due_date }}</td>

                  <td class="px-6 py-4">{{ $order->distributor->name }}</td>
                  <td class="px-6 py-4">{{ $order->distributor->phone_number }}</td>
                  <td class="px-6 py-4">{{ $order->distributor->address }}</td>

                  <td class="px-6 py-4">
                    <div class="hidden" id="status-{{ $order->id }}">{{ $order->status }}</div>
                    <button class="bg-blue-500 text-white py-2 px-4 rounded" data-order-id="{{ $order->id }}"
                      onclick="updateOrderStatus({{ $order->id }})">
                      {{ $order->status === \App\Constants\OrderStatusEnum::Assigned->value ? 'Loaded' : 'Delivered' }}
                    </button>
                  </td>
                </tr>
              @endif
            @endforeach
          @endif


        </tbody>
      </table>
    </div>
  </div>
@endsection

@section('scripts')
  <script>
    function updateOrderStatus(orderId) {
      let oldOrderStatus = document.querySelector(`#status-${orderId}`).innerText;
      console.log(oldOrderStatus);
      const newStatus = parseInt(oldOrderStatus) + 1;
      console.log(newStatus);
      console.log(orderId);

      if (newStatus > 5) {
        return
      };

      fetch(`/trucks/orders/${orderId}/update-status`, {
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
          const statusTag = document.querySelector(`td[data-order-id="${orderId}"]`);

          if (newStatus === 4) {
            button.innerText = "Delivered";
            statusTag.innerText = "Shipped";
            document.querySelector(`#status-${orderId}`).innerText = 4;
          }
          if (newStatus === 5) {
            button.disabled = true;
            button.remove()
            statusTag.innerText = "Delivered";
            document.querySelector(`#status-${orderId}`).innerText = 5;
          }
        })
        .catch(error => console.error('Error:', error));
    }

    function updateTruckStatus(truckStatus, truckId) {
      fetch(`/trucks/${truckId}`, {
          method: 'PUT',
          headers: {
            'Content-Type': 'application/json',
            'X-CSRF-TOKEN': '{{ csrf_token() }}',
          },
          body: JSON.stringify({
            status: truckStatus,
          }),
        })
        .then(response => response.json())
        .then(data => {
          console.log(data);
          // UPdate the truck status DOM
          const truckStatusTag = document.querySelector("#truck-status");

          if (parseInt(truckStatus) === 0) {
            truckStatusTag.innerText = "Truck status: At warehouse"
          }
          if (parseInt(truckStatus) === 1) {
            truckStatusTag.innerText = "Truck status: On the road"
          }
        })
        .catch(error => console.error('Error:', error));
    }
  </script>
@endsection
