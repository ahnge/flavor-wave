@extends('layouts.app')

@section('content')
    <div class="max-w-screen-lg p-8 mx-auto">
        <p class="text-xl my-6 text-gray-900 dark:text-white font-semibold">
            {{ $preorder->order_no }} Details
            <span @if ($preorder->status == 0)
                hidden
            @endif class="@if ($preorder->status != 2)
            text-green-500
            @else
            text-red-500
            @endif">({{ App\Constants\OrderStatusEnum::getLabelForAdmins($preorder->status) }})</span>
        </p>
        <div class="relative overflow-x-auto shadow-md sm:rounded-lg">
            <table class="w-full text-sm text-left rtl:text-right text-gray-500 dark:text-gray-400">
                <thead class="text-xs text-gray-700 uppercase bg-gray-50 dark:bg-gray-700 dark:text-gray-400">
                    <tr>
                        <th scope="col" class="px-16 py-3">
                            <span class="sr-only">Image</span>
                        </th>
                        <th scope="col" class="px-6 py-3">
                            Product
                        </th>
                        <th scope="col" class="px-6 py-3">
                            Qty
                        </th>
                        <th scope="col" class="px-6 py-3">
                            Price
                        </th>

                    </tr>
                </thead>
                <tbody>
                    @foreach ($preorder->products as $product)
                        <tr
                            class="bg-white border-b dark:bg-gray-800 dark:border-gray-700 hover:bg-gray-50 dark:hover:bg-gray-600">
                            <td class="p-4">
                                <img class="w-16 md:w-32 max-w-full max-h-full" src="{{ $product->product_photo }}"
                                    alt="Jese image">
                            </td>
                            <td class="px-6 py-4 font-semibold text-gray-900 dark:text-white">
                                {{ $product->title }}
                            </td>
                            <td class="px-6 ">
                                {{ App\Models\OrderProduct::where('order_id', $preorder->id)->where('product_id', $product->id)->first()->quantity }}

                            </td>
                            <td class="px-6 py-4 font-semibold text-gray-900 dark:text-white">
                                {{ App\Models\OrderProduct::where('order_id', $preorder->id)->where('product_id', $product->id)->first()->quantity *$product->price .' ks' }}

                            </td>

                        </tr>
                    @endforeach


                </tbody>
            </table>
        </div>

@if ($preorder->status == 0)

<div class="flex flex-row my-6 w-full justify-end gap-5">

    <div class="flex items-center justify-center space-x-10">
        <div>
            <form method="POST" action="{{ route('preorder.changeStatus', ['preorder' => $preorder]) }}">
                @csrf
                <button name='status' type="submit" value="Approve"
                    class="p-4 border border-b rounded-md mb-3 bg-green-400 text-white">Approve</button>
            </form>
        </div>
        <div>
            <form method="POST" action="{{ route('preorder.changeStatus', ['preorder' => $preorder]) }}">
                @csrf
                <button name='status' type="submit" value="Reject"
                    class="p-4 border border-b rounded-md mb-3 bg-red-600 text-black">Reject</button>
            </form>
        </div>
    </div>

</div>
@endif
    </div>
@endsection
