<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Testimonial;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;

class TestimonialController extends Controller
{
    public function index()
    {
        $testimonials = Testimonial::latest()->paginate(15);
        return view('admin.testimonials.index', compact('testimonials'));
    }

    public function create()
    {
        return view('admin.testimonials.create');
    }

    public function store(Request $request)
    {
        $validated = $request->validate([
            'customer_name' => 'required|string|max:255',
            'customer_email' => 'nullable|email|max:255',
            'message' => 'required|string',
            'rating' => 'required|integer|min:1|max:5',
            'customer_image' => 'nullable|image|mimes:jpeg,png,jpg,gif|max:2048',
            'is_approved' => 'boolean'
        ]);

        $validated['is_approved'] = $request->has('is_approved');

        // Handle image upload
        if ($request->hasFile('customer_image')) {
            $filename = 'testimonial_image_' . time() . '.' . $request->file('customer_image')->getClientOriginalExtension();
            $validated['customer_image'] = $request->file('customer_image')->storeAs('testimonials', $filename, 'public');
        }

        Testimonial::create($validated);

        return redirect()->route('admin.testimonials.index')->with('success', 'Testimonial created successfully!');
    }

    public function edit(Testimonial $testimonial)
    {
        return view('admin.testimonials.edit', compact('testimonial'));
    }

    public function update(Request $request, Testimonial $testimonial)
    {
        $validated = $request->validate([
            'customer_name' => 'required|string|max:255',
            'customer_email' => 'nullable|email|max:255',
            'message' => 'required|string',
            'rating' => 'required|integer|min:1|max:5',
            'customer_image' => 'nullable|image|mimes:jpeg,png,jpg,gif|max:2048',
            'is_approved' => 'boolean'
        ]);

        $validated['is_approved'] = $request->has('is_approved');

        // Handle new image upload
        if ($request->hasFile('customer_image')) {
            // Delete old image
            if ($testimonial->customer_image) {
                Storage::disk('public')->delete($testimonial->customer_image);
            }
            
            $filename = 'testimonial_image_' . time() . '.' . $request->file('customer_image')->getClientOriginalExtension();
            $validated['customer_image'] = $request->file('customer_image')->storeAs('testimonials', $filename, 'public');
        }

        $testimonial->update($validated);

        return redirect()->route('admin.testimonials.index')->with('success', 'Testimonial updated successfully!');
    }

    public function destroy(Testimonial $testimonial)
    {
        // Delete testimonial image
        if ($testimonial->customer_image) {
            Storage::disk('public')->delete($testimonial->customer_image);
        }

        $testimonial->delete();

        return redirect()->route('admin.testimonials.index')->with('success', 'Testimonial deleted successfully!');
    }

    public function approve(Testimonial $testimonial)
    {
        $testimonial->update(['is_approved' => true]);
        return redirect()->back()->with('success', 'Testimonial approved successfully!');
    }

    public function disapprove(Testimonial $testimonial)
    {
        $testimonial->update(['is_approved' => false]);
        return redirect()->back()->with('success', 'Testimonial disapproved successfully!');
    }
}
