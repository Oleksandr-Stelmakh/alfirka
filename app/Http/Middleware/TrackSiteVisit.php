<?php

namespace App\Http\Middleware;

use App\Models\SiteVisit;
use Closure;
use Illuminate\Http\Request;
use Symfony\Component\HttpFoundation\Response;

class TrackSiteVisit
{
    public function handle(
        Request $request,
        Closure $next
    ): Response {
        if (! $request->is('admin/*')) {
            SiteVisit::firstOrCreate([
                'session_id' => $request->session()->getId(),
                'visit_date' => now()->toDateString(),
            ]);
        }

        return $next($request);
    }
}
