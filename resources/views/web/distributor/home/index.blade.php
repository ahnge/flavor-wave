@extends('layouts.distributor.app')

@section('main')
    <div class="min-h-[100vh] min-w-[100vw] bg-white">
        <div class="min-w-full px-4 sm:px-6 lg:px-[20vw] sm:flex">
            <div class="w-full flex flex-col gap-y-10 pt-10">

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

            </div>
        </div>
    </div>
@endsection


@push('js')
    <script type="module">
      $(document).ready(function(){
        $("#product-1").on('click', function() {
            callAlert('success', 'Product added to cart')
        });

        $("#product-2").on('click', function() {
            callAlert('error', 'Product added to cart')
        });
        $("#product-3").on('click', function() {
            callAlert('warning', 'Product added to cart')
        });

      })
    </script>
@endpush()
