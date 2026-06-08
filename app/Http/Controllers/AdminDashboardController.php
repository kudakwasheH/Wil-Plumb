<?php

namespace App\Http\Controllers;

use App\Models\Service;
use App\Models\Project;
use App\Models\ServiceRequest;
use App\Models\Testimonial;
use App\Models\ContactMessage;
use Illuminate\Http\Request;

class AdminDashboardController extends Controller
{
    public function index()
    {
        $totalServices = Service::count();
        $totalProjects = Project::count();
        $totalRequests = ServiceRequest::count();
        $pendingRequests = ServiceRequest::where('status', 'pending')->count();
        $completedJobs = ServiceRequest::where('status', 'completed')->count();
        $totalTestimonials = Testimonial::count();
        $totalMessages = ContactMessage::count();
        $unreadMessages = ContactMessage::where('is_read', false)->count();

        $recentRequests = ServiceRequest::with('service')
            ->orderBy('created_at', 'desc')
            ->take(5)
            ->get();

        // 1. Chart.js Data: Monthly Request Volume (Current Year)
        // SQLite compatible grouping by month
        $monthlyData = ServiceRequest::selectRaw("strftime('%m', preferred_date) as month, count(id) as total")
            ->whereRaw("strftime('%Y', preferred_date) = ?", [date('Y')])
            ->groupBy('month')
            ->orderBy('month', 'asc')
            ->pluck('total', 'month')
            ->toArray();

        $monthsMap = [
            '01' => 'Jan', '02' => 'Feb', '03' => 'Mar', '04' => 'Apr', 
            '05' => 'May', '06' => 'Jun', '07' => 'Jul', '08' => 'Aug', 
            '09' => 'Sep', '10' => 'Oct', '11' => 'Nov', '12' => 'Dec'
        ];

        $monthlyChartLabels = [];
        $monthlyChartData = [];

        foreach ($monthsMap as $num => $label) {
            $monthlyChartLabels[] = $label;
            $monthlyChartData[] = $monthlyData[$num] ?? 0;
        }

        // 2. Chart.js Data: Job Status Distribution
        $statusCounts = ServiceRequest::selectRaw('status, count(id) as total')
            ->groupBy('status')
            ->pluck('total', 'status')
            ->toArray();

        $statusLabels = ['Pending', 'In Progress', 'Completed', 'Cancelled'];
        $statusData = [
            $statusCounts['pending'] ?? 0,
            $statusCounts['in_progress'] ?? 0,
            $statusCounts['completed'] ?? 0,
            $statusCounts['cancelled'] ?? 0,
        ];

        return view('admin.dashboard', compact(
            'totalServices',
            'totalProjects',
            'totalRequests',
            'pendingRequests',
            'completedJobs',
            'totalTestimonials',
            'totalMessages',
            'unreadMessages',
            'recentRequests',
            'monthlyChartLabels',
            'monthlyChartData',
            'statusLabels',
            'statusData'
        ));
    }
}
