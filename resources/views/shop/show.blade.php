@extends('layouts.app')

@section('content')
<div class="max-w-5xl mx-auto bg-white rounded-2xl shadow p-4 md:p-6 grid grid-cols-1 md:grid-cols-2 gap-6 mt-8">

    {{-- IMAGE CAROUSEL --}}
    @php
        $images = is_array($product->image_path)
            ? $product->image_path
            : ($product->image_path ? [$product->image_path] : []);
    @endphp

    <div
        x-data="{
            active: 0,
            max: 6,
            images: {{ json_encode($images) }},
            get visibleImages() {
                let start = Math.max(0, this.active - Math.floor(this.max / 2));
                start = Math.min(start, this.images.length - this.max);
                return this.images.slice(start, start + this.max);
            },
            get startIndex() {
                return Math.max(0, Math.min(
                    this.active - Math.floor(this.max / 2),
                    this.images.length - this.max
                ));
            }
        }"
        class="relative"
    >

        @if(count($images))
            {{-- Main image --}}
            <img
                :src="'{{ asset('storage') }}/' + {{ json_encode($images) }}[active]"
                alt="{{ $product->name }}"
                class="rounded-2xl object-cover w-full h-64 sm:h-80 md:h-[400px]"
            >

            {{-- Arrows --}}
            @if(count($images) > 1)
                <button
                    @click="active = active === 0 ? {{ count($images) - 1 }} : active - 1"
                    class="absolute left-3 top-1/2 -translate-y-1/2 bg-white/80 hover:bg-white rounded-full p-2 shadow"
                >
                    ‹
                </button>

                <button
                    @click="active = active === {{ count($images) - 1 }} ? 0 : active + 1"
                    class="absolute right-3 top-1/2 -translate-y-1/2 bg-white/80 hover:bg-white rounded-full p-2 shadow"
                >
                    ›
                </button>
            @endif

            @if(count($images) > 1)
                <div class="flex gap-2 mt-3 justify-center items-center overflow-x-auto">
                    <template x-for="(image, index) in visibleImages" :key="index">
                        <img
                            :src="'{{ asset('storage') }}/' + image"
                            @click="active = startIndex + index"
                            class="w-12 h-12 sm:w-16 sm:h-16 object-cover rounded cursor-pointer border-2 flex-shrink-0"
                            :class="active === startIndex + index ? 'border-gray-900' : 'border-transparent'"
                        >
                    </template>

                    <template x-if="images.length > max">
                        <div class="w-12 h-12 sm:w-16 sm:h-16 flex items-center justify-center rounded bg-gray-200 text-sm text-gray-700">
                            +<span x-text="images.length - (startIndex + visibleImages.length)"></span>
                        </div>
                    </template>
                </div>
            @endif
        @endif
    </div>

    {{-- PRODUCT INFO --}}
    <div>
        <h1 class="text-2xl sm:text-3xl font-bold mb-2">{{ $product->name }}</h1>

        <p class="text-gray-500 mb-4">
            {{ $product->category->name ?? '' }}
        </p>

        <p class="text-xl sm:text-2xl font-semibold mb-4">
            Dkk {{ number_format($product->price, 2) }}
        </p>

        <p class="text-gray-700 mb-4 sm:mb-6">
            {{ $product->description }}
        </p>

        <div class="grid grid-cols-2 gap-2 text-sm text-gray-600 mb-4 sm:mb-6">
            <p><strong>Brede:</strong> {{ $product->width }} cm</p>
            <p><strong>Højde:</strong> {{ $product->height }} cm</p>
            <p><strong>Materiale:</strong> {{ $product->category->name }}</p>
            <p>
                <strong>Tilgængelighed:</strong>
                {{ ucfirst(str_replace('_', ' ', $product->availability_status)) }}
            </p>
        </div>

        <div class="mb-4 sm:mb-6">
            <p class="text-black-700 font-semibold text-lg">Ved interesse:</p>
            <p class="text-black-700 font-semibold text-lg mt-2">☎ +45 40 38 77 98</p>
        </div>

        <div class="flex flex-wrap gap-3">
            <a
                href="{{ route('shop.index') }}"
                class="inline-block px-5 py-3 rounded-md bg-gray-800 text-white hover:bg-gray-700"
            >
                ← Tilbage til butikken
            </a>
        </div>
    </div>

</div>
@endsection
