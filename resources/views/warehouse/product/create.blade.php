@extends('layouts.app')

@section('content')
  <h2>Create a New Product</h2>

  <div class="container mx-auto">
    <div class="max-w-md mx-auto bg-white p-8 border rounded-md mt-10">
      <h2 class="text-2xl font-semibold mb-6">Add New Product</h2>

      @if (session('success'))
        <div class="bg-green-200 text-green-800 p-3 mb-4 rounded-md">
          {{ session('success') }}
        </div>
      @endif

      <form action="{{ route('products.store') }}" method="post" enctype="multipart/form-data">
        @csrf

        <div class="mb-4">
          <label for="title" class="block text-gray-700 text-sm font-medium">Product Title</label>
          <input type="text" id="title" name="title" class="form-input mt-1 block w-full" required>
        </div>

        <div class="mb-4">
          <label for="price" class="block text-gray-700 text-sm font-medium">Price</label>
          <input type="number" id="price" name="price" class="form-input mt-1 block w-full" required>
        </div>

        <div class="mb-4">
          <label for="product_photo_url" class="block text-gray-700 text-sm font-medium">Product Photo URL</label>
          <input type="url" id="product_photo_url" name="product_photo_url" class="form-input mt-1 block w-full"
            required>
        </div>

        <div class="mb-4">
          <label for="pc_per_box" class="block text-gray-700 text-sm font-medium">PC per Box</label>
          <input type="number" id="pc_per_box" name="pc_per_box" class="form-input mt-1 block w-full" required>
        </div>

        <div class="mb-4">
          <label for="total_box_count" class="block text-gray-700 text-sm font-medium">Total Box Count</label>
          <input type="number" id="total_box_count" name="total_box_count" class="form-input mt-1 block w-full" required>
        </div>

        <div class="mb-4">
          <label for="available_box_count" class="block text-gray-700 text-sm font-medium">Available Box Count</label>
          <input type="number" id="available_box_count" name="available_box_count" class="form-input mt-1 block w-full"
            required>
        </div>

        <div class="mb-4">
          <label for="reserving_box_count" class="block text-gray-700 text-sm font-medium">Reserving Box Count</label>
          <input type="number" id="reserving_box_count" name="reserving_box_count" class="form-input mt-1 block w-full"
            required>
        </div>

        <div class="mb-4">
          <label for="product_photo" class="block text-gray-700 text-sm font-medium">Product Photo</label>
          <input type="file" id="product_photo" name="product_photo" class="form-input mt-1 block w-full" required>
        </div>

        <button type="submit">Create</button>
      </form>
    </div>
  </div>
@endsection
