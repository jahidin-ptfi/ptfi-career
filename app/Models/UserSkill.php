<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class UserSkill extends Model
{
    //
    protected $guarded = ['id'];

    public function skill()
    {
        return $this->belongsTo(Skill::class, 'skill_id');
    }
}
