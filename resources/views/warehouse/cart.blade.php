@extends('layouts.app')

@section('content')
    <div class=" container bg-white dark:bg-gray-900 rounded-md px-10 py-5 mx-auto max-w-screen-md">
        <a href="{{ route('warehouse.productList') }}">
            <button type="button"
                class="py-2.5 px-5  text-sm font-medium text-gray-900 focus:outline-none bg-white rounded-md border border-gray-200 hover:bg-gray-100 hover:text-blue-700 focus:z-10 focus:ring-4 focus:ring-gray-200 dark:focus:ring-gray-700 dark:bg-gray-800 dark:text-gray-200 dark:border-gray-600 dark:hover:text-white dark:hover:bg-gray-700">Back</button>
        </a>
        <h1 class="text-2xl font-semibold my-7 dark:text-white">Weekly data chart</h1>
        {!! $chart->container() !!}
        {!! $chart->script() !!}

    </div>
@endsection

@section('scripts')
    @apexchartsScripts
@endsection
