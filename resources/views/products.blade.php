@extends('layouts.app')

@section('title', 'Products')

@section('content')
<div class="bg-gray-50 py-8">
    <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8">
        <div class="flex flex-col lg:flex-row gap-8">
            <!-- Filters Sidebar -->
            <div class="lg:w-1/4">
                <div class="bg-white rounded-lg shadow p-6 sticky top-24">
                    <h3 class="text-lg font-semibold mb-4">Filters</h3>
                    
                    <form method="GET" action="{{ route('products') }}">
                        <!-- Search -->
                        <div class="mb-6">
                            <label class="block text-sm font-medium text-gray-700 mb-2">Search</label>
                            <input type="text" name="search" value="{{ request('search') }}" 
                                   class="w-full px-3 py-2 border border-gray-300 rounded-md focus:outline-none focus:ring-2 focus:ring-primary-500"
                                   placeholder="Search products...">
                        </div>

                        <!-- Categories -->
                        <div class="mb-6">
                            <label class="block text-sm font-medium text-gray-700 mb-2">Category</label>
                            <select name="category" class="w-full px-3 py-2 border border-gray-300 rounded-md focus:outline-none focus:ring-2 focus:ring-primary-500">
                                <option value="">All Categories</option>
                                @foreach($categories as $category)
                                    <option value="{{ $category->slug }}" {{ request('category') == $category->slug ? 'selected' : '' }}>
                                        {{ $category->name }}
                                    </option>
                                @endforeach
                            </select>
                        </div>

                        <!-- Main Categories -->
                        <div class="mb-6">
                            <label class="block text-sm font-medium text-gray-700 mb-2">Main Category</label>
                            <select name="main_category" class="w-full px-3 py-2 border border-gray-300 rounded-md focus:outline-none focus:ring-2 focus:ring-primary-500">
                                <option value="">All Main Categories</option>
                                @foreach($mainCategories as $mainCategory)
                                    <option value="{{ $mainCategory }}" {{ request('main_category') == $mainCategory ? 'selected' : '' }}>
                                        {{ $mainCategory }}
                                    </option>
                                @endforeach
                            </select>
                        </div>

                        <!-- Price Range -->
                        <div class="mb-6">
                            <label class="block text-sm font-medium text-gray-700 mb-2">Price Range</label>
                            <div class="flex gap-2">
                                <input type="number" name="min_price" value="{{ request('min_price') }}" 
                                       class="w-1/2 px-3 py-2 border border-gray-300 rounded-md focus:outline-none focus:ring-2 focus:ring-primary-500"
                                       placeholder="Min">
                                <input type="number" name="max_price" value="{{ request('max_price') }}" 
                                       class="w-1/2 px-3 py-2 border border-gray-300 rounded-md focus:outline-none focus:ring-2 focus:ring-primary-500"
                                       placeholder="Max">
                            </div>
                        </div>

                        <button type="submit" class="w-full bg-primary-600 hover:bg-primary-700 text-white py-2 px-4 rounded-md transition duration-300">
                            Apply Filters
                        </button>
                        
                        <a href="{{ route('products') }}" class="block w-full text-center mt-2 text-gray-600 hover:text-primary-600">
                            Clear Filters
                        </a>
                    </form>
                </div>
            </div>

            <!-- Products Grid -->
            <div class="lg:w-3/4">
                <!-- Sort Options -->
                <div class="flex justify-between items-center mb-6">
                    <h1 class="text-2xl font-bold text-gray-900">Products</h1>
                    <div class="flex items-center space-x-4">
                        <span class="text-gray-600">{{ $products->total() }} products</span>
                        <select onchange="window.location.href=this.value" class="px-3 py-2 border border-gray-300 rounded-md focus:outline-none focus:ring-2 focus:ring-primary-500">
                            <option value="{{ route('products', array_merge(request()->all(), ['sort' => 'name'])) }}" {{ request('sort') == 'name' ? 'selected' : '' }}>Name A-Z</option>
                            <option value="{{ route('products', array_merge(request()->all(), ['sort' => 'price_low'])) }}" {{ request('sort') == 'price_low' ? 'selected' : '' }}>Price Low to High</option>
                            <option value="{{ route('products', array_merge(request()->all(), ['sort' => 'price_high'])) }}" {{ request('sort') == 'price_high' ? 'selected' : '' }}>Price High to Low</option>
                            <option value="{{ route('products', array_merge(request()->all(), ['sort' => 'newest'])) }}" {{ request('sort') == 'newest' ? 'selected' : '' }}>Newest First</option>
                        </select>
                    </div>
                </div>

                <!-- Products Grid -->
                <div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-3 gap-6">
                    @foreach($products as $product)
                        <div class="bg-white rounded-lg shadow-lg overflow-hidden hover:shadow-xl transition duration-300" data-aos="fade-up">
                            <div class="relative">
                                @if($product->images && count($product->images) > 0)
                                    <img src="{{ asset('storage/' . $product->images[0]) }}" alt="{{ $product->name }}" class="w-full h-48 object-cover">
                                @else
                                    <div class="w-full h-48 bg-gray-200 flex items-center justify-center">
                                        <img src="/images/product_placeholder_{{ ($loop->index % 10) + 1 }}.jpg" alt="{{ $product->name }}" class="w-full h-full object-cover">
                                    </div>
                                @endif
                                
                                @if($product->discount_percentage > 0)
                                    <div class="absolute top-2 right-2 bg-red-500 text-white px-2 py-1 rounded text-sm font-semibold">
                                        -{{ $product->discount_percentage }}%
                                    </div>
                                @endif
                            </div>
                            
                            <div class="p-6">
                                <h3 class="text-lg font-semibold text-gray-900 mb-2">{{ $product->name }}</h3>
                                <p class="text-gray-600 text-sm mb-4">{{ Str::limit($product->description, 100) }}</p>
                                
                                <div class="flex items-center justify-between mb-4">
                                    <div class="flex items-center space-x-2">
                                        @if($product->discounted_price)
                                            <span class="text-lg font-bold text-primary-600">${{ number_format($product->discounted_price, 2) }}</span>
                                            <span class="text-sm text-gray-500 line-through">${{ number_format($product->price, 2) }}</span>
                                        @else
                                            <span class="text-lg font-bold text-primary-600">${{ number_format($product->price, 2) }}</span>
                                        @endif
                                    </div>
                                </div>
                                
                                <div class="flex items-center justify-between">
                                    <a href="{{ route('products.show', $product) }}" class="text-primary-600 hover:text-primary-700 font-semibold">
                                        View Details
                                    </a>
                                    
                                    @if($product->quantity > 0)
                                        <button class="bg-primary-600 hover:bg-primary-700 text-white px-4 py-2 rounded-full text-sm font-semibold add-to-cart" 
                                                data-product-id="{{ $product->id }}" 
                                                data-product-name="{{ $product->name }}" 
                                                data-product-price="{{ $product->final_price }}">
                                            Add to Cart
                                        </button>
                                    @elseif($product->allow_preorder)
                                        <button class="bg-yellow-600 hover:bg-yellow-700 text-white px-4 py-2 rounded-full text-sm font-semibold">
                                            Pre-order
                                        </button>
                                    @else
                                        <span class="text-red-600 text-sm font-semibold">Out of Stock</span>
                                    @endif
                                </div>
                            </div>
                        </div>
                    @endforeach
                </div>

                <!-- Pagination -->
                <div class="mt-8">
                    {{ $products->appends(request()->query())->links() }}
                </div>
            </div>
        </div>
    </div>
</div>

<script>
// Add to cart functionality
document.querySelectorAll('.add-to-cart').forEach(button => {
    button.addEventListener('click', function() {
        const productId = this.dataset.productId;
        const productName = this.dataset.productName;
        const productPrice = parseFloat(this.dataset.productPrice);
        
        // Get existing cart from localStorage
        let cart = JSON.parse(localStorage.getItem('cart') || '[]');
        
        // Check if product already exists in cart
        const existingItem = cart.find(item => item.id === productId);
        
        if (existingItem) {
            existingItem.quantity += 1;
        } else {
            cart.push({
                id: productId,
                name: productName,
                price: productPrice,
                quantity: 1
            });
        }
        
        // Save cart to localStorage
        localStorage.setItem('cart', JSON.stringify(cart));
        
        // Update cart count
        updateCartCount();
        
        // Show success message
        this.textContent = 'Added!';
        this.classList.add('bg-green-600');
        this.classList.remove('bg-primary-600');
        
        setTimeout(() => {
            this.textContent = 'Add to Cart';
            this.classList.remove('bg-green-600');
            this.classList.add('bg-primary-600');
        }, 2000);
    });
});

function updateCartCount() {
    const cart = JSON.parse(localStorage.getItem('cart') || '[]');
    const totalItems = cart.reduce((sum, item) => sum + item.quantity, 0);
    document.getElementById('cart-count').textContent = totalItems;
}

// Initialize cart count on page load
updateCartCount();
</script>
@endsection
