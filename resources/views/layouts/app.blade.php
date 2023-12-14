<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">

<head>
  <meta charset="utf-8">
  <meta name="viewport" content="width=device-width, initial-scale=1">
  <meta name="csrf-token" content="{{ csrf_token() }}">

  @if (Illuminate\Support\Facades\Auth::guard('admin')->check())
    <title>{{ config('app.name') .' | ' .Illuminate\Support\Facades\Auth::guard('admin')->user()->getAppTitle() }}
    </title>
  @else
    <title>{{ config('app.name') . ' | ' . 'Distributor' }}</title>
  @endif
  <!-- Fonts -->
  <link rel="preconnect" href="https://fonts.bunny.net">
  <link href="https://fonts.bunny.net/css?family=figtree:400,500,600&display=swap" rel="stylesheet" />

  <!-- Scripts -->
  @vite(['resources/css/app.css', 'resources/js/app.js'])
  @yield('scripts')
</head>

<body class="font-sans antialiased box-border">
  <div class="min-h-screen  bg-neutral-200 dark:bg-gray-900">
    @include('layouts.navigation')

    <div id="alert-container" class="fixed top-10 right-10">

      {{-- @if (session('success')) --}}
      <div
        class="flex items-center p-4 mb-4 text-sm text-green-800 rounded-lg bg-green-50 dark:bg-gray-700 dark:text-green-400"
        role="alert">
        <svg class="flex-shrink-0 inline w-4 h-4 me-3" aria-hidden="true" xmlns="http://www.w3.org/2000/svg"
          fill="currentColor" viewBox="0 0 20 20">
          <path
            d="M10 .5a9.5 9.5 0 1 0 9.5 9.5A9.51 9.51 0 0 0 10 .5ZM9.5 4a1.5 1.5 0 1 1 0 3 1.5 1.5 0 0 1 0-3ZM12 15H8a1 1 0 0 1 0-2h1v-3H8a1 1 0 0 1 0-2h2a1 1 0 0 1 1 1v4h1a1 1 0 0 1 0 2Z" />
        </svg>
        <span class="sr-only">Info</span>
        <div>
          <span class="font-medium">Success !</span> {{ session('success') }}
        </div>
      </div>
      {{-- @endif --}}
      {{-- @if ($errors->any()) --}}
      <ul>
        {{-- @foreach ($errors->all() as $error) --}}
        <li>
          <div
            class="flex items-center p-4 mb-4 text-sm text-red-800 rounded-lg bg-red-50 dark:bg-gray-700 dark:text-red-400"
            role="alert">
            <svg class="flex-shrink-0 inline w-4 h-4 me-3" aria-hidden="true" xmlns="http://www.w3.org/2000/svg"
              fill="currentColor" viewBox="0 0 20 20">
              <path
                d="M10 .5a9.5 9.5 0 1 0 9.5 9.5A9.51 9.51 0 0 0 10 .5ZM9.5 4a1.5 1.5 0 1 1 0 3 1.5 1.5 0 0 1 0-3ZM12 15H8a1 1 0 0 1 0-2h1v-3H8a1 1 0 0 1 0-2h2a1 1 0 0 1 1 1v4h1a1 1 0 0 1 0 2Z" />
            </svg>
            <span class="sr-only">Info</span>
            <div>
              {{-- <span class="font-medium">Alert!</span> {{ $error }} --}}
              <span class="font-medium">Alert!</span> Somethis went wrong!
            </div>
          </div>
        </li>
        {{-- @endforeach --}}
      </ul>
      {{-- @endif --}}

    </div>
    <!-- Page Content -->
    <main class="p-10">
      @yield('content')
    </main>
  </div>

  @stack('js')
</body>

</html>
