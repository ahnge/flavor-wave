@extends('layouts.distributor.app')

@section('main')
    <div class="min-h-[100vh] min-w-[100vw] bg-white dark:bg-gray-800 pt-12 dark:text-white ">
        <div class="min-w-full h-full bg-white dark:bg-gray-900 dark:text-white px-4 sm:px-6 lg:px-[5vw] pt-20 pb-40">
            <h3 class="text-2xl font-bold pb-4 border-b">Cart</h3>
            <div class="flex gap-3 pt-4">
                <div class="w-1/2">
                    <div class="flex flex-col gap-y-4">
                        @forelse ($products as $product)
                            <div id="productItem-{{ $product->id }}" data-id="{{ $product->id }}"
                                data-price="{{ $product->price }}"
                                class="productItem flex border-gray-200 dark:border-gray-700 shadow h-40 min-w-[250px] pt-4 rounded-md border items-center justify-between px-4 py-3 cursor-pointer hover:bg-slate-100 dark:hover:bg-slate-700 gap-10  relative">
                                <div class="flex gap-5 items-center">
                                    <img src="{{ $product->product_photo }}" alt="Coffee Image"
                                        class="w-24 h-24 rounded-md object-cover" width="200" height="200"
                                        style="aspect-ratio: 200 / 200; object-fit: cover" />
                                    <div class="flex flex-col gap-2 mt-3">
                                        <h3 class="tracking-tight text-lg font-semibold">{{ $product->title }}</h3>
                                        <p class="m-0 text-sm font-semibold text-gray-700  dark:text-gray-400">
                                            Available Boxes : <span>{{ $product->available_box_count }}</span>
                                        </p>
                                        <p class="m-0 text-sm font-semibold text-gray-700  dark:text-gray-400">
                                            Price : <span>${{ $product->price }}</span>
                                        </p>
                                    </div>
                                </div>
                                <div class="flex gap-x-2">
                                    <button onclick="increaseQuantity({{ $product->id }})">
                                        +
                                    </button>
                                    <input type="number" id="quantity-{{ $product->id }}" value="1"
                                        class="product-quantity bg-gray-50 border border-gray-300 text-gray-900 text-sm rounded-lg focus:ring-blue-500 focus:border-blue-500 block w-20 p-2.5 dark:bg-gray-700 dark:border-gray-600 dark:placeholder-gray-400 dark:text-white dark:focus:ring-blue-500 dark:focus:border-blue-500"
                                        placeholder="John">
                                    <button onclick="decreaseQuantity({{ $product->id }})">
                                        -
                                    </button>
                                </div>

                                <div class="absolute top-3 right-3">
                                    <button onclick="removeCart({{ $product->id }},true)" id="rmc-{{ $product->id }}"
                                        class="rmc min-w-[40px]   text-white bg-gradient-to-r from-red-400 via-red-500 to-red-600 hover:bg-gradient-to-br focus:ring-4 focus:outline-none focus:ring-red-300 dark:focus:ring-red-800 font-medium rounded-lg text-xs px-3 py-1 text-center me-2 mb-2">Remove</button>
                                </div>
                            </div>
                        @empty
                          <p  class="text-center">No items in cart</p>
                        @endforelse
                    </div>
                </div>
                <div class="w-1/2 bg-slate-100 dark:bg-slate-800 rounded-lg h-[350px] ">
                    <div class="flex flex-col px-8 py-6  gap-6">
                        <h3>Order summary</h3>

                        <div class="flex flex-col divide-y-2 divide-slate-700 gap-4">
                            <div class="flex items-center justify-between">
                                <p>Subtotal</p>
                                <div class="flex items-center gap-2">
                                    <p id="subTotal">0</p> <span> Ks </span>
                                </div>
                            </div>

                            <div class="flex items-center justify-between pt-4">
                                <p>Tax</p>
                                <p>0 Ks</p>
                            </div>

                            <div class="flex flex-col gap-5">
                                <div class="flex items-center pt-4">
                                    <input id="urgent-checkbox" type="checkbox" value="" class="w-4 h-4 text-blue-600 bg-gray-100 border-gray-300 rounded focus:ring-blue-500 dark:focus:ring-blue-600 dark:ring-offset-gray-800 focus:ring-2 dark:bg-gray-700 dark:border-gray-600">
                                    <label for="default-checkbox" class="ms-2 text-sm font-medium text-gray-900 dark:text-gray-300">Urget Delivery</label>
                                </div>

                                <div class="flex items-center justify-between">

                                    <p class="text-lg font-bold">Order Total</p>
                                    <div class="flex items-center gap-2">
                                        <p id="orderTotal" class="text-lg font-bold">0</p> <span> Ks </span>

                                    </div>
                                </div>
                            </div>


                        </div>

                        {{-- <button type="button" class="text-white bg-blue-700 hover:bg-blue-800 focus:ring-4 focus:ring-blue-300 font-medium rounded-lg text-sm px-5 py-2.5 me-2 mb-2 dark:bg-blue-600 dark:hover:bg-blue-700 focus:outline-none dark:focus:ring-blue-800">Order Now</button> --}}
                        @include('layouts.distributor.order-confirm')
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection

@push('js')
    <script>
        let subTotalElement = document.getElementById('subTotal');
        let orderTotalElement = document.getElementById('orderTotal');
        // make int of subTotalElement and orderTotalElement
        let subTotal = parseInt(subTotalElement.innerHTML);
        let orderTotal = parseInt(orderTotalElement.innerHTML);

        let productItems = document.querySelectorAll('.productItem');
        productItems.forEach(productItem => {
            subTotal += parseInt(productItem.getAttribute('data-price'));
            orderTotal += parseInt(productItem.getAttribute('data-price'));
        });

        subTotalElement.innerHTML = subTotal;
        orderTotalElement.innerHTML = orderTotal;

        function increaseQuantity(productId) {
            const quantityInput = document.getElementById('quantity-' + productId);
            let productPrice = document.getElementById('productItem-' + productId).getAttribute('data-price');
            quantityInput.value = parseInt(quantityInput.value) + 1;

            subTotal = parseInt(subTotalElement.innerHTML);
            orderTotal = parseInt(orderTotalElement.innerHTML);

            subTotal += parseInt(productPrice);
            orderTotal += parseInt(productPrice);

            subTotalElement.innerHTML = subTotal;
            orderTotalElement.innerHTML = orderTotal;
        }

        function decreaseQuantity(productId) {
            const quantityInput = document.getElementById('quantity-' + productId);
            const currentValue = parseInt(quantityInput.value);
            let productPrice = document.getElementById('productItem-' + productId).getAttribute('data-price');

            if (currentValue > 1) {
                quantityInput.value = currentValue - 1;

                subTotal -= parseInt(productPrice);
                orderTotal -= parseInt(productPrice);

                subTotalElement.innerHTML = subTotal + ' Ks';
                orderTotalElement.innerHTML = orderTotal + ' Ks';
            }
        }
    </script>
    <script type="module">
        $(document).ready(function() {

            $('#orderConfirmed').on('click', function() {
                const cartData = [];

                $(".productItem").each(function() {
                    const productId = $(this).attr('data-id');
                    const productQuantity = $(this).find('.product-quantity').val();
                    let cartItem = {
                        productId: productId,
                        productQuantity: productQuantity
                    }

                    cartData.push(cartItem);
                })

                const isUrget =  $('#urgent-checkbox').is(":checked");

                console.log(isUrget)

                $.ajax({
                    type: "POST",
                    url: "{{ route('distributor.cart.order') }}",
                    data: {
                       cartData  : cartData,
                        isUrget : isUrget

                    },
                    success: function(response) {
                        callAlert("success","Order has been placed successfully")
                        // remove cart  from  localstorage
                        localStorage.removeItem('cart');
                        // navigate to the order page
                        setTimeout(() => {
                            window.location.href = "{{ route('distributor.index') }}";
                        }, 1500);
                    },
                    error: function(error) {
                        callAlert("error","something went wrong.Try again later")
                    }
                })
            })
        })
    </script>
@endpush
