@extends('layouts.app')

@section('title', $product->name . ' - MiniShop')

@section('content')
<div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8 py-12">
    <!-- Breadcrumb -->
    <nav class="mb-8">
        <ol class="flex items-center space-x-2 text-sm text-gray-600">
            <li>
                <a href="{{ route('shop.index') }}" class="hover:text-indigo-600">Shop</a>
            </li>
            <li>
                <svg class="w-4 h-4" fill="currentColor" viewBox="0 0 20 20">
                    <path fill-rule="evenodd" d="M7.293 14.707a1 1 0 010-1.414L10.586 10 7.293 6.707a1 1 0 011.414-1.414l4 4a1 1 0 010 1.414l-4 4a1 1 0 01-1.414 0z" clip-rule="evenodd"></path>
                </svg>
            </li>
            <li class="text-gray-900 font-medium">{{ $product->name }}</li>
        </ol>
    </nav>

    <!-- Product Details -->
    <div class="bg-white rounded-lg shadow-lg overflow-hidden">
        <div class="grid md:grid-cols-2 gap-8 p-8">
            <!-- Product Image -->
            <div class="bg-gray-100 rounded-lg overflow-hidden">
                @if($product->image_path)
                    <img src="{{ asset('storage/' . $product->image_path) }}" 
                         alt="{{ $product->name }}" 
                         class="w-full h-96 object-cover">
                @else
                    <div class="w-full h-96 flex items-center justify-center text-gray-400">
                        <svg class="w-32 h-32" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M4 16l4.586-4.586a2 2 0 012.828 0L16 16m-2-2l1.586-1.586a2 2 0 012.828 0L20 14m-6-6h.01M6 20h12a2 2 0 002-2V6a2 2 0 00-2-2H6a2 2 0 00-2 2v12a2 2 0 002 2z"></path>
                        </svg>
                    </div>
                @endif
            </div>

            <!-- Product Information -->
            <div class="flex flex-col justify-between">
                <div>
                    <!-- Product Name -->
                    <h1 class="text-3xl font-bold text-gray-900 mb-4">{{ $product->name }}</h1>

                    <!-- Price -->
                    <div class="mb-6">
                        <span class="text-4xl font-bold text-indigo-600">{{ $product->formatted_price }}</span>
                    </div>

                    <!-- Availability -->
                    <div class="mb-6">
                        @if($product->available)
                            <span class="inline-flex items-center px-3 py-1 rounded-full text-sm font-medium bg-green-100 text-green-800">
                                <svg class="w-4 h-4 mr-1" fill="currentColor" viewBox="0 0 20 20">
                                    <path fill-rule="evenodd" d="M10 18a8 8 0 100-16 8 8 0 000 16zm3.707-9.293a1 1 0 00-1.414-1.414L9 10.586 7.707 9.293a1 1 0 00-1.414 1.414l2 2a1 1 0 001.414 0l4-4z" clip-rule="evenodd"></path>
                                </svg>
                                In Stock
                            </span>
                        @else
                            <span class="inline-flex items-center px-3 py-1 rounded-full text-sm font-medium bg-red-100 text-red-800">
                                <svg class="w-4 h-4 mr-1" fill="currentColor" viewBox="0 0 20 20">
                                    <path fill-rule="evenodd" d="M10 18a8 8 0 100-16 8 8 0 000 16zM8.707 7.293a1 1 0 00-1.414 1.414L8.586 10l-1.293 1.293a1 1 0 101.414 1.414L10 11.414l1.293 1.293a1 1 0 001.414-1.414L11.414 10l1.293-1.293a1 1 0 00-1.414-1.414L10 8.586 8.707 7.293z" clip-rule="evenodd"></path>
                                </svg>
                                Out of Stock
                            </span>
                        @endif
                    </div>

                    <!-- Description -->
                    <div class="mb-6">
                        <h2 class="text-xl font-semibold text-gray-900 mb-3">Product Description</h2>
                        <p class="text-gray-700 leading-relaxed">{{ $product->description }}</p>
                    </div>
                </div>

                <!-- Action Buttons -->
                <div class="space-y-3">
                    @if($product->available)
                        <button class="w-full bg-indigo-600 text-white py-3 rounded-md hover:bg-indigo-700 transition font-semibold">
                            Add to Cart
                        </button>
                        <button class="w-full bg-gray-200 text-gray-900 py-3 rounded-md hover:bg-gray-300 transition font-semibold">
                            Buy Now
                        </button>
                    @else
                        <button disabled class="w-full bg-gray-300 text-gray-500 py-3 rounded-md cursor-not-allowed font-semibold">
                            Currently Unavailable
                        </button>
                    @endif
                    
                    <a href="{{ route('shop.index') }}" class="block w-full text-center border border-gray-300 text-gray-700 py-3 rounded-md hover:bg-gray-50 transition font-semibold">
                        Continue Shopping
                    </a>
                </div>
            </div>
        </div>
    </div>

    <!-- Additional Information (Optional) -->
    <div class="mt-8 bg-white rounded-lg shadow-lg p-8">
        <h2 class="text-2xl font-bold text-gray-900 mb-4">Product Specifications</h2>
        <div class="grid md:grid-cols-2 gap-6">
            <div>
                <h3 class="font-semibold text-gray-700 mb-2">Product ID</h3>
                <p class="text-gray-600">#{{ $product->id }}</p>
            </div>
            <div>
                <h3 class="font-semibold text-gray-700 mb-2">Category</h3>
                <p class="text-gray-600">Electronics & Accessories</p>
            </div>
            <div>
                <h3 class="font-semibold text-gray-700 mb-2">Warranty</h3>
                <p class="text-gray-600">1 Year Manufacturer Warranty</p>
            </div>
            <div>
                <h3 class="font-semibold text-gray-700 mb-2">Shipping</h3>
                <p class="text-gray-600">Free shipping on orders over $100</p>
            </div>
        </div>
    </div>
</div>
@endsection
