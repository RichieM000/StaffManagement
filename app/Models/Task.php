<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Task extends Model
{
    use HasFactory;

    protected $fillable = ['title', 'description', 'deadline', 'completed', 'jobrole'];

    public function assignedTo()
    {
        return $this->belongsTo(Staff::class, 'assigned_to');
    }
    public function staff()
{
    return $this->belongsToMany(Staff::class, 'staff_task');
}
public function jobRoles()
{
    return explode(',', $this->jobrole);
}
}

