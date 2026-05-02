<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Str;
use App\Models\Url;
use Carbon\Carbon;

class UrlController extends Controller
{
    public function store(Request $request)
    {
        // validation
        $request->validate([
            'url' => 'required|url'
        ]);

        $user = auth()->user();

        // short code generate
        $shortCode = Str::random(6);

        // save in DB
        Url::create([
            'user_id' => $user->id,
            'company_id' => $user->company_id,
            'original_url' => $request->url,
            'short_code' => $shortCode,
            'clicks' => 0,
        ]);

        return back()->with('short_url', url('u/' . $shortCode));
    }

    public function download(Request $request)
    {
        $user = auth()->user();

        $filter = $request->filter;

        $query = Url::query();

        //filter
        if ($filter == 'today') {
            $query->whereDate('created_at', Carbon::today());
        }

        if ($filter == 'week') {
            $query->whereBetween('created_at', [
                Carbon::now()->startOfWeek(),
                Carbon::now()->endOfWeek()
            ]);
        }

        if ($filter == 'month') {
            $query->whereMonth('created_at', Carbon::now()->month);
        }

        // role wise data
        if ($user->hasRole('admin')) {
            $query->where('company_id', $user->company_id);
        }

        if ($user->hasRole('member')) {
            $query->where('user_id', $user->id);
        }

        $urls = $query->latest()->get();

        // CSV generate
        $filename = "urls.csv";

        $headers = [
            "Content-Type" => "text/csv",
            "Content-Disposition" => "attachment; filename=$filename",
        ];

        $callback = function () use ($urls) {
            $file = fopen('php://output', 'w');

            // header row
            fputcsv($file, ['Original URL', 'Short Code', 'Clicks']);

            // data rows
            foreach ($urls as $url) {
                fputcsv($file, [
                    $url->original_url,
                    $url->short_code,
                    $url->clicks
                ]);
            }

            fclose($file);
        };

        return response()->stream($callback, 200, $headers);
    }
}
