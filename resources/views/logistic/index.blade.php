@extends('layouts.app')

@section('content')
    <div class="max-w-screen-lg  mx-auto">
        <h1 class="text-xl font-semibold my-6">Truck List</h1>
        <!-- Table -->
        <div class="relative overflow-x-auto">
            <table class="w-full text-sm text-left rtl:text-right text-gray-500 border border-neutral-100">
                <thead class="text-xs text-gray-700 uppercase bg-gray-100">
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
                            Actions
                        </th>

                    </tr>
                </thead>
                <tbody>
                    @foreach ($trucks as $t)
                        <tr class="bg-white border-b hover:bg-neutral-50 cursor-pointer">
                            <th scope="row" class="px-6 py-4 font-medium text-gray-900 whitespace-nowrap">
                                {{ $t->id }}
                            </th>
                            <td class="px-6 py-4">{{ $t->truck_no }}</td>
                            <td class="px-6 py-4">{{ $t->driver_name }}</td>
                            <td class="px-6 py-4">{{ $t->capacity }}</td>
                            <td class="px-6 py-4">
                                {{ $t->status }}
                            </td>
                            <td class="px-6 py-4">
                                <a href=""
                                    class="text-white bg-blue-700 hover:bg-blue-800 focus:ring-4 focus:ring-blue-300 font-medium rounded-md text-sm px-5 py-2.5 me-2 mb-2">
                                    Detail
                                    </button>
                                </a>
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
