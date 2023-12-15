@extends('layouts.app')

@section('content')
  <div class="max-w-screen-lg mx-auto">
  {{ Auth::guard('admin')->user()->truck->driver_name}}
    @if (Auth::guard('admin')->check() && auth('admin')->user()->role_id !== \App\Constants\RoleEnum::Driver->value)
      <a href="{{ route('logistic.index') }}">
        <button type="button"
          class="py-2.5 px-5 text-sm font-medium text-gray-900 focus:outline-none bg-white rounded-md border border-gray-200 hover:bg-gray-100 focus:z-10 focus:ring-4 focus:ring-gray-200 dark:focus:ring-gray-700 dark:bg-gray-800 dark:text-gray-200 dark:border-gray-600 dark:hover:text-white dark:hover:bg-gray-700">
          Back
        </button>
      </a>
    @endif


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
      <p class="text-xl my-6  text-gray-900 dark:text-white font-semibold">
        Assigned Order List
      </p>

      <div class="flex flex-row gap-3">
        <a href="{{ route('trucks.exportOrder', ['truck_id' => $truck->id]) }}"
          class="flex flex-row gap-2 dark:text-white border border-gray-600  dark:bg-gray-800 p-2 rounded-md">Export</a>
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
            <th scope="col" class="px-6 py-3">Due Date</th>
            <th scope="col" class="px-6 py-3">Distributor Name</th>
            <th scope="col" class="px-6 py-3">Distributor ph no</th>
            <th scope="col" class="px-6 py-3">Deliver to</th>
            <th scope="col" class="px-6 py-3 text-black dark:text-white">Status</th>
          </tr>
        </thead>
        <tbody>
          @forelse ($assignOrders as $order)
            <tr
              onclick="window.location.href='{{ route('trucks.orderDetail', ['truck_id' => $truck->id, 'id' => $order->id]) }}'"
              class="bg-white cursor-pointer border-b dark:bg-gray-800 dark:border-gray-700 hover:bg-gray-50 dark:hover:bg-gray-600">
              <td class="px-6 py-4">
                {{ $order->order_no }}
              </td>

              <td class="px-6 py-4">{{ $order->due_date->format('Y-m-d') }}</td>

              <td class="px-6 py-4">{{ $order->distributor->name }}</td>
              <td class="px-6 py-4">{{ $order->distributor->phone_number }}</td>
              <td class="px-6 py-4 ">{{ $order->distributor->address }}</td>
              <td class="px-6 py-4 text-black dark:text-white" data-order-id="{{ $order->id }}">
                {{ \App\Constants\OrderStatusEnum::getLabelForAdmins($order->status) }}</td>
            </tr>
          @empty
            <tr>
              <td colspan="6" class="text-center">
                <div class="flex flex-col items-center justify-center h-40 ">

                  <svg class="w-20 h-20 dark:fill-gray-700 f" version="1.1" id="Capa_1"
                    xmlns="http://www.w3.org/2000/svg" xmlns:xlink="http://www.w3.org/1999/xlink"
                    viewBox="0 0 462.035 462.035" xml:space="preserve">
                    <g id="SVGRepo_bgCarrier" stroke-width="0"></g>
                    <g id="SVGRepo_tracerCarrier" stroke-linecap="round" stroke-linejoin="round">
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
          @endempty

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
