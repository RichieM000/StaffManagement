<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Task extends Model
{
    use HasFactory;

    protected $fillable = ['title', 'description', 'deadline', 'rejection_reason', 'completed', 'jobrole', 'kagawad_committee_on', 'assigned_to'];
    protected $dates = ['deadline'];

    public function assignedTo()
    {
        return $this->belongsTo(User::class, 'assigned_to');
    }

    public function jobRoles()
    {
        return explode(',', $this->jobrole);
    }

//     public function pendingTasks()
// {
//     $tasks = Task::where('status', 'pending')->latest()->get();

//     return view('admin.tasks.pending', compact('tasks'));
// }

    public function users()
{
    return $this->belongsToMany(User::class, 'staff_task');
}

public function taskStatus()
{
    return $this->hasMany(TaskStatus::class);
}
}