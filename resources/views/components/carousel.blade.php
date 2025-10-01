{{-- Product Carousel Component --}}
<div class="grid grid-cols-3 gap-10 animate-fade-in animation-delay-800" id="product-carousel">
    {{-- Product 1 - Ayurvedic Face Cream --}}
    <div class="carousel-item cursor-pointer space-y-3 hover:scale-105 transition-all"
         data-product-id="1"
         data-title="Ayurvedic Face Cream"
         data-description="Premium natural face cream enriched with ancient herbs and modern science for radiant, healthy skin"
         data-price="Rs 1,299"
         data-bg-color="#68875A"
         data-modal-text="Natural"
         data-image="{{ asset('images/products/2.png') }}">
        <div class="flex justify-center">
            <img src="{{ asset('images/products/2.png') }}" 
                 alt="Ayurvedic Face Cream" 
                 class="w-[80px] img-shadow opacity-100 scale-110 product-thumb">
        </div>
        <div class="!mt-6 space-y-1 text-center">
            <p class="text-base line-through opacity-50">Rs 1,599</p>
            <p class="text-xl font-bold">Rs 1,299</p>
        </div>
    </div>
    
    {{-- Product 2 - Herbal Serum --}}
    <div class="carousel-item cursor-pointer space-y-3 hover:scale-105 transition-all"
         data-product-id="2"
         data-title="Herbal Glow Serum"
         data-description="Luxurious herbal serum with gold particles and saffron extract for ultimate skin rejuvenation"
         data-price="Rs 2,499"
         data-bg-color="#E3B43C"
         data-modal-text="Premium"
         data-image="{{ asset('images/products/3.png') }}">
        <div class="flex justify-center">
            <img src="{{ asset('images/products/3.png') }}" 
                 alt="Herbal Glow Serum" 
                 class="w-[80px] img-shadow opacity-50 product-thumb">
        </div>
        <div class="!mt-6 space-y-1 text-center">
            <p class="text-base line-through opacity-50">Rs 2,999</p>
            <p class="text-xl font-bold">Rs 2,499</p>
        </div>
    </div>
    
    {{-- Product 3 - Ayurvedic Oil --}}
    <div class="carousel-item cursor-pointer space-y-3 hover:scale-105 transition-all"
         data-product-id="3"
         data-title="Sacred Beauty Oil"
         data-description="Traditional Ayurvedic oil blend with 21 herbs for deep nourishment and healing"
         data-price="Rs 1,899"
         data-bg-color="#304F27"
         data-modal-text="Healing"
         data-image="{{ asset('images/products/2.png') }}">
        <div class="flex justify-center">
            <img src="{{ asset('images/products/2.png') }}" 
                 alt="Sacred Beauty Oil" 
                 class="w-[80px] img-shadow opacity-50 product-thumb">
        </div>
        <div class="!mt-6 space-y-1 text-center">
            <p class="text-base line-through opacity-50">Rs 2,199</p>
            <p class="text-xl font-bold">Rs 1,899</p>
        </div>
    </div>
</div>

