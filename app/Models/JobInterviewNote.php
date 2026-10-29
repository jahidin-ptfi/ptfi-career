<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class JobInterviewNote extends Model
{
    protected $guarded = ['id'];

    public function application()
    {
        return $this->belongsTo(JobApplication::class, 'job_application_id');
    }
}
