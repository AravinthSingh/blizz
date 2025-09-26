//import './bootstrap';
import '../css/app.css';

// Alpine.js initialization (if not using CDN)
// import Alpine from 'alpinejs';
// window.Alpine = Alpine;
// Alpine.start();

// Custom JavaScript for interactive elements
document.addEventListener('DOMContentLoaded', function() {
    // Smooth scroll for anchor links
    document.querySelectorAll('a[href^="#"]').forEach(anchor => {
        anchor.addEventListener('click', function (e) {
            e.preventDefault();
            const target = document.querySelector(this.getAttribute('href'));
            if (target) {
                target.scrollIntoView({
                    behavior: 'smooth',
                    block: 'start'
                });
            }
        });
    });

    // Add hover effects to navigation items
    const navItems = document.querySelectorAll('nav a');
    navItems.forEach(item => {
        item.addEventListener('mouseenter', function() {
            this.style.transform = 'scale(1.05)';
        });
        item.addEventListener('mouseleave', function() {
            this.style.transform = 'scale(1)';
        });
    });
});

// Export any functions that need to be available globally
window.fantaHero = {
    // Function to programmatically change the active product
    changeProduct: function(productId) {
        const item = document.querySelector(`[data-product-id="${productId}"]`);
        if (item) {
            item.click();
        }
    },
    
    // Function to get current active product
    getActiveProduct: function() {
        const activeThumb = document.querySelector('.product-thumb.opacity-100');
        if (activeThumb) {
            return activeThumb.closest('.carousel-item').dataset;
        }
        return null;
    }
};
