@extends('layouts.app')

@section('content')
    <div class="max-w-screen-lg  mx-auto">
        {{--   <button type="button"
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
          </button> --}}

        <div class="flex flex-row items-center justify-between">
            <p class="text-xl my-3 mt-0 text-gray-900 dark:text-white font-semibold">
                Products List
            </p>
            <div class="flex flex-row items-center gap-3">
                <a href="{{ route('warehouse.createProduct') }}"
                    class="text-white py-3 bg-blue-700 hover:bg-blue-800 focus:ring-4 focus:outline-none focus:ring-blue-300 font-medium rounded-lg text-sm px-5 text-center inline-flex items-center dark:bg-blue-600 dark:hover:bg-blue-700 dark:focus:ring-blue-800">Add
                    new product</a>
                <a href="{{ route('warehouse.chart') }}"
                    class="text-white py-3 bg-blue-700 hover:bg-blue-800 focus:ring-4 focus:outline-none focus:ring-blue-300 font-medium rounded-lg text-sm px-5 text-center inline-flex items-center dark:bg-blue-600 dark:hover:bg-blue-700 dark:focus:ring-blue-800">
                    Weekly Product Chart
                    <svg class="rtl:rotate-180 w-3.5 h-3.5 ms-2" aria-hidden="true" xmlns="http://www.w3.org/2000/svg"
                        fill="none" viewBox="0 0 14 10">
                        <path stroke="currentColor" stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                            d="M1 5h12m0 0L9 1m4 4L9 9" />
                    </svg>
                </a>


            </div>
        </div>

        <div class="flex justify-between items-center my-3">
            <div class="">

            </div>
            <div class="flex justify-between items-center gap-5">
                <form method="GET" class="mt-5" action="{{ route('preorder.preorderList') }}">

                    <div class="flex items-center justify-end gap-4">
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

            </div>
        </div>



        <div class="relative overflow-x-auto shadow-md sm:rounded-lg">
            <table class="w-full text-sm text-left rtl:text-right text-gray-500 dark:text-gray-400">
                <thead class="text-xs text-gray-700 uppercase bg-gray-300 dark:bg-gray-700 dark:text-gray-400">
                    <tr>
                        <th scope="col" class="px-16 py-3">
                            <span class="sr-only">Image</span>
                        </th>
                        <th scope="col" class="px-6 py-3">
                            Product
                        </th>
                        <th scope="col" class="px-6 py-3 text-center">
                            Boxes Quantity
                        </th>
                        <th scope="col" class="px-6 py-3">
                            Action
                        </th>


                    </tr>
                </thead>
                <tbody>
                    @foreach ($products as $product)
                        <tr class="bg-white border-b dark:bg-gray-800 dark:border-gray-700 ">
                            <td class="p-4">
                                <img class="w-16 md:w-32 max-w-full max-h-full" src="{{ $product->product_photo }}"
                                    alt="Jese image">
                            </td>
                            <td class="px-6 py-4 font-semibold text-gray-900 dark:text-white">
                                {{ $product->title }}
                            </td>
                            <td class="px-6 text-center dark:text-white text-black">
                                {{ $product->total_box_count }}
                            </td>
                            <td>
                                <a href="{{ route('warehouse.productShow', ['product' => $product]) }}">
                                    <div
                                        class="border px-3 py-2 text-center text-black hover:bg-neutral-200 border-gray-400 hover:dark:bg-gray-700  rounded-md mr-4 dark:text-gray-300">
                                        Update
                                    </div>
                                </a>
                            </td>

                        </tr>
                    @endforeach


                </tbody>
            </table>
        </div>

        <div class="flex justify-center py-5">
            {{ $products->links() }}
        </div>



    </div>
@endsection
