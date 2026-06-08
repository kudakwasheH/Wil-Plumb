<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\ServiceRequest;
use Illuminate\Http\Request;

class ServiceRequestController extends Controller
{
    public function index(Request $request)
    {
        $status = $request->query('status');
        $query = ServiceRequest::with('service');

        if ($status && in_array($status, ['pending', 'in_progress', 'completed', 'cancelled'])) {
            $query->where('status', $status);
        }

        $requests = $query->orderBy('created_at', 'desc')->get();
        $activeStatus = $status ?: 'all';

        return view('admin.requests.index', compact('requests', 'activeStatus'));
    }

    public function show(ServiceRequest $request)
    {
        return view('admin.requests.show', ['booking' => $request]);
    }

    public function update(Request $httpRequest, ServiceRequest $request)
    {
        $httpRequest->validate([
            'status' => 'required|in:pending,in_progress,completed,cancelled',
            'admin_notes' => 'nullable|string',
        ]);

        $request->update([
            'status' => $httpRequest->status,
            'admin_notes' => $httpRequest->admin_notes,
        ]);

        return back()->with('success', 'Booking updated successfully.');
    }

    public function destroy(ServiceRequest $request)
    {
        $request->delete();
        return redirect()->route('admin.requests.index')->with('success', 'Booking deleted successfully.');
    }
}
