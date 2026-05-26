<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\ActivityLog;
use App\Models\Post;
use App\Models\Service;
use App\Models\User;
use App\Models\Payment;
use Carbon\Carbon;

class DashboardController extends Controller
{
    public function index()
    {
        $now = Carbon::now();
        $from = $now->copy()->subDays(30)->startOfDay();

        $stats = [
            'users' => User::count(),
            'posts' => Post::count(),
            'services' => Service::count(),
            'payments_total' => (float) Payment::where('status', 'paid')->sum('amount'),
        ];

        $userActivity = User::query()
            ->selectRaw('DATE(created_at) as d, COUNT(*) as c')
            ->where('created_at', '>=', $from)
            ->groupBy('d')
            ->orderBy('d')
            ->get();

        $postActivity = Post::query()
            ->selectRaw('DATE(created_at) as d, COUNT(*) as c')
            ->where('created_at', '>=', $from)
            ->groupBy('d')
            ->orderBy('d')
            ->get();

        $serviceActivity = Service::query()
            ->selectRaw('DATE(created_at) as d, COUNT(*) as c')
            ->where('created_at', '>=', $from)
            ->groupBy('d')
            ->orderBy('d')
            ->get();

        $paymentActivity = Payment::query()
            ->selectRaw('DATE(created_at) as d, SUM(amount) as c')
            ->where('created_at', '>=', $from)
            ->where('status', 'paid')
            ->groupBy('d')
            ->orderBy('d')
            ->get();

        $recentActivity = ActivityLog::query()
            ->with('user')
            ->latest('id')
            ->limit(6)
            ->get();

        $notifications = auth()->user()
            ? auth()->user()->unreadNotifications()->latest()->limit(6)->get()
            : collect();

        return view('admin.dashboard', [
            'stats' => $stats,
            'series' => [
                'users' => $userActivity,
                'posts' => $postActivity,
                'services' => $serviceActivity,
                'payments' => $paymentActivity,
            ],
            'recentActivity' => $recentActivity,
            'notifications' => $notifications,
        ]);
    }
}
