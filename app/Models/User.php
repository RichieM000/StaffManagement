<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Notifications\Notifiable;

class User extends Authenticatable
{
    use HasFactory, Notifiable;

    protected $fillable = [
        'fname',
        'lname',
        'gender',
        'age',
        'address',
        'jobrole',
        'kagawad_committee_on',
        'email',
        'phone',
        'password',
    ];

    public function workSchedules()
    {
        return $this->hasMany(WorkSchedule::class);
    }

    public function tasks()
    {
        return $this->hasMany(Task::class, 'assigned_to');
    }

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
   
public function getJobRoleAttribute()
{
    return $this->attributes['jobrole']; // Assuming 'jobrole' is the attribute for job role in your User model
}

public function taskStatuses()
{
    return $this->hasMany(TaskStatus::class);
}

}