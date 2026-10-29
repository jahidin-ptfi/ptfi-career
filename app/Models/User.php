<?php

namespace App\Models;

// use Illuminate\Contracts\Auth\MustVerifyEmail;
use Database\Factories\UserFactory;
use Illuminate\Database\Eloquent\Attributes\Fillable;
use Illuminate\Database\Eloquent\Attributes\Hidden;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Notifications\Notifiable;

#[Fillable(['name', 'email', 'password'])]
#[Hidden(['password', 'remember_token'])]

class User extends Authenticatable
{
    /** @use HasFactory<UserFactory> */
    use HasFactory, Notifiable;

    protected $fillable = [
        'name',
        'username',
        'email',
        'password',
        'role',
        'is_active',
    ];

    protected $hidden = [
        'password',
        'remember_token',
    ];

    protected function casts(): array
    {
        return [
            'email_verified_at' => 'datetime',
            'password' => 'hashed',
        ];
    }

    public function profile()
    {
        return $this->hasOne(UserProfile::class);
    }

    public function educations()
    {
        return $this->hasMany(UserEducation::class);
    }

    public function experiences()
    {
        return $this->hasMany(UserExperience::class);
    }

    public function courses()
    {
        return $this->hasMany(UserCourse::class);
    }

    public function skills()
    {
        return $this->hasMany(UserSkill::class);
    }

    public function emergencyContacts()
    {
        return $this->hasMany(UserEmergencyContact::class);
    }

    public function families()
    {
        return $this->hasMany(UserFamily::class);
    }
    public function skill()
    {
        return $this->belongsTo(Skill::class);
    }

    public function applications()
    {
        return $this->hasMany(JobApplication::class);
    }

    public function documents()
    {
        return $this->hasMany(UserDocument::class);
    }
}
