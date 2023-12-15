@extends('layouts.app')

@section('content')
    <section
        class="pb-8 pt-3 px-10 lg:pb-16 lg:pt-5  border dark:border-gray-700 border-neutral-300 mx-auto max-w-screen-sm dark:bg-gray-800 bg-neutral-50  rounded-lg">
        <a href="{{ route('warehouse.productList') }}">
            <button type="button"
                class="py-2.5   px-5 text-sm font-medium text-gray-900 focus:outline-none bg-white rounded-md border border-gray-200 hover:bg-gray-100 hover:text-blue-700 focus:z-10 focus:ring-4 focus:ring-gray-200 dark:focus:ring-gray-700 dark:bg-gray-800 dark:text-gray-200 dark:border-gray-600 dark:hover:text-white dark:hover:bg-gray-700">Back</button>
        </a>
        <div class=" mx-auto rounded-md mt-7">



            <h2 class="text-2xl font-semibold mb-6 dark:text-white">Add New Product</h2>

            <form id="myForm" action="{{ route('warehouse.storeProduct') }}" method="post" enctype="multipart/form-data">
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

                <div class="flex justify-start items-center gap-8">
                    <div class="mb-4">
                        <label for="product_photo"
                            class="block mb-2 text-sm font-medium text-gray-900 dark:text-white">Product
                            Photo</label>
                        <input type="file" id="product_photo" name="product_photo" accept="image/*"
                            class="focus-visible:outline-none focus-visible:border-0 focus:border-0 block w-full border-e-0   text-sm text-gray-900 border border-gray-300 rounded-lg bg-gray-50  dark:bg-gray-700 dark:border-gray-600 dark:placeholder-gray-400 dark:text-white "
                            required>
                    </div>

                    <!-- Hidden product photo container -->
                    <div id="product-photo-placeholder" class="hidden"></div>

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
                        class="focus-visible:outline-none focus-visible:border-0 focus:border-0 block w-full border-e-0 rounded-e-none  text-sm text-gray-900 border border-gray-300 rounded-lg bg-gray-50  dark:bg-gray-700 dark:border-gray-600 dark:placeholder-gray-400 dark:text-white "
                        required>
                </div>



                <button type="submit"
                    class="text-white  ml-auto bg-blue-700 hover:bg-blue-800 focus:ring-4 focus:outline-none focus:ring-blue-300 font-medium rounded-lg text-sm  sm:w-auto px-5 py-2.5 text-center dark:bg-blue-600 dark:hover:bg-blue-700 dark:focus:ring-blue-800">
                    <svg id="svgLoading" role="status" class="hidden w-4 h-4 me-3 text-gray-200 animate-spin dark:text-gray-600" viewBox="0 0 100 101" fill="none" xmlns="http://www.w3.org/2000/svg">
                        <path d="M100 50.5908C100 78.2051 77.6142 100.591 50 100.591C22.3858 100.591 0 78.2051 0 50.5908C0 22.9766 22.3858 0.59082 50 0.59082C77.6142 0.59082 100 22.9766 100 50.5908ZM9.08144 50.5908C9.08144 73.1895 27.4013 91.5094 50 91.5094C72.5987 91.5094 90.9186 73.1895 90.9186 50.5908C90.9186 27.9921 72.5987 9.67226 50 9.67226C27.4013 9.67226 9.08144 27.9921 9.08144 50.5908Z" fill="currentColor"/>
                        <path d="M93.9676 39.0409C96.393 38.4038 97.8624 35.9116 97.0079 33.5539C95.2932 28.8227 92.871 24.3692 89.8167 20.348C85.8452 15.1192 80.8826 10.7238 75.2124 7.41289C69.5422 4.10194 63.2754 1.94025 56.7698 1.05124C51.7666 0.367541 46.6976 0.446843 41.7345 1.27873C39.2613 1.69328 37.813 4.19778 38.4501 6.62326C39.0873 9.04874 41.5694 10.4717 44.0505 10.1071C47.8511 9.54855 51.7191 9.52689 55.5402 10.0491C60.8642 10.7766 65.9928 12.5457 70.6331 15.2552C75.2735 17.9648 79.3347 21.5619 82.5849 25.841C84.9175 28.9121 86.7997 32.2913 88.1811 35.8758C89.083 38.2158 91.5421 39.6781 93.9676 39.0409Z" fill="#1C64F2"/>
                        </svg>
                    <span id="submit-text">Submit</span>
                    </button>
            </form>
        </div>
    </section>
@endsection

@section('scripts')
    <script type="module">
        document.addEventListener("DOMContentLoaded", function() {
            const productPhoto = document.querySelector('#product_photo');
            const placeholder = document.querySelector('#product-photo-placeholder');

            productPhoto.addEventListener("change", () => {
                let imgSrc = URL.createObjectURL(productPhoto.files[0]);
                placeholder.innerHTML += `
        <img src="${imgSrc}" class="rounded-box w-auto max-h-[5rem] object-contain" />
      `;
                placeholder.classList.remove('hidden');
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
