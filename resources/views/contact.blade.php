@extends('layouts.app')

@section('title', 'Contact Us')

@section('content')
<!-- Ayurvedic Contact Hero Section -->
<section class="relative py-20 overflow-hidden">
    <div class="absolute inset-0 bg-gradient-to-br from-primary-900 via-earth-800 to-secondary-900"></div>
    <div class="absolute inset-0 bg-gradient-to-tr from-primary-600/30 to-secondary-600/20"></div>
    
    <!-- Floating Elements -->
    <div class="absolute top-10 left-10 w-24 h-24 bg-primary-400/20 rounded-full blur-xl float" style="animation-delay: -1s;"></div>
    <div class="absolute top-32 right-20 w-20 h-20 bg-secondary-400/20 rounded-full blur-lg float" style="animation-delay: -3s;"></div>
    <div class="absolute bottom-20 left-1/4 w-16 h-16 bg-earth-400/20 rounded-full blur-lg float" style="animation-delay: -2s;"></div>
    
    <div class="relative z-10 max-w-4xl mx-auto px-4 sm:px-6 lg:px-8 text-center">
        <div class="glass p-12 rounded-3xl breathe" data-aos="fade-up">
            <h1 class="text-5xl md:text-7xl font-bold mb-6 gradient-text">
                🌿 Connect with Nature
            </h1>
            <p class="text-xl md:text-2xl text-white/90 mb-8 max-w-3xl mx-auto leading-relaxed">
                Reach out to our Ayurvedic experts for personalized skincare guidance and support
            </p>
            
            <div class="flex flex-col sm:flex-row gap-6 justify-center items-center">
                <div class="flex items-center space-x-4 text-white/90">
                    <i class="fas fa-phone text-2xl text-secondary-400"></i>
                    <span class="text-lg font-semibold">+1 (555) 123-4567</span>
                </div>
                <div class="flex items-center space-x-4 text-white/90">
                    <i class="fas fa-envelope text-2xl text-secondary-400"></i>
                    <span class="text-lg font-semibold">hello@blizzayurveda.com</span>
                </div>
            </div>
        </div>
    </div>
</section>

<!-- Contact Form & Info Section -->
<section class="py-16 bg-gradient-to-br from-primary-50 to-secondary-50">
    <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8">
        <div class="grid grid-cols-1 lg:grid-cols-2 gap-12">
            <!-- Contact Form -->
            <div class="glass rounded-3xl shadow-xl p-8 border border-primary-200" data-aos="fade-right">
                <div class="mb-8">
                    <h2 class="text-3xl font-bold gradient-text mb-4">Send Us a Message</h2>
                    <p class="text-earth-600 leading-relaxed">
                        Have questions about our Ayurvedic products or need personalized skincare advice? 
                        Our experts are here to help you on your natural beauty journey.
                    </p>
                </div>

                <form id="contactForm" class="space-y-6">
                    @csrf
                    <div class="grid grid-cols-1 md:grid-cols-2 gap-6">
                        <div>
                            <label for="first_name" class="block text-sm font-bold text-earth-700 mb-3">
                                <i class="fas fa-user mr-2 text-primary-600"></i>First Name
                            </label>
                            <input type="text" id="first_name" name="first_name" required
                                   class="w-full px-4 py-3 border-2 border-earth-300 rounded-2xl focus:outline-none focus:ring-2 focus:ring-primary-500 focus:border-primary-500 bg-white transition-all duration-300">
                        </div>
                        
                        <div>
                            <label for="last_name" class="block text-sm font-bold text-earth-700 mb-3">
                                <i class="fas fa-user mr-2 text-primary-600"></i>Last Name
                            </label>
                            <input type="text" id="last_name" name="last_name" required
                                   class="w-full px-4 py-3 border-2 border-earth-300 rounded-2xl focus:outline-none focus:ring-2 focus:ring-primary-500 focus:border-primary-500 bg-white transition-all duration-300">
                        </div>
                    </div>

                    <div>
                        <label for="email" class="block text-sm font-bold text-earth-700 mb-3">
                            <i class="fas fa-envelope mr-2 text-primary-600"></i>Email Address
                        </label>
                        <input type="email" id="email" name="email" required
                               class="w-full px-4 py-3 border-2 border-earth-300 rounded-2xl focus:outline-none focus:ring-2 focus:ring-primary-500 focus:border-primary-500 bg-white transition-all duration-300">
                    </div>

                    <div>
                        <label for="phone" class="block text-sm font-bold text-earth-700 mb-3">
                            <i class="fas fa-phone mr-2 text-primary-600"></i>Phone Number
                        </label>
                        <input type="tel" id="phone" name="phone"
                               class="w-full px-4 py-3 border-2 border-earth-300 rounded-2xl focus:outline-none focus:ring-2 focus:ring-primary-500 focus:border-primary-500 bg-white transition-all duration-300">
                    </div>

                    <div>
                        <label for="subject" class="block text-sm font-bold text-earth-700 mb-3">
                            <i class="fas fa-tag mr-2 text-primary-600"></i>Subject
                        </label>
                        <select id="subject" name="subject" required
                                class="w-full px-4 py-3 border-2 border-earth-300 rounded-2xl focus:outline-none focus:ring-2 focus:ring-primary-500 focus:border-primary-500 bg-white transition-all duration-300">
                            <option value="">Select a subject</option>
                            <option value="product_inquiry">Product Inquiry</option>
                            <option value="skincare_consultation">Skincare Consultation</option>
                            <option value="order_support">Order Support</option>
                            <option value="partnership">Partnership Opportunity</option>
                            <option value="feedback">Feedback & Suggestions</option>
                            <option value="other">Other</option>
                        </select>
                    </div>

                    <div>
                        <label for="message" class="block text-sm font-bold text-earth-700 mb-3">
                            <i class="fas fa-comment mr-2 text-primary-600"></i>Message
                        </label>
                        <textarea id="message" name="message" rows="5" required
                                  class="w-full px-4 py-3 border-2 border-earth-300 rounded-2xl focus:outline-none focus:ring-2 focus:ring-primary-500 focus:border-primary-500 bg-white transition-all duration-300 resize-none"
                                  placeholder="Tell us how we can help you on your Ayurvedic journey..."></textarea>
                    </div>

                    <div class="flex items-center">
                        <input type="checkbox" id="newsletter" name="newsletter" value="1"
                               class="rounded border-earth-300 text-primary-600 focus:ring-primary-500 mr-3">
                        <label for="newsletter" class="text-sm text-earth-700">
                            Subscribe to our newsletter for Ayurvedic tips and exclusive offers
                        </label>
                    </div>

                    <button type="submit" class="w-full btn-3d py-4 text-lg">
                        <i class="fas fa-paper-plane mr-3"></i>Send Message
                    </button>
                </form>
            </div>

            <!-- Contact Information -->
            <div class="space-y-8" data-aos="fade-left">
                <!-- Contact Details -->
                <div class="glass rounded-3xl shadow-xl p-8 border border-secondary-200">
                    <h3 class="text-2xl font-bold gradient-text mb-6">Get in Touch</h3>
                    
                    <div class="space-y-6">
                        <div class="flex items-start space-x-4">
                            <div class="w-12 h-12 bg-gradient-to-r from-primary-500 to-primary-600 rounded-2xl flex items-center justify-center">
                                <i class="fas fa-map-marker-alt text-white text-lg"></i>
                            </div>
                            <div>
                                <h4 class="font-semibold text-earth-800 mb-1">Visit Our Store</h4>
                                <p class="text-earth-600">123 Ayurveda Lane<br>Natural Beauty District<br>Wellness City, WC 12345</p>
                            </div>
                        </div>

                        <div class="flex items-start space-x-4">
                            <div class="w-12 h-12 bg-gradient-to-r from-secondary-500 to-secondary-600 rounded-2xl flex items-center justify-center">
                                <i class="fas fa-phone text-white text-lg"></i>
                            </div>
                            <div>
                                <h4 class="font-semibold text-earth-800 mb-1">Call Us</h4>
                                <p class="text-earth-600">+1 (555) 123-4567<br>Mon-Fri: 9AM-6PM<br>Sat-Sun: 10AM-4PM</p>
                            </div>
                        </div>

                        <div class="flex items-start space-x-4">
                            <div class="w-12 h-12 bg-gradient-to-r from-earth-500 to-earth-600 rounded-2xl flex items-center justify-center">
                                <i class="fas fa-envelope text-white text-lg"></i>
                            </div>
                            <div>
                                <h4 class="font-semibold text-earth-800 mb-1">Email Us</h4>
                                <p class="text-earth-600">hello@blizzayurveda.com<br>support@blizzayurveda.com<br>We reply within 24 hours</p>
                            </div>
                        </div>
                    </div>
                </div>

                <!-- Business Hours -->
                <div class="glass rounded-3xl shadow-xl p-8 border border-earth-200">
                    <h3 class="text-2xl font-bold gradient-text mb-6">
                        <i class="fas fa-clock mr-3 text-primary-600"></i>Business Hours
                    </h3>
                    
                    <div class="space-y-3">
                        <div class="flex justify-between items-center py-2 border-b border-earth-200">
                            <span class="font-semibold text-earth-700">Monday - Friday</span>
                            <span class="text-earth-600">9:00 AM - 6:00 PM</span>
                        </div>
                        <div class="flex justify-between items-center py-2 border-b border-earth-200">
                            <span class="font-semibold text-earth-700">Saturday</span>
                            <span class="text-earth-600">10:00 AM - 4:00 PM</span>
                        </div>
                        <div class="flex justify-between items-center py-2 border-b border-earth-200">
                            <span class="font-semibold text-earth-700">Sunday</span>
                            <span class="text-earth-600">10:00 AM - 4:00 PM</span>
                        </div>
                        <div class="flex justify-between items-center py-2">
                            <span class="font-semibold text-earth-700">Holidays</span>
                            <span class="text-earth-600">Closed</span>
                        </div>
                    </div>
                </div>

                <!-- Social Media -->
                <div class="glass rounded-3xl shadow-xl p-8 border border-primary-200">
                    <h3 class="text-2xl font-bold gradient-text mb-6">
                        <i class="fas fa-share-alt mr-3 text-secondary-600"></i>Follow Us
                    </h3>
                    
                    <div class="flex space-x-4">
                        <a href="#" class="w-12 h-12 bg-gradient-to-r from-blue-500 to-blue-600 rounded-2xl flex items-center justify-center text-white hover:scale-110 transition-transform duration-300">
                            <i class="fab fa-facebook-f"></i>
                        </a>
                        <a href="#" class="w-12 h-12 bg-gradient-to-r from-pink-500 to-pink-600 rounded-2xl flex items-center justify-center text-white hover:scale-110 transition-transform duration-300">
                            <i class="fab fa-instagram"></i>
                        </a>
                        <a href="#" class="w-12 h-12 bg-gradient-to-r from-blue-400 to-blue-500 rounded-2xl flex items-center justify-center text-white hover:scale-110 transition-transform duration-300">
                            <i class="fab fa-twitter"></i>
                        </a>
                        <a href="#" class="w-12 h-12 bg-gradient-to-r from-green-500 to-green-600 rounded-2xl flex items-center justify-center text-white hover:scale-110 transition-transform duration-300">
                            <i class="fab fa-whatsapp"></i>
                        </a>
                        <a href="#" class="w-12 h-12 bg-gradient-to-r from-red-500 to-red-600 rounded-2xl flex items-center justify-center text-white hover:scale-110 transition-transform duration-300">
                            <i class="fab fa-youtube"></i>
                        </a>
                    </div>
                    
                    <p class="text-earth-600 text-sm mt-4">
                        Stay connected for daily Ayurvedic tips, product updates, and wellness inspiration!
                    </p>
                </div>
            </div>
        </div>
    </div>
</section>

<!-- FAQ Section -->
<section class="py-16 bg-white">
    <div class="max-w-4xl mx-auto px-4 sm:px-6 lg:px-8">
        <div class="text-center mb-12" data-aos="fade-up">
            <h2 class="text-4xl font-bold gradient-text mb-4">Frequently Asked Questions</h2>
            <p class="text-earth-600 text-lg">Quick answers to common questions about our Ayurvedic products</p>
        </div>

        <div class="space-y-4" data-aos="fade-up" data-aos-delay="200">
            <div class="glass rounded-2xl border border-primary-200">
                <button class="w-full px-6 py-4 text-left flex items-center justify-between faq-toggle">
                    <span class="font-semibold text-earth-800">What makes your products truly Ayurvedic?</span>
                    <i class="fas fa-chevron-down text-primary-600 transition-transform duration-300"></i>
                </button>
                <div class="faq-content hidden px-6 pb-4">
                    <p class="text-earth-600">Our products are formulated using traditional Ayurvedic principles with authentic herbs and natural ingredients sourced from certified organic farms. Each product is crafted following ancient recipes passed down through generations.</p>
                </div>
            </div>

            <div class="glass rounded-2xl border border-primary-200">
                <button class="w-full px-6 py-4 text-left flex items-center justify-between faq-toggle">
                    <span class="font-semibold text-earth-800">How do I choose the right products for my skin type?</span>
                    <i class="fas fa-chevron-down text-primary-600 transition-transform duration-300"></i>
                </button>
                <div class="faq-content hidden px-6 pb-4">
                    <p class="text-earth-600">We recommend taking our free Ayurvedic skin assessment or consulting with our experts. Based on your dosha (body constitution) and skin concerns, we'll recommend the perfect products for your unique needs.</p>
                </div>
            </div>

            <div class="glass rounded-2xl border border-primary-200">
                <button class="w-full px-6 py-4 text-left flex items-center justify-between faq-toggle">
                    <span class="font-semibold text-earth-800">Are your products suitable for sensitive skin?</span>
                    <i class="fas fa-chevron-down text-primary-600 transition-transform duration-300"></i>
                </button>
                <div class="faq-content hidden px-6 pb-4">
                    <p class="text-earth-600">Yes! Our gentle formulations are designed to be suitable for all skin types, including sensitive skin. We use only natural, non-irritating ingredients and avoid harsh chemicals, parabens, and artificial fragrances.</p>
                </div>
            </div>

            <div class="glass rounded-2xl border border-primary-200">
                <button class="w-full px-6 py-4 text-left flex items-center justify-between faq-toggle">
                    <span class="font-semibold text-earth-800">How long does shipping take?</span>
                    <i class="fas fa-chevron-down text-primary-600 transition-transform duration-300"></i>
                </button>
                <div class="faq-content hidden px-6 pb-4">
                    <p class="text-earth-600">We offer free shipping on orders over $50. Standard shipping takes 3-5 business days, while express shipping takes 1-2 business days. All orders are carefully packaged to ensure your products arrive in perfect condition.</p>
                </div>
            </div>
        </div>
    </div>
</section>

<script>
// Contact form submission
document.getElementById('contactForm').addEventListener('submit', function(e) {
    e.preventDefault();
    
    const submitBtn = this.querySelector('button[type="submit"]');
    const originalText = submitBtn.innerHTML;
    
    // Show loading state
    submitBtn.innerHTML = '<i class="fas fa-spinner fa-spin mr-3"></i>Sending...';
    submitBtn.disabled = true;
    
    // Simulate form submission (replace with actual API call)
    setTimeout(() => {
        // Show success state
        submitBtn.innerHTML = '<i class="fas fa-check mr-3"></i>Message Sent!';
        submitBtn.classList.remove('btn-3d');
        submitBtn.classList.add('bg-green-500', 'hover:bg-green-600');
        
        // Show success toast
        showToast('Thank you! Your message has been sent successfully. We\'ll get back to you within 24 hours.', 'success');
        
        // Reset form
        this.reset();
        
        // Reset button after 3 seconds
        setTimeout(() => {
            submitBtn.innerHTML = originalText;
            submitBtn.disabled = false;
            submitBtn.classList.add('btn-3d');
            submitBtn.classList.remove('bg-green-500', 'hover:bg-green-600');
        }, 3000);
    }, 2000);
});

// FAQ toggle functionality
document.querySelectorAll('.faq-toggle').forEach(button => {
    button.addEventListener('click', function() {
        const content = this.nextElementSibling;
        const icon = this.querySelector('i');
        
        if (content.classList.contains('hidden')) {
            content.classList.remove('hidden');
            icon.style.transform = 'rotate(180deg)';
        } else {
            content.classList.add('hidden');
            icon.style.transform = 'rotate(0deg)';
        }
    });
});

// Toast notification function
function showToast(message, type = 'info') {
    const toast = document.createElement('div');
    toast.className = `fixed top-4 right-4 z-50 glass p-4 rounded-2xl border ${
        type === 'success' ? 'border-green-200 text-green-800' : 'border-primary-200 text-primary-800'
    } transform translate-x-full transition-transform duration-300`;
    
    toast.innerHTML = `
        <div class="flex items-center">
            <i class="fas ${type === 'success' ? 'fa-check-circle' : 'fa-info-circle'} mr-3 text-lg"></i>
            <span class="font-semibold">${message}</span>
        </div>
    `;
    
    document.body.appendChild(toast);
    
    // Animate in
    setTimeout(() => {
        toast.classList.remove('translate-x-full');
    }, 100);
    
    // Remove after 5 seconds
    setTimeout(() => {
        toast.classList.add('translate-x-full');
        setTimeout(() => {
            document.body.removeChild(toast);
        }, 300);
    }, 5000);
}
</script>
@endsection
