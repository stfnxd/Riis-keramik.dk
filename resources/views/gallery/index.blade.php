@extends('layouts.app')

@section('content')
    <!-- Categories -->
<div class="mb-6 py-2">
    <div class="flex gap-3 flex-wrap justify-center md:justify-center sm:flex-nowrap sm:overflow-x-auto">
        <a href="{{ route('gallery.index') }}"
           class="px-4 py-2 rounded-full border {{ !$categoryFilter ? 'bg-gray-900 text-white' : 'bg-white hover:bg-gray-100' }}">
            All
        </a>

        @foreach($categories as $category)
            <a href="{{ route('gallery.index', ['category' => $category->slug]) }}"
               class="px-4 py-2 rounded-full border {{ $categoryFilter === $category->slug ? 'bg-gray-900 text-white' : 'bg-white hover:bg-gray-100' }}">
                {{ $category->name }}
            </a>
        @endforeach
    </div>
</div>

    <!-- Gallery Grid -->
    <div class="grid grid-cols-1 sm:grid-cols-2 lg:grid-cols-3 xl:grid-cols-4 gap-4 md:gap-6 px-2 md:px-0">
        @foreach($products as $product)
            <a href="{{ route('shop.show', $product) }}" class="block group">
                @if($product->image_url)
                    <img
                        src="{{ $product->image_url }}"
                        alt="{{ $product->name }}"
                        class="w-full h-60 sm:h-64 md:h-72 lg:h-80 object-cover rounded-xl shadow group-hover:shadow-lg transition"
                    />
                @endif
            </a>
        @endforeach
    </div>

    <!-- No gallery items -->
    @if($products->isEmpty())
        <p class="text-center text-gray-500 mt-10">No gallery items yet.</p>
    @endif
@endsection
