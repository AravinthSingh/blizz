<?php

namespace App\Http\Controllers;

use App\Models\Product;
use App\Models\Category;
use App\Models\Testimonial;
use Illuminate\Http\Request;

class HomeController extends Controller
{
    public function index()
    {
        $featuredProducts = Product::where('is_active', true)
            ->with('category')
            ->take(5)
            ->get();
        
        $categories = Category::where('is_active', true)->take(6)->get();
        $testimonials = Testimonial::where('is_approved', true)->take(3)->get();
        
        return view('home', compact('featuredProducts', 'categories', 'testimonials'));
    }

    public function about()
    {
        return view('about');
    }

    public function contact()
    {
        return view('contact');
    }
}
