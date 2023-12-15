@extends('layouts.app')


@section('content')
  <div class="relative overflow-x-auto max-w-screen-lg mx-auto ">

    <div class="flex flex-row items-center justify-between">

      <a href="{{ route('logistic.orderAssign', ['id' => $truck_id]) }}"> <button type="button"
          class="py-2.5 px-5  text-sm font-medium text-gray-900 focus:outline-none bg-white rounded-md border border-gray-200 hover:bg-gray-100 focus:z-10 focus:ring-4 focus:ring-gray-200 dark:focus:ring-gray-700 dark:bg-gray-800 dark:text-gray-200 dark:border-gray-600 dark:hover:text-white dark:hover:bg-gray-700">Back</button>
      </a>

      @if ($order->status == \App\Constants\OrderStatusEnum::Approved->value)
        <form action="{{ route('logistic.addOrderToTruck', ['id' => $truck_id]) }}" method="post">
          @csrf
          <input type="hidden" name="truck_id" value="{{ $truck_id }}">
          <input type="hidden" name="order_id" value="{{ $order->id }}">
          <input type="hidden" name="total_quantity" value="{{ $order->totalProductQuantity() }}">
          <button type="submit"
            class="font-medium text-white bg-blue-500 px-5 py-2 rounded-md  hover:bg-blue-600">Assign</button>
        </form>
      @endif
    </div>
    <div class="flex justify-between mt-6">
      <!-- Header -->
      <h2 class="font-semibold mb-6 text-xl dark:text-white text-gray-800 leading-tight">
        {{ $order->order_no }}
      </h2>
    </div>
    <!-- Order information -->
    <p class="text-xl my-6 mb-3 text-gray-900 dark:text-white font-semibold">
      Order Information
    </p>
    <div class="text-black dark:text-white bg-gray-50 mb-5 rounded-lg  dark:bg-gray-800 p-6 flex flex-col gap-3 ">
      <div id="status"><span class="font-bold ">Status :</span>
        {{ \App\Constants\OrderStatusEnum::getLabelForAdmins($order->status) }}</div>
      <div class=""><span class="font-bold ">Due date :</span> {{ $order->due_date->format('Y-m-d') }}</div>

      <div class=""><span class="font-bold ">Company name :</span> {{ $order->distributor->name }}</div>
      <div class=""><span class="font-bold ">Phone number :</span> {{ $order->distributor->phone_number }}
      </div>
      <div class=""><span class="font-bold ">Region :</span> {{ getRegionName($order->region_code) }}</div>

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
