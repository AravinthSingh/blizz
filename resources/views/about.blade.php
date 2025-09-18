@extends('layouts.app')

@section('title', 'About Us')

@section('content')
<!-- Ayurvedic About Hero Section -->
<section class="relative py-20 overflow-hidden">
    <div class="absolute inset-0 bg-gradient-to-br from-primary-900 via-earth-800 to-secondary-900"></div>
    <div class="absolute inset-0 bg-gradient-to-tr from-primary-600/30 to-secondary-600/20"></div>
    
    <!-- Floating Elements -->
    <div class="absolute top-10 left-10 w-32 h-32 bg-primary-400/20 rounded-full blur-xl float" style="animation-delay: -1s;"></div>
    <div class="absolute top-40 right-20 w-24 h-24 bg-secondary-400/20 rounded-full blur-lg float" style="animation-delay: -3s;"></div>
    <div class="absolute bottom-20 left-1/4 w-20 h-20 bg-earth-400/20 rounded-full blur-lg float" style="animation-delay: -2s;"></div>
    <div class="absolute bottom-10 right-10 w-28 h-28 bg-primary-300/20 rounded-full blur-xl float" style="animation-delay: -4s;"></div>
    
    <div class="relative z-10 max-w-6xl mx-auto px-4 sm:px-6 lg:px-8 text-center">
        <div class="glass p-12 rounded-3xl breathe" data-aos="fade-up">
            <h1 class="text-5xl md:text-7xl font-bold mb-6 gradient-text">
                🌿 Our Ayurvedic Journey
            </h1>
            <p class="text-xl md:text-2xl text-white/90 mb-8 max-w-4xl mx-auto leading-relaxed">
                Bridging ancient Ayurvedic wisdom with modern skincare science to bring you the purest, most effective natural beauty solutions
            </p>
            
            <div class="flex flex-col sm:flex-row gap-6 justify-center items-center">
                <div class="glass px-8 py-4 rounded-full border border-white/30">
                    <span class="text-white font-semibold">🕉️ Est. 2020</span>
                </div>
                <div class="glass px-8 py-4 rounded-full border border-white/30">
                    <span class="text-white font-semibold">🌱 100% Natural</span>
                </div>
                <div class="glass px-8 py-4 rounded-full border border-white/30">
                    <span class="text-white font-semibold">🧘‍♀️ Holistic Wellness</span>
                </div>
            </div>
        </div>
    </div>
</section>

<!-- Our Story Section -->
<section class="py-16 bg-gradient-to-br from-primary-50 to-secondary-50">
    <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8">
        <div class="grid grid-cols-1 lg:grid-cols-2 gap-12 items-center">
            <div data-aos="fade-right">
                <div class="glass rounded-3xl p-8 border border-primary-200">
                    <div class="w-20 h-20 bg-gradient-to-r from-primary-500 to-secondary-500 rounded-3xl flex items-center justify-center mb-6">
                        <i class="fas fa-leaf text-white text-2xl"></i>
                    </div>
                    <h2 class="text-4xl font-bold gradient-text mb-6">Our Story</h2>
                    <p class="text-earth-600 text-lg leading-relaxed mb-6">
                        Founded in 2020 by a team of Ayurvedic practitioners and skincare enthusiasts, Blizz Ayurveda was born from a simple belief: nature holds the key to radiant, healthy skin.
                    </p>
                    <p class="text-earth-600 text-lg leading-relaxed mb-6">
                        Our journey began when our founder, Dr. Priya Sharma, discovered the transformative power of traditional Ayurvedic formulations during her studies in Kerala, India. Witnessing the remarkable results of these time-tested remedies, she was inspired to bring authentic Ayurvedic skincare to the modern world.
                    </p>
                    <p class="text-earth-600 text-lg leading-relaxed">
                        Today, we continue to honor these ancient traditions while incorporating modern scientific research to create products that deliver visible results while nurturing your skin's natural balance.
                    </p>
                </div>
            </div>
            
            <div data-aos="fade-left">
                <div class="relative">
                    <div class="glass rounded-3xl p-8 border border-secondary-200">
                        <div class="grid grid-cols-2 gap-6">
                            <div class="text-center">
                                <div class="text-4xl font-bold gradient-text mb-2">5000+</div>
                                <div class="text-earth-600 font-semibold">Years of Wisdom</div>
                            </div>
                            <div class="text-center">
                                <div class="text-4xl font-bold gradient-text mb-2">50K+</div>
                                <div class="text-earth-600 font-semibold">Happy Customers</div>
                            </div>
                            <div class="text-center">
                                <div class="text-4xl font-bold gradient-text mb-2">100%</div>
                                <div class="text-earth-600 font-semibold">Natural Ingredients</div>
                            </div>
                            <div class="text-center">
                                <div class="text-4xl font-bold gradient-text mb-2">25+</div>
                                <div class="text-earth-600 font-semibold">Premium Products</div>
                            </div>
                        </div>
                    </div>
                    
                    <!-- Floating testimonial -->
                    <div class="absolute -bottom-6 -right-6 glass rounded-2xl p-4 border border-earth-200 max-w-xs">
                        <div class="flex items-center mb-2">
                            @for($i = 1; $i <= 5; $i++)
                                <i class="fas fa-star text-secondary-500 text-sm"></i>
                            @endfor
                        </div>
                        <p class="text-earth-700 text-sm italic">"Blizz Ayurveda transformed my skin completely. The natural glow is incredible!"</p>
                        <p class="text-earth-500 text-xs mt-2">- Sarah M., Verified Customer</p>
                    </div>
                </div>
            </div>
        </div>
    </div>
</section>

<!-- Our Mission & Values -->
<section class="py-16 bg-white">
    <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8">
        <div class="text-center mb-16" data-aos="fade-up">
            <h2 class="text-4xl font-bold gradient-text mb-4">Our Mission & Values</h2>
            <p class="text-earth-600 text-lg max-w-3xl mx-auto">
                We're committed to bringing you the finest Ayurvedic skincare products while honoring traditional practices and protecting our planet
            </p>
        </div>

        <div class="grid grid-cols-1 md:grid-cols-3 gap-8">
            <div class="glass rounded-3xl p-8 border border-primary-200 text-center hover:shadow-2xl transition-all duration-500" data-aos="fade-up" data-aos-delay="100">
                <div class="w-20 h-20 bg-gradient-to-r from-primary-500 to-primary-600 rounded-3xl flex items-center justify-center mx-auto mb-6">
                    <i class="fas fa-spa text-white text-2xl"></i>
                </div>
                <h3 class="text-2xl font-bold text-earth-800 mb-4">Authentic Ayurveda</h3>
                <p class="text-earth-600 leading-relaxed">
                    We source authentic herbs and follow traditional Ayurvedic principles to create products that honor this ancient science of life and wellness.
                </p>
            </div>

            <div class="glass rounded-3xl p-8 border border-secondary-200 text-center hover:shadow-2xl transition-all duration-500" data-aos="fade-up" data-aos-delay="200">
                <div class="w-20 h-20 bg-gradient-to-r from-secondary-500 to-secondary-600 rounded-3xl flex items-center justify-center mx-auto mb-6">
                    <i class="fas fa-leaf text-white text-2xl"></i>
                </div>
                <h3 class="text-2xl font-bold text-earth-800 mb-4">Sustainable Beauty</h3>
                <p class="text-earth-600 leading-relaxed">
                    Our commitment to sustainability extends from eco-friendly packaging to supporting organic farming practices that protect our environment.
                </p>
            </div>

            <div class="glass rounded-3xl p-8 border border-earth-200 text-center hover:shadow-2xl transition-all duration-500" data-aos="fade-up" data-aos-delay="300">
                <div class="w-20 h-20 bg-gradient-to-r from-earth-500 to-earth-600 rounded-3xl flex items-center justify-center mx-auto mb-6">
                    <i class="fas fa-heart text-white text-2xl"></i>
                </div>
                <h3 class="text-2xl font-bold text-earth-800 mb-4">Holistic Wellness</h3>
                <p class="text-earth-600 leading-relaxed">
                    We believe true beauty comes from within. Our products support not just healthy skin, but overall well-being and inner radiance.
                </p>
            </div>
        </div>
    </div>
</section>

<!-- Our Team Section -->
<section class="py-16 bg-gradient-to-br from-secondary-50 to-earth-50">
    <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8">
        <div class="text-center mb-16" data-aos="fade-up">
            <h2 class="text-4xl font-bold gradient-text mb-4">Meet Our Experts</h2>
            <p class="text-earth-600 text-lg max-w-3xl mx-auto">
                Our team combines traditional Ayurvedic knowledge with modern skincare expertise to bring you the best of both worlds
            </p>
        </div>

        <div class="grid grid-cols-1 md:grid-cols-3 gap-8">
            <div class="glass rounded-3xl overflow-hidden border border-primary-200 hover:shadow-2xl transition-all duration-500" data-aos="fade-up" data-aos-delay="100">
                <div class="h-64 bg-gradient-to-br from-primary-200 to-secondary-200 flex items-center justify-center">
                    <div class="text-center">
                        <div class="w-24 h-24 bg-gradient-to-r from-primary-500 to-secondary-500 rounded-full flex items-center justify-center mx-auto mb-4">
                            <i class="fas fa-user-md text-white text-2xl"></i>
                        </div>
                        <p class="text-primary-700 font-semibold">Dr. Priya Sharma</p>
                    </div>
                </div>
                <div class="p-6">
                    <h3 class="text-xl font-bold text-earth-800 mb-2">Dr. Priya Sharma</h3>
                    <p class="text-secondary-600 font-semibold mb-3">Founder & Chief Ayurvedic Officer</p>
                    <p class="text-earth-600 text-sm leading-relaxed">
                        With over 15 years of experience in Ayurvedic medicine and a PhD in Traditional Medicine from Kerala University, Dr. Sharma leads our product development with authentic wisdom.
                    </p>
                </div>
            </div>

            <div class="glass rounded-3xl overflow-hidden border border-secondary-200 hover:shadow-2xl transition-all duration-500" data-aos="fade-up" data-aos-delay="200">
                <div class="h-64 bg-gradient-to-br from-secondary-200 to-earth-200 flex items-center justify-center">
                    <div class="text-center">
                        <div class="w-24 h-24 bg-gradient-to-r from-secondary-500 to-earth-500 rounded-full flex items-center justify-center mx-auto mb-4">
                            <i class="fas fa-flask text-white text-2xl"></i>
                        </div>
                        <p class="text-secondary-700 font-semibold">Dr. Michael Chen</p>
                    </div>
                </div>
                <div class="p-6">
                    <h3 class="text-xl font-bold text-earth-800 mb-2">Dr. Michael Chen</h3>
                    <p class="text-secondary-600 font-semibold mb-3">Head of Research & Development</p>
                    <p class="text-earth-600 text-sm leading-relaxed">
                        A biochemist with 12 years in cosmetic science, Dr. Chen ensures our traditional formulations meet modern safety and efficacy standards.
                    </p>
                </div>
            </div>

            <div class="glass rounded-3xl overflow-hidden border border-earth-200 hover:shadow-2xl transition-all duration-500" data-aos="fade-up" data-aos-delay="300">
                <div class="h-64 bg-gradient-to-br from-earth-200 to-primary-200 flex items-center justify-center">
                    <div class="text-center">
                        <div class="w-24 h-24 bg-gradient-to-r from-earth-500 to-primary-500 rounded-full flex items-center justify-center mx-auto mb-4">
                            <i class="fas fa-seedling text-white text-2xl"></i>
                        </div>
                        <p class="text-earth-700 font-semibold">Anjali Patel</p>
                    </div>
                </div>
                <div class="p-6">
                    <h3 class="text-xl font-bold text-earth-800 mb-2">Anjali Patel</h3>
                    <p class="text-secondary-600 font-semibold mb-3">Sustainability Director</p>
                    <p class="text-earth-600 text-sm leading-relaxed">
                        An environmental scientist passionate about sustainable beauty, Anjali ensures our practices protect the planet while delivering exceptional products.
                    </p>
                </div>
            </div>
        </div>
    </div>
</section>

<!-- Our Process Section -->
<section class="py-16 bg-white">
    <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8">
        <div class="text-center mb-16" data-aos="fade-up">
            <h2 class="text-4xl font-bold gradient-text mb-4">Our Ayurvedic Process</h2>
            <p class="text-earth-600 text-lg max-w-3xl mx-auto">
                From ancient wisdom to modern application, discover how we create products that honor tradition while delivering results
            </p>
        </div>

        <div class="grid grid-cols-1 md:grid-cols-4 gap-8">
            <div class="text-center" data-aos="fade-up" data-aos-delay="100">
                <div class="relative mb-6">
                    <div class="w-20 h-20 bg-gradient-to-r from-primary-500 to-primary-600 rounded-full flex items-center justify-center mx-auto">
                        <i class="fas fa-search text-white text-2xl"></i>
                    </div>
                    <div class="absolute -top-2 -right-2 w-8 h-8 bg-secondary-500 rounded-full flex items-center justify-center">
                        <span class="text-white font-bold text-sm">1</span>
                    </div>
                </div>
                <h3 class="text-xl font-bold text-earth-800 mb-3">Research & Sourcing</h3>
                <p class="text-earth-600 text-sm leading-relaxed">
                    We research ancient Ayurvedic texts and source the finest organic herbs from certified farms across India.
                </p>
            </div>

            <div class="text-center" data-aos="fade-up" data-aos-delay="200">
                <div class="relative mb-6">
                    <div class="w-20 h-20 bg-gradient-to-r from-secondary-500 to-secondary-600 rounded-full flex items-center justify-center mx-auto">
                        <i class="fas fa-mortar-pestle text-white text-2xl"></i>
                    </div>
                    <div class="absolute -top-2 -right-2 w-8 h-8 bg-earth-500 rounded-full flex items-center justify-center">
                        <span class="text-white font-bold text-sm">2</span>
                    </div>
                </div>
                <h3 class="text-xl font-bold text-earth-800 mb-3">Traditional Preparation</h3>
                <p class="text-earth-600 text-sm leading-relaxed">
                    Our master formulators prepare ingredients using time-honored Ayurvedic methods to preserve their potency.
                </p>
            </div>

            <div class="text-center" data-aos="fade-up" data-aos-delay="300">
                <div class="relative mb-6">
                    <div class="w-20 h-20 bg-gradient-to-r from-earth-500 to-earth-600 rounded-full flex items-center justify-center mx-auto">
                        <i class="fas fa-microscope text-white text-2xl"></i>
                    </div>
                    <div class="absolute -top-2 -right-2 w-8 h-8 bg-primary-500 rounded-full flex items-center justify-center">
                        <span class="text-white font-bold text-sm">3</span>
                    </div>
                </div>
                <h3 class="text-xl font-bold text-earth-800 mb-3">Modern Testing</h3>
                <p class="text-earth-600 text-sm leading-relaxed">
                    Every batch undergoes rigorous testing for purity, potency, and safety using advanced laboratory techniques.
                </p>
            </div>

            <div class="text-center" data-aos="fade-up" data-aos-delay="400">
                <div class="relative mb-6">
                    <div class="w-20 h-20 bg-gradient-to-r from-green-500 to-green-600 rounded-full flex items-center justify-center mx-auto">
                        <i class="fas fa-heart text-white text-2xl"></i>
                    </div>
                    <div class="absolute -top-2 -right-2 w-8 h-8 bg-secondary-500 rounded-full flex items-center justify-center">
                        <span class="text-white font-bold text-sm">4</span>
                    </div>
                </div>
                <h3 class="text-xl font-bold text-earth-800 mb-3">Loving Delivery</h3>
                <p class="text-earth-600 text-sm leading-relaxed">
                    Products are carefully packaged with love and delivered to your doorstep, ready to transform your skincare routine.
                </p>
            </div>
        </div>
    </div>
</section>

<!-- Certifications & Awards -->
<section class="py-16 bg-gradient-to-br from-primary-50 to-earth-50">
    <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8">
        <div class="text-center mb-16" data-aos="fade-up">
            <h2 class="text-4xl font-bold gradient-text mb-4">Certifications & Recognition</h2>
            <p class="text-earth-600 text-lg max-w-3xl mx-auto">
                Our commitment to quality and authenticity is recognized by leading organizations worldwide
            </p>
        </div>

        <div class="grid grid-cols-2 md:grid-cols-4 gap-8">
            <div class="glass rounded-2xl p-6 text-center border border-primary-200" data-aos="fade-up" data-aos-delay="100">
                <div class="w-16 h-16 bg-gradient-to-r from-green-500 to-green-600 rounded-2xl flex items-center justify-center mx-auto mb-4">
                    <i class="fas fa-leaf text-white text-xl"></i>
                </div>
                <h4 class="font-bold text-earth-800 mb-2">USDA Organic</h4>
                <p class="text-earth-600 text-sm">Certified organic ingredients</p>
            </div>

            <div class="glass rounded-2xl p-6 text-center border border-secondary-200" data-aos="fade-up" data-aos-delay="200">
                <div class="w-16 h-16 bg-gradient-to-r from-blue-500 to-blue-600 rounded-2xl flex items-center justify-center mx-auto mb-4">
                    <i class="fas fa-award text-white text-xl"></i>
                </div>
                <h4 class="font-bold text-earth-800 mb-2">Cruelty-Free</h4>
                <p class="text-earth-600 text-sm">Never tested on animals</p>
            </div>

            <div class="glass rounded-2xl p-6 text-center border border-earth-200" data-aos="fade-up" data-aos-delay="300">
                <div class="w-16 h-16 bg-gradient-to-r from-purple-500 to-purple-600 rounded-2xl flex items-center justify-center mx-auto mb-4">
                    <i class="fas fa-certificate text-white text-xl"></i>
                </div>
                <h4 class="font-bold text-earth-800 mb-2">Ayush Certified</h4>
                <p class="text-earth-600 text-sm">Authentic Ayurvedic formulations</p>
            </div>

            <div class="glass rounded-2xl p-6 text-center border border-primary-200" data-aos="fade-up" data-aos-delay="400">
                <div class="w-16 h-16 bg-gradient-to-r from-yellow-500 to-yellow-600 rounded-2xl flex items-center justify-center mx-auto mb-4">
                    <i class="fas fa-star text-white text-xl"></i>
                </div>
                <h4 class="font-bold text-earth-800 mb-2">Beauty Awards</h4>
                <p class="text-earth-600 text-sm">Best Natural Skincare 2023</p>
            </div>
        </div>
    </div>
</section>

<!-- Call to Action -->
<section class="py-16 bg-gradient-to-r from-primary-600 to-secondary-600 relative overflow-hidden">
    <div class="absolute inset-0 bg-gradient-to-tr from-primary-900/50 to-secondary-900/30"></div>
    
    <!-- Floating Elements -->
    <div class="absolute top-10 left-10 w-20 h-20 bg-white/10 rounded-full blur-xl float"></div>
    <div class="absolute bottom-10 right-10 w-16 h-16 bg-white/10 rounded-full blur-lg float" style="animation-delay: -2s;"></div>
    
    <div class="relative z-10 max-w-4xl mx-auto px-4 sm:px-6 lg:px-8 text-center">
        <div class="glass p-12 rounded-3xl border border-white/20" data-aos="fade-up">
            <h2 class="text-4xl md:text-5xl font-bold text-white mb-6">
                🌿 Begin Your Ayurvedic Journey
            </h2>
            <p class="text-xl text-white/90 mb-8 leading-relaxed">
                Experience the transformative power of authentic Ayurvedic skincare. Your skin deserves the wisdom of nature.
            </p>
            
            <div class="flex flex-col sm:flex-row gap-4 justify-center">
                <a href="{{ route('products') }}" class="btn-ayurveda px-8 py-4 bg-white text-primary-600 hover:bg-white/90 text-lg">
                    <i class="fas fa-spa mr-3"></i>Explore Products
                </a>
                <a href="{{ route('contact') }}" class="glass px-8 py-4 rounded-2xl text-white font-semibold hover:bg-white/10 transition-all duration-300 border border-white/30 text-lg">
                    <i class="fas fa-comments mr-3"></i>Get Consultation
                </a>
            </div>
        </div>
    </div>
</section>

<script>
// Add smooth scrolling animation for process steps
const processSteps = document.querySelectorAll('[data-aos-delay]');
processSteps.forEach((step, index) => {
    step.addEventListener('mouseenter', function() {
        this.style.transform = 'translateY(-10px) scale(1.05)';
    });
    
    step.addEventListener('mouseleave', function() {
        this.style.transform = 'translateY(0) scale(1)';
    });
});

// Add floating animation to team cards
document.querySelectorAll('.glass').forEach((card, index) => {
    card.style.animationDelay = `${index * 0.2}s`;
});
</script>
@endsection
