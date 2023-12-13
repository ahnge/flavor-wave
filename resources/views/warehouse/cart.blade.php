@extends('layouts.app')

@section('content')
    <div class=" container mx-auto w-96">
        {!! $chart->container() !!}
        {!! $chart->script() !!}
    </div>
@endsection

@section('scripts')
    @apexchartsScripts
@endsection
