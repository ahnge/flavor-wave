<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 leading-tight">
            {{ __('Preorders') }}
        </h2>
    </x-slot>



    <div class="py-12">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">

            <div class="bg-white overflow-hidden shadow-sm sm:rounded-lg">
                <div class="p-6 text-gray-900">
                    <form action="{{ route('preorder.filteredPreorderList',['status'=>'pending']) }}" method="GET">
                        @csrf
                        <div class="flex items-center space-x-4">
                            <div>
                                <button type="submit">Pending</button>
                            </div>
                        </div>

                    </form>
                    <form action="{{ route('preorder.preorderList') }}" method="GET">
                        @csrf
                        <div class="flex items-center justify-end space-x-4 mb-4">

                            <div>
                                <input type="text" name="keyword" class="border border-b">
                            </div>

                            <div>
                                <button type="submit" class="border border-b rounded-md py-2 px-4">Search</button>
                            </div>
                        </div>

                    </form>

                    <div class="relative overflow-x-auto">
                        <table class="w-full text-sm text-left rtl:text-right text-gray-500 border border-neutral-100">
                            <thead class="text-xs text-gray-700 uppercase bg-gray-100">
                                <tr>
                                    <th scope="col" class="px-6 py-3">Preorder No</th>
                                    <th scope="col" class="px-6 py-3">Distributor</th>
                                    <th scope="col" class="px-6 py-3">Address</th>
                                    <th scope="col" class="px-6 py-3">Qty?</th>
                                    <th scope="col" class="px-6 py-3"></th>
                                    <th scope="col" class="px-6 py-3">Status</th>
                                </tr>
                            </thead>
                            <tbody>
                                @foreach ($preorders as $preorder)
                                    <tr class="bg-white border-b hover:bg-neutral-50 cursor-pointer">
                                        <th scope="row"
                                            class="px-6 py-4 font-medium text-gray-900 whitespace-nowrap">
                                            {{ $preorder->order_no }}
                                        </th>
                                        <td class="px-6 py-4">{{ $preorder->distributor->name }}</td>
                                        <td class="px-6 py-4">{{ $preorder->distributor->address }}</td>
                                        <td class="px-6 py-4">{{ $preorder->total }}</td>
                                        <td class="px-6 py-4">
                                            <a href="{{ route('preorder.edit', ['preorder' => $preorder]) }}">
                                                <button type="button"
                                                    class="text-white bg-blue-700 hover:bg-blue-800 focus:ring-4 focus:ring-blue-300 font-medium rounded-md text-sm px-5 py-2.5 me-2 mb-2">
                                                    Detail
                                                </button>
                                            </a>
                                        </td>
                                        <td class="px-6 py-4">
                                            <div class="px-4 py-2 border border-b rounded-md text-white @if ($preorder->status == 1 || $preorder->status > 2)
                                                bg-green-400
                                                @elseif ($preorder->status == 2)
                                                bg-red-400
                                                @elseif ($preorder->status == 0)
                                                bg-yellow-400
                                            @endif">
                                                {{ App\Constants\OrderStatusEnum::getLabelForAdmins($preorder->status) }}
                                            </div>
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
            </div>
        </div>
    </div>
</x-app-layout>
