@extends('layouts.app')

@section('content')
    <section
        class="pb-8 pt-3 px-10 lg:pb-16 lg:pt-5  border dark:border-gray-700 border-neutral-400 mx-auto max-w-screen-sm dark:bg-gray-800 bg-neutral-50  rounded-lg">
        <a href="{{ route('warehouse.productList') }}">
            <button type="button"
                class="py-2.5   px-5 text-sm font-medium text-gray-900 focus:outline-none bg-white rounded-md border border-gray-200 hover:bg-gray-100 hover:text-blue-700 focus:z-10 focus:ring-4 focus:ring-gray-200 dark:focus:ring-gray-700 dark:bg-gray-800 dark:text-gray-200 dark:border-gray-600 dark:hover:text-white dark:hover:bg-gray-700">Back</button>
        </a>
        <div class=" mx-auto   rounded-md mt-7">



            <h2 class="text-2xl font-semibold mb-6 dark:text-white">Add New Product</h2>

            <form action="{{ route('warehouse.storeProduct') }}" method="post">
                @csrf

                <div class="mb-4">
                    <label for="title" class="block mb-2 text-sm font-medium text-gray-900 dark:text-white">Product
                        Title</label>
                    <input type="text" id="title" name="title"
                        class="bg-gray-50 border border-gray-300 text-gray-900 text-sm rounded-lg focus:ring-blue-500 focus:border-blue-500 block w-full p-2.5 dark:bg-gray-700 dark:border-gray-600 dark:placeholder-gray-400 dark:text-white dark:focus:ring-blue-500 dark:focus:border-blue-500"
                        required>
                </div>

                <div class="mb-4">
                    <label for="price" class="block mb-2 text-sm font-medium text-gray-900 dark:text-white">Price</label>
                    <input type="number" id="price" name="price"
                        class="bg-gray-50 border border-gray-300 text-gray-900 text-sm rounded-lg focus:ring-blue-500 focus:border-blue-500 block w-full p-2.5 dark:bg-gray-700 dark:border-gray-600 dark:placeholder-gray-400 dark:text-white dark:focus:ring-blue-500 dark:focus:border-blue-500"
                        required>
                </div>

                <div class="mb-4">
                    <label for="product_photo_url"
                        class="block mb-2 text-sm font-medium text-gray-900 dark:text-white">Product
                        Photo URL</label>
                    <input type="url" id="product_photo_url" name="product_photo"
                        class="bg-gray-50 border border-gray-300 text-gray-900 text-sm rounded-lg focus:ring-blue-500 focus:border-blue-500 block w-full p-2.5 dark:bg-gray-700 dark:border-gray-600 dark:placeholder-gray-400 dark:text-white dark:focus:ring-blue-500 dark:focus:border-blue-500"
                        required>
                </div>

                <div class="mb-4">
                    <label for="pc_per_box" class="block mb-2 text-sm font-medium text-gray-900 dark:text-white">PC per
                        Box</label>
                    <input type="number" id="pc_per_box" name="pc_per_box"
                        class="bg-gray-50 border border-gray-300 text-gray-900 text-sm rounded-lg focus:ring-blue-500 focus:border-blue-500 block w-full p-2.5 dark:bg-gray-700 dark:border-gray-600 dark:placeholder-gray-400 dark:text-white dark:focus:ring-blue-500 dark:focus:border-blue-500"
                        required>
                </div>

                <div class="mb-4">
                    <label for="total_box_count" class="block mb-2 text-sm font-medium text-gray-900 dark:text-white">Total
                        Box
                        Count</label>
                    <input type="number" id="total_box_count" name="total_box_count"
                        class="bg-gray-50 border border-gray-300 text-gray-900 text-sm rounded-lg focus:ring-blue-500 focus:border-blue-500 block w-full p-2.5 dark:bg-gray-700 dark:border-gray-600 dark:placeholder-gray-400 dark:text-white dark:focus:ring-blue-500 dark:focus:border-blue-500"
                        required>
                </div>

                <div class="mb-4">
                    <label for="available_box_count"
                        class="block mb-2 text-sm font-medium text-gray-900 dark:text-white">Available
                        Box Count</label>
                    <input type="number" id="available_box_count" name="available_box_count"
                        class="bg-gray-50 border border-gray-300 text-gray-900 text-sm rounded-lg focus:ring-blue-500 focus:border-blue-500 block w-full p-2.5 dark:bg-gray-700 dark:border-gray-600 dark:placeholder-gray-400 dark:text-white dark:focus:ring-blue-500 dark:focus:border-blue-500"
                        required>
                </div>

                <div class="mb-4">
                    <label for="reserving_box_count"
                        class="block mb-2 text-sm font-medium text-gray-900 dark:text-white">Reserving
                        Box Count</label>
                    <input type="number" id="reserving_box_count" name="reserving_box_count"
                        class="bg-gray-50 border border-gray-300 text-gray-900 text-sm rounded-lg focus:ring-blue-500 focus:border-blue-500 block w-full p-2.5 dark:bg-gray-700 dark:border-gray-600 dark:placeholder-gray-400 dark:text-white dark:focus:ring-blue-500 dark:focus:border-blue-500"
                        required>
                </div>

                <button type="submit"
                    class="text-white  ml-auto bg-blue-700 hover:bg-blue-800 focus:ring-4 focus:outline-none focus:ring-blue-300 font-medium rounded-lg text-sm  sm:w-auto px-5 py-2.5 text-center dark:bg-blue-600 dark:hover:bg-blue-700 dark:focus:ring-blue-800">Submit</button>
            </form>
        </div>
    </section>
@endsection
