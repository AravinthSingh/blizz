{{-- Unified Hero Component with Integrated Carousel --}}
<div id="hero-section" class="min-h-screen relative overflow-hidden transition-all duration-700" style="background-color: #68875A;">
    <!-- Animated Background Pattern -->
    <div class="absolute inset-0 opacity-10">
        <div class="absolute top-0 left-0 w-96 h-96 bg-white rounded-full mix-blend-overlay filter blur-3xl animate-pulse"></div>
        <div class="absolute bottom-0 right-0 w-96 h-96 bg-secondary-400 rounded-full mix-blend-overlay filter blur-3xl animate-pulse animation-delay-200"></div>
    </div>
    
    <!-- Background Text Modal -->
    <div id="bg-text" class="absolute top-1/2 left-1/2 transform -translate-x-1/2 -translate-y-1/2 text-[15rem] md:text-[20rem] font-black opacity-5 text-white select-none animate-fade-in pointer-events-none">
        Natural
    </div>
    
    <!-- Hero Content -->
    <div class="container mx-auto px-4 py-8 relative z-10">
        <div class="grid grid-cols-1 lg:grid-cols-2 gap-8 items-center min-h-[70vh]">
            <!-- Left Content -->
            <div class="space-y-6 order-2 lg:order-1">
                <div class="space-y-4">
                    <span class="inline-block px-4 py-2 bg-white/20 backdrop-blur rounded-full text-white text-sm font-semibold animate-slide-right">
                        🌿 100% Natural Ingredients
                    </span>
                    <h1 id="product-title" class="text-4xl md:text-6xl lg:text-7xl font-bold text-white animate-slide-right leading-tight">
                        Ayurvedic Face Cream
                    </h1>
                    <p id="product-description" class="text-lg md:text-xl text-white/90 animate-slide-right animation-delay-200 leading-relaxed">
                        Premium natural face cream enriched with ancient herbs and modern science for radiant, healthy skin
                    </p>
                </div>
                
                <div class="flex flex-wrap gap-4 animate-slide-right animation-delay-400">
                    <button id="order-button" class="px-8 py-4 bg-white font-bold rounded-full hover:scale-105 transition-all shadow-2xl flex items-center gap-2" style="color: #68875A;">
                        <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="1.5" stroke="currentColor" class="w-5 h-5">
                            <path stroke-linecap="round" stroke-linejoin="round" d="M2.25 3h1.386c.51 0 .955.343 1.087.835l.383 1.437M7.5 14.25a3 3 0 00-3 3h15.75m-12.75-3h11.218c1.121-2.3 2.1-4.684 2.924-7.138a60.114 60.114 0 00-16.536-1.84M7.5 14.25L5.106 5.272M6 20.25a.75.75 0 11-1.5 0 .75.75 0 011.5 0zm12.75 0a.75.75 0 11-1.5 0 .75.75 0 011.5 0z" />
                        </svg>
                        ORDER NOW
                    </button>
                    <button class="px-8 py-4 border-2 border-white text-white font-bold rounded-full hover:bg-white/10 transition-all">
                        LEARN MORE
                    </button>
                </div>
                
                <!-- Product Features -->
                <div class="flex flex-wrap gap-6 mt-8 animate-fade-in animation-delay-600">
                    <div class="flex items-center gap-2 text-white/80">
                        <svg class="w-5 h-5" fill="currentColor" viewBox="0 0 20 20">
                            <path fill-rule="evenodd" d="M10 18a8 8 0 100-16 8 8 0 000 16zm3.707-9.293a1 1 0 00-1.414-1.414L9 10.586 7.707 9.293a1 1 0 00-1.414 1.414l2 2a1 1 0 001.414 0l4-4z" clip-rule="evenodd" />
                        </svg>
                        <span>Organic Certified</span>
                    </div>
                    <div class="flex items-center gap-2 text-white/80">
                        <svg class="w-5 h-5" fill="currentColor" viewBox="0 0 20 20">
                            <path fill-rule="evenodd" d="M10 18a8 8 0 100-16 8 8 0 000 16zm3.707-9.293a1 1 0 00-1.414-1.414L9 10.586 7.707 9.293a1 1 0 00-1.414 1.414l2 2a1 1 0 001.414 0l4-4z" clip-rule="evenodd" />
                        </svg>
                        <span>Cruelty Free</span>
                    </div>
                    <div class="flex items-center gap-2 text-white/80">
                        <svg class="w-5 h-5" fill="currentColor" viewBox="0 0 20 20">
                            <path fill-rule="evenodd" d="M10 18a8 8 0 100-16 8 8 0 000 16zm3.707-9.293a1 1 0 00-1.414-1.414L9 10.586 7.707 9.293a1 1 0 00-1.414 1.414l2 2a1 1 0 001.414 0l4-4z" clip-rule="evenodd" />
                        </svg>
                        <span>5000+ Years Legacy</span>
                    </div>
                </div>
            </div>
            
            <!-- Right Content - Hero Image -->
            <div class="relative order-1 lg:order-2">
                <div class="relative mx-auto max-w-md lg:max-w-lg">
                    <!-- Glow Effect -->
                    <div class="absolute inset-0 bg-gradient-to-r from-yellow-400 to-orange-400 rounded-full filter blur-3xl opacity-20 animate-pulse"></div>
                    
                    <!-- Product Image -->
                    <img id="hero-image" 
                         src="{{ asset('images/products/2.png') }}" 
                         alt="Premium Ayurvedic Product" 
                         class="relative w-full h-auto animate-slide-left img-shadow transform hover:scale-105 transition-transform duration-500">
                </div>
            </div>
        </div>
        
        <!-- Product Carousel Section -->
        <div class="mt-16 pb-8">
            <div class="text-center mb-8 animate-fade-in animation-delay-800">
                <h3 class="text-2xl font-bold text-white mb-2">Choose Your Product</h3>
                <p class="text-white/70">Click on any product below to explore</p>
            </div>
            
            <!-- Carousel Component -->
            @include('components.carousel')
        </div>
    </div>
</div>
