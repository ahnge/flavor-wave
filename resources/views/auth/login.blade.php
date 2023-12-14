<x-guest-layout>
    <!-- Session Status -->


    <section class="bg-gray-50 dark:bg-gray-900 min-w-full">
        <div class="flex flex-col items-center justify-center px-6 py-8 mx-auto md:h-screen lg:py-0">
            <a href="{{ route('distributor.index') }}" class="flex items-center mb-6 text-2xl font-semibold text-gray-900 dark:text-white">
                <img class="w-20 h-20 mr-2" src="{{asset('assets/images/sig.png')}}"
                    alt="logo">
                <span>Flavor Wave</span>
            </a>

            <div
                class="w-full bg-white @if ($errors->any())
                    border dark:border-red-500 border-red-500
                     @else
                     dark:border-gray-700
                @endif  rounded-lg shadow dark:border md:mt-0 sm:max-w-md xl:p-0 dark:bg-gray-800 ">
                <div class="p-6 space-y-4 md:space-y-6 sm:p-8">
                    <h1
                        class="text-xl font-bold leading-tight tracking-tight text-gray-900 md:text-2xl dark:text-white">
                        Sign in to your account
                    </h1>

                    @if (Illuminate\Support\Facades\Route::currentRouteName() == 'login')
                        <form method="POST"  class="space-y-4 md:space-y-6" action="{{ route('login') }}">
                        @else
                            <form method="POST"  class="space-y-4 md:space-y-6" action="{{ route('admin') }}">
                    @endif
                        <div>
                            <label for="email"
                                class="block mb-2 text-sm font-medium text-gray-900 dark:text-white">Your email</label>
                            <input type="email" name="email" id="email" value="{{ old('email') }}"
                                class="bg-gray-50 border border-gray-300 text-gray-900 sm:text-sm rounded-lg focus:ring-primary-600 focus:border-primary-600 block w-full p-2.5 dark:bg-gray-700 dark:border-gray-600 dark:placeholder-gray-400 dark:text-white dark:focus:ring-blue-500 dark:focus:border-blue-500"
                                placeholder="name@company.com" required="">

                        </div>
                        <div>
                            <label for="password"
                                class="block mb-2 text-sm font-medium text-gray-900 dark:text-white">Password</label>
                            <input type="password" name="password" id="password" placeholder="••••••••"
                                class="bg-gray-50 border border-gray-300 text-gray-900 sm:text-sm rounded-lg focus:ring-primary-600 focus:border-primary-600 block w-full p-2.5 dark:bg-gray-700 dark:border-gray-600 dark:placeholder-gray-400 dark:text-white dark:focus:ring-blue-500 dark:focus:border-blue-500"
                                required="">
                        </div>

                        <button type="submit" class="w-full text-white bg-gradient-to-br from-green-400 to-blue-600 hover:bg-gradient-to-bl focus:ring-4 focus:outline-none focus:ring-green-200 dark:focus:ring-green-800 font-medium rounded-lg text-md text-center me-2 mb-2
                        py-3
                        ">Sign in</button>
                        @if ($errors->any())
                        <div class="flex items-center p-4 mb-4 text-sm text-red-800 rounded-lg bg-red-50 dark:bg-gray-800 dark:text-red-400" role="alert">
                            <svg class="flex-shrink-0 inline w-4 h-4 me-3" aria-hidden="true" xmlns="http://www.w3.org/2000/svg" fill="currentColor" viewBox="0 0 20 20">
                              <path d="M10 .5a9.5 9.5 0 1 0 9.5 9.5A9.51 9.51 0 0 0 10 .5ZM9.5 4a1.5 1.5 0 1 1 0 3 1.5 1.5 0 0 1 0-3ZM12 15H8a1 1 0 0 1 0-2h1v-3H8a1 1 0 0 1 0-2h2a1 1 0 0 1 1 1v4h1a1 1 0 0 1 0 2Z"/>
                            </svg>
                            <span class="sr-only">Info</span>
                            <div>
                              <span class="font-medium">These credentials do not match our records.</span>
                            </div>
                          </div>
                        @endif
                        @if (Illuminate\Support\Facades\Route::currentRouteName() == 'login')
                        <p class="text-sm font-light text-gray-500 dark:text-gray-400">
                            Don’t have an account yet?
                            <a href="{{ route('register') }}"
                                class="font-medium text-primary-600 hover:underline dark:text-primary-500">Sign up</a>
                        </p>
                        @endif
                    </form>
                </div>
            </div>
        </div>
    </section>
</x-guest-layout>
