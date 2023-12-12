<x-app-layout>
  <x-slot name="header">
    <h2 class="font-semibold text-xl text-gray-800 leading-tight">
      {{ __('Truck Details') }}
    </h2>
  </x-slot>

  <div class="py-6">
    <div class="max-w-7xl mx-auto py-6 px-4 sm:px-6 lg:px-8">
      <h1 class="text-3xl font-semibold mb-6">Truck Details</h1>
      <p class="text-lg">Truck Number: {{ $truck->truck_no }}</p>
      <p class="text-lg">Driver Name: {{ $truck->driver_name }}</p>
      <p class="text-lg">Capacity: {{ $truck->capacity }}</p>

      <h2 class="text-2xl font-semibold mt-6 mb-4">Orders</h2>
      @if ($truck->orders->isEmpty())
        <p>No orders associated with this truck.</p>
      @else
        @foreach ($truck->orders as $order)
          <div class="border p-4 mb-4">
            <p class="text-lg">Order Number: {{ $order->order_no }}</p>
            <p class="text-lg" data-order-id="{{ $order->id }}">Status:
              {{ \App\Constants\OrderStatusEnum::getLabelForDistributors($order->status) }}</p>
            <p class="text-lg">Due Date: {{ $order->due_date }}</p>

            <h3 class="text-xl font-semibold mt-2 mb-1">Distributor Information</h3>
            <p class="text-base">Name: {{ $order->distributor->name }}</p>
            <p class="text-base">Address: {{ $order->distributor->address }}</p>
            <p class="text-base">Phone Number: {{ $order->distributor->phone_number }}</p>

            <button class="bg-blue-500 text-white py-2 px-4 rounded" data-order-id="{{ $order->id }}"
              onclick="updateOrderStatus({{ $order->status }}, {{ $order->id }})">
              {{ $order->status === \App\Constants\OrderStatusEnum::Assigned->value ? 'Loaded' : 'Delivered' }}
            </button>
          </div>
        @endforeach
      @endif
    </div>
  </div>


  <script>
    function updateOrderStatus(orderStatus, orderId) {
      const newStatus = orderStatus + 1;
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
          alert(data.message);
          // Update the button text and disable the button if status is 'delivered'
          const button = document.querySelector(`button[data-order-id="${orderId}"]`);
          const statusTag = document.querySelector(`p[data-order-id="${orderId}"]`);

          if (newStatus === 4) {
            button.innerText = "Delivered";
            statusTag.innerText = "Shipped";
          }
          if (newStatus === 5) {
            button.disabled = true;
            statusTag.innerText = "Delivered";
          }
        })
        .catch(error => console.error('Error:', error));
    }
  </script>
</x-app-layout>
