@extends('layouts.distributor.app')

@section('main')
    <div class="main-container min-h-[100vh] min-w-[100vw] bg-white dark:bg-gray-800 pt-12 ">

        @include('web.distributor.home.hero')

        @include('web.distributor.home.section-one')

        <div id="Products" class="min-w-full bg-white dark:bg-gray-900 dark:text-white px-4 sm:px-6 lg:px-[5vw] pb-20">

            <div class="flex flex-col gap-3 px-3 md:px-5 w-full">
                <h1 class="text-4xl font-semibold ">Product List</h1>
                <div class="w-full grid grid-cols-1 sm:grid-cols-2 md:grid-cols-3 lg:grid-cols-4 gap-4" data-v0-t="card" >
                    @foreach ($products as $product)
                    <a >
                      <div
                        class="flex border-gray-200 dark:border-gray-700 shadow h-72 min-w-[250px] pt-4 rounded-md border md:flex-col flex-row items-center px-4 py-3 cursor-pointer hover:bg-slate-100 dark:hover:bg-slate-700">
                        <img
                          src="{{ $product->product_photo }}"
                          alt="Coffee Image"
                          class="w-24 h-24 rounded-md object-cover"
                          width="200"
                          height="200"
                          style="aspect-ratio: 200 / 200; object-fit: cover"
                        />
                        <div  class="flex flex-col  gap-2 mt-3">
                          <h3 class="tracking-tight text-lg font-semibold">{{ $product->title }}</h3>
                          <p class="m-0 text-sm font-semibold text-gray-700  dark:text-gray-400">
                            Avalible Boxes : <span>{{ $product->available_box_count }}</span>
                          </p>
                          <p class="m-0 text-sm font-semibold text-gray-700  dark:text-gray-400">
                            Price : <span>${{$product->price}}</span>
                          </p>


                          <div  x-data="{ cartList: [] }" x-init="cartList = JSON.parse(localStorage.getItem('cart') || '[]')" id="cart-btn-{{$product->id}}" class="cart-btn">

                            <button  x-show="!cartList.includes({{ $product->id }})"  type="button" onclick="addToCart({{ $product->id }})" id="atc-{{$product->id}}" class="min-w-[160px]  max-w-[180px] text-white bg-gradient-to-br from-green-400 to-blue-600 hover:bg-gradient-to-bl focus:ring-4 focus:outline-none focus:ring-green-200 dark:focus:ring-green-800 font-medium rounded-lg text-xs text-center me-2 mb-2
                                py-3
                                ">Add to cart</button>

                            <button x-show="cartList.includes({{ $product->id }})"  type="button" onclick="removeCart({{ $product->id }})" id="rmc-{{ $product->id }}" class="rmc hidden min-w-[160px]  max-w-[180px] text-white bg-gradient-to-r from-red-400 via-red-500 to-red-600 hover:bg-gradient-to-br focus:ring-4 focus:outline-none focus:ring-red-300 dark:focus:ring-red-800 font-medium rounded-lg text-sm px-5 py-2.5 text-center me-2 mb-2">Added</button>
                          </div>

                        </div>
                      </div>
                    </a>
                    @endforeach
                  </div>

              </div>
            {{-- <div class="w-full flex flex-col gap-y-10 pt-10">

                <div class="flex flex-wrap gap-4 ">

                        @foreach ($products as $product)
                        <a href="#" id="product-{{ $product->id }}"
                        class="flex flex-col items-center bg-white border border-gray-200 rounded-lg shadow md:flex-row md:w-[24rem] hover:bg-gray-100 dark:border-gray-700 dark:bg-gray-800 dark:hover:bg-gray-700">
                        <img class="object-cover w-full rounded-t-lg h-28 md:h-full md:w-40 md:rounded-none md:rounded-s-lg"
                            src="{{ $product->product_photo }}" alt="">
                        <div class="flex flex-col justify-between p-4 leading-normal">
                            <h5 class="mb-2 text-2xl font-bold tracking-tight text-gray-900 dark:text-white">{{ $product->title }}</h5>
                            <p class="mb-3 font-normal text-gray-700 dark:text-gray-400">{{ $product->price }}</p>
                        </div>
                         </a>
                        @endforeach

                </div>

            </div> --}}
        </div>
    </div>


@endsection


@push('js')
    <script type="module">
        $(document).ready(function(){
            $('.rmc').each(function(rmc){
                $(this).removeClass('hidden')
            })
        })
    </script>
@endpush()
