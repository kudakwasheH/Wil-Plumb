<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Setting;
use Illuminate\Http\Request;

class SettingController extends Controller
{
    public function index()
    {
        $settings = [
            'site_name' => Setting::get('site_name', 'WIL Plumbing'),
            'site_email' => Setting::get('site_email', 'info@wilplumbing.com'),
            'site_phone' => Setting::get('site_phone', '+263 77 955 2793'),
            'whatsapp_number' => Setting::get('whatsapp_number', '263779552793'),
            'business_address' => Setting::get('business_address', '123 Plumbing Way, Harare'),
            'business_hours' => Setting::get('business_hours', 'Mon - Fri: 8:00 AM - 6:00 PM, Sat: 9:00 AM - 4:00 PM'),
            'hero_title' => Setting::get('hero_title', 'Expert Plumbing Services When You Need Them Most'),
            'hero_subtitle' => Setting::get('hero_subtitle', 'Fast, reliable, and professional residential & commercial plumbing solutions.'),
            'about_content' => Setting::get('about_content', 'At WIL Plumbing, we have provided high-quality plumbing services for over 15 years.'),
        ];

        return view('admin.settings.index', compact('settings'));
    }

    public function update(Request $request)
    {
        $validated = $request->validate([
            'site_name' => 'required|string|max:100',
            'site_email' => 'required|email|max:150',
            'site_phone' => 'required|string|max:50',
            'whatsapp_number' => 'nullable|string|max:20',
            'business_address' => 'required|string|max:255',
            'business_hours' => 'required|string|max:255',
            'hero_title' => 'required|string|max:200',
            'hero_subtitle' => 'required|string|max:500',
            'about_content' => 'required|string|max:2000',
        ]);

        foreach ($validated as $key => $value) {
            Setting::set($key, $value);
        }

        return redirect()->route('admin.settings.index')->with('success', 'Settings updated successfully.');
    }
}
