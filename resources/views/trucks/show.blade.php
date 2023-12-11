<x-app-layout>
  <x-slot name="header">
    <h2 class="font-semibold text-xl text-gray-800 leading-tight">
      {{ __('Truck Details') }}
    </h2>
  </x-slot>

  <div class="py-6">
    <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
      <div class="bg-white overflow-hidden shadow-sm sm:rounded-lg">
        <div class="p-6 text-gray-900">
          <p class="text-lg">Truck Number: {{ $truck->truck_no }}</p>
          <p class="text-lg">Driver Name: {{ $truck->driver_name }}</p>
          <p class="text-lg">Capacity: {{ $truck->capacity }}</p>

          <h2 class="text-xl font-semibold mt-6 mb-4">Orders</h2>
          @if ($truck->orders->isEmpty())
            <p>No orders associated with this truck.</p>
          @else
            <ul class="list-disc pl-8">
              @foreach ($truck->orders as $order)
                <li>
                  <p class="text-base">Order Number: {{ $order->order_no }}</p>
                  <p class="text-base">Status: {{ $order->status }}</p>
                  <!-- Add more order details as needed -->
                </li>
              @endforeach
            </ul>
          @endif
        </div>
      </div>
    </div>
  </div>
</x-app-layout>
