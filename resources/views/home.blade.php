@extends('layouts.app')

@section('title', 'Home')

@section('content')
<!-- New Unified Hero Component with Carousel -->
@include('components.hero-new')

<!-- Featured Products -->
<section class="py-20 relative overflow-hidden">
    <!-- Premium Background -->
    <div class="absolute inset-0 bg-gradient-to-br from-primary-50 via-white to-secondary-50"></div>
    
    <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8 relative z-10">
        <div class="text-center mb-16" data-aos="fade-up">
            <h2 class="text-5xl md:text-6xl font-bold mb-6">
                <span class="text-gradient-gold">✨ Premium</span>
                <span class="text-primary-900">Collection</span>
            </h2>
            <p class="text-2xl text-primary-700 max-w-3xl mx-auto">Discover our luxury Ayurvedic face creams crafted with pure gold essence</p>
        </div>
        
        <div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-3 xl:grid-cols-5 gap-8">
            @foreach($featuredProducts as $product)
                <div class="product-card group" data-aos="fade-up" data-aos-delay="{{ $loop->index * 100 }}">
                    <div class="relative overflow-hidden">
                        <div class="product-image relative">
                            @if($product->images && count($product->images) > 0)
                                <img src="{{ asset('storage/' . $product->images[0]) }}" alt="{{ $product->name }}" class="w-full h-56 object-cover">
                            @else
                                <img src="https://images.unsplash.com/photo-1556228578-8c89e6adf883?w=400&h=300&fit=crop&crop=face" alt="{{ $product->name }}" class="w-full h-56 object-cover">
                            @endif
                            
                            <!-- Overlay -->
                            <div class="absolute inset-0 bg-gradient-to-t from-black/20 to-transparent opacity-0 group-hover:opacity-100 transition-opacity duration-300"></div>
                        </div>
                        
                        @if($product->discount_percentage > 0)
                            <div class="absolute top-4 right-4 glass px-3 py-1 rounded-full text-white text-sm font-bold pulse-3d">
                                <i class="fas fa-tag mr-1"></i>-{{ $product->discount_percentage }}%
                            </div>
                        @endif
                        
                        <!-- Quick View Button -->
                        <div class="absolute top-4 left-4 opacity-0 group-hover:opacity-100 transition-all duration-300 transform -translate-y-2 group-hover:translate-y-0">
                            <button class="glass p-2 rounded-full text-white hover:scale-110 transition-all duration-300">
                                <i class="fas fa-eye icon-3d"></i>
                            </button>
                        </div>
                    </div>
                    
                    <div class="p-6 relative z-10">
                        <h3 class="text-xl font-bold text-gray-900 mb-3 group-hover:text-primary-600 transition-colors duration-300">
                            {{ $product->name }}
                        </h3>
                        <p class="text-gray-600 text-sm mb-4 leading-relaxed">{{ Str::limit($product->description, 80) }}</p>
                        
                        <!-- Rating Stars -->
                        <div class="flex items-center mb-4">
                            <div class="flex text-yellow-400">
                                <i class="fas fa-star"></i>
                                <i class="fas fa-star"></i>
                                <i class="fas fa-star"></i>
                                <i class="fas fa-star"></i>
                                <i class="fas fa-star"></i>
                            </div>
                            <span class="text-gray-500 text-sm ml-2">(4.9)</span>
                        </div>
                        
                        <div class="flex items-center justify-between mb-4">
                            <div class="flex items-center space-x-2">
                                @if($product->discounted_price)
                                    <span class="text-2xl font-bold gradient-text">${{ number_format($product->discounted_price, 2) }}</span>
                                    <span class="text-sm text-gray-500 line-through">${{ number_format($product->price, 2) }}</span>
                                @else
                                    <span class="text-2xl font-bold gradient-text">${{ number_format($product->price, 2) }}</span>
                                @endif
                            </div>
                        </div>
                        
                        <button class="btn-3d w-full text-sm add-to-cart group-hover:scale-105" 
                                data-product-id="{{ $product->id }}" 
                                data-product-name="{{ $product->name }}" 
                                data-product-price="{{ $product->final_price }}">
                            <i class="fas fa-shopping-cart mr-2"></i>Add to Cart
                        </button>
                        
                        @if($product->quantity == 0)
                            <div class="mt-3 text-center">
                                @if($product->allow_preorder)
                                    <span class="glass px-3 py-1 rounded-full text-yellow-600 text-sm font-semibold">
                                        <i class="fas fa-clock mr-1"></i>Pre-order Available
                                    </span>
                                @else
                                    <span class="glass px-3 py-1 rounded-full text-red-600 text-sm font-semibold">
                                        <i class="fas fa-times mr-1"></i>Out of Stock
                                    </span>
                                @endif
                            </div>
                        @endif
                    </div>
                </div>
            @endforeach
        </div>
        
        <div class="text-center mt-16" data-aos="fade-up">
            <a href="{{ route('products') }}" class="btn-3d text-lg px-12 py-4">
                <i class="fas fa-arrow-right mr-3"></i>View All Products
            </a>
        </div>
    </div>
    
    <!-- Floating Elements -->
    <div class="absolute top-20 right-10 w-24 h-24 bg-primary-200 rounded-full opacity-20 float" style="animation-delay: -1s;"></div>
    <div class="absolute bottom-32 left-16 w-16 h-16 bg-secondary-200 rounded-full opacity-20 float" style="animation-delay: -3s;"></div>
</section>

<!-- Categories -->
<section class="py-20 relative overflow-hidden">
    <!-- Background -->
    <div class="absolute inset-0 bg-gradient-to-br from-white to-purple-50"></div>
    
    <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8 relative z-10">
        <div class="text-center mb-16" data-aos="fade-up">
            <h2 class="text-5xl md:text-6xl font-bold gradient-text mb-6 text-shadow-3d">
                🎯 Shop by Category
            </h2>
            <p class="text-2xl text-gray-600 max-w-3xl mx-auto">Find the perfect product tailored for your unique skin type and needs</p>
        </div>
        
        <div class="grid grid-cols-2 md:grid-cols-3 lg:grid-cols-6 gap-8">
            @foreach($categories as $category)
                <a href="{{ route('products', ['category' => $category->slug]) }}" class="category-card group p-8 text-center" data-aos="zoom-in" data-aos-delay="{{ $loop->index * 100 }}">
                    <div class="relative mb-6">
                        @if($category->image)
                            <img src="{{ asset('storage/' . $category->image) }}" alt="{{ $category->name }}" class="w-20 h-20 mx-auto rounded-full object-cover shadow-lg group-hover:scale-110 transition-all duration-300">
                        @else
                            <div class="w-20 h-20 mx-auto glass rounded-full flex items-center justify-center group-hover:scale-110 transition-all duration-300">
                                <img src="https://images.unsplash.com/photo-1571019613454-1cb2f99b2d8b?w=100&h=100&fit=crop&crop=face" alt="{{ $category->name }}" class="w-16 h-16 rounded-full object-cover">
                            </div>
                        @endif
                        
                        <!-- Floating Icon -->
                        <div class="absolute -top-2 -right-2 glass p-2 rounded-full opacity-0 group-hover:opacity-100 transition-all duration-300 transform scale-0 group-hover:scale-100">
                            <i class="fas fa-arrow-right text-primary-600 text-sm icon-3d"></i>
                        </div>
                    </div>
                    
                    <h3 class="text-lg font-bold text-gray-900 group-hover:text-primary-600 transition-colors duration-300 mb-2">
                        {{ $category->name }}
                    </h3>
                    
                    <p class="text-sm text-gray-500 opacity-0 group-hover:opacity-100 transition-all duration-300 transform translate-y-2 group-hover:translate-y-0">
                        Explore products
                    </p>
                    
                    <!-- Hover Effect Background -->
                    <div class="absolute inset-0 bg-gradient-to-br from-primary-500/10 to-secondary-500/10 rounded-2xl opacity-0 group-hover:opacity-100 transition-opacity duration-300"></div>
                </a>
            @endforeach
        </div>
    </div>
    
    <!-- Floating Elements -->
    <div class="absolute top-16 left-20 w-20 h-20 bg-primary-200 rounded-full opacity-10 float" style="animation-delay: -2s;"></div>
    <div class="absolute bottom-20 right-24 w-16 h-16 bg-secondary-200 rounded-full opacity-10 float" style="animation-delay: -4s;"></div>
</section>

<!-- Testimonials -->
<section class="py-20 relative overflow-hidden">
    <!-- Background -->
    <div class="absolute inset-0 bg-gradient-to-br from-gray-50 to-indigo-50"></div>
    
    <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8 relative z-10">
        <div class="text-center mb-16" data-aos="fade-up">
            <h2 class="text-5xl md:text-6xl font-bold gradient-text mb-6 text-shadow-3d">
                💬 What Our Customers Say
            </h2>
            <p class="text-2xl text-gray-600 max-w-3xl mx-auto">Real reviews from real customers who love their radiant skin transformation</p>
        </div>
        
        <div class="grid grid-cols-1 md:grid-cols-3 gap-8">
            @foreach($testimonials as $testimonial)
                <div class="testimonial-card p-8 group" data-aos="fade-up" data-aos-delay="{{ $loop->index * 200 }}">
                    <!-- Quote Icon -->
                    <div class="text-6xl text-primary-200 mb-4 group-hover:text-primary-300 transition-colors duration-300">
                        <i class="fas fa-quote-left"></i>
                    </div>
                    
                    <p class="text-gray-700 text-lg italic mb-6 leading-relaxed group-hover:text-gray-900 transition-colors duration-300">
                        "{{ $testimonial->message }}"
                    </p>
                    
                    <div class="flex items-center">
                        <div class="relative">
                            @if($testimonial->customer_image)
                                <img src="{{ asset('storage/' . $testimonial->customer_image) }}" alt="{{ $testimonial->customer_name }}" class="w-16 h-16 rounded-full object-cover shadow-lg group-hover:scale-110 transition-all duration-300">
                            @else
                                <img src="https://images.unsplash.com/photo-1494790108755-2616b612b786?w=100&h=100&fit=crop&crop=face" alt="{{ $testimonial->customer_name }}" class="w-16 h-16 rounded-full object-cover shadow-lg group-hover:scale-110 transition-all duration-300">
                            @endif
                            
                            <!-- Verified Badge -->
                            <div class="absolute -bottom-1 -right-1 glass p-1 rounded-full">
                                <i class="fas fa-check text-green-500 text-xs"></i>
                            </div>
                        </div>
                        
                        <div class="ml-4">
                            <h4 class="font-bold text-gray-900 text-lg group-hover:text-primary-600 transition-colors duration-300">
                                {{ $testimonial->customer_name }}
                            </h4>
                            <div class="flex items-center">
                                <div class="text-yellow-400 mr-2">
                                    {!! $testimonial->stars !!}
                                </div>
                                <span class="text-gray-500 text-sm">Verified Customer</span>
                            </div>
                        </div>
                    </div>
                    
                    <!-- Floating Heart -->
                    <div class="absolute top-4 right-4 opacity-0 group-hover:opacity-100 transition-all duration-300 transform scale-0 group-hover:scale-100">
                        <i class="fas fa-heart text-red-400 text-xl pulse-3d"></i>
                    </div>
                </div>
            @endforeach
        </div>
        
        <!-- Trust Indicators -->
        <div class="grid grid-cols-2 md:grid-cols-4 gap-8 mt-16" data-aos="fade-up">
            <div class="glass p-6 rounded-2xl text-center">
                <i class="fas fa-shield-alt text-3xl text-green-500 mb-3 icon-3d"></i>
                <div class="font-bold text-gray-900">100% Safe</div>
                <div class="text-gray-600 text-sm">Dermatologist Tested</div>
            </div>
            <div class="glass p-6 rounded-2xl text-center">
                <i class="fas fa-leaf text-3xl text-green-500 mb-3 icon-3d"></i>
                <div class="font-bold text-gray-900">Natural</div>
                <div class="text-gray-600 text-sm">Organic Ingredients</div>
            </div>
            <div class="glass p-6 rounded-2xl text-center">
                <i class="fas fa-award text-3xl text-yellow-500 mb-3 icon-3d"></i>
                <div class="font-bold text-gray-900">Award Winning</div>
                <div class="text-gray-600 text-sm">Beauty Industry</div>
            </div>
            <div class="glass p-6 rounded-2xl text-center">
                <i class="fas fa-shipping-fast text-3xl text-blue-500 mb-3 icon-3d"></i>
                <div class="font-bold text-gray-900">Fast Delivery</div>
                <div class="text-gray-600 text-sm">2-3 Business Days</div>
            </div>
        </div>
    </div>
    
    <!-- Floating Elements -->
    <div class="absolute top-24 right-16 w-18 h-18 bg-pink-200 rounded-full opacity-15 float" style="animation-delay: -1s;"></div>
    <div class="absolute bottom-28 left-20 w-14 h-14 bg-blue-200 rounded-full opacity-15 float" style="animation-delay: -3s;"></div>
</section>

<!-- Contact Section -->
<section class="py-20 relative overflow-hidden">
    <!-- Background -->
    <div class="absolute inset-0 bg-gradient-to-br from-primary-600 via-purple-700 to-secondary-600"></div>
    <div class="absolute inset-0 bg-black/20"></div>
    
    <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8 relative z-10">
        <div class="text-center text-white" data-aos="fade-up">
            <h2 class="text-5xl md:text-6xl font-bold mb-6 text-shadow-3d">
                📞 Get in Touch
            </h2>
            <p class="text-2xl mb-12 max-w-3xl mx-auto text-shadow-3d">Have questions about our products? We're here to help you achieve your best skin!</p>
            
            <div class="grid grid-cols-1 md:grid-cols-3 gap-8 mb-12">
                <div class="glass p-8 rounded-2xl text-center group hover:scale-105 transition-all duration-300">
                    <div class="glass p-4 rounded-full w-20 h-20 mx-auto mb-6 flex items-center justify-center group-hover:scale-110 transition-all duration-300">
                        <i class="fas fa-map-marker-alt text-3xl text-white icon-3d"></i>
                    </div>
                    <h3 class="text-xl font-bold mb-3 text-shadow-3d">Visit Us</h3>
                    <p class="text-white/90">123 Beauty Street<br>Skincare City, SC 12345</p>
                </div>
                
                <div class="glass p-8 rounded-2xl text-center group hover:scale-105 transition-all duration-300">
                    <div class="glass p-4 rounded-full w-20 h-20 mx-auto mb-6 flex items-center justify-center group-hover:scale-110 transition-all duration-300">
                        <i class="fas fa-phone text-3xl text-white icon-3d"></i>
                    </div>
                    <h3 class="text-xl font-bold mb-3 text-shadow-3d">Call Us</h3>
                    <p class="text-white/90">+1 (555) 123-4567<br>Mon-Fri: 9AM-6PM</p>
                </div>
                
                <div class="glass p-8 rounded-2xl text-center group hover:scale-105 transition-all duration-300">
                    <div class="glass p-4 rounded-full w-20 h-20 mx-auto mb-6 flex items-center justify-center group-hover:scale-110 transition-all duration-300">
                        <i class="fas fa-envelope text-3xl text-white icon-3d"></i>
                    </div>
                    <h3 class="text-xl font-bold mb-3 text-shadow-3d">Email Us</h3>
                    <p class="text-white/90">info@blizz.com<br>support@blizz.com</p>
                </div>
            </div>
            
            <div class="flex flex-col sm:flex-row gap-6 justify-center items-center">
                <a href="{{ route('contact') }}" class="btn-3d text-lg px-12 py-4 bg-white text-primary-600 hover:bg-gray-100">
                    <i class="fas fa-paper-plane mr-3"></i>Contact Us Now
                </a>
                <button class="glass px-8 py-4 rounded-full text-white font-semibold hover:scale-105 transition-all duration-300 border border-white/30">
                    <i class="fas fa-calendar mr-3"></i>Book Consultation
                </button>
            </div>
        </div>
    </div>
    
    <!-- Floating Elements -->
    <div class="absolute top-20 left-16 w-24 h-24 bg-white/10 rounded-full blur-xl float" style="animation-delay: -1s;"></div>
    <div class="absolute top-40 right-20 w-20 h-20 bg-white/10 rounded-full blur-lg float" style="animation-delay: -3s;"></div>
    <div class="absolute bottom-32 left-1/4 w-16 h-16 bg-white/10 rounded-full blur-lg float" style="animation-delay: -2s;"></div>
    <div class="absolute bottom-20 right-1/3 w-18 h-18 bg-white/10 rounded-full blur-xl float" style="animation-delay: -4s;"></div>
</section>

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
