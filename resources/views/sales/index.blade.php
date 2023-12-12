@extends('layouts.app')

@section('content')
    <div class="max-w-screen-lg p-8 mx-auto">
        <p class="text-xl my-6 text-gray-900 dark:text-white font-semibold">
            Order List
        </p>
        <!-- Table -->
        <div class="w-full my-3 flex flex-row justify-between items-center">
            <form class="w-2/6">
                <label for="default-search"
                    class="mb-2 text-sm font-medium text-gray-900 sr-only dark:text-white">Search</label>
                <div class="relative">
                    <div class="absolute inset-y-0 start-0 flex items-center ps-3 pointer-events-none">
                        <svg class="w-4 h-4 text-gray-500 dark:text-gray-400" aria-hidden="true"
                            xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 20 20">
                            <path stroke="currentColor" stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                d="m19 19-4-4m0-7A7 7 0 1 1 1 8a7 7 0 0 1 14 0Z" />
                        </svg>
                    </div>
                    <form action="{{ route('preorder.preorderList') }}" method="GET">
                        @csrf
                        <input type="search" id="default-search" name="keyword"
                            class="block w-full p-4 ps-10 text-sm text-gray-900 border border-gray-300 rounded-lg bg-gray-50 focus:ring-blue-500 focus:border-blue-500 dark:bg-gray-700 dark:border-gray-600 dark:placeholder-gray-400 dark:text-white dark:focus:ring-blue-500 dark:focus:border-blue-500"
                            placeholder="Search OrderIDs, Distributors..." required />
                        <button type="submit"
                            class="text-white absolute end-2.5 bottom-2.5 bg-blue-700 hover:bg-blue-800 focus:ring-4 focus:outline-none focus:ring-blue-300 font-medium rounded-lg text-sm px-4 py-2 dark:bg-blue-600 dark:hover:bg-blue-700 dark:focus:ring-blue-800">
                            Search
                        </button>
                    </form>
                </div>
            </form>

            <div>
                <select id="statuses"
                    class="bg-gray-50 border border-gray-300 text-gray-900 text-sm rounded-lg focus:ring-blue-500 focus:border-blue-500 block w-full p-2.5 dark:bg-gray-700 dark:border-gray-600 dark:placeholder-gray-400 dark:text-white dark:focus:ring-blue-500 dark:focus:border-blue-500">
                    <option selected disabled>Choose a status</option>
                    <option value="10">All</option>
                    <option value="0">Pending</option>
                    <option value="1">Approved</option>
                    <option value="2">Rejected</option>
                    <option value="3">Assigned</option>
                    <option value="4">Shipped</option>
                    <option value="5">Delivered</option>
                </select>
            </div>
        </div>
        <div class="relative overflow-x-auto shadow-md sm:rounded-lg">
            <table class="w-full text-sm text-left rtl:text-right text-gray-500 dark:text-gray-400">
                <thead class="text-xs text-gray-700 uppercase bg-gray-100 dark:bg-gray-700 dark:text-gray-400">
                    <tr>
                        <th scope="col" class="px-6 py-3">Order ID</th>
                        <th scope="col" class="px-6 py-3">Distributor</th>
                        <th scope="col" class="px-6 py-3">Price</th>
                        <th scope="col" class="px-6 py-3">Region</th>
                        <th scope="col" class="px-6 py-3">Date</th>
                        <th scope="col" class="px-6 py-3">Status</th>
                        <th scope="col" class="px-6 py-3"></th>

                    </tr>
                </thead>
                <tbody>
                    @foreach ($preorders as $preorder)
                        <tr
                            class="cursor-pointer bg-white border-b dark:bg-gray-800 dark:border-gray-700 hover:bg-gray-50 dark:hover:bg-gray-600">
                            <th scope="row"
                                class="px-6 py-4 font-medium text-gray-900 whitespace-nowrap dark:text-white">
                                {{ $preorder->order_no }}
                            </th>
                            <td class="px-6 py-4">
                                {{ $preorder->distributor->name }}
                            </td>
                            <td class="px-6 py-4">
                                {{ $preorder->total . 'ks' }}
                            </td>
                            <td class="px-6 py-4">
                                {{ $preorder->distributor->region_code }}
                            </td>
                            <td class="px-6 py-4">
                                {{ Illuminate\Support\Carbon::parse($preorder->created_at)->toDateString() }}
                            </td>
                            <td class="px-6 py-4">
                                <div
                                    class="px-3 py-2 text-center rounded-md text-white @if ($preorder->status == 1 || $preorder->status > 2) bg-green-500
                @elseif ($preorder->status == 2)
                bg-red-500
                @elseif ($preorder->status == 0)
                bg-yellow-400 @endif">
                                    {{ App\Constants\OrderStatusEnum::getLabelForAdmins($preorder->status) }}
                                </div>
                            </td>
                            <td class="px-6 py-4">
                                <a href="{{ route('preorder.edit', ['preorder' => $preorder]) }}">
                                    <button
                                        class="text-white bg-blue-700 hover:bg-blue-800 focus:ring-4 focus:outline-none focus:ring-blue-300 font-medium rounded-lg text-sm px-3 py-2 dark:bg-blue-600 dark:hover:bg-blue-700 dark:focus:ring-blue-800">
                                        Detail
                                    </button>

                                </a>
                            </td>
                        </tr>
                    @endforeach

                </tbody>
            </table>
        </div>
        <div class="mt-4">
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
                window.location.href = "{{ route('preorders.filteredPreorderList', ':status') }}".replace(
                    ':status', status);
            });
        });
    </script>
@endsection
