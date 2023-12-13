@extends('layouts.app')

@section('content')
    <div class=" container mx-auto w-[900px]">
        {!! $productChart->container() !!}
        {!! $productChart->script() !!}
    </div>
@endsection

@section('scripts')
    @apexchartsScripts
@endsection
