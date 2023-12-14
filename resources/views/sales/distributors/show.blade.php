@extends('layouts.app')

@section('content')
    <div class="max-w-screen-lg mx-auto">

        <!-- Search Form -->
        <a href="{{ route('sales.distributors.index') }}">
            <button type="button"
                class="py-2.5 px-5  text-sm font-medium text-gray-900 focus:outline-none bg-white rounded-md border border-gray-200 hover:bg-gray-100 hover:text-blue-700 focus:z-10 focus:ring-4 focus:ring-gray-200 dark:focus:ring-gray-700 dark:bg-gray-800 dark:text-gray-200 dark:border-gray-600 dark:hover:text-white dark:hover:bg-gray-700">Back</button>
        </a>


        <div class="flex flex-row justify-start gap-4 items-center my-3">
            <div class="w-1/2 p-6 bg-white border border-gray-200 rounded-lg shadow dark:bg-gray-800 dark:border-gray-700">

                <a href="#">
                    <h5 class="mb-2 text-2xl font-semibold tracking-tight text-gray-900 dark:text-white">Distributor Detail</h5>
                </a>
                <p class="mb-3 font-normal text-gray-500 dark:text-gray-400">Name : <strong class="text-gray-700 dark:text-gray-300">{{ $distributor->name }}</strong></p>
                <p class="mb-3 font-normal text-gray-500 dark:text-gray-400">Email :  <strong class="text-gray-700 dark:text-gray-300">{{ $distributor->email }}</strong></p>
                <p class="mb-3 font-normal text-gray-500 dark:text-gray-400">Phone Number :  <strong class="text-gray-700 dark:text-gray-300">{{ $distributor->phone_number }}</strong></p>
                <p class="mb-3 font-normal text-gray-500 dark:text-gray-400">Address :  <strong class="text-gray-700 dark:text-gray-300">{{ $distributor->address }}</strong></p>
                <p class="mb-3 font-normal text-gray-500 dark:text-gray-400">Region :  <strong class="text-gray-700 dark:text-gray-300">{{getRegionName($distributor->region_code) }}</strong></p>

            </div>
            <div class="w-1/2 p-6 bg-white border border-gray-200 rounded-lg shadow dark:bg-gray-800 dark:border-gray-700">

                <a href="#">
                    <h5 class="mb-2 text-2xl font-semibold tracking-tight text-gray-900 dark:text-white">Orders</h5>
                </a>
                <p class="mb-3 font-normal text-gray-500 dark:text-gray-400">OverAll Orders : <strong class="text-gray-700 dark:text-gray-300">{{ $summary['total'] }}</strong></p>
                <p class="mb-3 font-normal text-gray-500 dark:text-gray-400">Total Suscription :  <strong class="text-gray-700 dark:text-gray-300">{{ $summary['total_spent'] }} Ks</strong></p>
                <p class="mb-3 font-normal text-gray-500 dark:text-gray-400">Pending Orders :  <strong class="text-gray-700 dark:text-gray-300">{{ $summary['pending_orders'] }}</strong></p>
                <p class="mb-3 font-normal text-gray-500 dark:text-gray-400">Total Approved Orders :  <strong class="text-gray-700 dark:text-gray-300">{{ $summary['approved_orders'] }}</strong></p>
                <p class="mb-3 font-normal text-gray-500 dark:text-gray-400">Total Returned Orders :  <strong class="text-gray-700 dark:text-gray-300">{{ $summary['returned_orders'] }}</strong></p>
            </div>
        </div>

        <table class="w-full text-sm text-left rtl:text-right text-gray-500 dark:text-gray-400 rounded-md mt-8">
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
                        Phone No
                    </th>
                    <th scope="col" class="px-6 py-3  text-center">
                        Region
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
                    <tr onclick="window.location.href='{{ route('preorder.edit', $order) }}'"
                        class="bg-white border-b dark:bg-gray-800 dark:border-gray-700 hover:bg-gray-50 dark:hover:bg-gray-600 cursor-pointer">
                        {{-- <td class="w-4 p-4">
                        <div class="flex items-center">
                            <input id="checkbox-table-search-1" type="checkbox" class="w-4 h-4 text-blue-600 bg-gray-100 border-gray-300 rounded focus:ring-blue-500 dark:focus:ring-blue-600 dark:ring-offset-gray-800 dark:focus:ring-offset-gray-800 focus:ring-2 dark:bg-gray-700 dark:border-gray-600">
                            <label for="checkbox-table-search-1" class="sr-only">checkbox</label>
                        </div>
                    </td> --}}
                        <th scope="row"
                            class="px-6 py-4 font-medium text-gray-900 whitespace-nowrap dark:text-white">
                            {{ $order->order_no }}
                        </th>
                        <td class="px-6 py-4 text-center">
                            {{ count($order->products) }}
                        </td>
                        <td class="px-6 py-4 text-center">
                            {{ $order->phone_no }}
                        </td>
                        <td class="px-6 py-4 text-center">
                            {{ getRegionName($order->region_code) }}
                        </td>
                        <td class="px-6 py-4 text-center whitespace-nowrap">
                            {{ $order->total }} Ks
                        </td>
                        <td class="px-6 py-4 text-center">
                            {{ $order->created_at->format('Y-m-d') }}
                        </td>
                        <td class="px-6 py-4 text-center">
                            {{ $order->due_date->format('Y-m-d') }}
                        </td>
                        <td class="px-6 py-4 text-center">

                            <div
                            class="px-3 py-2 bg-opacity-40 text-center rounded-md text-gray-900 dark:text-white @if ($order->status == 1 || $order->status > 2) bg-green-600
                          @elseif ($order->status == 2)
                          bg-red-500
                          @elseif ($order->status == 0)
                          bg-[#ebff00] @endif">
                            {{ App\Constants\OrderStatusEnum::getLabelForDistributors($order->status) }}
                          </div>

                            {{-- {{$order->status}} --}}
                        </td>
                    </tr>
                @empty
                    <tr>
                        <td colspan="6" class="text-center">
                            <div class="flex flex-col items-center justify-center h-40 ">

                                <svg class="w-20 h-20 dark:fill-gray-700 f" version="1.1" id="Capa_1"
                                    xmlns="http://www.w3.org/2000/svg"
                                    xmlns:xlink="http://www.w3.org/1999/xlink" viewBox="0 0 462.035 462.035"
                                    xml:space="preserve">
                                    <g id="SVGRepo_bgCarrier" stroke-width="0"></g>
                                    <g id="SVGRepo_tracerCarrier" stroke-linecap="round"
                                        stroke-linejoin="round">
                                    </g>
                                    <g id="SVGRepo_iconCarrier">
                                        <g>
                                            <path
                                                d="M457.83,158.441c-0.021-0.028-0.033-0.058-0.057-0.087l-50.184-62.48c-0.564-0.701-1.201-1.305-1.879-1.845 c-2.16-2.562-5.355-4.225-8.967-4.225H65.292c-3.615,0-6.804,1.661-8.965,4.225c-0.678,0.54-1.316,1.138-1.885,1.845l-50.178,62.48 c-0.023,0.029-0.034,0.059-0.057,0.087C1.655,160.602,0,163.787,0,167.39v193.07c0,6.5,5.27,11.771,11.77,11.771h438.496 c6.5,0,11.77-5.271,11.77-11.771V167.39C462.037,163.787,460.381,160.602,457.83,158.441z M408.516,134.615l16.873,21.005h-16.873 V134.615z M384.975,113.345v42.274H296.84c-2.514,0-4.955,0.805-6.979,2.293l-58.837,43.299l-58.849-43.305 c-2.023-1.482-4.466-2.287-6.978-2.287H77.061v-42.274H384.975z M53.523,155.62H36.65l16.873-21.005V155.62z M438.498,348.69H23.54 V179.16h137.796l62.711,46.148c4.15,3.046,9.805,3.052,13.954-0.005l62.698-46.144h137.799V348.69L438.498,348.69z">
                                            </path>
                                        </g>
                                    </g>
                                </svg>
                                <div class="text-gray-700">
                                    <p class="mb-2 font-bold text-lg">No data found</p>
                                </div>
                            </div>
                        </td>
                    </tr>
                @endforelse


            </tbody>
        </table>

        <div class="flex justify-between">
            <div class="">

            </div>
            <div class="">
                {{ $orders->onEachSide(2)->links() }}
            </div>
        </div>





    </div>
@endsection

@section('scripts')
    <script type="module">
        console.log('loaded js');

    </script>
@endsection
