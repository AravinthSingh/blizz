@extends('layouts.app')

@section('title', 'Ayurvedic Products')

@section('content')
<!-- Ayurvedic Hero Section -->
<section class="relative py-20 overflow-hidden">
    <div class="absolute inset-0 bg-gradient-to-br from-primary-900 via-earth-800 to-secondary-900"></div>
    <div class="absolute inset-0 bg-gradient-to-tr from-primary-600/30 to-secondary-600/20"></div>
    
    <!-- Floating Elements -->
    <div class="absolute top-10 left-10 w-20 h-20 bg-primary-400/20 rounded-full blur-xl float" style="animation-delay: -1s;"></div>
    <div class="absolute top-32 right-20 w-16 h-16 bg-secondary-400/20 rounded-full blur-lg float" style="animation-delay: -3s;"></div>
    <div class="absolute bottom-20 left-1/4 w-12 h-12 bg-earth-400/20 rounded-full blur-lg float" style="animation-delay: -2s;"></div>
    
    <div class="relative z-10 max-w-7xl mx-auto px-4 sm:px-6 lg:px-8 text-center">
        <div class="glass p-12 rounded-3xl breathe" data-aos="fade-up">
            <h1 class="text-5xl md:text-7xl font-bold mb-6 gradient-text">
                🌿 Ayurvedic Collection
            </h1>
            <p class="text-xl md:text-2xl text-white/90 mb-8 max-w-3xl mx-auto leading-relaxed">
                Discover our premium range of natural skincare products, crafted with ancient Ayurvedic wisdom and modern science
            </p>
            
            <div class="flex flex-col sm:flex-row gap-4 justify-center items-center">
                <div class="relative">
                    <input type="text" id="heroSearch" placeholder="Search natural products..." 
                           class="pl-12 pr-6 py-4 w-80 rounded-full border-2 border-primary-300 focus:outline-none focus:ring-2 focus:ring-secondary-500 bg-white/90 backdrop-blur-sm">
                    <i class="fas fa-search absolute left-4 top-1/2 transform -translate-y-1/2 text-primary-600"></i>
                </div>
                <button onclick="scrollToProducts()" class="btn-ayurveda px-8 py-4 text-lg">
                    <i class="fas fa-leaf mr-2"></i>Explore Products
                </button>
            </div>
        </div>
    </div>
</section>

<!-- Products Section -->
<section id="products-section" class="py-16 bg-gradient-to-br from-primary-50 to-secondary-50">
    <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8">
        <div class="flex flex-col lg:flex-row gap-8">
            <!-- Enhanced Filters Sidebar -->
            <div class="lg:w-1/4">
                <div class="glass rounded-3xl shadow-xl p-8 sticky top-24 border border-primary-200">
                    <div class="flex items-center mb-6">
                        <i class="fas fa-filter text-2xl text-primary-600 mr-3"></i>
                        <h3 class="text-2xl font-bold gradient-text">Filters</h3>
                    </div>
                    
                    <form method="GET" action="{{ route('products') }}" id="filterForm">
                        <!-- Search -->
                        <div class="mb-8">
                            <label class="block text-sm font-bold text-earth-700 mb-3">
                                <i class="fas fa-search mr-2 text-primary-600"></i>Search Products
                            </label>
                            <div class="relative">
                                <input type="text" name="search" value="{{ request('search') }}" 
                                       class="w-full pl-10 pr-4 py-3 border-2 border-earth-300 rounded-2xl focus:outline-none focus:ring-2 focus:ring-primary-500 focus:border-primary-500 bg-white"
                                       placeholder="Search natural products...">
                                <i class="fas fa-search absolute left-3 top-1/2 transform -translate-y-1/2 text-earth-400"></i>
                            </div>
                        </div>

                        <!-- Categories -->
                        <div class="mb-8">
                            <label class="block text-sm font-bold text-earth-700 mb-3">
                                <i class="fas fa-spa mr-2 text-primary-600"></i>Category
                            </label>
                            <select name="category" class="w-full px-4 py-3 border-2 border-earth-300 rounded-2xl focus:outline-none focus:ring-2 focus:ring-primary-500 focus:border-primary-500 bg-white">
                                <option value="">All Categories</option>
                                @foreach($categories as $category)
                                    <option value="{{ $category->slug }}" {{ request('category') == $category->slug ? 'selected' : '' }}>
                                        {{ $category->name }}
                                    </option>
                                @endforeach
                            </select>
                        </div>

                        <!-- Ayurvedic Types -->
                        <div class="mb-8">
                            <label class="block text-sm font-bold text-earth-700 mb-3">
                                <i class="fas fa-leaf mr-2 text-primary-600"></i>Ayurvedic Type
                            </label>
                            <select name="main_category" class="w-full px-4 py-3 border-2 border-earth-300 rounded-2xl focus:outline-none focus:ring-2 focus:ring-primary-500 focus:border-primary-500 bg-white">
                                <option value="">All Types</option>
                                @foreach($mainCategories as $mainCategory)
                                    <option value="{{ $mainCategory }}" {{ request('main_category') == $mainCategory ? 'selected' : '' }}>
                                        {{ $mainCategory }}
                                    </option>
                                @endforeach
                            </select>
                        </div>

                        <!-- Price Range -->
                        <div class="mb-8">
                            <label class="block text-sm font-bold text-earth-700 mb-3">
                                <i class="fas fa-dollar-sign mr-2 text-primary-600"></i>Price Range
                            </label>
                            <div class="flex gap-3">
                                <input type="number" name="min_price" value="{{ request('min_price') }}" 
                                       class="w-1/2 px-4 py-3 border-2 border-earth-300 rounded-2xl focus:outline-none focus:ring-2 focus:ring-primary-500 focus:border-primary-500 bg-white"
                                       placeholder="Min $">
                                <input type="number" name="max_price" value="{{ request('max_price') }}" 
                                       class="w-1/2 px-4 py-3 border-2 border-earth-300 rounded-2xl focus:outline-none focus:ring-2 focus:ring-primary-500 focus:border-primary-500 bg-white"
                                       placeholder="Max $">
                            </div>
                        </div>

                        <!-- Availability -->
                        <div class="mb-8">
                            <label class="block text-sm font-bold text-earth-700 mb-3">
                                <i class="fas fa-check-circle mr-2 text-primary-600"></i>Availability
                            </label>
                            <div class="space-y-3">
                                <label class="flex items-center">
                                    <input type="checkbox" name="in_stock" value="1" {{ request('in_stock') ? 'checked' : '' }}
                                           class="rounded border-earth-300 text-primary-600 focus:ring-primary-500 mr-3">
                                    <span class="text-earth-700">In Stock</span>
                                </label>
                                <label class="flex items-center">
                                    <input type="checkbox" name="on_sale" value="1" {{ request('on_sale') ? 'checked' : '' }}
                                           class="rounded border-earth-300 text-secondary-600 focus:ring-secondary-500 mr-3">
                                    <span class="text-earth-700">On Sale</span>
                                </label>
                            </div>
                        </div>

                        <button type="submit" class="w-full btn-3d py-4 mb-4">
                            <i class="fas fa-filter mr-2"></i>Apply Filters
                        </button>
                        
                        <a href="{{ route('products') }}" class="block w-full text-center py-3 text-earth-600 hover:text-primary-600 font-semibold transition-colors">
                            <i class="fas fa-times mr-2"></i>Clear All Filters
                        </a>
                    </form>
                </div>
            </div>

            <!-- Enhanced Products Grid -->
            <div class="lg:w-3/4">
                <!-- Sort & View Options -->
                <div class="glass rounded-2xl p-6 mb-8 border border-primary-200">
                    <div class="flex flex-col sm:flex-row justify-between items-center gap-4">
                        <div>
                            <h2 class="text-3xl font-bold gradient-text">Natural Products</h2>
                            <p class="text-earth-600 mt-1">{{ $products->total() }} premium Ayurvedic products found</p>
                        </div>
                        
                        <div class="flex items-center space-x-4">
                            <div class="flex items-center space-x-2">
                                <span class="text-sm text-earth-600">Sort by:</span>
                                <select onchange="window.location.href=this.value" class="px-4 py-2 border-2 border-earth-300 rounded-2xl focus:outline-none focus:ring-2 focus:ring-primary-500 bg-white">
                                    <option value="{{ route('products', array_merge(request()->all(), ['sort' => 'name'])) }}" {{ request('sort') == 'name' ? 'selected' : '' }}>Name A-Z</option>
                                    <option value="{{ route('products', array_merge(request()->all(), ['sort' => 'price_low'])) }}" {{ request('sort') == 'price_low' ? 'selected' : '' }}>Price Low to High</option>
                                    <option value="{{ route('products', array_merge(request()->all(), ['sort' => 'price_high'])) }}" {{ request('sort') == 'price_high' ? 'selected' : '' }}>Price High to Low</option>
                                    <option value="{{ route('products', array_merge(request()->all(), ['sort' => 'newest'])) }}" {{ request('sort') == 'newest' ? 'selected' : '' }}>Newest First</option>
                                </select>
                            </div>
                            
                            <div class="flex border-2 border-earth-300 rounded-2xl overflow-hidden">
                                <button class="px-3 py-2 bg-primary-100 text-primary-600" title="Grid View">
                                    <i class="fas fa-th"></i>
                                </button>
                                <button class="px-3 py-2 text-earth-400 hover:bg-earth-100" title="List View">
                                    <i class="fas fa-list"></i>
                                </button>
                            </div>
                        </div>
                    </div>
                </div>

                <!-- Enhanced Products Grid -->
                <div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-3 gap-8">
                    @forelse($products as $product)
                        <div class="card-3d glass rounded-3xl overflow-hidden border border-primary-200 hover:shadow-2xl transition-all duration-500 group" data-aos="fade-up" data-aos-delay="{{ $loop->index * 100 }}">
                            <div class="relative overflow-hidden">
                                @if($product->images && count($product->images) > 0)
                                    <img src="{{ asset('storage/' . $product->images[0]) }}" alt="{{ $product->name }}" 
                                         class="w-full h-64 object-cover group-hover:scale-110 transition-transform duration-500">
                                @else
                                    <div class="w-full h-64 bg-gradient-to-br from-primary-200 to-secondary-200 flex items-center justify-center">
                                        <div class="text-center">
                                            <i class="fas fa-spa text-4xl text-primary-600 mb-2"></i>
                                            <p class="text-primary-700 font-semibold">{{ $product->name }}</p>
                                        </div>
                                    </div>
                                @endif
                                
                                <!-- Badges -->
                                <div class="absolute top-4 left-4 space-y-2">
                                    @if($product->discount_percentage > 0)
                                        <span class="inline-block bg-gradient-to-r from-red-500 to-red-600 text-white px-3 py-1 rounded-full text-sm font-bold shadow-lg">
                                            -{{ $product->discount_percentage }}%
                                        </span>
                                    @endif
                                    
                                    @if($product->quantity <= 5 && $product->quantity > 0)
                                        <span class="inline-block bg-gradient-to-r from-yellow-500 to-yellow-600 text-white px-3 py-1 rounded-full text-sm font-bold shadow-lg">
                                            Low Stock
                                        </span>
                                    @endif
                                </div>
                                
                                <!-- Quick Actions -->
                                <div class="absolute top-4 right-4 opacity-0 group-hover:opacity-100 transition-opacity duration-300">
                                    <div class="flex flex-col space-y-2">
                                        <button class="w-10 h-10 bg-white/90 rounded-full flex items-center justify-center text-primary-600 hover:bg-primary-600 hover:text-white transition-colors shadow-lg" title="Quick View">
                                            <i class="fas fa-eye"></i>
                                        </button>
                                        <button class="w-10 h-10 bg-white/90 rounded-full flex items-center justify-center text-secondary-600 hover:bg-secondary-600 hover:text-white transition-colors shadow-lg" title="Add to Wishlist">
                                            <i class="fas fa-heart"></i>
                                        </button>
                                    </div>
                                </div>
                                
                                <!-- Category Badge -->
                                <div class="absolute bottom-4 left-4">
                                    <span class="inline-block bg-white/90 backdrop-blur-sm text-earth-700 px-3 py-1 rounded-full text-xs font-semibold">
                                        {{ $product->category->name ?? 'Ayurvedic' }}
                                    </span>
                                </div>
                            </div>
                            
                            <div class="p-6">
                                <div class="mb-4">
                                    <h3 class="text-xl font-bold text-earth-800 mb-2 group-hover:text-primary-600 transition-colors">
                                        {{ $product->name }}
                                    </h3>
                                    <p class="text-earth-600 text-sm leading-relaxed">
                                        {{ Str::limit($product->description, 120) }}
                                    </p>
                                </div>
                                
                                <!-- Rating -->
                                <div class="flex items-center mb-4">
                                    @for($i = 1; $i <= 5; $i++)
                                        <i class="fas fa-star text-secondary-500 text-sm"></i>
                                    @endfor
                                    <span class="ml-2 text-sm text-earth-600">(4.8) • 127 reviews</span>
                                </div>
                                
                                <!-- Price -->
                                <div class="flex items-center justify-between mb-6">
                                    <div class="flex items-center space-x-2">
                                        @if($product->discounted_price)
                                            <span class="text-2xl font-bold gradient-text">${{ number_format($product->discounted_price, 2) }}</span>
                                            <span class="text-lg text-earth-500 line-through">${{ number_format($product->price, 2) }}</span>
                                        @else
                                            <span class="text-2xl font-bold gradient-text">${{ number_format($product->price, 2) }}</span>
                                        @endif
                                    </div>
                                    
                                    @if($product->quantity > 0)
                                        <span class="text-sm text-green-600 font-semibold">
                                            <i class="fas fa-check-circle mr-1"></i>In Stock
                                        </span>
                                    @else
                                        <span class="text-sm text-red-600 font-semibold">
                                            <i class="fas fa-times-circle mr-1"></i>Out of Stock
                                        </span>
                                    @endif
                                </div>
                                
                                <!-- Actions -->
                                <div class="flex flex-col space-y-3">
                                    <a href="{{ route('products.show', $product) }}" class="btn-3d text-center py-3">
                                        <i class="fas fa-eye mr-2"></i>View Details
                                    </a>
                                    
                                    @if($product->quantity > 0)
                                        <button class="btn-ayurveda py-3 add-to-cart" 
                                                data-product-id="{{ $product->id }}" 
                                                data-product-name="{{ $product->name }}" 
                                                data-product-price="{{ $product->final_price }}">
                                            <i class="fas fa-shopping-basket mr-2"></i>Add to Cart
                                        </button>
                                    @elseif($product->allow_preorder)
                                        <button class="bg-gradient-to-r from-yellow-500 to-yellow-600 hover:from-yellow-600 hover:to-yellow-700 text-white font-semibold py-3 px-6 rounded-2xl transition-all duration-300 shadow-lg hover:shadow-xl">
                                            <i class="fas fa-clock mr-2"></i>Pre-order Now
                                        </button>
                                    @else
                                        <button disabled class="bg-gray-300 text-gray-500 font-semibold py-3 px-6 rounded-2xl">
                                            <i class="fas fa-times-circle mr-2"></i>Out of Stock
                                        </button>
                                    @endif
                                </div>
                            </div>
                        </div>
                    @empty
                        <div class="col-span-full">
                            <div class="glass rounded-3xl p-16 text-center border border-earth-200">
                                <i class="fas fa-spa text-6xl text-earth-400 mb-6"></i>
                                <h3 class="text-2xl font-bold text-earth-600 mb-4">No Products Found</h3>
                                <p class="text-earth-500 mb-8">Try adjusting your filters or search terms to find what you're looking for.</p>
                                <a href="{{ route('products') }}" class="btn-3d px-8 py-3">
                                    <i class="fas fa-refresh mr-2"></i>View All Products
                                </a>
                            </div>
                        </div>
                    @endforelse
                </div>

                <!-- Enhanced Pagination -->
                @if($products->hasPages())
                    <div class="mt-12">
                        <div class="glass rounded-2xl p-6 border border-primary-200">
                            {{ $products->appends(request()->query())->links() }}
                        </div>
                    </div>
                @endif
            </div>
        </div>
    </div>
</section>

<!-- Newsletter Section -->
<section class="py-16 bg-gradient-to-r from-primary-600 to-secondary-600 relative overflow-hidden">
    <div class="absolute inset-0 bg-gradient-to-tr from-primary-900/50 to-secondary-900/30"></div>
    
    <!-- Floating Elements -->
    <div class="absolute top-10 left-10 w-20 h-20 bg-white/10 rounded-full blur-xl float"></div>
    <div class="absolute bottom-10 right-10 w-16 h-16 bg-white/10 rounded-full blur-lg float" style="animation-delay: -2s;"></div>
    
    <div class="relative z-10 max-w-4xl mx-auto px-4 sm:px-6 lg:px-8 text-center">
        <div class="glass p-12 rounded-3xl border border-white/20" data-aos="fade-up">
            <h2 class="text-4xl md:text-5xl font-bold text-white mb-6">
                🌿 Stay Connected with Nature
            </h2>
            <p class="text-xl text-white/90 mb-8 leading-relaxed">
                Subscribe to our newsletter for exclusive Ayurvedic tips, product launches, and special offers
            </p>
            
            <form class="flex flex-col sm:flex-row gap-4 max-w-md mx-auto">
                <input type="email" placeholder="Enter your email address" 
                       class="flex-1 px-6 py-4 rounded-full border-2 border-white/30 focus:outline-none focus:ring-2 focus:ring-white focus:border-white bg-white/10 backdrop-blur-sm text-white placeholder-white/70">
                <button type="submit" class="btn-ayurveda px-8 py-4 bg-white text-primary-600 hover:bg-white/90">
                    <i class="fas fa-leaf mr-2"></i>Subscribe
                </button>
            </form>
            
            <p class="text-white/70 text-sm mt-4">
                Join 10,000+ customers who trust our natural skincare expertise
            </p>
        </div>
    </div>
</section>

<script>
// Enhanced search functionality
function scrollToProducts() {
    document.getElementById('products-section').scrollIntoView({ 
        behavior: 'smooth',
        block: 'start'
    });
}

// Hero search integration
document.getElementById('heroSearch').addEventListener('keypress', function(e) {
    if (e.key === 'Enter') {
        const searchValue = this.value;
        const url = new URL(window.location.href);
        url.searchParams.set('search', searchValue);
        window.location.href = url.toString();
    }
});

// Auto-submit filters on change
document.querySelectorAll('#filterForm select, #filterForm input[type="checkbox"]').forEach(element => {
    element.addEventListener('change', function() {
        document.getElementById('filterForm').submit();
    });
});

// Enhanced add to cart functionality
document.querySelectorAll('.add-to-cart').forEach(button => {
    button.addEventListener('click', function() {
        const productId = this.dataset.productId;
        const productName = this.dataset.productName;
        const productPrice = this.dataset.productPrice;
        
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
