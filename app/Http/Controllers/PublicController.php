<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Service;
use App\Models\Project;
use App\Models\Testimonial;
use App\Models\ContactMessage;
use App\Models\ServiceRequest;
use App\Models\Setting;

class PublicController extends Controller
{
    public function home()
    {
        $services = Service::where('is_active', true)->take(3)->get();
        $projects = Project::where('is_featured', true)->take(3)->get();
        $testimonials = Testimonial::where('is_approved', true)->take(5)->get();

        return view('public.home', compact('services', 'projects', 'testimonials'));
    }

    public function services()
    {
        $services = Service::where('is_active', true)->get();
        return view('public.services', compact('services'));
    }

    public function projects(Request $request)
    {
        $category = $request->query('category');
        $query = Project::query();

        if ($category && in_array($category, ['Residential', 'Commercial', 'Emergency'])) {
            $query->where('category', $category);
        }

        $projects = $query->orderBy('completion_date', 'desc')->get();
        $categories = ['All', 'Residential', 'Commercial', 'Emergency'];
        $activeCategory = $category ?: 'All';

        return view('public.projects', compact('projects', 'categories', 'activeCategory'));
    }

    public function testimonials()
    {
        $testimonials = Testimonial::where('is_approved', true)->orderBy('created_at', 'desc')->paginate(10);
        $totalReviews = Testimonial::where('is_approved', true)->count();
        $averageRating = Testimonial::where('is_approved', true)->avg('rating') ?: 5.0;
        $averageRating = round($averageRating, 1);

        return view('public.testimonials', compact('testimonials', 'totalReviews', 'averageRating'));
    }

    public function storeTestimonial(Request $request)
    {
        $validated = $request->validate([
            'customer_name' => 'required|string|max:100',
            'customer_role' => 'nullable|string|max:100',
            'rating' => 'required|integer|min:1|max:5',
            'review' => 'required|string|min:10|max:1000',
        ]);

        Testimonial::create(array_merge($validated, ['is_approved' => false]));

        return back()->with('success', 'Thank you! Your testimonial has been submitted and is awaiting approval by our administrator.');
    }

    public function contact()
    {
        return view('public.contact');
    }

    public function storeContact(Request $request)
    {
        $validated = $request->validate([
            'name' => 'required|string|max:100',
            'email' => 'required|email|max:150',
            'phone' => 'nullable|string|max:20',
            'subject' => 'required|string|max:200',
            'message' => 'required|string|min:10|max:2000',
        ]);

        ContactMessage::create($validated);

        return back()->with('success', 'Your inquiry has been received! Our team will get back to you shortly.');
    }

    public function booking(Request $request)
    {
        $services = Service::where('is_active', true)->get();
        $selectedServiceId = null;

        if ($request->query('service')) {
            $selectedService = Service::where('slug', $request->query('service'))->first();
            if ($selectedService) {
                $selectedServiceId = $selectedService->id;
            }
        }

        return view('public.booking', compact('services', 'selectedServiceId'));
    }

    public function storeBooking(Request $request)
    {
        $validated = $request->validate([
            'customer_name' => 'required|string|max:100',
            'customer_email' => 'required|email|max:150',
            'customer_phone' => 'required|string|max:20',
            'address' => 'required|string|max:255',
            'service_id' => 'required|exists:services,id',
            'preferred_date' => 'required|date|after_or_equal:today',
            'problem_description' => 'required|string|min:10|max:2000',
        ]);

        ServiceRequest::create(array_merge($validated, ['status' => 'pending']));

        return redirect()->route('booking.success');
    }

    public function bookingSuccess()
    {
        return view('public.booking_success');
    }
}
