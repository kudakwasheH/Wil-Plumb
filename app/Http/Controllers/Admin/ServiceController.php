<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Service;
use Illuminate\Http\Request;
use Illuminate\Support\Str;
use Illuminate\Support\Facades\Storage;

class ServiceController extends Controller
{
    public function index()
    {
        $services = Service::all();
        return view('admin.services.index', compact('services'));
    }

    public function create()
    {
        return view('admin.services.create');
    }

    public function store(Request $request)
    {
        $request->validate([
            'name' => 'required|string|max:100|unique:services,name',
            'description' => 'required|string',
            'price_info' => 'required|string|max:100',
            'icon' => 'required|string|max:50',
            'image' => 'nullable|image|mimes:jpeg,png,jpg,gif,svg|max:2048',
        ]);

        $imagePath = null;
        if ($request->hasFile('image')) {
            $imagePath = $request->file('image')->store('services', 'public');
        }

        Service::create([
            'name' => $request->name,
            'slug' => Str::slug($request->name),
            'description' => $request->description,
            'price_info' => $request->price_info,
            'icon' => $request->icon,
            'image_path' => $imagePath,
            'is_active' => $request->has('is_active'),
        ]);

        return redirect()->route('admin.services.index')->with('success', 'Service created successfully.');
    }

    public function edit(Service $service)
    {
        return view('admin.services.edit', compact('service'));
    }

    public function update(Request $request, Service $service)
    {
        $request->validate([
            'name' => 'required|string|max:100|unique:services,name,' . $service->id,
            'description' => 'required|string',
            'price_info' => 'required|string|max:100',
            'icon' => 'required|string|max:50',
            'image' => 'nullable|image|mimes:jpeg,png,jpg,gif,svg|max:2048',
        ]);

        $imagePath = $service->image_path;
        if ($request->hasFile('image')) {
            if ($imagePath && Storage::disk('public')->exists($imagePath)) {
                Storage::disk('public')->delete($imagePath);
            }
            $imagePath = $request->file('image')->store('services', 'public');
        }

        $service->update([
            'name' => $request->name,
            'slug' => Str::slug($request->name),
            'description' => $request->description,
            'price_info' => $request->price_info,
            'icon' => $request->icon,
            'image_path' => $imagePath,
            'is_active' => $request->has('is_active'),
        ]);

        return redirect()->route('admin.services.index')->with('success', 'Service updated successfully.');
    }

    public function destroy(Service $service)
    {
        if ($service->image_path && Storage::disk('public')->exists($service->image_path)) {
            Storage::disk('public')->delete($service->image_path);
        }
        $service->delete();

        return redirect()->route('admin.services.index')->with('success', 'Service deleted successfully.');
    }
}
