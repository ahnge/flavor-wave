@extends('layouts.app')

@section('content')
<div id="alert-container" class="fixed top-10 right-10 z-50">
    @if (session('error'))
                <div id="alert-error"
                    class="flex items-center p-4 mb-4 text-red-800 rounded-lg bg-red-50 dark:bg-gray-700 dark:text-red-400 alert"
                    role="alert">
                    <svg class="flex-shrink-0 w-4 h-4" aria-hidden="true" xmlns="http://www.w3.org/2000/svg"
                        fill="currentColor" viewBox="0 0 20 20">
                        <path
                            d="M10 .5a9.5 9.5 0 1 0 9.5 9.5A9.51 9.51 0 0 0 10 .5ZM9.5 4a1.5 1.5 0 1 1 0 3 1.5 1.5 0 0 1 0-3ZM12 15H8a1 1 0 0 1 0-2h1v-3H8a1 1 0 0 1 0-2h2a1 1 0 0 1 1 1v4h1a1 1 0 0 1 0 2Z" />
                    </svg>
                    <span class="sr-only">Info</span>
                    <div class="ms-3 text-sm font-medium">
                        {{ session('error') }}
                    </div>
                    <button type="button"
                        class="ms-auto -mx-1.5 -my-1.5 bg-red-50 text-red-500 rounded-lg focus:ring-2 focus:ring-blue-400 p-1.5 hover:bg-blue-200 inline-flex items-center justify-center h-8 w-8 dark:bg-gray-700 dark:text-red-400 dark:hover:bg-gray-700"
                        data-dismiss-target="#alert-error" aria-label="Close">
                        <span class="sr-only">Close</span>
                        <svg class="w-3 h-3" aria-hidden="true" xmlns="http://www.w3.org/2000/svg" fill="none"
                            viewBox="0 0 14 14">
                            <path stroke="currentColor" stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                d="m1 1 6 6m0 0 6 6M7 7l6-6M7 7l-6 6" />
                        </svg>
                    </button>
                </div>
            @endif
</div>
    <section
        class="pb-8 pt-3 px-10 lg:pb-16 lg:pt-5  border dark:border-gray-700 border-neutral-300 mx-auto max-w-screen-lg dark:bg-gray-800 bg-neutral-50  rounded-lg">
        <a href="{{ route('warehouse.productList') }}"
            class=" text-black bg-gray-300 hover:bg-gray-400 focus:ring-4 focus:outline-none focus:ring-gray-300 font-medium rounded-md text-sm px-5 py-2.5 text-center dark:text-white dark:bg-gray-600 dark:hover:bg-gray-700 dark:focus:ring-gray-800 mt-6">
             Back
        </a>
        <div class="py-8 lg:py-16 px-4 mx-auto max-w-screen-md">
            <h2 class="mb-4 text-4xl tracking-tight font-extrabold text-center dark:text-white text-gray-900">
                {{ $product->title }}
            </h2>
            <div id="qty-form" class="">
                <form class="" method="POST"
                    action="{{ route('warehouse.productDetailChange', ['product' => $product]) }}"
                    enctype="multipart/form-data">
                    @csrf
                    <div class="flex items-start justify-center space-x-20">
                        <div class="flex flex-col">
                            <div class="mb-4 ">
                                <label for="product_photo-placeholder"
                                    class="block mb-2 text-sm font-medium text-gray-900 dark:text-white">Product
                                    Photo</label>
                                <div id="product-photo-placeholder" class="ml-4 mt-6 max-w-full object-cover w-fit"></div>
                            </div>
                        </div>
                        <div class="flex flex-col mt-4">

                            <div class="mb-4">
                                <label for="product_photo-placeholder"
                                    class="block mb-2 text-sm font-medium text-gray-900 dark:text-white">Edit
                                    Photo</label>

                                <input type="file" id="product_photo" name="product_photo" accept="image/*"
                                    class="block max-w-[18rem] text-sm text-gray-900 border border-gray-300 rounded-lg cursor-pointer bg-gray-50 dark:text-gray-400 focus:outline-none dark:bg-gray-700 dark:border-gray-600 dark:placeholder-gray-400">
                            </div>
                            <div class="mb-5">
                                <label for="title"
                                    class="block mb-2 text-sm font-medium text-gray-900 dark:text-white">Title</label>
                                <input type="title" id="title" name="title"
                                    class="shadow-sm bg-gray-50 border border-gray-300 text-gray-900 text-sm rounded-lg focus:ring-blue-500 focus:border-blue-500 block w-full p-2.5 dark:bg-gray-700 dark:border-gray-600 dark:placeholder-gray-400 dark:text-white dark:focus:ring-blue-500 dark:focus:border-blue-500 dark:shadow-sm-light"
                                    value="{{ $product->title }}" required>
                            </div>
                            <div class="mb-5">
                                <label for="price"
                                    class="block mb-2 text-sm font-medium text-gray-900 dark:text-white">Price Per
                                    Box</label>
                                <input type="price" id="price" name="price"
                                    class="shadow-sm bg-gray-50 border border-gray-300 text-gray-900 text-sm rounded-lg focus:ring-blue-500 focus:border-blue-500 block w-full p-2.5 dark:bg-gray-700 dark:border-gray-600 dark:placeholder-gray-400 dark:text-white dark:focus:ring-blue-500 dark:focus:border-blue-500 dark:shadow-sm-light"
                                    value="{{ $product->price }}" required>
                            </div>
                            <div class="mb-5">
                                <label for="ppb"
                                    class="block mb-2 text-sm font-medium text-gray-900 dark:text-white">Pieces
                                    Per Box</label>
                                <input type="ppb" id="ppb" name="ppb"
                                    class="shadow-sm bg-gray-50 border border-gray-300 text-gray-900 text-sm rounded-lg focus:ring-blue-500 focus:border-blue-500 block w-full p-2.5 dark:bg-gray-700 dark:border-gray-600 dark:placeholder-gray-400 dark:text-white dark:focus:ring-blue-500 dark:focus:border-blue-500 dark:shadow-sm-light"
                                    value="{{ $product->pc_per_box }}" required>
                            </div>

                            <div class="flex items-center justify-end gap-3">
                                <a href="{{ route('warehouse.productList') }}"
                                    class=" text-white bg-blue-700 hover:bg-blue-800 focus:ring-4 focus:outline-none focus:ring-blue-300 font-medium rounded-md text-sm px-5 py-2.5 text-center dark:bg-blue-600 dark:hover:bg-blue-700 dark:focus:ring-blue-800">
                                    Cancel</a>
                                    <button type="submit"
                                    class="text-white  ml-auto bg-blue-700 hover:bg-blue-800 focus:ring-4 focus:outline-none focus:ring-blue-300 font-medium rounded-lg text-sm  sm:w-auto px-5 py-2.5 text-center dark:bg-blue-600 dark:hover:bg-blue-700 dark:focus:ring-blue-800">
                                    <svg id="svgLoading" role="status" class="hidden w-4 h-4 me-3 text-gray-200 animate-spin dark:text-gray-600" viewBox="0 0 100 101" fill="none" xmlns="http://www.w3.org/2000/svg">
                                        <path d="M100 50.5908C100 78.2051 77.6142 100.591 50 100.591C22.3858 100.591 0 78.2051 0 50.5908C0 22.9766 22.3858 0.59082 50 0.59082C77.6142 0.59082 100 22.9766 100 50.5908ZM9.08144 50.5908C9.08144 73.1895 27.4013 91.5094 50 91.5094C72.5987 91.5094 90.9186 73.1895 90.9186 50.5908C90.9186 27.9921 72.5987 9.67226 50 9.67226C27.4013 9.67226 9.08144 27.9921 9.08144 50.5908Z" fill="currentColor"/>
                                        <path d="M93.9676 39.0409C96.393 38.4038 97.8624 35.9116 97.0079 33.5539C95.2932 28.8227 92.871 24.3692 89.8167 20.348C85.8452 15.1192 80.8826 10.7238 75.2124 7.41289C69.5422 4.10194 63.2754 1.94025 56.7698 1.05124C51.7666 0.367541 46.6976 0.446843 41.7345 1.27873C39.2613 1.69328 37.813 4.19778 38.4501 6.62326C39.0873 9.04874 41.5694 10.4717 44.0505 10.1071C47.8511 9.54855 51.7191 9.52689 55.5402 10.0491C60.8642 10.7766 65.9928 12.5457 70.6331 15.2552C75.2735 17.9648 79.3347 21.5619 82.5849 25.841C84.9175 28.9121 86.7997 32.2913 88.1811 35.8758C89.083 38.2158 91.5421 39.6781 93.9676 39.0409Z" fill="#1C64F2"/>
                                        </svg>
                                    <span id="submit-text">Update</span>
                                    </button>
                            </div>
                        </div>
                    </div>
            </div>
            </form>
        </div>


    </section>
@endsection
@section('scripts')
    <script type="module">
        document.addEventListener("DOMContentLoaded", function() {
            const productPhoto = document.querySelector('#product_photo');
            const placeholder = document.querySelector('#product-photo-placeholder');
            placeholder.innerHTML += `
        <img src="{{ $product->product_photo }}" class="rounded-box max-h-[300px] object-contain" />
      `;

            productPhoto.addEventListener("change", () => {
                let imgSrc = URL.createObjectURL(productPhoto.files[0]);
                placeholder.innerHTML = `
        <img src="${imgSrc}" class="rounded-box max-h-[300px] object-contain" />
      `;
            })

        });

        $('form').on('submit', function (e) {
     $('button[type=submit], input[type=submit]', $(this)).blur().addClass('disabled is-submited');

    $('#svgLoading').removeClass('hidden');
    $('#submit-text').addClass('hidden');

});

$(document).on('click', 'button[type=submit].is-submited, input[type=submit].is-submited', function(e) {
    e.preventDefault();
});
    </script>
@endsection
