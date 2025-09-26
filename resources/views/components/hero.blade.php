<!-- Premium 3D Slider Hero Component -->
<section id="premiumHeroSlider" class="hero-3d-slider relative h-screen w-full overflow-hidden">
    
    <!-- Slider Container -->
    <div class="slider-container relative h-full w-full">
        
        <!-- Slide 1 - Green Theme -->
        <div class="slide active absolute inset-0 w-full h-full" data-slide="1">
            <!-- Background Layer with 3D Depth -->
            <div class="bg-layer absolute inset-0 transform-gpu scale-110 transition-transform duration-1500">
                <img src="{{ asset('images/BG/Green.jpg') }}" alt="Green Background" 
                     class="w-full h-full object-cover">
                <div class="absolute inset-0 bg-gradient-to-br from-primary-900/70 via-primary-800/50 to-transparent"></div>
            </div>
            
            <!-- Product Layer with 3D Animation -->
            <div class="product-layer absolute inset-0 flex items-center justify-center">
                <div class="product-wrapper transform-gpu translate-z-50 perspective-1000">
                    <img src="{{ asset('images/products/2.png') }}" alt="Premium Ayurvedic Cream"
                         class="product-3d max-w-md w-full h-auto drop-shadow-2xl animate-float-3d">
                </div>
            </div>
            
            <!-- Content Layer with 3D Text -->
            <div class="content-layer absolute inset-0 flex items-center z-20">
                <div class="container mx-auto px-8 lg:px-16">
                    <div class="max-w-2xl">
                        <h1 class="text-3d text-6xl lg:text-8xl font-bold text-white mb-6 transform-gpu"
                            data-aos="fade-right" data-aos-delay="500">
                            <span class="text-gradient-gold">Premium</span> 
                            <span class="text-shadow-3d">Ayurvedic</span>
                            <span class="block text-5xl lg:text-7xl mt-4">Face Cream</span>
                        </h1>
                        <p class="text-xl lg:text-2xl text-white/90 mb-8 leading-relaxed transform-gpu"
                           data-aos="fade-right" data-aos-delay="700">
                            Unlock the ancient secrets of radiant skin with our luxury collection 
                            infused with pure herbs and natural gold essence.
                        </p>
                        <button class="btn-premium-3d group" data-aos="zoom-in" data-aos-delay="900">
                            <span class="relative z-10 flex items-center">
                                <i class="fas fa-shopping-cart mr-3"></i>
                                Buy Now
                                <i class="fas fa-arrow-right ml-3 transform group-hover:translate-x-2 transition-transform"></i>
                            </span>
                        </button>
                    </div>
                </div>
            </div>
        </div>
        
        <!-- Slide 2 - Gold Theme -->
        <div class="slide absolute inset-0 w-full h-full" data-slide="2">
            <!-- Background Layer -->
            <div class="bg-layer absolute inset-0 transform-gpu scale-110 transition-transform duration-1500">
                <img src="{{ asset('images/BG/Gold Fabric Texture_06.jpg') }}" alt="Gold Background"
                     class="w-full h-full object-cover">
                <div class="absolute inset-0 bg-gradient-to-tl from-secondary-900/70 via-secondary-700/50 to-transparent"></div>
            </div>
            
            <!-- Product Layer -->
            <div class="product-layer absolute inset-0 flex items-center justify-center">
                <div class="product-wrapper transform-gpu translate-z-50 perspective-1000">
                    <img src="{{ asset('images/products/3.png') }}" alt="Golden Glow Cream"
                         class="product-3d max-w-md w-full h-auto drop-shadow-2xl animate-float-3d">
                </div>
            </div>
            
            <!-- Content Layer -->
            <div class="content-layer absolute inset-0 flex items-center z-20">
                <div class="container mx-auto px-8 lg:px-16">
                    <div class="max-w-2xl ml-auto text-right">
                        <h1 class="text-3d text-6xl lg:text-8xl font-bold text-white mb-6 transform-gpu">
                            <span class="text-gradient-green">Natural</span>
                            <span class="text-shadow-3d-gold block">Golden Glow</span>
                            <span class="block text-5xl lg:text-7xl mt-4">Collection</span>
                        </h1>
                        <p class="text-xl lg:text-2xl text-white/90 mb-8 leading-relaxed transform-gpu">
                            Experience the luxury of 24K gold particles combined with 
                            traditional Ayurvedic herbs for ultimate skin rejuvenation.
                        </p>
                        <button class="btn-premium-3d-gold group">
                            <span class="relative z-10 flex items-center justify-end">
                                <i class="fas fa-shopping-cart mr-3"></i>
                                Shop Collection
                                <i class="fas fa-arrow-right ml-3 transform group-hover:translate-x-2 transition-transform"></i>
                            </span>
                        </button>
                    </div>
                </div>
            </div>
        </div>
        
    </div>
    
    <!-- Navigation Arrows with 3D Effect -->
    <button id="prevSlide" class="nav-arrow nav-arrow-left group">
        <i class="fas fa-chevron-left text-2xl transform group-hover:-translate-x-1 transition-transform"></i>
    </button>
    <button id="nextSlide" class="nav-arrow nav-arrow-right group">
        <i class="fas fa-chevron-right text-2xl transform group-hover:translate-x-1 transition-transform"></i>
    </button>
    
    <!-- Slide Indicators -->
    <div class="slide-indicators absolute bottom-8 left-1/2 transform -translate-x-1/2 flex space-x-4 z-30">
        <button class="indicator active" data-slide-to="1"></button>
        <button class="indicator" data-slide-to="2"></button>
    </div>
    
</section>

<!-- Premium Slider Styles -->
<style>
/* 3D Slider Base Styles */
.hero-3d-slider {
    perspective: 1500px;
    transform-style: preserve-3d;
}

/* Slide Transitions with 3D Effects */
.slide {
    opacity: 0;
    visibility: hidden;
    transform: translateX(100%) rotateY(45deg) scale(0.8);
    transition: all 1.2s cubic-bezier(0.68, -0.55, 0.265, 1.55);
}

.slide.active {
    opacity: 1;
    visibility: visible;
    transform: translateX(0) rotateY(0) scale(1);
}

.slide.prev {
    transform: translateX(-100%) rotateY(-45deg) scale(0.8);
}

/* 3D Background Layer Animation */
.bg-layer {
    animation: parallaxBg 20s ease-in-out infinite;
}

@keyframes parallaxBg {
    0%, 100% { transform: scale(1.1) translateZ(-100px); }
    50% { transform: scale(1.15) translateZ(-80px); }
}

/* 3D Product Floating Animation */
@keyframes float-3d {
    0%, 100% { 
        transform: translateY(0) rotateY(-10deg) rotateX(5deg);
    }
    25% {
        transform: translateY(-20px) rotateY(10deg) rotateX(-5deg);
    }
    50% {
        transform: translateY(-10px) rotateY(-5deg) rotateX(10deg);
    }
    75% {
        transform: translateY(-25px) rotateY(5deg) rotateX(-10deg);
    }
}

.animate-float-3d {
    animation: float-3d 6s ease-in-out infinite;
    transform-style: preserve-3d;
}

.product-3d {
    filter: drop-shadow(0 40px 60px rgba(0, 0, 0, 0.3))
            drop-shadow(0 20px 30px rgba(0, 0, 0, 0.2));
    transition: transform 0.6s cubic-bezier(0.4, 0, 0.2, 1);
}

.product-wrapper:hover .product-3d {
    transform: scale(1.05) rotateY(15deg);
}

/* Text 3D Effects */
.text-3d {
    transform-style: preserve-3d;
    transform: translateZ(50px);
    text-shadow: 
        0 1px 0 rgba(0,0,0,0.1),
        0 2px 0 rgba(0,0,0,0.1),
        0 3px 0 rgba(0,0,0,0.1),
        0 4px 0 rgba(0,0,0,0.1),
        0 5px 0 rgba(0,0,0,0.1),
        0 6px 20px rgba(0,0,0,0.3),
        0 0 40px rgba(255,255,255,0.2);
}

/* Premium Gold Gradient Text */
.text-gradient-gold {
    background: linear-gradient(135deg, #F8C42E 0%, #E3B43C 50%, #F8C42E 100%);
    -webkit-background-clip: text;
    -webkit-text-fill-color: transparent;
    background-clip: text;
    filter: drop-shadow(0 4px 8px rgba(227, 180, 60, 0.4));
    animation: shimmer 3s ease-in-out infinite;
}

/* Premium Green Gradient Text */
.text-gradient-green {
    background: linear-gradient(135deg, #68875A 0%, #304F27 50%, #68875A 100%);
    -webkit-background-clip: text;
    -webkit-text-fill-color: transparent;
    background-clip: text;
    filter: drop-shadow(0 4px 8px rgba(104, 135, 90, 0.4));
}

@keyframes shimmer {
    0%, 100% { background-position: 0% 50%; }
    50% { background-position: 100% 50%; }
}

/* Enhanced Text Shadows */
.text-shadow-3d {
    text-shadow: 
        0 1px 0 #ccc,
        0 2px 0 #c9c9c9,
        0 3px 0 #bbb,
        0 4px 0 #b9b9b9,
        0 5px 0 #aaa,
        0 6px 1px rgba(0,0,0,.1),
        0 0 5px rgba(0,0,0,.1),
        0 1px 3px rgba(0,0,0,.3),
        0 3px 5px rgba(0,0,0,.2),
        0 5px 10px rgba(0,0,0,.25),
        0 10px 10px rgba(0,0,0,.2),
        0 20px 20px rgba(0,0,0,.15);
}

.text-shadow-3d-gold {
    text-shadow: 
        0 1px 0 #E3B43C,
        0 2px 0 #d4a537,
        0 3px 0 #c59632,
        0 4px 0 #b6872d,
        0 5px 0 #a77828,
        0 6px 1px rgba(227,180,60,.1),
        0 0 5px rgba(248,196,46,.3),
        0 1px 3px rgba(227,180,60,.3),
        0 3px 5px rgba(227,180,60,.2),
        0 5px 10px rgba(227,180,60,.25),
        0 10px 10px rgba(227,180,60,.2),
        0 20px 20px rgba(227,180,60,.15);
}

/* Premium 3D Buttons */
.btn-premium-3d {
    @apply px-10 py-5 text-white font-bold text-lg rounded-full relative overflow-hidden;
    background: linear-gradient(135deg, #68875A 0%, #304F27 100%);
    box-shadow: 
        0 4px 15px rgba(104, 135, 90, 0.4),
        0 10px 40px rgba(48, 79, 39, 0.2),
        inset 0 -4px 10px rgba(0, 0, 0, 0.2);
    transform-style: preserve-3d;
    transform: translateZ(0);
    transition: all 0.3s cubic-bezier(0.4, 0, 0.2, 1);
}

.btn-premium-3d:hover {
    transform: translateY(-3px) translateZ(20px);
    box-shadow: 
        0 8px 25px rgba(104, 135, 90, 0.5),
        0 15px 50px rgba(48, 79, 39, 0.3),
        inset 0 -4px 15px rgba(0, 0, 0, 0.3);
}

.btn-premium-3d::before {
    content: '';
    position: absolute;
    top: 0;
    left: -100%;
    width: 100%;
    height: 100%;
    background: linear-gradient(90deg, transparent, rgba(255,255,255,0.2), transparent);
    transition: left 0.5s;
}

.btn-premium-3d:hover::before {
    left: 100%;
}

.btn-premium-3d-gold {
    @apply px-10 py-5 text-primary-900 font-bold text-lg rounded-full relative overflow-hidden;
    background: linear-gradient(135deg, #F8C42E 0%, #E3B43C 100%);
    box-shadow: 
        0 4px 15px rgba(227, 180, 60, 0.4),
        0 10px 40px rgba(248, 196, 46, 0.2),
        inset 0 -4px 10px rgba(0, 0, 0, 0.1);
    transform-style: preserve-3d;
    transform: translateZ(0);
    transition: all 0.3s cubic-bezier(0.4, 0, 0.2, 1);
}

.btn-premium-3d-gold:hover {
    transform: translateY(-3px) translateZ(20px);
    box-shadow: 
        0 8px 25px rgba(227, 180, 60, 0.5),
        0 15px 50px rgba(248, 196, 46, 0.3),
        inset 0 -4px 15px rgba(0, 0, 0, 0.2);
}

/* Navigation Arrows with 3D Effect */
.nav-arrow {
    @apply absolute top-1/2 transform -translate-y-1/2 z-30 w-16 h-16 flex items-center justify-center rounded-full;
    background: rgba(255, 255, 255, 0.1);
    backdrop-filter: blur(10px);
    border: 2px solid rgba(255, 255, 255, 0.2);
    color: white;
    transition: all 0.3s cubic-bezier(0.4, 0, 0.2, 1);
    box-shadow: 
        0 4px 15px rgba(0, 0, 0, 0.2),
        inset 0 1px 1px rgba(255, 255, 255, 0.2);
}

.nav-arrow:hover {
    background: rgba(255, 255, 255, 0.2);
    transform: translateY(-50%) scale(1.1);
    box-shadow: 
        0 8px 25px rgba(0, 0, 0, 0.3),
        inset 0 1px 1px rgba(255, 255, 255, 0.3);
}

.nav-arrow-left {
    left: 2rem;
}

.nav-arrow-right {
    right: 2rem;
}

/* Slide Indicators with 3D Effect */
.indicator {
    @apply w-16 h-3 rounded-full transition-all duration-300;
    background: rgba(255, 255, 255, 0.3);
    backdrop-filter: blur(5px);
    box-shadow: 
        0 2px 5px rgba(0, 0, 0, 0.2),
        inset 0 1px 1px rgba(255, 255, 255, 0.1);
}

.indicator.active {
    @apply w-24;
    background: linear-gradient(90deg, #F8C42E, #E3B43C);
    box-shadow: 
        0 4px 10px rgba(227, 180, 60, 0.4),
        0 0 20px rgba(248, 196, 46, 0.3);
}

.indicator:hover:not(.active) {
    background: rgba(255, 255, 255, 0.5);
    transform: scale(1.1);
}

/* Responsive Design */
@media (max-width: 768px) {
    .text-3d {
        font-size: 3rem;
    }
    
    .nav-arrow {
        @apply w-12 h-12;
    }
    
    .nav-arrow-left {
        left: 1rem;
    }
    
    .nav-arrow-right {
        right: 1rem;
    }
    
    .product-3d {
        max-width: 300px;
    }
}
</style>

<!-- Premium Slider JavaScript -->
<script>
document.addEventListener('DOMContentLoaded', function() {
    const slider = {
        currentSlide: 1,
        totalSlides: 2,
        isAnimating: false,
        autoPlayInterval: null,
        
        init() {
            this.bindEvents();
            this.startAutoPlay();
            this.preloadImages();
        },
        
        bindEvents() {
            // Navigation arrows
            document.getElementById('prevSlide').addEventListener('click', () => this.prevSlide());
            document.getElementById('nextSlide').addEventListener('click', () => this.nextSlide());
            
            // Indicators
            document.querySelectorAll('.indicator').forEach(indicator => {
                indicator.addEventListener('click', (e) => {
                    const slideTo = parseInt(e.target.dataset.slideTo);
                    this.goToSlide(slideTo);
                });
            });
            
            // Keyboard navigation
            document.addEventListener('keydown', (e) => {
                if (e.key === 'ArrowLeft') this.prevSlide();
                if (e.key === 'ArrowRight') this.nextSlide();
            });
            
            // Touch/swipe support
            let touchStartX = 0;
            let touchEndX = 0;
            
            const sliderContainer = document.querySelector('.slider-container');
            
            sliderContainer.addEventListener('touchstart', (e) => {
                touchStartX = e.touches[0].clientX;
            });
            
            sliderContainer.addEventListener('touchend', (e) => {
                touchEndX = e.changedTouches[0].clientX;
                this.handleSwipe();
            });
            
            sliderContainer.addEventListener('touchmove', (e) => {
                touchEndX = e.touches[0].clientX;
            });
            
            this.handleSwipe = () => {
                if (touchEndX < touchStartX - 50) this.nextSlide();
                if (touchEndX > touchStartX + 50) this.prevSlide();
            };
        },
        
        nextSlide() {
            if (this.isAnimating) return;
            const next = this.currentSlide === this.totalSlides ? 1 : this.currentSlide + 1;
            this.transition(this.currentSlide, next, 'next');
        },
        
        prevSlide() {
            if (this.isAnimating) return;
            const prev = this.currentSlide === 1 ? this.totalSlides : this.currentSlide - 1;
            this.transition(this.currentSlide, prev, 'prev');
        },
        
        goToSlide(slideNumber) {
            if (this.isAnimating || slideNumber === this.currentSlide) return;
            const direction = slideNumber > this.currentSlide ? 'next' : 'prev';
            this.transition(this.currentSlide, slideNumber, direction);
        },
        
        transition(from, to, direction) {
            this.isAnimating = true;
            this.resetAutoPlay();
            
            const currentSlide = document.querySelector(`.slide[data-slide="${from}"]`);
            const nextSlide = document.querySelector(`.slide[data-slide="${to}"]`);
            
            // Prepare next slide
            nextSlide.classList.add(direction === 'next' ? 'next' : 'prev');
            nextSlide.offsetHeight; // Force reflow
            
            // Start transition
            currentSlide.classList.add(direction === 'next' ? 'prev' : 'next');
            currentSlide.classList.remove('active');
            
            nextSlide.classList.remove('next', 'prev');
            nextSlide.classList.add('active');
            
            // Update indicators
            document.querySelector('.indicator.active').classList.remove('active');
            document.querySelector(`.indicator[data-slide-to="${to}"]`).classList.add('active');
            
            // Animate content
            this.animateContent(nextSlide);
            
            this.currentSlide = to;
            
            setTimeout(() => {
                this.isAnimating = false;
            }, 1200);
        },
        
        animateContent(slide) {
            // Animate text elements
            const textElements = slide.querySelectorAll('[data-aos]');
            textElements.forEach((el, index) => {
                el.style.animation = 'none';
                el.offsetHeight; // Force reflow
                el.style.animation = null;
            });
            
            // Animate product
            const product = slide.querySelector('.product-3d');
            if (product) {
                product.style.animation = 'none';
                product.offsetHeight;
                product.style.animation = null;
            }
        },
        
        startAutoPlay() {
            this.autoPlayInterval = setInterval(() => {
                this.nextSlide();
            }, 6000);
        },
        
        resetAutoPlay() {
            clearInterval(this.autoPlayInterval);
            this.startAutoPlay();
        },
        
        preloadImages() {
            // Preload background images
            const images = [
                '{{ asset("images/BG/Green.jpg") }}',
                '{{ asset("images/BG/Gold Fabric Texture_06.jpg") }}',
                '{{ asset("images/products/2.png") }}',
                '{{ asset("images/products/3.png") }}'
            ];
            
            images.forEach(src => {
                const img = new Image();
                img.src = src;
            });
        }
    };
    
    // Initialize slider
    slider.init();
});
</script>