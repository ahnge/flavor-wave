<nav class="bg-neutral-100 border-gray-200 dark:bg-gray-800">
    <div
      class="max-w-screen-xl flex flex-wrap items-center justify-between mx-auto p-4"
    >
      <a
        href="./index.html"
        class="flex items-center space-x-3 rtl:space-x-reverse"
      >
        <!-- <img
          src="https://flowbite.com/docs/images/logo.svg"
          class="h-8"
          alt="Flowbite Logo"
        /> -->
        <span
          class="self-center text-2xl font-semibold whitespace-nowrap dark:text-white"
          >Flavor Wave</span
        >
      </a>

      <div class="hidden w-full md:block md:w-auto" id="navbar-default">

          <!-- <li>
            <a
              href="#"
              class="block py-2 px-3 text-white bg-blue-700 rounded md:bg-transparent md:text-blue-700 md:p-0 dark:text-white md:dark:text-blue-500"
              aria-current="page"
              >Home</a
            >
          </li> -->
          <div class="hidden sm:flex sm:items-center sm:ms-6">
            <x-dropdown align="right" width="48">
                <x-slot name="trigger">
                    <button class="inline-flex items-center px-3 py-2 border border-transparent text-sm leading-4 font-medium rounded-md text-gray-500 bg-white hover:text-gray-700 focus:outline-none transition ease-in-out duration-150">
                        <div>
                            @if (Illuminate\Support\Facades\Auth::guard('web')->check())
                            {{ Auth::guard('web')->user()->name }}
                            @elseif (Illuminate\Support\Facades\Auth::guard('admin')->check())
                            {{ Auth::guard('admin')->user()->name }}
                            @endif
                        </div>

                        <div class="ms-1">
                            <svg class="fill-current h-4 w-4" xmlns="http://www.w3.org/2000/svg" viewBox="0 0 20 20">
                                <path fill-rule="evenodd" d="M5.293 7.293a1 1 0 011.414 0L10 10.586l3.293-3.293a1 1 0 111.414 1.414l-4 4a1 1 0 01-1.414 0l-4-4a1 1 0 010-1.414z" clip-rule="evenodd" />
                            </svg>
                        </div>
                    </button>
                </x-slot>

                <x-slot name="content">
                    @if (Illuminate\Support\Facades\Auth::guard('web')->check())
            {{-- <x-responsive-nav-link :href="route('profile.edit')">
                {{ __('Profile') }}
            </x-responsive-nav-link> --}}

            <!-- Authentication -->
            <form method="POST" action="{{ route('logout') }}">
                @csrf

                <x-responsive-nav-link :href="route('logout')"
                        onclick="event.preventDefault();
                                    this.closest('form').submit();">
                    {{ __('Log Out') }}
                </x-responsive-nav-link>
            </form>
           @elseif(Illuminate\Support\Facades\Auth::guard('admin')->check())
           <form method="POST" action="{{ route('admin-logout') }}">
            @csrf

            <x-responsive-nav-link :href="route('admin-logout')"
                    onclick="event.preventDefault();
                                this.closest('form').submit();">
                {{ __('Log Out') }}
            </x-responsive-nav-link>
        </form>
           @endif
                </x-slot>
            </x-dropdown>
        </div>

      </div>
    </div>
  </nav>
