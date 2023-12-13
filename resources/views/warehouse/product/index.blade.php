@extends('layouts.app')

@section('content')
<section class="bg-white">
    <div class="py-8 lg:py-16 px-4 mx-auto max-w-screen-md">
      <h2
        class="mb-4 text-4xl tracking-tight font-extrabold text-center text-gray-900"
      >
        {{ $product->title }} ({{ $product->total_box_count}})
      </h2>
      <form class="max-w-sm mx-auto" method="POST" action="{{ route('warehouse.productEdit', ['id' => $product->id]) }}">
        @csrf
        @method('PUT')
        <div class="mb-5">
            <label for="region" class="block mb-2 text-sm font-medium text-gray-900 dark:text-white">Select an
                option</label>
            <select id="region" name="type"
                class="bg-gray-50 border border-gray-300 text-gray-900 text-sm rounded-lg focus:ring-blue-500 focus:border-blue-500 block w-full p-2.5 dark:bg-gray-700 dark:border-gray-600 dark:placeholder-gray-400 dark:text-white dark:focus:ring-blue-500 dark:focus:border-blue-500">
                <option selected>Select Operation</option>
                <option value="expire">Expire</option>
                <option value="return">Return</option>
                <option value="produced">Produced</option>
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

    </div>
  </section>
@endsection
