@extends('layouts.app')

@section('content')
  <h2>Create a New Product</h2>


  @if (session('success'))
    <div class="alert alert-success">{{ session('success') }}</div>
  @endif
@endsection
