<x-app-layout>
    {{-- <div class="py-12">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
            <div class="bg-white overflow-hidden shadow-sm sm:rounded-lg">
                <div class="p-6 text-gray-900">
                        @foreach ($preorder->products as $product)
                                {{ $product->title }}
                        @endforeach
                    <div class="mt-4">
                    </div>
                </div>
                <div class="flex items-center justify-center space-x-10">
                    <div>
                        <form method="POST" action="{{ route('preorder.changeStatus',['preorder'=>$preorder]) }}">
                            @csrf
                            <button name='status' type="submit" value="Approve" class="p-4 border border-b rounded-md mb-3 bg-green-400 text-white">Approve</button>
                        </form>
                    </div>
                    <div>
                        <form method="POST" action="{{ route('preorder.changeStatus',['preorder'=>$preorder]) }}">
                            @csrf
                            <button name='status' type="submit" value="Reject" class="p-4 border border-b rounded-md mb-3 bg-red-600 text-black">Reject</button>
                        </form>
                    </div>
                </div>
            </div>
        </div>
    </div> --}}
    <div class="max-w-screen-lg p-8 mx-auto">
        <button type="button"
            class="py-2 px-4 focus:outline-none bg-white rounded-lg border border-gray-200 hover:bg-gray-100 hover:text-blue-700 focus:z-10 focus:ring-4 focus:ring-gray-200">
            <svg viewBox="0 0 1024 1024" width="20px" height="20px" xmlns="http://www.w3.org/2000/svg" fill="#000000">
                <g id="SVGRepo_bgCarrier" stroke-width="0"></g>
                <g id="SVGRepo_tracerCarrier" stroke-linecap="round" stroke-linejoin="round"></g>
                <g id="SVGRepo_iconCarrier">
                    <path fill="#000000" d="M224 480h640a32 32 0 1 1 0 64H224a32 32 0 0 1 0-64z"></path>
                    <path fill="#000000"
                        d="m237.248 512 265.408 265.344a32 32 0 0 1-45.312 45.312l-288-288a32 32 0 0 1 0-45.312l288-288a32 32 0 1 1 45.312 45.312L237.248 512z">
                    </path>
                </g>
            </svg>
        </button>

        <p class="text-xl my-6 text-gray-900 dark:text-white font-semibold">
            {{ $preorder->order_no }} Details
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
                                <img class="w-16 md:w-32 max-w-full max-h-full" src="{{ $product->product_photo }}" alt="Jese image">
                            </td>
                            <td class="px-6 py-4 font-semibold text-gray-900 dark:text-white">
                                {{ $product->title }}
                            </td>
                            <td class="px-6 ">
                                {{ App\Models\OrderProduct::where('order_id',$preorder->id)->where('product_id',$product->id)->first()->quantity}}

                            </td>
                            <td class="px-6 py-4 font-semibold text-gray-900 dark:text-white">
                                {{((App\Models\OrderProduct::where('order_id',$preorder->id)->where('product_id',$product->id)->first()->quantity)*$product->price).' ks'}}

                            </td>

                        </tr>
                    @endforeach


                </tbody>
            </table>
        </div>


        <div class="flex flex-row my-6 w-full justify-end gap-5">
            <button type="button"
                class="focus:outline-none text-white bg-red-700 hover:bg-red-800 focus:ring-4 focus:ring-red-300 font-medium rounded-lg text-sm px-5 py-2.5 me-2 mb-2 dark:bg-red-600 dark:hover:bg-red-700 dark:focus:ring-red-900">
                Reject
            </button>
            <button type="button"
                class="focus:outline-none text-white bg-green-700 hover:bg-green-800 focus:ring-4 focus:ring-green-300 font-medium rounded-lg text-sm px-5 py-2.5 me-2 mb-2 dark:bg-green-600 dark:hover:bg-green-700 dark:focus:ring-green-800">
                Approve
            </button>
        </div>
    </div>
</x-app-layout>
