@extends('layouts.app')

@section('content')
<div class="mb-6 overflow-x-auto py-2">
    <div class="flex gap-3 flex-wrap sm:flex-nowrap justify-center">
        <a href="{{ route('shop.index') }}" 
           class="px-4 py-2 rounded-full border {{ !$categoryFilter ? 'bg-gray-900 text-white' : 'bg-white hover:bg-gray-100' }}">
            All
        </a>

        @foreach($categories as $category)
            <a href="{{ route('shop.index', ['category' => $category->slug]) }}"
               class="px-4 py-2 rounded-full border {{ $categoryFilter === $category->slug ? 'bg-gray-900 text-white' : 'bg-white hover:bg-gray-100' }}">
                {{ $category->name }}
            </a>
        @endforeach
    </div>
</div>

<div class="grid grid-cols-1 sm:grid-cols-2 lg:grid-cols-3 xl:grid-cols-4 gap-4 md:gap-6 px-2 md:px-0">
    @foreach($products as $product)
        @if($product->availability_status !== 'sold_out')
            <a href="{{ route('shop.show', $product) }}" class="block bg-white rounded-2xl overflow-hidden shadow hover:shadow-lg transition">
                @if($product->image_url)
                    <img src="{{ $product->image_url }}" alt="{{ $product->name }}" class="w-full h-64 object-cover">
                @endif
                <div class="p-4">
                    <div class="flex justify-between items-center mb-1">
                        <h2 class="text-lg font-semibold">{{ $product->name }}</h2>
                        @if($product->featured)
                            <span class="text-yellow-500 text-sm">★ Featured</span>
                        @endif
                    </div>
                    <p class="text-sm text-gray-500">{{ $product->category->name ?? '' }}</p>
                    <p class="text-xl font-bold mt-2">Dkk{{ number_format($product->price, 2) }}</p>
                </div>
            </a>
        @endif
    @endforeach
</div>

@if($products->isEmpty())
    <p class="text-center text-gray-500 mt-10">No products found.</p>
@endif
@endsection
