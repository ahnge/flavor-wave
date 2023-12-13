@extends('layouts.app')

@section('content')
    <div class=" container mx-auto w-[900px]">
        {!! $productChart->container() !!}
        {!! $productChart->script() !!}
    </div>
    <div class=" container mx-auto w-[900px]">
        {!! $weeklyBestProductChart->container() !!}
        {!! $weeklyBestProductChart->script() !!}
    </div>
@endsection

@section('scripts')
    @apexchartsScripts
@endsection
