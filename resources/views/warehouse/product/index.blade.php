@extends('layouts.app')

@section('content')
    <section
        class="border dark:border-gray-700 pb-8 pt-3 lg:pb-16 lg:pt-6 px-6 mx-auto max-w-screen-md dark:bg-gray-800 bg-neutral-100 m-10 rounded-lg">
        <a href="{{ route('warehouse.productList') }}">
            <button type="button"
                class="py-2.5 px-5  text-sm font-medium text-gray-900 focus:outline-none bg-white rounded-md border border-gray-200 hover:bg-gray-100 hover:text-blue-700 focus:z-10 focus:ring-4 focus:ring-gray-200 dark:focus:ring-gray-700 dark:bg-gray-800 dark:text-gray-200 dark:border-gray-600 dark:hover:text-white dark:hover:bg-gray-700">Back</button>
        </a>
        <h2 class="mb-4 text-4xl tracking-tight font-extrabold text-center dark:text-white text-gray-900 ">

            {{ $product->title }} ({{ $product->total_box_count }})
        </h2>
        <form class="max-w-sm mx-auto" method="POST" action="{{ route('warehouse.productEdit', ['id' => $product->id]) }}">
            @csrf
            @method('PUT')
            <div class="mb-5">
                <label for="type" class="block mb-2 text-sm font-medium text-gray-900 dark:text-white">Select an
                    option</label>
                <select id="type" name="type" required
                    class="bg-gray-50 border border-gray-300 text-gray-900 text-sm rounded-lg focus:ring-blue-500 focus:border-blue-500 block w-full p-2.5 dark:bg-gray-700 dark:border-gray-600 dark:placeholder-gray-400 dark:text-white dark:focus:ring-blue-500 dark:focus:border-blue-500">
                    <option value="" selected>Select Operation</option>
                    <option value="expire">Expire</option>
                    <option value="produce">Produced</option>
                </select>
            </div>
            <div class="mb-5">
                <label for="quantity" class="block mb-2 text-sm font-medium text-gray-900 dark:text-white">Amount</label>
                <input type="quantity" id="quantity" name="quantity"
                    class="shadow-sm bg-gray-50 border border-gray-300 text-gray-900 text-sm rounded-lg focus:ring-blue-500 focus:border-blue-500 block w-full p-2.5 dark:bg-gray-700 dark:border-gray-600 dark:placeholder-gray-400 dark:text-white dark:focus:ring-blue-500 dark:focus:border-blue-500 dark:shadow-sm-light"
                    placeholder="1234... " required>
            </div>


            <button type="submit"
                class=" text-white bg-blue-700 hover:bg-blue-800 focus:ring-4 focus:outline-none focus:ring-blue-300 font-medium rounded-lg text-sm px-5 py-2.5 text-center dark:bg-blue-600 dark:hover:bg-blue-700 dark:focus:ring-blue-800 mt-6">
                Update
            </button>
        </form>



    </section>
@endsection
@section('scripts')
    <script type="module">
        $("document").ready(function() {
            setTimeout(function() {
                console.log('test');
                $("#error-message").fadeOut('fast');
            }, 3000);
        });
    </script>
@endsection
