@extends('layouts.app')
    @section('content')
        <div class="max-w-5xl mx-auto bg-white rounded-2xl shadow p-6 grid grid-cols-1 md:grid-cols-2 gap-6">
            @if($product->image_path)
                <img src="{{ asset('storage/' . $product->image_path) }}" alt="{{ $product->name }}" class="rounded-2xl object-cover w-full h-[400px]">
            @endif

            <div>
                <h1 class="text-3xl font-bold mb-2">{{ $product->name }}</h1>
                <p class="text-gray-500 mb-4">{{ $product->category->name ?? '' }}</p>

                <p class="text-2xl font-semibold mb-4">Dkk {{ number_format($product->price, 2) }}</p>

                <p class="text-gray-700 mb-6">{{ $product->description }}</p>

                <div class="grid grid-cols-2 gap-2 text-sm text-gray-600 mb-6">
                    <p><strong>Brede:</strong> {{ $product->width }} cm</p>
                    <p><strong>Højde:</strong> {{ $product->height }} cm</p>
                    <p><strong>Materiale:</strong> {{ $product->category->name }}</p>
                    <p><strong>Tilgængelighed:</strong> {{ ucfirst(str_replace('_', ' ', $product->availability_status)) }}</p>
                </div>

                <a href="{{ route('shop.index') }}" class="inline-block px-5 py-3 rounded-md bg-gray-800 text-white hover:bg-gray-700">
                    ← Tilbage til butikken
                </a>
                <a href="{{ route('shop.index') }}" class="inline-block px-5 py-3 rounded-md bg-green-700 text-white hover:bg-green-600">
                    Kontakt for køb
                </a>
            </div>
        </div>
@endsection