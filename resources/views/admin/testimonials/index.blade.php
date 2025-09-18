@extends('layouts.admin')

@section('title', 'Testimonials Management')
@section('page-title', 'Testimonials Management')

@section('content')
<div class="mb-6">
    <div class="flex flex-col sm:flex-row sm:items-center sm:justify-between">
        <div class="mb-4 sm:mb-0">
            <h2 class="text-xl font-semibold text-earth-800">Customer Testimonials</h2>
            <p class="text-earth-600">Manage customer reviews and testimonials</p>
        </div>
        
        <div class="flex space-x-3">
            <div class="relative">
                <input type="text" placeholder="Search testimonials..." 
                       class="pl-10 pr-4 py-2 border border-earth-300 rounded-2xl focus:outline-none focus:ring-2 focus:ring-primary-500 bg-white">
                <i class="fas fa-search absolute left-3 top-1/2 transform -translate-y-1/2 text-earth-400"></i>
            </div>
            
            <select class="px-4 py-2 border border-earth-300 rounded-2xl focus:outline-none focus:ring-2 focus:ring-primary-500 bg-white">
                <option value="">All Status</option>
                <option value="approved">Approved</option>
                <option value="pending">Pending</option>
                <option value="rejected">Rejected</option>
            </select>
            
            <button class="btn-3d px-6 py-2" onclick="openCreateModal()">
                <i class="fas fa-plus mr-2"></i>Add Testimonial
            </button>
        </div>
    </div>
</div>

<!-- Testimonials Stats -->
<div class="grid grid-cols-1 md:grid-cols-4 gap-6 mb-8">
    <div class="glass rounded-2xl p-6 border border-green-200">
        <div class="flex items-center">
            <div class="p-3 rounded-full bg-green-500">
                <i class="fas fa-check-circle text-white text-xl"></i>
            </div>
            <div class="ml-4">
                <p class="text-sm font-semibold text-earth-600">Approved</p>
                <p class="text-2xl font-bold text-green-600">{{ $testimonials->where('is_approved', true)->count() }}</p>
            </div>
        </div>
    </div>
    
    <div class="glass rounded-2xl p-6 border border-yellow-200">
        <div class="flex items-center">
            <div class="p-3 rounded-full bg-yellow-500">
                <i class="fas fa-clock text-white text-xl"></i>
            </div>
            <div class="ml-4">
                <p class="text-sm font-semibold text-earth-600">Pending</p>
                <p class="text-2xl font-bold text-yellow-600">{{ $testimonials->where('is_approved', false)->count() }}</p>
            </div>
        </div>
    </div>
    
    <div class="glass rounded-2xl p-6 border border-blue-200">
        <div class="flex items-center">
            <div class="p-3 rounded-full bg-blue-500">
                <i class="fas fa-star text-white text-xl"></i>
            </div>
            <div class="ml-4">
                <p class="text-sm font-semibold text-earth-600">Avg Rating</p>
                <p class="text-2xl font-bold text-blue-600">{{ number_format($testimonials->avg('rating'), 1) }}</p>
            </div>
        </div>
    </div>
    
    <div class="glass rounded-2xl p-6 border border-purple-200">
        <div class="flex items-center">
            <div class="p-3 rounded-full bg-purple-500">
                <i class="fas fa-comments text-white text-xl"></i>
            </div>
            <div class="ml-4">
                <p class="text-sm font-semibold text-earth-600">Total</p>
                <p class="text-2xl font-bold text-purple-600">{{ $testimonials->count() }}</p>
            </div>
        </div>
    </div>
</div>

<!-- Testimonials Grid -->
<div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-3 gap-6">
    @forelse($testimonials as $testimonial)
        <div class="glass rounded-3xl shadow-xl p-6 border border-primary-200 hover:shadow-2xl transition-all duration-300">
            <!-- Header -->
            <div class="flex items-center justify-between mb-4">
                <div class="flex items-center space-x-3">
                    <div class="w-12 h-12 bg-gradient-to-br from-primary-500 to-secondary-500 rounded-full flex items-center justify-center text-white font-bold text-lg">
                        {{ strtoupper(substr($testimonial->customer_name, 0, 1)) }}
                    </div>
                    <div>
                        <h4 class="font-semibold text-earth-800">{{ $testimonial->customer_name }}</h4>
                        <p class="text-sm text-earth-600">{{ $testimonial->customer_email }}</p>
                    </div>
                </div>
                
                <div class="flex items-center space-x-2">
                    @if($testimonial->is_approved)
                        <span class="w-3 h-3 bg-green-500 rounded-full" title="Approved"></span>
                    @else
                        <span class="w-3 h-3 bg-yellow-500 rounded-full" title="Pending"></span>
                    @endif
                    
                    <div class="relative group">
                        <button class="text-earth-400 hover:text-earth-600">
                            <i class="fas fa-ellipsis-v"></i>
                        </button>
                        
                        <div class="absolute right-0 mt-2 w-48 bg-white rounded-2xl shadow-xl border border-earth-200 opacity-0 invisible group-hover:opacity-100 group-hover:visible transition-all duration-200 z-10">
                            <div class="p-2">
                                @if(!$testimonial->is_approved)
                                    <form method="POST" action="{{ route('admin.testimonials.approve', $testimonial) }}" class="w-full">
                                        @csrf
                                        @method('PATCH')
                                        <button type="submit" class="w-full text-left px-3 py-2 text-sm text-green-700 hover:bg-green-50 rounded-lg transition-colors">
                                            <i class="fas fa-check mr-2"></i>Approve
                                        </button>
                                    </form>
                                @else
                                    <form method="POST" action="{{ route('admin.testimonials.disapprove', $testimonial) }}" class="w-full">
                                        @csrf
                                        @method('PATCH')
                                        <button type="submit" class="w-full text-left px-3 py-2 text-sm text-yellow-700 hover:bg-yellow-50 rounded-lg transition-colors">
                                            <i class="fas fa-times mr-2"></i>Disapprove
                                        </button>
                                    </form>
                                @endif
                                
                                <button onclick="editTestimonial({{ $testimonial->id }})" class="w-full text-left px-3 py-2 text-sm text-blue-700 hover:bg-blue-50 rounded-lg transition-colors">
                                    <i class="fas fa-edit mr-2"></i>Edit
                                </button>
                                
                                <form method="POST" action="{{ route('admin.testimonials.destroy', $testimonial) }}" class="w-full" onsubmit="return confirm('Are you sure you want to delete this testimonial?')">
                                    @csrf
                                    @method('DELETE')
                                    <button type="submit" class="w-full text-left px-3 py-2 text-sm text-red-700 hover:bg-red-50 rounded-lg transition-colors">
                                        <i class="fas fa-trash mr-2"></i>Delete
                                    </button>
                                </form>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
            
            <!-- Rating -->
            <div class="flex items-center mb-3">
                @for($i = 1; $i <= 5; $i++)
                    @if($i <= $testimonial->rating)
                        <i class="fas fa-star text-secondary-500"></i>
                    @else
                        <i class="far fa-star text-earth-300"></i>
                    @endif
                @endfor
                <span class="ml-2 text-sm font-semibold text-earth-600">{{ $testimonial->rating }}/5</span>
            </div>
            
            <!-- Message -->
            <div class="mb-4">
                <p class="text-earth-700 leading-relaxed">{{ $testimonial->message }}</p>
            </div>
            
            <!-- Footer -->
            <div class="flex items-center justify-between text-sm text-earth-500">
                <span>{{ $testimonial->created_at->format('M d, Y') }}</span>
                <span>{{ $testimonial->created_at->diffForHumans() }}</span>
            </div>
            
            <!-- Status Badge -->
            <div class="mt-3">
                @if($testimonial->is_approved)
                    <span class="inline-flex px-3 py-1 text-xs font-semibold rounded-full bg-green-100 text-green-800 border border-green-200">
                        <i class="fas fa-check mr-1"></i>Approved
                    </span>
                @else
                    <span class="inline-flex px-3 py-1 text-xs font-semibold rounded-full bg-yellow-100 text-yellow-800 border border-yellow-200">
                        <i class="fas fa-clock mr-1"></i>Pending Review
                    </span>
                @endif
            </div>
        </div>
    @empty
        <div class="col-span-full">
            <div class="glass rounded-3xl shadow-xl p-12 text-center border border-earth-200">
                <i class="fas fa-comments text-4xl text-earth-400 mb-4"></i>
                <h3 class="text-lg font-semibold text-earth-600 mb-2">No Testimonials Found</h3>
                <p class="text-earth-500 mb-6">Customer testimonials will appear here once they start leaving reviews</p>
                <button onclick="openCreateModal()" class="btn-3d px-6 py-3">
                    <i class="fas fa-plus mr-2"></i>Add First Testimonial
                </button>
            </div>
        </div>
    @endforelse
</div>

@if($testimonials->hasPages())
    <div class="mt-8">
        {{ $testimonials->links() }}
    </div>
@endif

<!-- Create/Edit Testimonial Modal -->
<div id="testimonialModal" class="fixed inset-0 bg-black bg-opacity-50 hidden items-center justify-center z-50">
    <div class="glass rounded-3xl p-8 max-w-2xl w-full mx-4 max-h-screen overflow-y-auto">
        <div class="flex items-center justify-between mb-6">
            <h3 class="text-2xl font-bold gradient-text" id="modalTitle">Add New Testimonial</h3>
            <button onclick="closeModal()" class="text-earth-400 hover:text-earth-600">
                <i class="fas fa-times text-xl"></i>
            </button>
        </div>
        
        <form id="testimonialForm" method="POST" action="{{ route('admin.testimonials.store') }}">
            @csrf
            <div id="methodField"></div>
            
            <div class="grid grid-cols-1 md:grid-cols-2 gap-6 mb-6">
                <div>
                    <label for="customer_name" class="block text-sm font-semibold text-earth-700 mb-2">
                        <i class="fas fa-user mr-2 text-primary-600"></i>Customer Name
                    </label>
                    <input type="text" id="customer_name" name="customer_name" required
                           class="w-full px-4 py-3 border border-earth-300 rounded-2xl focus:outline-none focus:ring-2 focus:ring-primary-500 bg-white">
                </div>
                
                <div>
                    <label for="customer_email" class="block text-sm font-semibold text-earth-700 mb-2">
                        <i class="fas fa-envelope mr-2 text-primary-600"></i>Customer Email
                    </label>
                    <input type="email" id="customer_email" name="customer_email" required
                           class="w-full px-4 py-3 border border-earth-300 rounded-2xl focus:outline-none focus:ring-2 focus:ring-primary-500 bg-white">
                </div>
            </div>
            
            <div class="mb-6">
                <label for="rating" class="block text-sm font-semibold text-earth-700 mb-2">
                    <i class="fas fa-star mr-2 text-secondary-600"></i>Rating
                </label>
                <div class="flex items-center space-x-2">
                    @for($i = 1; $i <= 5; $i++)
                        <button type="button" onclick="setRating({{ $i }})" 
                                class="rating-star text-2xl text-earth-300 hover:text-secondary-500 transition-colors">
                            <i class="far fa-star"></i>
                        </button>
                    @endfor
                    <input type="hidden" id="rating" name="rating" value="5">
                    <span class="ml-3 text-sm text-earth-600" id="ratingText">5 Stars</span>
                </div>
            </div>
            
            <div class="mb-6">
                <label for="message" class="block text-sm font-semibold text-earth-700 mb-2">
                    <i class="fas fa-comment mr-2 text-primary-600"></i>Testimonial Message
                </label>
                <textarea id="message" name="message" rows="4" required
                          class="w-full px-4 py-3 border border-earth-300 rounded-2xl focus:outline-none focus:ring-2 focus:ring-primary-500 bg-white"
                          placeholder="Enter the customer's testimonial message..."></textarea>
            </div>
            
            <div class="mb-6">
                <label class="flex items-center">
                    <input type="checkbox" id="is_approved" name="is_approved" value="1" checked
                           class="rounded border-earth-300 text-primary-600 focus:ring-primary-500 mr-3">
                    <span class="text-sm font-semibold text-earth-700">
                        <i class="fas fa-check-circle mr-2 text-green-600"></i>Approve immediately
                    </span>
                </label>
            </div>
            
            <div class="flex justify-end space-x-4">
                <button type="button" onclick="closeModal()" 
                        class="px-6 py-3 text-earth-600 hover:text-earth-800 font-semibold">
                    Cancel
                </button>
                <button type="submit" class="btn-3d px-8 py-3">
                    <i class="fas fa-save mr-2"></i>Save Testimonial
                </button>
            </div>
        </form>
    </div>
</div>

<script>
let currentRating = 5;

function openCreateModal() {
    document.getElementById('modalTitle').textContent = 'Add New Testimonial';
    document.getElementById('testimonialForm').action = '{{ route("admin.testimonials.store") }}';
    document.getElementById('methodField').innerHTML = '';
    document.getElementById('testimonialForm').reset();
    setRating(5);
    document.getElementById('testimonialModal').classList.remove('hidden');
    document.getElementById('testimonialModal').classList.add('flex');
}

function editTestimonial(id) {
    // This would typically fetch testimonial data via AJAX
    document.getElementById('modalTitle').textContent = 'Edit Testimonial';
    document.getElementById('testimonialForm').action = `/admin/testimonials/${id}`;
    document.getElementById('methodField').innerHTML = '@method("PUT")';
    document.getElementById('testimonialModal').classList.remove('hidden');
    document.getElementById('testimonialModal').classList.add('flex');
}

function closeModal() {
    document.getElementById('testimonialModal').classList.add('hidden');
    document.getElementById('testimonialModal').classList.remove('flex');
}

function setRating(rating) {
    currentRating = rating;
    document.getElementById('rating').value = rating;
    document.getElementById('ratingText').textContent = `${rating} Star${rating !== 1 ? 's' : ''}`;
    
    // Update star display
    const stars = document.querySelectorAll('.rating-star i');
    stars.forEach((star, index) => {
        if (index < rating) {
            star.className = 'fas fa-star';
            star.parentElement.classList.remove('text-earth-300');
            star.parentElement.classList.add('text-secondary-500');
        } else {
            star.className = 'far fa-star';
            star.parentElement.classList.add('text-earth-300');
            star.parentElement.classList.remove('text-secondary-500');
        }
    });
}

// Initialize rating display
document.addEventListener('DOMContentLoaded', function() {
    setRating(5);
});

// Close modal when clicking outside
document.getElementById('testimonialModal').addEventListener('click', function(e) {
    if (e.target === this) {
        closeModal();
    }
});
</script>
@endsection
