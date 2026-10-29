<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Str;

class JobListing extends Model
{
    protected $guarded = ['id'];

    protected $casts = [
        'badges' => 'array',
        'responsibilities' => 'array',
        'qualifications' => 'array',
        'benefits' => 'array',
        'is_featured' => 'boolean',
        'is_active' => 'boolean',
        'posted_at' => 'datetime',
    ];

    public function getLogoAttribute()
    {
        return $this->logo_initials;
    }

    public function getExcerptAttribute()
    {
        // Menghapus semua tag HTML dan memotongnya menjadi 150 karakter
        return Str::limit(strip_tags($this->description), 150);
    }
}
