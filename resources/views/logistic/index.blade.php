@extends('layouts.app')

@section('content')
    <div class="max-w-screen-lg  mx-auto">
        <h1 class="text-xl font-semibold my-6 dark:text-white">Truck List <span
                class="dark:text-gray-500 text-neutral-600 text-sm">(Total : 5)</span>
        </h1>
        <!-- Table -->
        <div class="relative overflow-x-auto shadow-md sm:rounded-lg">
            <table class="w-full text-sm text-left rtl:text-right text-gray-500 dark:text-gray-400">
                <thead class="text-xs text-gray-700 uppercase bg-gray-300 dark:bg-gray-700 dark:text-gray-400">
                    <tr>
                        <th scope="col" class="px-6 py-3">
                            Id
                        </th>
                        <th scope="col" class="px-6 py-3">
                            Truck No
                        </th>
                        <th scope="col" class="px-6 py-3">
                            Driver Name
                        </th>
                        <th scope="col" class="px-6 py-3">
                            Capacity
                        </th>
                        <th scope="col" class="px-6 py-3">
                            Status
                        </th>
                        <th scope="col" class="px-6 py-3">
                            Action
                        </th>

                    </tr>
                </thead>
                <tbody>
                    @foreach ($trucks as $t)
                        <tr onclick="window.location.href='{{ route('trucks.show', [$t->id]) }}'"
                            class="bg-white cursor-pointer
                            border-b dark:bg-gray-800 hover:bg-neutral-100 hover:dark:bg-opacity-70 dark:border-gray-700 ">
                            <th scope="row" class="px-6 py-4 font-medium whitespace-nowrap">
                                {{ $t->id }}
                            </th>
                            <td class="px-6 py-4">{{ $t->truck_no }}</td>
                            <td class="px-6 py-4">{{ $t->driver_name }}</td>
                            <td class="px-6 py-4">{{ $t->capacity }}</td>
                            <td class="px-6 py-4">
                                {{ \App\Constants\TruckStatusEnum::getLabel($t->status) }}
                            </td>
                            <td class="px-6 py-4">
                                <a href="{{ route('logistic.orderAssign', [$t->id]) }}">
                                    <button type="button"
                                        class="focus:outline-none text-white bg-green-700 hover:bg-green-800 focus:ring-4 focus:ring-green-100 font-medium rounded-md text-sm px-5 py-2.5">
                                        Assign
                                    </button>
                                </a>
                            </td>
                        </tr>
                    @endforeach
                </tbody>
            </table>
        </div>
    </div>
@endsection
