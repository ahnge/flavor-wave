<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 leading-tight">
            {{ $preorder->order_no }}
        </h2>
    </x-slot>



    <div class="py-12">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
            <div class="bg-white overflow-hidden shadow-sm sm:rounded-lg">
                <div class="p-6 text-gray-900">
                        @foreach ($preorder->products as $product)
                                {{ $product->title }}
                        @endforeach
                    <div class="mt-4">
                    </div>
                </div>
                <div class="flex items-center justify-center space-x-10">
                    <div>
                        <form method="POST" action="{{ route('preorder.changeStatus',['preorder'=>$preorder]) }}">
                            @csrf
                            <button name='status' type="submit" value="Approve" class="p-4 border border-b rounded-md mb-3 bg-green-400 text-white">Approve</button>
                        </form>
                    </div>
                    <div>
                        <form method="POST" action="{{ route('preorder.changeStatus',['preorder'=>$preorder]) }}">
                            @csrf
                            <button name='status' type="submit" value="Reject" class="p-4 border border-b rounded-md mb-3 bg-red-600 text-black">Reject</button>
                        </form>
                    </div>
                </div>
            </div>
        </div>
    </div>
</x-app-layout>
