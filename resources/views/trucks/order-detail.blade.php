<x-app-layout>
  <x-slot name="header">
    <h2 class="font-semibold text-xl text-gray-800 leading-tight">
      {{ $order->order_no }}
    </h2>
  </x-slot>


  <div class="relative overflow-x-auto max-w-6xl mx-auto mt-10">
    <table class="w-full text-sm text-left rtl:text-right text-gray-500 dark:text-gray-400">
      <thead class="text-xs text-gray-700 uppercase bg-gray-50 dark:bg-gray-700 dark:text-gray-400">
        <tr>
          <th scope="col" class="px-6 py-3">
            Product name
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
          <tr class="bg-white border-b dark:bg-gray-800 dark:border-gray-700">
            <th scope="row" class="px-6 py-4 font-medium text-gray-900 whitespace-nowrap dark:text-white">
              {{ $product->title }}
            </th>
            <td class="px-6 py-4">
              {{ $product->pivot->quantity }} box
            </td>
            <td class="px-6 py-4">
              {{ $order->total }}
            </td>
          </tr>
        @endforeach
      </tbody>
    </table>
  </div>




</x-app-layout>
