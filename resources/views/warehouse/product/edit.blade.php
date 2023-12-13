@extends('layouts.app')

@section('content')
    <section class="bg-white">
        <div class="py-8 lg:py-16 px-4 mx-aut   o max-w-screen-md">
            <h2 class="mb-4 text-4xl tracking-tight font-extrabold text-center text-gray-900">
                {{ $product->title }}
            </h2>
            <div id="qty-form" class="">
                <form class="max-w-sm mx-auto" method="POST"
                    action="{{ route('warehouse.productDetailChange', ['product'=>$product]) }}">
                    @csrf
                    @method('PUT')
                    <div class="mb-5">
                        <label for="title"
                            class="block mb-2 text-sm font-medium text-gray-900 dark:text-white">Title</label>
                        <input type="title" id="title" name="title"
                            class="shadow-sm bg-gray-50 border border-gray-300 text-gray-900 text-sm rounded-lg focus:ring-blue-500 focus:border-blue-500 block w-full p-2.5 dark:bg-gray-700 dark:border-gray-600 dark:placeholder-gray-400 dark:text-white dark:focus:ring-blue-500 dark:focus:border-blue-500 dark:shadow-sm-light"
                            value="{{ $product->title }}" required>
                    </div>
                    <div class="mb-5">
                        <label for="price" class="block mb-2 text-sm font-medium text-gray-900 dark:text-white">Price Per
                            Box</label>
                        <input type="price" id="price" name="price"
                            class="shadow-sm bg-gray-50 border border-gray-300 text-gray-900 text-sm rounded-lg focus:ring-blue-500 focus:border-blue-500 block w-full p-2.5 dark:bg-gray-700 dark:border-gray-600 dark:placeholder-gray-400 dark:text-white dark:focus:ring-blue-500 dark:focus:border-blue-500 dark:shadow-sm-light"
                            value="{{ $product->price }}" required>
                    </div>
                    <div class="mb-5">
                        <label for="ppb" class="block mb-2 text-sm font-medium text-gray-900 dark:text-white">Pieces
                            Per Box</label>
                        <input type="ppb" id="ppb" name="ppb"
                            class="shadow-sm bg-gray-50 border border-gray-300 text-gray-900 text-sm rounded-lg focus:ring-blue-500 focus:border-blue-500 block w-full p-2.5 dark:bg-gray-700 dark:border-gray-600 dark:placeholder-gray-400 dark:text-white dark:focus:ring-blue-500 dark:focus:border-blue-500 dark:shadow-sm-light"
                            value="{{ $product->pc_per_box }}" required>
                    </div>
                    <div>
                        <button type="submit"
                            class=" text-white bg-blue-700 hover:bg-blue-800 focus:ring-4 focus:outline-none focus:ring-blue-300 font-medium rounded-lg text-sm px-5 py-2.5 text-center dark:bg-blue-600 dark:hover:bg-blue-700 dark:focus:ring-blue-800 mt-6">
                            Update
                        </button>
                    </div>
            </div>
            </form>
        </div>


    </section>
@endsection
{{-- @section('scripts')
<script type="module">
    console.log('loaded js');

    $(document).ready(function() {
    $("#column-type").on('change', function() {
       $("#ppb-form").prop('hidden', false)
    });
});
  </script>
@endsection --}}
