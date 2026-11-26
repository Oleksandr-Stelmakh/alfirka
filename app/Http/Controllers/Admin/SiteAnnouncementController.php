<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\SiteAnnouncement;
use Carbon\Carbon;
use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Request;
use Inertia\Inertia;
use Inertia\Response;

class SiteAnnouncementController extends Controller
{
    /**
     * Show the announcement settings page.
     */
    public function edit(): Response
    {
        $announcement = SiteAnnouncement::query()->find(1);

        return Inertia::render('Admin/Announcements/Edit', [
            'announcement' => $announcement ? [
                'message' => $announcement->message,
                'starts_at' => $announcement->starts_at->format('Y-m-d\TH:i'),
                'ends_at' => $announcement->ends_at->format('Y-m-d\TH:i'),
                'theme' => $announcement->theme,
                'is_enabled' => $announcement->is_enabled,
                'can_be_closed' => $announcement->can_be_closed,
            ] : null,
        ]);
    }

    /**
     * Save announcement settings.
     */
    public function update(Request $request): RedirectResponse
    {
        $validated = $request->validate([
            'message' => ['required', 'string', 'max:2000'],
            'starts_at' => ['required', 'date'],
            'ends_at' => ['required', 'date', 'after:starts_at'],
            'theme' => [
                'required',
                'regex:/^#[0-9A-Fa-f]{6}$/',
            ],
            'is_enabled' => ['required', 'boolean'],
            'can_be_closed' => ['required', 'boolean'],
        ], [
            'message.required' => 'Введіть текст оголошення.',
            'message.max' => 'Текст оголошення не може перевищувати 2000 символів.',
            'starts_at.required' => 'Вкажіть дату та час початку.',
            'starts_at.date' => 'Вкажіть коректну дату початку.',
            'ends_at.required' => 'Вкажіть дату та час завершення.',
            'ends_at.date' => 'Вкажіть коректну дату завершення.',
            'ends_at.after' => 'Дата завершення має бути пізніше дати початку.',
            'theme.required' => 'Оберіть колір оголошення.',
            'theme.regex' => 'Оберіть коректний колір.',
            'is_enabled.required' => 'Вкажіть, чи увімкнене оголошення.',
            'can_be_closed.required' => 'Вкажіть налаштування закриття оголошення.',
        ]);

        $timezone = config('app.timezone', 'Europe/Kyiv');

        SiteAnnouncement::query()->updateOrCreate(
            ['id' => 1],
            [
                'message' => $validated['message'],
                'starts_at' => Carbon::parse($validated['starts_at'], $timezone),
                'ends_at' => Carbon::parse($validated['ends_at'], $timezone),
                'theme' => $validated['theme'],
                'is_enabled' => $validated['is_enabled'],
                'can_be_closed' => $validated['can_be_closed'],
            ],
        );

        return redirect()
            ->route('admin.announcements.edit')
            ->with('success', 'Оголошення успішно збережено.');
    }
}
