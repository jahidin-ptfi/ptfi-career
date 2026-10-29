<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use App\Enums\HubunganKeluarga;

class UserFamily extends Model
{
    protected $table = 'user_families';
    protected $guarded = ['id'];

    protected $casts = [
        'hubungan' => HubunganKeluarga::class,
    ];

    public function getHubunganLabelAttribute()
    {
        $value = $this->getRawOriginal('hubungan');
        if (is_null($value) || $value === '') return '-';

        return HubunganKeluarga::tryFrom($value)?->label() ?? $value;
    }

    public function user()
    {
        return $this->belongsTo(User::class);
    }
}
