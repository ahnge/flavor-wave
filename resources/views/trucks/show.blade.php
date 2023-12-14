@extends('layouts.app')

@section('content')
    <div class="max-w-screen-lg mx-auto">
        <a href="{{ route('logistic.index') }}"> <button type="button"
                class="py-2.5 px-5  text-sm font-medium text-gray-900 focus:outline-none bg-white rounded-md border border-gray-200 hover:bg-gray-100 focus:z-10 focus:ring-4 focus:ring-gray-200 dark:focus:ring-gray-700 dark:bg-gray-800 dark:text-gray-200 dark:border-gray-600 dark:hover:text-white dark:hover:bg-gray-700">Back</button>
        </a>

        <!-- Truck information -->
        <p class="text-xl my-6 text-gray-900 dark:text-white font-semibold">
            Truck information
        </p>
        <div class="text-black dark:text-white bg-gray-50 mb-5 rounded-lg  dark:bg-gray-800 p-6 flex flex-col gap-3 ">
            <div id="status"><span class="font-bold ">Truck Number :</span>
                {{ $truck->truck_no }}</div>
            <div class=""><span class="font-bold ">Driver Name :</span> {{ $truck->driver_name }}</div>


            <div class=""><span class="font-bold ">Capacity:</span> {{ $truck->capacity }}</div>
            <div class=""><span class="font-bold">Truck status:</span>
                <span id="truck-status"> {{ \App\Constants\TruckStatusEnum::getLabel($truck->status) }}</span>
            </div>
        </div>



        <div class="flex flex-row justify-between items-center">
            <p class="text-xl my-6 text-gray-900 dark:text-white font-semibold">
                Assigned Order List
            </p>

            <div class="flex flex-row gap-3">
                <select id="countries" onchange="updateTruckStatus(this.value, {{ $truck->id }})"
                    class="bg-gray-50 border border-gray-300 text-gray-900 text-sm rounded-lg focus:ring-blue-500 focus:border-blue-500 block w-full p-2.5 dark:bg-gray-700 dark:border-gray-600 dark:placeholder-gray-400 dark:text-white dark:focus:ring-blue-500 dark:focus:border-blue-500">
                    <option selected disabled>Change truck status</option>
                    <option value="0">At warehouse</option>
                    <option value="1">On the road</option>
                </select>
            </div>
        </div>
        <!-- Table -->
        <div class="relative overflow-x-auto shadow-md sm:rounded-lg">
            <table class="w-full text-sm text-left rtl:text-right text-gray-500 dark:text-gray-400">
                <thead class="text-xs text-gray-700 uppercase bg-gray-50 dark:bg-gray-700 dark:text-gray-400">
                    <tr>
                        <th scope="col" class="px-6 py-3">Order number</th>
                        <th scope="col" class="px-6 py-3">Status</th>
                        <th scope="col" class="px-6 py-3">Due Date</th>
                        <th scope="col" class="px-6 py-3">Distributor Name</th>
                        <th scope="col" class="px-6 py-3">Distributor ph no</th>
                        <th scope="col" class="px-6 py-3">Deliver to</th>
                    </tr>
                </thead>
                <tbody>
                    @if ($assignOrders->isEmpty())
                        <p>No orders associated with this truck.</p>
                    @else
                        @foreach ($assignOrders as $order)
                            <tr onclick="window.location.href='{{ route('trucks.orderDetail', ['truck_id' => $truck->id, 'id' => $order->id]) }}'"
                                class="bg-white cursor-pointer border-b dark:bg-gray-800 dark:border-gray-700 hover:bg-gray-50 dark:hover:bg-gray-600">
                                <td class="px-6 py-4">
                                    {{ $order->order_no }}
                                </td>
                                <td class="px-6 py-4" data-order-id="{{ $order->id }}">
                                    {{ \App\Constants\OrderStatusEnum::getLabelForAdmins($order->status) }}</td>
                                <td class="px-6 py-4">{{ $order->due_date->format('Y-m-d') }}</td>

                                <td class="px-6 py-4">{{ $order->distributor->name }}</td>
                                <td class="px-6 py-4">{{ $order->distributor->phone_number }}</td>
                                <td class="px-6 py-4">{{ $order->distributor->address }}</td>
                            </tr>
                        @endforeach
                    @endif
                </tbody>
            </table>
        </div>

        <div class="mt-4 flex justify-end items-center">
            {{ $assignOrders->links() }}
        </div>
    </div>
@endsection

@section('scripts')
    <script>
        function updateTruckStatus(truckStatus, truckId) {
            fetch(`/trucks/${truckId}`, {
                    method: 'PUT',
                    headers: {
                        'Content-Type': 'application/json',
                        'X-CSRF-TOKEN': '{{ csrf_token() }}',
                    },
                    body: JSON.stringify({
                        status: truckStatus,
                    }),
                })
                .then(response => response.json())
                .then(data => {
                    console.log(data);
                    // UPdate the truck status DOM
                    const truckStatusTag = document.querySelector("#truck-status");

                    if (parseInt(truckStatus) === 0) {
                        truckStatusTag.innerText = "At warehouse"
                    }
                    if (parseInt(truckStatus) === 1) {
                        truckStatusTag.innerText = " On the road"
                    }
                })
                .catch(error => console.error('Error:', error));
        }
    </script>
@endsection
