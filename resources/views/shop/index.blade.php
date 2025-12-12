@extends('layouts.app')
    @section('content')
    <div class="mb-6 flex flex-wrap gap-3 justify-center">
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

    <div class="grid grid-cols-1 sm:grid-cols-2 lg:grid-cols-3 xl:grid-cols-4 gap-8">
        @foreach($products as $product)
            @if($product->availability_status !== 'sold_out')
                <a href="{{ route('shop.show', $product) }}" class="block bg-white rounded-2xl overflow-hidden shadow hover:shadow-lg transition">
                    @if($product->image_path)
                        <img src="{{ asset('storage/' . $product->image_path) }}" alt="{{ $product->name }}" class="w-full h-64 object-cover">
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
