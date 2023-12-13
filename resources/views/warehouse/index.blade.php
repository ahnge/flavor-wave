@extends('layouts.app')

@section('content')
  <div class="max-w-screen-lg p-8 mx-auto">
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

    <div class="flex justify-between">
      <div class="">
        <p class="text-xl my-6 text-gray-900 dark:text-white font-semibold">
          Products List
        </p>
      </div>
      <div class="flex justify-between gap-5">

        <a href="{{ route('warehouse.createProduct') }}"
          class="text-white bg-blue-700 hover:bg-blue-800 focus:ring-4 focus:outline-none focus:ring-blue-300 font-medium rounded-lg text-sm px-5 py-2.5 text-center inline-flex items-center dark:bg-blue-600 dark:hover:bg-blue-700 dark:focus:ring-blue-800">Add
          new product</a>
        <a href="{{ route('warehouse.chart') }}"
          class="text-white bg-blue-700 hover:bg-blue-800 focus:ring-4 focus:outline-none focus:ring-blue-300 font-medium rounded-lg text-sm px-5 py-2.5 text-center inline-flex items-center dark:bg-blue-600 dark:hover:bg-blue-700 dark:focus:ring-blue-800">
          Weekly Product Chart
          <svg class="rtl:rotate-180 w-3.5 h-3.5 ms-2" aria-hidden="true" xmlns="http://www.w3.org/2000/svg" fill="none"
            viewBox="0 0 14 10">
            <path stroke="currentColor" stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
              d="M1 5h12m0 0L9 1m4 4L9 9" />
          </svg>
        </a>
      </div>
    </div>



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
            <th scope="col" class="px-6 py-3 text-center">
              Boxes Quantity
            </th>
            <th scope="col" class="px-6 py-3">

            </th>


          </tr>
        </thead>
        <tbody>
          @foreach ($products as $product)
            <tr class="bg-white border-b dark:bg-gray-800 dark:border-gray-700 hover:bg-gray-50 dark:hover:bg-gray-600">
              <td class="p-4">
                <img class="w-16 md:w-32 max-w-full max-h-full" src="{{ $product->product_photo }}" alt="Jese image">
              </td>
              <td class="px-6 py-4 font-semibold text-gray-900 dark:text-white">
                {{ $product->title }}
              </td>
              <td class="px-6 text-center">
                {{ $product->total_box_count }}
              </td>
              <td>
                <a href="{{ route('warehouse.productShow', ['product' => $product]) }}">
                  <div class="border px-3 py-2 text-center rounded-md mr-4">
                    Update
                  </div>
                </a>
              </td>

            </tr>
          @endforeach


        </tbody>
      </table>
    </div>



  </div>
@endsection
