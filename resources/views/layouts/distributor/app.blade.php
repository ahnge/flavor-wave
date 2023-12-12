<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
    <head>
        <meta charset="utf-8">
        <meta name="viewport" content="width=device-width, initial-scale=1">
        <meta name="csrf-token" content="{{ csrf_token() }}">

        <title>{{ config('app.name', 'Laravel') }}</title>

        <!-- Fonts -->
        <link rel="preconnect" href="https://fonts.bunny.net">
        <link href="https://fonts.bunny.net/css?family=figtree:400,500,600&display=swap" rel="stylesheet" />
        <script src="https://kit.fontawesome.com/f39d469662.js" crossorigin="anonymous"></script>
        <!-- Scripts -->
        @vite(['resources/css/app.css', 'resources/js/app.js'])

    </head>
    <body class="font-sans antialiased">
        <div  class="dark min-h-screen bg-gray-100 relative">
            <div  class="fixed  right-0 w-[40vw]  min-h-fit z-[995]">
                <div id="parent-container" class="relative  w-full   h-full">
                    @include('layouts.alert')

                </div>

            </div>
            @include('layouts.distributor.navigation')

            <!-- Page Content -->
            <main>
                @yield('main')
            </main>

            <div class="w-full ">
                @include('web.distributor.home.footer')

            </div>

        </div>


        <script src="{{ asset('distributor/index.js') }}"></script>
        <script>
            function navigateToCart()
{
    let cartIcon = document.getElementById('cartIcon');

    // get the cart list from local storage
    var cart = localStorage.getItem('cart');
    var cartList = [];
    if (cart) {
        cartList = JSON.parse(cart);
    }
    // navigate to the cart page with the cart list
    window.location.href = "{{route('distributor.cart.index')}}" +`?cartList=${cartList.join(',')}`;
}
        </script>
        @stack('js')
    </body>
</html>
