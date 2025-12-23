@extends('layouts.app')

@section('content')
    <div class="mb-6 flex flex-wrap gap-3 justify-center">
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

    <div class="grid grid-cols-1 sm:grid-cols-2 lg:grid-cols-3 xl:grid-cols-4 gap-8">
        @foreach($products as $product)
            <a href="{{ route('shop.show', $product) }}" class="block group">
                @if($product->image_url)
                    <img
                        src="{{ $product->image_url }}"
                        alt="{{ $product->name }}"
                        class="w-full h-80 object-cover rounded-xl shadow group-hover:shadow-lg transition"
                    />
                @endif
            </a>
        @endforeach
    </div>

    @if($products->isEmpty())
        <p class="text-center text-gray-500 mt-10">No gallery items yet.</p>
    @endif
@endsection
