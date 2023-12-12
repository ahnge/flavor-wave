@extends('layouts.distributor.app')

@section('main')
    <div class="min-h-[100vh] min-w-[100vw] bg-white dark:bg-gray-800 pt-12 dark:text-white ">
        <div class="min-w-full min-h-screen bg-white dark:bg-gray-900 dark:text-white px-4 sm:px-6 lg:px-[5vw] pt-20 pb-40">
            <h3 class="text-2xl font-bold pb-4 border-b">Your Orders</h3>
            <div class="flex gap-3 pt-4 w-full ">


                <div class="relative overflow-x-auto shadow-md sm:rounded-lg w-full pb-6">
                    <div class="pb-4 bg-white dark:bg-gray-900">
                        <label for="table-search" class="sr-only">Search</label>
                        <div class="relative mt-1">
                            <div class="absolute inset-y-0 rtl:inset-r-0 start-0 flex items-center ps-3 pointer-events-none">
                                <svg class="w-4 h-4 text-gray-500 dark:text-gray-400" aria-hidden="true" xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 20 20">
                                    <path stroke="currentColor" stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="m19 19-4-4m0-7A7 7 0 1 1 1 8a7 7 0 0 1 14 0Z"/>
                                </svg>
                            </div>
                            <input type="search" id="table-search" class="block pt-2 ps-10 text-sm text-gray-900 border border-gray-300 rounded-lg w-80 bg-gray-50 focus:ring-blue-500 focus:border-blue-500 dark:bg-gray-700 dark:border-gray-600 dark:placeholder-gray-400 dark:text-white dark:focus:ring-blue-500 dark:focus:border-blue-500" placeholder="Search for items">
                        </div>
                    </div>
                    <table class="w-full text-sm text-left rtl:text-right text-gray-500 dark:text-gray-400">
                        <thead class="text-xs text-gray-700 uppercase bg-gray-50 dark:bg-gray-700 dark:text-gray-400">
                            <tr>
                                {{-- <th scope="col" class="p-4">
                                    <div class="flex items-center">
                                        <input id="checkbox-all-search" type="checkbox" class="w-4 h-4 text-blue-600 bg-gray-100 border-gray-300 rounded focus:ring-blue-500 dark:focus:ring-blue-600 dark:ring-offset-gray-800 dark:focus:ring-offset-gray-800 focus:ring-2 dark:bg-gray-700 dark:border-gray-600">
                                        <label for="checkbox-all-search" class="sr-only">checkbox</label>
                                    </div>
                                </th> --}}
                                <th scope="col" class="px-6 py-3  text-center">
                                    Order No
                                </th>
                                <th scope="col" class="px-6 py-3  text-center">
                                    Product Count
                                </th>
                                <th scope="col" class="px-6 py-3  text-center">
                                    Total
                                </th>
                                <th scope="col" class="px-6 py-3  text-center">
                                    Start Order At
                                </th>

                                <th scope="col" class="px-6 py-3  text-center">
                                    Due Date
                                </th>

                                <th scope="col" class="px-6 py-3  text-center">
                                    Order Status
                                </th>
                            </tr>
                        </thead>
                        <tbody>
                            @forelse ($orders as $order)
                            <tr class="bg-white border-b dark:bg-gray-800 dark:border-gray-700 hover:bg-gray-50 dark:hover:bg-gray-600">
                                {{-- <td class="w-4 p-4">
                                    <div class="flex items-center">
                                        <input id="checkbox-table-search-1" type="checkbox" class="w-4 h-4 text-blue-600 bg-gray-100 border-gray-300 rounded focus:ring-blue-500 dark:focus:ring-blue-600 dark:ring-offset-gray-800 dark:focus:ring-offset-gray-800 focus:ring-2 dark:bg-gray-700 dark:border-gray-600">
                                        <label for="checkbox-table-search-1" class="sr-only">checkbox</label>
                                    </div>
                                </td> --}}
                                <th scope="row" class="px-6 py-4 font-medium text-gray-900 whitespace-nowrap dark:text-white">
                                   {{ $order->order_no }}
                                </th>
                                <td class="px-6 py-4 text-center">
                                    {{ count($order->products)}}
                                </td>
                                <td class="px-6 py-4 text-center">
                                    {{ $order->total }}
                                </td>
                                <td class="px-6 py-4 text-center">
                                    {{$order->created_at}}
                                </td>
                                <td class="px-6 py-4 text-center">
                                    {{$order->due_date}}
                                </td>
                                <td class="px-6 py-4 text-center">
                                    {{$order->status}}
                                </td>
                            </tr>
                            @empty

                            @endforelse


                        </tbody>
                    </table>

                    <div class="flex justify-between mt-10">
                        <div class="">

                        </div>
                        <div class="">
                            {{ $orders->onEachSide(2)->links() }}
                        </div>
                    </div>

                </div>

            </div>
        </div>
    </div>
@endsection

@push('js')
    <script>

    </script>
    <script type="module">
        $(document).ready(function() {



        })
    </script>
@endpush
