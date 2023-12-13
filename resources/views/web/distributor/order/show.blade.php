@extends('layouts.distributor.app')

@section('main')
    <div class="min-h-[90vh] min-w-[100vw] bg-white dark:bg-gray-800 pt-12 dark:text-white ">
        <div class="min-w-full h-full bg-white dark:bg-gray-900 dark:text-white px-4 sm:px-6 lg:px-[5vw] pt-20 pb-40">
            <div class="pb-4 border-b flex  items-center  justify-between">
                <h3 class="text-2xl font-bold ">Order Detail</h3>
                {{-- <a href="{{ route('distributor.order.index') }}" class="pt-5 text-xs underline">Orders</a> --}}
            </div>
            <div class="flex gap-3 pt-4">
                <div class="w-1/2">
                    <div class="flex flex-col gap-y-4 max-h-[60vh] overflow-y-scroll">
                        @forelse ($order->orderProducts as $op)
                            <div id="productItem-{{ $op->product->id }}"
                                class="productItem flex border-gray-200 dark:border-gray-700 shadow h-40 min-w-[250px] pt-4 rounded-md border items-center justify-between px-4 py-3 cursor-pointer hover:bg-slate-100 dark:hover:bg-slate-700 gap-10  relative">
                                <div class="flex gap-5 items-center">
                                    <img src="{{ $op->product->product_photo }}" alt="Coffee Image"
                                        class="w-24 h-24 rounded-md object-cover" width="200" height="200"
                                        style="aspect-ratio: 200 / 200; object-fit: cover" />
                                    <div class="flex flex-col gap-2 mt-3">
                                        <h3 class="tracking-tight text-lg font-semibold">{{ $op->product->title }}</h3>
                                        {{-- <p class="m-0 text-sm font-semibold text-gray-700  dark:text-gray-400">
                                            Available Boxes : <span>{{ $product->available_box_count }}</span>
                                        </p> --}}
                                        <p class="m-0 text-sm font-semibold text-gray-700  dark:text-gray-400">
                                            Price : <span>${{ $op->product->price }}</span>
                                        </p>
                                    </div>
                                </div>

                                    <div class="flex gap-x-2">
                                        <p class="m-0 text-sm font-semibold text-gray-700  dark:text-gray-400">
                                            Qty : <span>{{ $op->quantity }}</span>
                                        </p>
                                    </div>



                            </div>
                        @empty
                            <p class="text-center">No items in cart</p>
                        @endforelse
                    </div>
                </div>
                <div class="w-1/2 bg-[#f9f9f9] dark:bg-slate-800 rounded-lg h-[330px] ">
                    <div class="flex flex-col px-8 py-6  gap-6">
                        <h3 class="text-2xl  font-bold">Order summary</h3>

                        <div class="flex flex-col divide-slate-700 gap-4 ps-1 dark:text-[#dddddd]">
                            <div class="flex items-center justify-between">
                                <p>Order Number</p>
                                <div class="flex items-center gap-2">
                                    <p class="highlight-text">{{ $order->order_no }}</p>
                                </div>
                            </div>

                            <div class="flex items-center justify-between">
                                <p>Total Cost</p>
                                <div class="flex items-center gap-2">
                                    <p class="highlight-text">{{ $order->total }}</p>
                                </div>
                            </div>

                            <div class="flex items-center justify-between">
                                <p>Order Status</p>
                                <div class="flex items-center gap-2">
                                    {!! getStatusBadge($order->status) !!}
                                </div>
                            </div>

                            <div class="flex items-center justify-between">
                                <p>Start Ordered At</p>
                                <div class="flex items-center gap-2">
                                    <p class="highlight-text">{{ $order->created_at->diffForHumans() }}</p>
                                </div>
                            </div>

                            <div class="flex items-center justify-between">
                                <p>Estilimated Date </p>
                                <div class="flex items-center gap-2">
                                    <p class="highlight-text">{{ $order->due_date->format('d-m-Y') }}</p>
                                </div>
                            </div>

                            <div class="flex items-center justify-between">
                                <p>Completed at </p>
                                <div class="flex items-center gap-2">
                                    <p class="highlight-text">{{ $order->completed_at ? $order->completed_at->format('d-m-Y') : "Not Yet"  }}</p>
                                </div>
                            </div>


                        </div>

                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection

@push('js')
    <script></script>
@endpush
