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
            <p class="text-lg">Status: {{ \App\Constants\OrderStatusEnum::getLabel($order->status) }}</p>
            <p class="text-lg">Due Date: {{ $order->due_date }}</p>

            <h3 class="text-xl font-semibold mt-2 mb-1">Distributor Information</h3>
            <p class="text-base">Name: {{ $order->distributor->name }}</p>
            <p class="text-base">Address: {{ $order->distributor->address }}</p>
            <p class="text-base">Phone Number: {{ $order->distributor->phone_number }}</p>
          </div>
        @endforeach
      @endif
    </div>
  </div>
</x-app-layout>
