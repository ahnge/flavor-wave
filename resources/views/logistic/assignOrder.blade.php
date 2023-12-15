@extends('layouts.app')

@section('content')
    <div class="max-w-screen-lg  mx-auto">

        <div class="max-w-screen-lg  ">
            <div class="flex flex-row justify-between items-center">


                <a href="{{ route('logistic.index') }}"> <button type="button"
                        class="py-2.5 px-5  text-sm font-medium text-gray-900 focus:outline-none bg-white rounded-md border border-gray-200 hover:bg-gray-100 focus:z-10 focus:ring-4 focus:ring-gray-200 dark:focus:ring-gray-700 dark:bg-gray-800 dark:text-gray-200 dark:border-gray-600 dark:hover:text-white dark:hover:bg-gray-700">Back</button>
                </a>

                <div
                    class=" py-2.5 px-5  text-sm font-medium text-gray-900 focus:outline-none bg-white rounded-md border border-gray-200 hover:bg-gray-100  focus:z-10 focus:ring-4 focus:ring-gray-200 dark:focus:ring-gray-700 dark:bg-gray-800 dark:text-gray-200 dark:border-gray-600 dark:hover:text-white dark:hover:bg-gray-700">

                    Capacity -<span class="text-gray-500 dark:text-gray-400">
                        {{ $currentTotalOrders }}</span> / {{ $truck->capacity }}
                </div>
            </div>


            <h1 class="text-xl font-semibold my-6 dark:text-white text-gray-800">Approved Order List</h1>
            <!-- Table -->
            <div class="relative overflow-x-auto shadow-md sm:rounded-lg">
                <table class="w-full text-sm text-left rtl:text-right text-gray-500 dark:text-gray-400">
                    <thead class="text-xs text-gray-700 uppercase bg-gray-300 dark:bg-gray-700 dark:text-gray-400">
                        <tr>
                            <th scope="col" class="px-6 py-3">
                                Order name
                            </th>
                            <th scope="col" class="px-6 py-3">
                                Total Quantities
                            </th>
                            <th scope="col" class="px-6 py-3 text-center">
                                Actions
                            </th>
                        </tr>
                    </thead>
                    <tbody>
                        @foreach ($approvedOrders as $order)
                            <tr class="bg-white border-b dark:bg-gray-800 dark:border-gray-700 ">
                                <th scope="row"
                                    class="px-6 py-4 font-medium text-gray-900 dark:text-neutral-200 whitespace-nowrap">
                                    {{ $order->order_no }}
                                </th>
                                <td class="px-6 py-4">{{ $order->totalProductQuantity }}</td>
                                <td class="px-6 py-4 flex flex-row gap-6 justify-center">


                                    <a href="{{ route('logistic.orderDetail', ['truck_id' => $truck->id, 'id' => $order->id]) }}"
                                        type="submit"
                                        class="border px-3 py-2 text-center text-black hover:bg-neutral-200 border-gray-400 hover:dark:bg-gray-900  rounded-md mr-4 dark:text-gray-300">See
                                        more...</a>
                                </td>

                            </tr>
                        @endforeach
                    </tbody>
                </table>
            </div>
            <div class="flex justify-end items-center">
                {{ $approvedOrders->links() }}
            </div>

        </div>

    </div>
@endsection
