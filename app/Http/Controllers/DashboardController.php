<?php

namespace App\Http\Controllers;

use App\Models\Company;
use App\Models\Url;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Carbon\Carbon;
use Illuminate\Support\Facades\DB;

class DashboardController extends Controller
{
    public function index(Request $request)
    {
        $user = Auth::user();
        $filter = $request->query('filter');

        // SuperAdmin
        if ($user->hasRole('superadmin')) {

            $companies = Company::withCount('users')
                ->withCount('urls')
                ->withSum('urls', 'clicks')
                ->latest()
                ->paginate(3);

            $urls = Url::with(['user', 'company']);

            if ($filter === 'today') {
                $urls->whereDate('created_at', now()->today());
            } elseif ($filter === 'week') {
                $urls->whereBetween('created_at', [now()->startOfWeek(), now()->endOfWeek()]);
            } elseif ($filter === 'month') {
                $urls->whereMonth('created_at', now()->month);
            }

            $urls = $urls->latest()->paginate(3);

            return view('dashboard.superadmin', compact('companies', 'urls', 'filter'));
        }

        // Admin
        if ($user->hasRole('admin')) {

            $filter = $request->query('filter');

            // Team Members (With Total + Filter)
            $users = User::where('users.company_id', $user->company_id)
                ->leftJoin('urls', function ($join) use ($filter) {
                    $join->on('users.id', '=', 'urls.user_id');

                    // filter apply
                    if ($filter === 'today') {
                        $join->whereDate('urls.created_at', now()->toDateString());
                    } elseif ($filter === 'week') {
                        $join->whereBetween('urls.created_at', [
                            now()->startOfWeek(),
                            now()->endOfWeek()
                        ]);
                    } elseif ($filter === 'month') {
                        $join->whereMonth('urls.created_at', now()->month);
                    }
                })
                ->select(
                    'users.id',
                    'users.name',
                    'users.email',
                    'users.created_at',
                    DB::raw('COUNT(urls.id) as total_urls'),
                    DB::raw('COALESCE(SUM(urls.clicks),0) as total_clicks')
                )
                ->groupBy('users.id', 'users.name', 'users.email', 'users.created_at')
                ->get();

            // Url list (With Filter)
            $urls = Url::with('user')
                ->where('company_id', $user->company_id);

            if ($filter === 'today') {
                $urls->whereDate('created_at', now()->toDateString());
            } elseif ($filter === 'week') {
                $urls->whereBetween('created_at', [
                    now()->startOfWeek(),
                    now()->endOfWeek()
                ]);
            } elseif ($filter === 'month') {
                $urls->whereMonth('created_at', now()->month);
            }

            $urls = $urls->latest()->paginate(3);

            return view('dashboard.admin', compact('users', 'urls', 'filter'));
        }

        // Member
        if ($user->hasRole('member')) {

            $filter = $request->query('filter');

            $urls = Url::with('user')
                ->where('user_id', $user->id);

            if ($filter === 'today') {
                $urls->whereDate('created_at', now()->toDateString());
            } elseif ($filter === 'week') {
                $urls->whereBetween('created_at', [
                    now()->startOfWeek(),
                    now()->endOfWeek()
                ]);
            } elseif ($filter === 'month') {
                $urls->whereMonth('created_at', now()->month);
            }

            $urls = $urls->latest()->paginate(3);

            return view('dashboard.member', compact('urls', 'filter'));
        }

        abort(403);
    }
}
