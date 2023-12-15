@extends('layouts.app')

@section('content')
    <div class="max-w-screen-lg mx-auto">
        <div class="flex flex-row my-6 items-center justify-between">
            <p class="text-xl  mt-0 text-gray-900 dark:text-white font-semibold">
                Distributors List
            </p>

            <a href="{{ route('preorder.preorderList') }}">
                <button type="button"
                    class="py-2.5 px-5  text-sm font-medium text-gray-900 focus:outline-none bg-white rounded-md border border-gray-200 hover:bg-gray-100 hover:text-blue-700 focus:z-10 focus:ring-4 focus:ring-gray-200 dark:focus:ring-gray-700 dark:bg-gray-800 dark:text-gray-200 dark:border-gray-600 dark:hover:text-white dark:hover:bg-gray-700">Back</button>
            </a>

        </div>
        <!-- Search Form -->

        <div class="flex flex-row justify-start gap-4 items-center my-3">
            <form method="GET" action="{{ route('sales.distributors.index') }}">

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
                    </div>

                </div>
            </form>
            <a href="{{ route('sales.distributors.index') }}">

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
                        <th scope="col" class="px-6 py-3">Id</th>
                        <th scope="col" class="px-6 py-3">Name</th>
                        <th scope="col" class="px-6 py-3">Email</th>
                        <th scope="col" class="px-6 py-3">Phone</th>
                        <th scope="col" class="px-6 py-3">Address</th>
                        <th scope="col" class="px-6 py-3">Region</th>

                    </tr>
                </thead>
                <tbody>

                    @forelse ($distributors as $distributor)
                        <tr onclick="window.location.href='{{ route('sales.distributors.show', ['id' => $distributor->id]) }}'"
                            class="bg-white border-b dark:bg-gray-800 dark:border-gray-700 hover:bg-gray-50 dark:hover:bg-gray-600 cursor-pointer ">
                            <th scope="row"
                                class="px-6 py-4 font-medium text-gray-900 whitespace-nowrap dark:text-white">
                                {{ $distributor->id }}
                            </th>
                            <td class="px-6 py-4 dark:text-white ">
                                {{ $distributor->name }}
                            </td>
                            <td class="px-6 py-4 dark:text-white">
                                {{ $distributor->email }}
                            </td>
                            <td class="px-6 py-4 dark:text-white">
                                {{ $distributor->phone_number }}
                            </td>

                            <td class="px-6 py-4 dark:text-white">
                                {{ $distributor->address }}
                            </td>

                            <td class="px-6 py-4 dark:text-white">
                                {{ getRegionName($distributor->region_code) }}
                            </td>
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
        {{ $distributors->links() }}
    </div>
</div>
@endsection

@section('scripts')
<script type="module">
    console.log('loaded js');
</script>
@endsection
