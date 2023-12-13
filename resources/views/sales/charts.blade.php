@extends('layouts.app')

@section('content')
    <div class=" container mx-auto w-[800px]">
        {!! $monthlyChart->container() !!}
        {!! $monthlyChart->script() !!}
    </div>
    <div class=" container mx-auto w-[800px]">
        {!! $weeklyChart->container() !!}
        {!! $weeklyChart->script() !!}
    </div>
    <div class=" container mx-auto w-[800px]">
        {!! $yearlyChart->container() !!}
        {!! $yearlyChart->script() !!}
    </div>
@endsection

@section('scripts')
    @apexchartsScripts
@endsection
