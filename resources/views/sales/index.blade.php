@extends('layouts.app')

@section('content')
    <div class="max-w-screen-lg mx-auto">
        <div class="flex flex-row my-6 items-center justify-between">
            <p class="text-xl  mt-0 text-gray-900 dark:text-white font-semibold">
                Order List
            </p>
            <div class="flex gap-3">

                <a href="{{ route('sales.distributors.index') }}"
                    class=" text-white py-3 bg-blue-700 hover:bg-blue-800 focus:ring-4 focus:outline-none focus:ring-blue-300 font-medium rounded-lg text-sm px-5 text-center inline-flex items-center dark:bg-blue-600 dark:hover:bg-blue-700 dark:focus:ring-blue-800">
                    See Distributors
                </a>


                <a href="{{ route('preorders.charts') }}"
                    class=" text-white py-3 bg-blue-700 hover:bg-blue-800 focus:ring-4 focus:outline-none focus:ring-blue-300 font-medium rounded-lg text-sm px-5 text-center inline-flex items-center dark:bg-blue-600 dark:hover:bg-blue-700 dark:focus:ring-blue-800">
                    Total Sales charts
                    <svg class="rtl:rotate-180 w-3.5 h-3.5 ms-2" aria-hidden="true" xmlns="http://www.w3.org/2000/svg"
                        fill="none" viewBox="0 0 14 10">
                        <path stroke="currentColor" stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                            d="M1 5h12m0 0L9 1m4 4L9 9" />
                    </svg>
                </a>
            </div>
        </div>
        <!-- Search Form -->

        <div class="flex flex-row justify-start gap-4 items-center my-3">
            <form method="GET" action="{{ route('preorder.preorderList') }}">

                <div class="flex items-center justify-end gap-4 ">
                    <div class="flex flex-row items-center gap-5">
                        {{-- search-input --}}
                        <div class="flex flex-row items-center">
                            <input type="search" id="default-search" name="keyword"
                                class="focus-visible:outline-none focus-visible:border-0 focus:border-0 block w-full border-e-0 rounded-e-none  text-sm text-gray-900 border border-gray-300 rounded-lg bg-gray-50  dark:bg-gray-700 dark:border-gray-600 dark:placeholder-gray-400 dark:text-white "
                                placeholder="Search" value="{{ request('keyword') }}" />
                            {{-- search-button --}}

                            <button type="submit"
                                class="btn-primary rounded-e-lg border-s-0 dark:border-gray-600 hover:bg-opacity-20 bg-black bg-opacity-0 border-gray-300   border  p-2  cursor-pointer">
                                <svg class="w-5 h-5 text-gray-500 dark:text-gray-400" aria-hidden="true"
                                    xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 20 20">
                                    <path stroke="currentColor" stroke-linecap="round" stroke-linejoin="round"
                                        stroke-width="2" d="m19 19-4-4m0-7A7 7 0 1 1 1 8a7 7 0 0 1 14 0Z" />
                                </svg>
                            </button>

                        </div>
                        {{-- status-select --}}
                        <div>

                            <select id="statuses" name="orderStatus"
                                class="bg-gray-50 border border-gray-300 text-gray-900 text-sm rounded-lg focus:ring-blue-500 focus:border-blue-500 block w-full p-2 dark:bg-gray-700 dark:border-gray-600 dark:placeholder-gray-400 dark:text-white dark:focus:ring-blue-500 dark:focus:border-blue-500">
                                <option value="10" selected {{ request('orderStatus') === '10' ? 'selected' : '' }}>All
                                </option>
                                <option value="0" {{ request('orderStatus') === '0' ? 'selected' : '' }}>Pending
                                </option>
                                <option value="1" {{ request('orderStatus') === '1' ? 'selected' : '' }}>Approved
                                </option>
                                <option value="2" {{ request('orderStatus') === '2' ? 'selected' : '' }}>Rejected
                                </option>
                                <option value="3" {{ request('orderStatus') === '3' ? 'selected' : '' }}>Assigned
                                </option>
                                <option value="4" {{ request('orderStatus') === '4' ? 'selected' : '' }}>Shipped
                                </option>
                                <option value="5" {{ request('orderStatus') === '5' ? 'selected' : '' }}>Delivered
                                </option>
                            </select>
                        </div>
                    </div>

                </div>
            </form>
            <a href="{{ route('preorder.preorderList') }}">

                <button type="button"
                    class="text-gray-900 border border-neutral-300 dark:text-white bg-neutral-200 hover:bg-gray-300 focus:outline-none focus:ring-4 focus:ring-gray-300 font-medium rounded-lg text-sm px-5 py-2.5 dark:bg-gray-800 dark:hover:bg-gray-700 dark:focus:ring-gray-700 dark:border-gray-700 ">Reset</button>
            </a>

        </div>

        {{-- <div class="my-3">
            <a href="{{ route('preorders.chart') }}"
                class="text-white bg-blue-700 hover:bg-blue-800 focus:ring-4 focus:outline-none focus:ring-blue-300 font-medium rounded-lg text-sm px-5 py-2.5 text-center inline-flex items-center dark:bg-blue-600 dark:hover:bg-blue-700 dark:focus:ring-blue-800">
                Monthly Order Chart
                <svg class="rtl:rotate-180 w-3.5 h-3.5 ms-2" aria-hidden="true" xmlns="http://www.w3.org/2000/svg"
                    fill="none" viewBox="0 0 14 10">
                    <path stroke="currentColor" stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                        d="M1 5h12m0 0L9 1m4 4L9 9" />
                </svg>
            </a>

        </div> --}}

        <div class="relative overflow-x-auto shadow-md sm:rounded-lg">
            <table class="w-full text-sm text-left rtl:text-right text-gray-500 dark:text-gray-400">
                <thead class="text-xs text-gray-700 uppercase bg-gray-100 dark:bg-gray-700 dark:text-gray-400">
                    <tr>
                        <th scope="col" class="px-6 py-3">Order ID</th>
                        <th scope="col" class="px-6 py-3">Distributor</th>
                        <th scope="col" class="px-6 py-3">Price</th>
                        <th scope="col" class="px-6 py-3">Region</th>
                        <th scope="col" class="px-6 py-3">Urgent</th>
                        <th scope="col" class="px-6 py-3">Due Date</th>
                        <th scope="col" class="px-6 py-3">Status</th>

                    </tr>
                </thead>
                <tbody>

                    @forelse ($preorders as $preorder)
                        <tr onclick="window.location.href='{{ route('preorder.edit', ['preorder' => $preorder]) }}'"
                            class="hover:dark:bg-opacity-70 cursor-pointer hover:bg-gray-200 bg-white border-b dark:bg-gray-800 dark:border-gray-700 ">
                            <th scope="row"
                                class="px-6 py-4 font-medium text-gray-900 whitespace-nowrap dark:text-white">
                                {{ $preorder->order_no }}
                            </th>
                            <td class="px-6 py-4 dark:text-white ">
                                {{ $preorder->distributor->name }}
                            </td>
                            <td class="px-6 py-4 dark:text-white">
                                {{ $preorder->total . 'ks' }}
                            </td>
                            <td class="px-6 py-4 dark:text-white">
                                {{ getRegionName($preorder->distributor->region_code) }}
                            </td>

                            <td class="px-6 py-4 dark:text-white">
                                {{ $preorder->is_urgent ? 'Yes' : 'No' }}
                            </td>


                            <td class="px-6 py-4 dark:text-white">
                                {{ Illuminate\Support\Carbon::parse($preorder->due_date)->toDateString() }}
                            </td>
                            <td class="px-6 py-4 dark:text-white">
                                <div
                                    class="px-3 py-2 bg-opacity-40 text-center rounded-md text-gray-900 dark:text-white @if ($preorder->status == 1 || $preorder->status > 2) bg-green-600
                @elseif ($preorder->status == 2)
                bg-red-500
                @elseif ($preorder->status == 0)
                bg-[#fffb00] @endif">
                                    {{ App\Constants\OrderStatusEnum::getLabelForAdmins($preorder->status) }}
                                </div>
                            </td>
                            {{-- <td class="px-6 py-4">
                                <a href="{{ route('preorder.edit', ['preorder' => $preorder]) }}">
                                    <button
                                        class="text-white bg-blue-700 hover:bg-blue-800 focus:ring-4 focus:outline-none focus:ring-blue-300 font-medium rounded-lg text-sm px-3 py-2 dark:bg-blue-600 dark:hover:bg-blue-700 dark:focus:ring-blue-800">
                                        Detail
                                    </button>

                                </a>
                            </td> --}}
                        </tr>
                    @empty
                        <tr>
                            <td colspan="7" class="text-center">
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
        {{ $preorders->links() }}
    </div>
</div>
@endsection

@section('scripts')
<script type="module">
    console.log('loaded js');

    $(document).ready(function() {
        $("#statuses").on('change', function() {
            let status = $("#statuses").val();
            let keyword = $("#default-search").val();
            window.location.href = ("{{ route('preorder.preorderList') }}" + "?keyword=:keyword" +
                "&orderStatus=:status").replace(':status', status).replace(':keyword', keyword);
        });
    });
</script>
@endsection
