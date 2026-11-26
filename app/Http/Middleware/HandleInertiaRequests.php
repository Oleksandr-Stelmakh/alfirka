<?php

namespace App\Http\Middleware;

use App\Models\SiteAnnouncement;
use Illuminate\Http\Request;
use Inertia\Middleware;

class HandleInertiaRequests extends Middleware
{
    /**
     * The root template that's loaded on the first page visit.
     *
     * @see https://inertiajs.com/server-side-setup#root-template
     *
     * @var string
     */
    protected $rootView = 'app';

    /**
     * Determines the current asset version.
     *
     * @see https://inertiajs.com/asset-versioning
     */
    public function version(Request $request): ?string
    {
        return parent::version($request);
    }

    /**
     * Define the props that are shared by default.
     *
     * @return array<string, mixed>
     */
    public function share(Request $request): array
    {
        return array_merge(parent::share($request), [
            'flash' => [
                'success' => fn () => $request->session()->get('success'),
                'error' => fn () => $request->session()->get('error'),
            ],

            'siteAnnouncement' => function () {
                $announcement = SiteAnnouncement::query()
                    ->where('id', 1)
                    ->where('is_enabled', true)
                    ->where('ends_at', '>', now())
                    ->first();

                if (! $announcement) {
                    return null;
                }

                return [
                    'id' => $announcement->id,
                    'message' => $announcement->message,
                    'starts_at' => $announcement->starts_at->toIso8601String(),
                    'ends_at' => $announcement->ends_at->toIso8601String(),
                    'theme' => $announcement->theme,
                    'can_be_closed' => $announcement->can_be_closed,
                    'updated_at' => $announcement->updated_at->toIso8601String(),
                ];
            },
        ]);
    }
}
