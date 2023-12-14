@extends('layouts.app')

@section('content')
  <div class="relative overflow-x-auto shadow-md sm:rounded-lg">
    <div class=" absolute right-10 top-10 px-4 py-3 bg-gray-400 rounded-lg">
      <div class="flex">
        <span class="me-2 font-bold">
          Capacity</span><span>{{ $currentTotalOrders }}/{{ $truck->capacity }}</span>
      </div>
    </div>
    <div class=" absolute  top-0 left-4 px-4 py-3 bg-gray-400 rounded-lg">
      <div class="flex">
        <a href="{{ route('logistic.index') }}">Back</a>
      </div>
    </div>
    <div class="max-w-screen-lg p-8 mx-auto">
      <h1 class="text-xl font-semibold my-6">Approved Order List</h1>
      <!-- Table -->
      <div class="relative overflow-x-auto">
        <table class="w-full text-sm text-left rtl:text-right text-gray-500 border border-neutral-100">
          <thead class="text-xs text-gray-700 uppercase bg-gray-100">
            <tr>
              <th scope="col" class="px-6 py-3">
                Order name
              </th>
              <th scope="col" class="px-6 py-3">
                Total Quantities
              </th>
              <th scope="col" class="px-6 py-3">
                Action
              </th>
            </tr>
          </thead>
          <tbody>
            @foreach ($approvedOrders as $order)
              <tr class="bg-white border-b hover:bg-neutral-50 cursor-pointer">
                <th scope="row" class="px-6 py-4 font-medium text-gray-900 whitespace-nowrap">
                  {{ $order->order_no }}
                </th>
                <td class="px-6 py-4">{{ $order->totalProductQuantity }}</td>
                <td class="px-6 py-4">
                  <form action="{{ route('logistic.addOrderToTruck', ['id' => $truck->id]) }}" method="post">
                    @csrf
                    <input type="hidden" name="truck_id" value="{{ $truck->id }}">
                    <input type="hidden" name="order_id" value="{{ $order->id }}">
                    <input type="hidden" name="total_quantity" value="{{ $order->totalProductQuantity }}">
                    <button type="submit"
                      class="font-medium text-blue-600 dark:text-blue-500 hover:underline">Add</button>
                  </form>

                  <a href="{{ route('trucks.orderDetail', ['truck_id' => $truck->id,'id'=>$order->id]) }}" type="submit"
                    class="font-medium text-blue-600 dark:text-blue-500 hover:underline">Detail</a>
                </td>

              </tr>
            @endforeach
          </tbody>
        </table>
      </div>

    </div>
    {{ $approvedOrders->links() }}
  </div>
@endsection
