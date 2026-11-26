<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class SiteAnnouncement extends Model
{
    protected $fillable = [
        'message',
        'starts_at',
        'ends_at',
        'theme',
        'is_enabled',
        'can_be_closed',
    ];

    protected function casts(): array
    {
        return [
            'starts_at' => 'datetime',
            'ends_at' => 'datetime',
            'is_enabled' => 'boolean',
            'can_be_closed' => 'boolean',
        ];
    }
}
