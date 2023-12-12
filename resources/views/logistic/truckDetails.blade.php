@extends('layouts.guest')

@section('content')
    <div class="relative overflow-x-auto shadow-md sm:rounded-lg">
        <div class=" absolute right-10 top-10 px-4 py-3 bg-gray-400 rounded-lg">
            <div class="flex">
                <span class="me-2 font-bold">
                    Capacity</span><span>{{ $currentTotalOrders }}/{{ $truck->capacity }}</span>
            </div>
        </div>
        <div class=" absolute  left-20 px-4 py-3 bg-gray-400 rounded-lg">
            <div class="flex">
                <button onclick="history.back()">Back</button>
            </div>
        </div>
        <div class="max-w-screen-lg p-8 mx-auto">
            <h1 class="text-xl font-semibold my-6">Assigned Order List</h1>
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
                                Status
                            </th>
                        </tr>
                    </thead>
                    <tbody>
                        @foreach ($truckOrders as $order)
                            <tr class="bg-white border-b hover:bg-neutral-50 cursor-pointer">
                                <th scope="row" class="px-6 py-4 font-medium text-gray-900 whitespace-nowrap">
                                    {{ $order->order_id }}
                                </th>
                                <td class="px-6 py-4">{{ $order->total_quantity }}</td>
                                <td class="px-6 py-4">
                                    {{ $order->status }}
                                </td>

                            </tr>
                        @endforeach
                    </tbody>
                </table>
            </div>

        </div>

    </div>
@endsection
